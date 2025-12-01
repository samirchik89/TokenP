$(document).ready(function() {
    // Global updateBalances function that can be called before crypto system is initialized
    let updateBalances = function() {
        // This will be replaced when the crypto system is initialized
        // For now, it's a no-op to prevent errors
    };

    function toggleMetaTransferPanel(){
        if($("#payment_method").val() == 'crypto_transfer'){
            $('.crypto-transfer-container').removeClass('d-none');
        }else{
            $('.crypto-transfer-container').addClass('d-none');
        }
        toggleTransferButton();
    }
    toggleMetaTransferPanel();

    $('#payment_method').on('change', toggleMetaTransferPanel);

    function toggleTransferButton(){
        if($("#payment_method").val() == 'crypto_transfer' && $('#crypto_selector').val()){
            $('#transaction-actions').removeClass('d-none');
            $('.crypto-transfer-container').removeClass('d-none');
        }else{
            $('.crypto-transfer-container').addClass('d-none');
            $('#transaction-actions').addClass('d-none');
        }
        updateBalances();
    }
    toggleTransferButton();
    $('#crypto_selector').on('change', toggleTransferButton);

    // Wait for ethers to be available
    function waitForEthers(callback, maxAttempts = 10) {
        if (typeof ethers !== 'undefined') {
            callback();
        } else if (maxAttempts > 0) {
            setTimeout(() => waitForEthers(callback, maxAttempts - 1), 500);
        } else {
            toastr.error('Failed to load ethers.js library. Please refresh the page.');
            console.error('ethers.js library not loaded');
        }
    }

    waitForEthers(function() {
        initializeCryptoTransfer();
    });

    function initializeCryptoTransfer() {
        let provider = null;
        let signer = null;
        let currentAccount = null;
        let currentNetwork = null;
        let tokenContract = null;

        // Fetch network configurations first
        fetchNetworkConfigs().then(() => {
            console.log('Crypto transfer system initialized with network configs');
        });

        // ERC-20 Token ABI (minimal for transfer)
        const ERC20_ABI = [
            "function name() view returns (string)",
            "function symbol() view returns (string)",
            "function decimals() view returns (uint8)",
            "function totalSupply() view returns (uint256)",
            "function balanceOf(address) view returns (uint256)",
            "function transfer(address to, uint256 amount) returns (bool)",
            "function allowance(address owner, address spender) view returns (uint256)",
            "function approve(address spender, uint256 amount) returns (bool)",
            "event Transfer(address indexed from, address indexed to, uint256 amount)"
        ];

        // Check if MetaMask is installed
        function checkMetaMask() {
            if (typeof window.ethereum !== 'undefined') {
                return true;
            } else {
                toastr.error('MetaMask is not installed. Please install MetaMask to use this feature.');
                return false;
            }
        }

        // Update connection status
        function updateConnectionStatus(connected, account = null) {
            const statusIcon = $('#connection-status-icon i');
            const statusText = $('#connection-status');
            const accountText = $('#connected-account');

            if (connected) {
                statusIcon.removeClass('text-danger').addClass('text-success');
                statusText.val('Connected');
                accountText.val(account);
                $('#connect-metamask').hide();
                $('#disconnect-metamask').show();
                $('#transfer-form').show();
                $('#get-test-token').show(); // Show test token button when connected
            } else {
                statusIcon.removeClass('text-success').addClass('text-danger');
                statusText.val('Not Connected');
                accountText.val('No account connected');
                $('#connect-metamask').show();
                $('#disconnect-metamask').hide();
                $('#transfer-form').hide();
                $('#network-info').hide();
                $('#balance-info').hide();
                $('#get-test-token').hide(); // Hide test token button when disconnected
                $('#test-token-response').hide(); // Hide test token response when disconnected
            }
        }

        // Connect to MetaMask
        $('#connect-metamask').click(async function() {
            if (!checkMetaMask()) return;

            try {
                // Request account access
                const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' });

                if (accounts.length > 0) {
                    currentAccount = accounts[0];

                    // Create provider and signer
                    provider = new ethers.providers.Web3Provider(window.ethereum);
                    signer = provider.getSigner();

                    // Verify signer is properly configured
                    console.log('Provider:', provider);
                    console.log('Signer:', signer);
                    console.log('Current Account:', currentAccount);

                    // Test signer connection
                    try {
                        const signerAddress = await signer.getAddress();
                        console.log('Signer Address:', signerAddress);

                        if (signerAddress.toLowerCase() !== currentAccount.toLowerCase()) {
                            console.warn('Signer address mismatch!');
                        }
                    } catch (signerError) {
                        console.error('Signer error:', signerError);
                        toastr.error('Failed to configure signer: ' + signerError.message);
                        return;
                    }

                    // Get network information
                    const network = await provider.getNetwork();
                    currentNetwork = network;

                    // Update UI
                    updateConnectionStatus(true, currentAccount);
                    updateNetworkInfo(network);
                    updateNetworkValidation(network.chainId);
                    await updateBalances();

                    // Listen for account changes
                    window.ethereum.on('accountsChanged', handleAccountsChanged);
                    window.ethereum.on('chainChanged', handleChainChanged);

                    // Start network state monitoring
                    startNetworkStateCheck();

                    toastr.success('Successfully connected to MetaMask!');
                }
            } catch (error) {
                console.error('Error connecting to MetaMask:', error);
                toastr.error('Failed to connect to MetaMask: ' + error.message);
            }
        });

        // Disconnect from MetaMask
        $('#disconnect-metamask').click(function() {
            currentAccount = null;
            currentNetwork = null;
            provider = null;
            signer = null;
            tokenContract = null;

            // Stop all monitoring
            stopNetworkStateCheck();
            stopNetworkMonitoring();

            updateConnectionStatus(false);
            $('#network-validation').hide();
            toastr.info('Disconnected from MetaMask');
        });

        // Handle account changes
        async function handleAccountsChanged(accounts) {
            if (accounts.length === 0) {
                // MetaMask is locked or user has no accounts
                updateConnectionStatus(false);
                $('#network-validation').hide();
                toastr.warning('Please connect your MetaMask account.');
            } else if (accounts[0] !== currentAccount) {
                // Account changed
                currentAccount = accounts[0];
                updateConnectionStatus(true, currentAccount);
                if (currentNetwork) {
                    updateNetworkValidation(currentNetwork.chainId);
                }
                await updateBalances();
                toastr.info('Account changed to: ' + currentAccount);
            }
        }

        // Force refresh provider and network state
        async function refreshProviderAndNetwork() {
            try {
                if (window.ethereum && provider) {
                    // Force refresh the provider
                    provider = new ethers.providers.Web3Provider(window.ethereum);
                    signer = provider.getSigner();

                    // Get the latest network
                    currentNetwork = await provider.getNetwork();
                    console.log('Provider refreshed, current network:', currentNetwork);

                    // Update UI
                    updateNetworkInfo(currentNetwork);
                    updateNetworkValidation(currentNetwork.chainId);

                    return true;
                }
                return false;
            } catch (error) {
                console.error('Error refreshing provider:', error);
                return false;
            }
        }

        // Handle chain changes
        async function handleChainChanged(chainId) {
            console.log('Chain changed to:', chainId);

            try {
                // Convert chainId to number if it's a hex string
                const numericChainId = typeof chainId === 'string' ? parseInt(chainId, 16) : parseInt(chainId);
                console.log('Numeric chain ID:', numericChainId);

                // Force refresh provider and network state
                const refreshSuccess = await refreshProviderAndNetwork();

                if (!refreshSuccess) {
                    // Fallback: update current network state manually
                    if (provider) {
                        try {
                            currentNetwork = await provider.getNetwork();
                            console.log('Updated current network from provider:', currentNetwork);
                        } catch (providerError) {
                            console.warn('Provider network fetch failed, using chainId from event:', providerError);
                            // Fallback: create a network object from the chainId
                            currentNetwork = {
                                chainId: numericChainId,
                                name: getNetworkName(numericChainId)
                            };
                        }

                        // Update UI with the new network
                        updateNetworkInfo(currentNetwork);
                        updateNetworkValidation(currentNetwork.chainId);

                        // Update balances after network change
                        try {
                            await updateBalances();
                        } catch (balanceError) {
                            console.warn('Failed to update balances after network change:', balanceError);
                        }
                    }
                }

                // Check if the new network is valid for the selected crypto
                const requiredChainId = getRequiredNetwork();
                console.log('Required chain ID:', requiredChainId, 'Current chain ID:', numericChainId);

                if (requiredChainId && numericChainId !== requiredChainId) {
                    toastr.warning(`Network changed to ${getNetworkName(numericChainId)}, but this transaction requires ${getNetworkName(requiredChainId)}. Please switch to the correct network.`);
                } else {
                    toastr.success('Network changed to: ' + getNetworkName(numericChainId));
                }

                // Handle ongoing transactions
                if (window.currentTransaction) {
                    console.log('Network changed during transaction, cancelling...');
                    window.currentTransaction = null;
                    stopNetworkMonitoring();
                    toastr.warning('Network changed during transaction. Please try again.');

                    // Reset UI
                    $('#transaction-status-text').val('Transaction cancelled - network changed');
                    $('#transaction-progress').hide();
                    $('#send-start-transaction').prop('disabled', false);
                }

            } catch (error) {
                console.error('Error handling chain change:', error);
                toastr.error('Error handling network change: ' + error.message);
            }
        }

        // Event handlers for network switching
        $('#switch-network').click(function() {
            const requiredChainId = getRequiredNetwork();
            console.log('Switching to required chain ID:', requiredChainId);

            if (!requiredChainId) {
                toastr.error('Please select a crypto option first to determine the required network.');
                return;
            }

            switchToRequiredNetwork(requiredChainId);
        });

        $('#add-network').click(function() {
            addNetwork();
        });

        // Update network validation when crypto selection changes
        $('#crypto_selector').on('change', function() {
            if (currentNetwork) {
                updateNetworkValidation(currentNetwork.chainId);
            }
        });

        // Update network information
        function updateNetworkInfo(network) {
            $('#network-name').val(getNetworkName(network.chainId));
            $('#chain-id').val(network.chainId);
            $('#network-info').show();
        }

        // Get network name from chain ID
        function getNetworkName(chainId) {
            const networks = {
                1: 'Ethereum Mainnet',
                3: 'Ropsten Testnet',
                4: 'Rinkeby Testnet',
                5: 'Goerli Testnet',
                42: 'Kovan Testnet',
                137: 'Polygon Mainnet',
                80001: 'Mumbai Testnet',
                56: 'BSC Mainnet',
                97: 'BSC Testnet',
                11155111: 'Sepolia Testnet'
            };
            return networks[chainId] || `Chain ID: ${chainId}`;
        }

        // Network configuration for different blockchains
        let networkConfigs = {};

        // Fetch network configurations from backend
        async function fetchNetworkConfigs() {
            try {
                console.log('Fetching network configurations...');
                const response = await fetch('/network-configs');
                const result = await response.json();

                console.log('Network configs response:', result);

                if (result.status === 'success') {
                    networkConfigs = result.data;
                    console.log('Network configurations loaded:', networkConfigs);
                    console.log('Available chain IDs:', Object.keys(networkConfigs));
                } else {
                    console.error('Failed to load network configurations:', result.message);
                }
            } catch (error) {
                console.error('Error fetching network configurations:', error);
                // Fallback to hardcoded configs if API fails
                networkConfigs = {
                    11155111: { // Sepolia
                        chainId: '0xaa36a7',
                        chainName: 'Sepolia Testnet',
                        nativeCurrency: {
                            name: 'Sepolia Ether',
                            symbol: 'SEP',
                            decimals: 18
                        },
                        rpcUrls: ['https://sepolia.infura.io/v3/'],
                        blockExplorerUrls: ['https://sepolia.etherscan.io/']
                    },
                    80001: { // Mumbai
                        chainId: '0x13881',
                        chainName: 'Mumbai Testnet',
                        nativeCurrency: {
                            name: 'MATIC',
                            symbol: 'MATIC',
                            decimals: 18
                        },
                        rpcUrls: ['https://rpc-mumbai.maticvigil.com/'],
                        blockExplorerUrls: ['https://mumbai.polygonscan.com/']
                    }
                };
                console.log('Using fallback network configs:', networkConfigs);
            }
        }

        // Validate network against required network
        function validateNetwork(currentChainId, requiredChainId) {
            return parseInt(currentChainId) === parseInt(requiredChainId);
        }

        // Get required network for selected crypto
        function getRequiredNetwork() {
            const selectedOption = $('#crypto_selector option:selected');
            if (!selectedOption.length || !selectedOption.val()) {
                console.log('No crypto selected');
                return null;
            }

            const cryptoData = selectedOption.data('crypto');
            console.log('Crypto data:', cryptoData);

            if (cryptoData && cryptoData.blockchain && cryptoData.blockchain.chain_id !== undefined) {
                const chainId = parseInt(cryptoData.blockchain.chain_id);
                console.log('Required chain ID:', chainId);
                return chainId;
            }

            console.log('Invalid crypto data structure:', cryptoData);
            return null;
        }

        // Update network validation UI
        function updateNetworkValidation(currentChainId) {
            const requiredChainId = getRequiredNetwork();
            const networkValidation = $('#network-validation');
            const networkAlert = $('#network-alert');
            const networkAlertIcon = $('#network-alert-icon');
            const networkAlertMessage = $('#network-alert-message');
            const networkActions = $('#network-actions');

            if (!requiredChainId) {
                networkValidation.hide();
                return;
            }

            const isValid = validateNetwork(currentChainId, requiredChainId);

            if (isValid) {
                networkValidation.hide();
            } else {
                const currentNetworkName = getNetworkName(currentChainId);
                const requiredNetworkName = getNetworkName(requiredChainId);

                networkAlert.removeClass('alert-warning alert-danger').addClass('alert-warning');
                networkAlertIcon.removeClass('fa-exclamation-triangle fa-times-circle').addClass('fa-exclamation-triangle');
                networkAlertMessage.text(`You are connected to ${currentNetworkName}, but this transaction requires ${requiredNetworkName}.`);

                networkActions.show();
                networkValidation.show();
            }
        }

        // Switch to required network
        async function switchToRequiredNetwork(requiredChainId) {
            console.log('Switching to required chain ID:', requiredChainId);

            if (!requiredChainId) {
                toastr.error('Please select a crypto option first to determine the required network.');
                return;
            }

            const networkConfig = networkConfigs[requiredChainId];
            if (!networkConfig) {
                toastr.error(`Network configuration not found for Chain ID: ${requiredChainId}. Please contact support.`);
                console.error('Missing network config for chain ID:', requiredChainId);
                console.log('Available network configs:', networkConfigs);
                return;
            }

            try {
                // Try to switch to the network
                await window.ethereum.request({
                    method: 'wallet_switchEthereumChain',
                    params: [{ chainId: networkConfig.chainId }]
                });

                toastr.success(`Successfully switched to ${networkConfig.chainName}`);

                // Reload the page to update the connection
                setTimeout(() => {
                    window.location.reload();
                }, 1000);

            } catch (switchError) {
                // This error code indicates that the chain has not been added to MetaMask
                if (switchError.code === 4902) {
                    try {
                        await window.ethereum.request({
                            method: 'wallet_addEthereumChain',
                            params: [networkConfig]
                        });

                        toastr.success(`Successfully added and switched to ${networkConfig.chainName}`);

                        // Reload the page to update the connection
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);

                    } catch (addError) {
                        console.error('Error adding network:', addError);
                        toastr.error('Failed to add network to MetaMask: ' + addError.message);
                    }
                } else {
                    console.error('Error switching network:', switchError);
                    toastr.error('Failed to switch network: ' + switchError.message);
                }
            }
        }

        // Add network manually
        async function addNetwork() {
            const requiredChainId = getRequiredNetwork();
            console.log('Adding network for chain ID:', requiredChainId);

            if (!requiredChainId) {
                toastr.error('Please select a crypto option first to determine the required network.');
                return;
            }

            const networkConfig = networkConfigs[requiredChainId];
            if (!networkConfig) {
                toastr.error(`Network configuration not found for Chain ID: ${requiredChainId}. Please contact support.`);
                console.error('Missing network config for chain ID:', requiredChainId);
                console.log('Available network configs:', networkConfigs);
                return;
            }

            try {
                await window.ethereum.request({
                    method: 'wallet_addEthereumChain',
                    params: [networkConfig]
                });

                toastr.success(`Successfully added ${networkConfig.chainName} to MetaMask`);

                // Reload the page to update the connection
                setTimeout(() => {
                    window.location.reload();
                }, 1000);

            } catch (addError) {
                console.error('Error adding network:', addError);
                toastr.error('Failed to add network to MetaMask: ' + addError.message);
            }
        }

        // Update balances - now in global scope
        updateBalances = async function() {
            if (!provider || !currentAccount) return;

            try {
                // Get ETH balance
                const ethBalance = await provider.getBalance(currentAccount);
                $('#eth-balance').val(ethers.utils.formatEther(ethBalance) + ' ETH');

                // Get token balance if contract is set
                const selectedOption = $('#crypto_selector option:selected');
                const cryptoData = selectedOption.data('crypto');
                console.log(cryptoData,'cryptoData');
                if ($('#crypto_selector').val()) {
                    const tokenAddress = cryptoData.stablecoin.token_address;
                    console.log(tokenAddress,'tokenAddress');
                    if (tokenAddress && ethers.utils.isAddress(tokenAddress)) {
                        try {
                            // Use provider for read-only operations
                            const readContract = new ethers.Contract(tokenAddress, ERC20_ABI, provider);

                            // Add retry logic for rate limiting
                            let balance;
                            let retryCount = 0;
                            const maxRetries = 3;

                            while (retryCount < maxRetries) {
                                try {
                                    balance = await readContract.balanceOf(currentAccount);
                                    break;
                                } catch (error) {
                                    retryCount++;
                                    console.log(`Balance check attempt ${retryCount} failed:`, error.message);

                                    if (error.code === -32005 || error.message.includes('rate limited')) {
                                        if (retryCount < maxRetries) {
                                            console.log(`Rate limited, waiting ${retryCount * 2} seconds before retry...`);
                                            await new Promise(resolve => setTimeout(resolve, retryCount * 2000));
                                            continue;
                                        } else {
                                            throw new Error('Rate limited by RPC provider. Please try again in a few minutes.');
                                        }
                                    } else {
                                        throw error;
                                    }
                                }
                            }

                            console.log('Token Balance:', ethers.utils.formatUnits(balance, cryptoData.stablecoin.decimals));
                            $('#token-balance').val(ethers.utils.formatUnits(balance, cryptoData.stablecoin.decimals) + ' ' + cryptoData.stablecoin.title);
                        } catch (error) {
                            console.error('Error loading token balance:', error);
                            $('#token-balance').val('Error loading token balance');
                        }
                    } else {
                        $('#token-balance').val('No token available');
                    }
                } else {
                    $('#token-balance').val('No tokens available');
                }

                $('#balance-info').show();
            } catch (error) {
                console.error('Error updating balances:', error);
            }
        };

        // Handle pay button clicks
        $(document).on('click', '#send-start-transaction', async function() {
            if (!currentAccount || !provider || !signer) {
                toastr.error('Please connect your MetaMask wallet first');
                return;
            }

            // Validate signer before transfer
            try {
                const signerAddress = await signer.getAddress();
                console.log('Transfer - Signer Address:', signerAddress);
                console.log('Transfer - Current Account:', currentAccount);

                if (signerAddress.toLowerCase() !== currentAccount.toLowerCase()) {
                    console.warn('Signer address mismatch during transfer!');
                    toastr.error('Signer configuration error. Please reconnect your wallet.');
                    return;
                }
            } catch (signerError) {
                console.error('Signer validation error:', signerError);
                toastr.error('Signer not properly configured. Please reconnect your wallet.');
                return;
            }

            if(!$('#crypto_selector').val()){
                toastr.error('Please select a crypto');
                return;
            }
            const selectedOption = $('#crypto_selector option:selected');
            const cryptoData = selectedOption.data('crypto');

            console.log(cryptoData,'cryptoData');
            const tokenAddress = cryptoData.stablecoin.token_address;
            const tokenSymbol = cryptoData.stablecoin.title; //TODO
            const tokenDecimals = cryptoData.stablecoin.decimals; //TODO
            const tokenName = cryptoData.stablecoin.title;
            const tokenChainId = cryptoData.blockchain.chain_id; //TODO
            const recipientAddress = cryptoData.address;
            const amount = $('#total_token_value').data('amount');
            const explorerUrl = cryptoData.blockchain.link;
            console.log(explorerUrl,'explorerUrl');
            // Validate inputs
            if (!tokenAddress || !ethers.utils.isAddress(tokenAddress)) {
                toastr.error('Invalid token address');
                return;
            }

            if (!recipientAddress || !ethers.utils.isAddress(recipientAddress)) {
                toastr.error('Invalid recipient address');
                return;
            }

            if (!amount || parseFloat(amount) <= 0) {
                toastr.error('Invalid amount');
                return;
            }

            // Check if connected to the correct network
            const currentChainId = currentNetwork.chainId;
            const requiredChainId = tokenChainId;

            console.log('Network validation - Current:', currentChainId, 'Required:', requiredChainId);

            // Enhanced network validation
            if (!currentNetwork) {
                toastr.error('No network connection detected. Please reconnect your wallet.');
                return;
            }

            if (currentChainId !== requiredChainId) {
                // Show network validation UI and prevent transaction
                updateNetworkValidation(currentChainId);
                toastr.error(`Please switch to the correct network (${getNetworkName(requiredChainId)}) before proceeding with the transaction.`);
                return;
            }

            // Double-check network before proceeding
            try {
                const latestNetwork = await provider.getNetwork();
                if (latestNetwork.chainId !== requiredChainId) {
                    toastr.error('Network changed during validation. Please refresh and try again.');
                    return;
                }
            } catch (error) {
                console.error('Error validating network:', error);
                toastr.error('Network validation failed. Please reconnect your wallet.');
                return;
            }

            const checkBeforePay = await $.ajax({
                url: '/check-before-pay',
                method: 'POST',
                data: {
                    user_token_id: $('#user_token_id').val(),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json'
            });

            if(checkBeforePay.status === 'error'){
                toastr.error(checkBeforePay.message);
                return;
            }

            try {
                // Set transaction tracking
                window.currentTransaction = {
                    tokenAddress: tokenAddress,
                    recipientAddress: recipientAddress,
                    amount: amount,
                    chainId: requiredChainId,
                    startTime: Date.now()
                };

                // Start network monitoring
                startNetworkMonitoring(requiredChainId);

                // Show transaction status
                $('#transaction-status').show();
                $('#transaction-status-text').val('Preparing transaction...');
                $('#transaction-progress').show();
                $(this).prop('disabled', true);

                console.log('Starting transfer process...');
                console.log('Token Address:', tokenAddress);
                console.log('Recipient Address:', recipientAddress);
                console.log('Amount:', amount);
                console.log('Token Decimals:', tokenDecimals);

                // Create contract instance with signer for transactions
                const transferContract = new ethers.Contract(tokenAddress, ERC20_ABI, signer);
                console.log('Transfer Contract created:', transferContract);

                // Check token balance using provider for read-only
                const readContract = new ethers.Contract(tokenAddress, ERC20_ABI, provider);

                // Add retry logic for rate limiting
                let balance;
                let retryCount = 0;
                const maxRetries = 3;

                while (retryCount < maxRetries) {
                    try {
                        balance = await readContract.balanceOf(currentAccount);
                        break;
                    } catch (error) {
                        retryCount++;
                        console.log(`Balance check attempt ${retryCount} failed:`, error.message);

                        if (error.code === -32005 || error.message.includes('rate limited')) {
                            if (retryCount < maxRetries) {
                                console.log(`Rate limited, waiting ${retryCount * 2} seconds before retry...`);
                                await new Promise(resolve => setTimeout(resolve, retryCount * 2000));
                                continue;
                            } else {
                                throw new Error('Rate limited by RPC provider. Please try again in a few minutes.');
                            }
                        } else if (error.message.includes('cannot estimate gas') || error.message.includes('transaction may fail')) {
                            console.log('Gas estimation failed, using fallback gas limit');
                            gasEstimate = ethers.BigNumber.from('100000'); // 100k gas as fallback
                            break;
                        } else {
                            throw error;
                        }
                    }
                }

                console.log('Token Balance:', ethers.utils.formatUnits(balance, tokenDecimals));

                // Check if user has enough balance
                const transferAmount = ethers.utils.parseUnits(amount.toString(), tokenDecimals);
                console.log('Transfer Amount:', transferAmount.toString());
                console.log('Balance Check:', balance.gte(transferAmount) ? 'Sufficient' : 'Insufficient');

                if (balance.lt(transferAmount)) {
                    throw new Error(`Insufficient token balance. You have ${ethers.utils.formatUnits(balance, tokenDecimals)} ${tokenSymbol}, but trying to transfer ${amount} ${tokenSymbol}`);
                }

                // Estimate gas using read contract with retry
                let gasEstimate;
                retryCount = 0;

                while (retryCount < maxRetries) {
                    try {
                        gasEstimate = await readContract.estimateGas.transfer(recipientAddress, transferAmount);
                        break;
                    } catch (error) {
                        retryCount++;
                        console.log(`Gas estimation attempt ${retryCount} failed:`, error.message);

                        if (error.code === -32005 || error.message.includes('rate limited')) {
                            if (retryCount < maxRetries) {
                                console.log(`Rate limited, waiting ${retryCount * 2} seconds before retry...`);
                                await new Promise(resolve => setTimeout(resolve, retryCount * 2000));
                                continue;
                            } else {
                                throw new Error('Rate limited by RPC provider. Please try again in a few minutes.');
                            }
                        } else if (error.message.includes('cannot estimate gas') || error.message.includes('transaction may fail')) {
                            console.log('Gas estimation failed, using fallback gas limit');
                            gasEstimate = ethers.BigNumber.from('100000'); // 100k gas as fallback
                            break;
                        } else {
                            throw error;
                        }
                    }
                }

                console.log('Gas Estimate:', gasEstimate.toString());

                // Prepare transaction with signer contract
                console.log('Preparing transaction...');

                // Add retry logic for transfer with rate limiting handling
                let tx;
                retryCount = 0;

                while (retryCount < maxRetries) {
                    try {
                        // Calculate gas limit with fallback
                        const gasLimit = gasEstimate ? gasEstimate.mul(120).div(100) : ethers.BigNumber.from('120000'); // 20% buffer or 120k fallback
                        console.log('Using gas limit:', gasLimit.toString());

                        // Add timeout to prevent getting stuck
                        const transferPromise = transferContract.transfer(recipientAddress, transferAmount, {
                            gasLimit: gasLimit
                        });

                        // Set a timeout of 60 seconds
                        const timeoutPromise = new Promise((_, reject) => {
                            setTimeout(() => reject(new Error('Transaction timeout - please try again')), 60000);
                        });

                        tx = await Promise.race([transferPromise, timeoutPromise]);
                        break;

                    } catch (error) {
                        retryCount++;
                        console.log(`Transfer attempt ${retryCount} failed:`, error.message);

                        if (error.code === -32005 || error.message.includes('rate limited')) {
                            if (retryCount < maxRetries) {
                                console.log(`Rate limited, waiting ${retryCount * 3} seconds before retry...`);
                                await new Promise(resolve => setTimeout(resolve, retryCount * 3000));
                                continue;
                            } else {
                                throw new Error('Rate limited by RPC provider. Please try again in a few minutes.');
                            }
                        } else if (error.message.includes('insufficient funds') || error.message.includes('gas required exceeds allowance')) {
                            throw new Error('Insufficient ETH for gas fees. Please add some SEP to your wallet.');
                        } else if (error.message.includes('execution reverted') || error.message.includes('transaction may fail')) {
                            throw new Error('Transaction would fail. Please check your token balance and recipient address.');
                        } else {
                            throw error;
                        }
                    }
                }

                console.log('Transaction sent:', tx.hash);
                console.log('Transaction details:', {
                    hash: tx.hash,
                    from: tx.from,
                    to: tx.to,
                    value: tx.value.toString(),
                    gasLimit: tx.gasLimit.toString(),
                    gasPrice: tx.gasPrice.toString()
                });

                // Update status
                $('#transaction-status-text').val('Transaction sent! Hash: ' + tx.hash);
                $('#transaction-hash').val(tx.hash);

                console.log(explorerUrl,`${explorerUrl}/tx/${tx.hash}`,'explorerUrl');
                // Get the correct explorer URL from the network data
                $('#view-on-etherscan').attr('href', `${explorerUrl}/tx/${tx.hash}`).show();

                // Store transfer data in backend before waiting for confirmation
                const storeResult = await storeTransferData({
                    sender_address: currentAccount,
                    recipient_address: recipientAddress,
                    amount: amount,
                    blockchain_stablecoin_id: selectedOption.val(),
                    transaction_hash: tx.hash,
                    gas_used: null, // Will be updated after confirmation
                    gas_price: tx.gasPrice ? tx.gasPrice.toString() : null,
                    block_number: null, // Will be updated after confirmation
                    user_token_id: $('#user_token_id').val(),
                });

                // Wait for transaction confirmation
                $('#transaction-status-text').val('Waiting for confirmation...');

                const receipt = await tx.wait();
                console.log('Transaction receipt:', receipt);

                if (receipt.status === 1) {
                    $('#transaction-status-text').val('Transaction confirmed!');
                    toastr.success(`${tokenName} payment successful!`);

                    // Update transfer status to completed
                    if (storeResult && storeResult.transfer_id) {
                        await updateTransferStatus(storeResult.transfer_id, 'completed', tx.hash, {
                            gas_used: receipt.gasUsed ? receipt.gasUsed.toString() : null,
                            block_number: receipt.blockNumber ? receipt.blockNumber.toString() : null,
                        });
                    }

                    // Update balances
                    await updateBalances();
                } else {
                    $('#transaction-status-text').val('Transaction failed!');
                    toastr.error('Payment failed!');

                    // Update transfer status to failed
                    if (storeResult && storeResult.transfer_id) {
                        await updateTransferStatus(storeResult.transfer_id, 'failed', tx.hash);
                    }
                }

            } catch (error) {
                console.error('Transfer error:', error);
                $('#transaction-status-text').val('Payment failed: ' + error.message);
                toastr.error('Payment failed: ' + error.message);
            } finally {
                // Clear transaction tracking
                window.currentTransaction = null;
                stopNetworkMonitoring(); // Stop monitoring on completion or error

                // Re-enable button and hide progress
                $(this).prop('disabled', false);
                $('#transaction-progress').hide();

                console.log('Transaction cleanup completed');
            }
        });

        // Monitor network changes during transactions
        let networkMonitor = null;

        function startNetworkMonitoring(requiredChainId) {
            if (networkMonitor) {
                clearInterval(networkMonitor);
            }

            networkMonitor = setInterval(async () => {
                try {
                    if (!provider) return;

                    const currentNetwork = await provider.getNetwork();
                    if (currentNetwork.chainId !== requiredChainId) {
                        console.warn('Network changed during transaction!');
                        clearInterval(networkMonitor);
                        networkMonitor = null;

                        // Clear any ongoing transaction
                        window.currentTransaction = null;

                        toastr.error('Network changed during transaction. Please try again.');

                        // Reset UI
                        $('#transaction-status-text').val('Transaction cancelled - network changed');
                        $('#transaction-progress').hide();
                        $('#send-start-transaction').prop('disabled', false);
                    }
                } catch (error) {
                    console.error('Network monitoring error:', error);
                }
            }, 2000); // Check every 2 seconds
        }

        function stopNetworkMonitoring() {
            if (networkMonitor) {
                clearInterval(networkMonitor);
                networkMonitor = null;
            }
        }

        // Periodic network state check
        let networkStateCheckInterval = null;

        function startNetworkStateCheck() {
            if (networkStateCheckInterval) {
                clearInterval(networkStateCheckInterval);
            }

            networkStateCheckInterval = setInterval(async () => {
                try {
                    if (!provider || !currentNetwork) return;

                    const latestNetwork = await provider.getNetwork();
                    if (latestNetwork.chainId !== currentNetwork.chainId) {
                        console.log('Network state mismatch detected, updating...');
                        console.log('Expected:', currentNetwork.chainId, 'Actual:', latestNetwork.chainId);

                        // Update the current network
                        currentNetwork = latestNetwork;
                        updateNetworkInfo(currentNetwork);
                        updateNetworkValidation(currentNetwork.chainId);

                        // Update balances
                        await updateBalances();

                        toastr.info('Network state updated to: ' + getNetworkName(latestNetwork.chainId));
                    }
                } catch (error) {
                    console.warn('Network state check error:', error);
                }
            }, 5000); // Check every 5 seconds
        }

        function stopNetworkStateCheck() {
            if (networkStateCheckInterval) {
                clearInterval(networkStateCheckInterval);
                networkStateCheckInterval = null;
            }
        }

        // Validate network before critical operations
        async function validateNetworkBeforeOperation(requiredChainId) {
            try {
                if (!provider || !currentNetwork) {
                    throw new Error('No network connection available');
                }

                const latestNetwork = await provider.getNetwork();
                console.log('Network validation - Expected:', requiredChainId, 'Actual:', latestNetwork.chainId);

                if (latestNetwork.chainId !== requiredChainId) {
                    throw new Error(`Network mismatch. Expected: ${getNetworkName(requiredChainId)}, Actual: ${getNetworkName(latestNetwork.chainId)}`);
                }

                return true;
            } catch (error) {
                console.error('Network validation failed:', error);
                toastr.error('Network validation failed: ' + error.message);
                return false;
            }
        }

        // Copy transaction hash
        $('#copy-hash').click(function() {
            const hash = $('#transaction-hash').val();
            if (hash) {
                navigator.clipboard.writeText(hash).then(function() {
                    toastr.success('Transaction hash copied to clipboard!');
                });
            }
        });

        // Global copy to clipboard function
        window.copyToClipboard = function(text) {
            navigator.clipboard.writeText(text).then(function() {
                toastr.success('Copied to clipboard!');
            }).catch(function() {
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = text;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                toastr.success('Copied to clipboard!');
            });
        };

        // Function to store transfer data in backend
        async function storeTransferData(transferData) {
            try {
                const response = await fetch('/crypto/transfer/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify(transferData)
                });

                const result = await response.json();

                if (result.status === 'success') {
                    console.log('Transfer stored successfully:', result.transfer_id);
                    toastr.success('Transfer recorded in database successfully!');
                    return result; // Return the result for use in the transaction handler
                } else {
                    console.error('Failed to store transfer:', result.message);
                    toastr.warning('Transfer completed but failed to record in database: ' + result.message);
                    return null; // Return null or throw an error if needed
                }
            } catch (error) {
                console.error('Error storing transfer data:', error);
                toastr.warning('Transfer completed but failed to record in database. Please contact support.');
                return null; // Return null or throw an error if needed
            }
        }

        // Function to update transfer status in backend
        async function updateTransferStatus(transferId, status, transactionHash, data = {}) {
            try {
                const response = await fetch(`/crypto/transfer/update/${transferId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        status: status,
                        transaction_hash: transactionHash,
                        ...data
                    })
                });

                const result = await response.json();

                if (result.status === 'success') {
                    console.log(`Transfer ${transferId} status updated to ${status}`);
                    toastr.success(`Transfer ${transferId} status updated to ${status}!`);
                } else {
                    console.error('Failed to update transfer status:', result.message);
                    toastr.warning(`Failed to update transfer ${transferId} status: ${result.message}`);
                }
            } catch (error) {
                console.error('Error updating transfer status:', error);
                toastr.warning('Failed to update transfer status. Please contact support.');
            } finally {
                toastr.success('Buy Process completed, Kindly please check the wallet for the token updation');
                setTimeout(() => {
                    window.location.href = '/investment';
                }, 3000);
            }
        }

        // Test Token Functionality
        $('#get-test-token').on('click', function() {
            const $btn = $(this);
            const $response = $('#test-token-response');
            const $alert = $('#test-token-alert');
            const $message = $('#test-token-message');

            // Get connected account address
            const connectedAccount = $('#connected-account').val();

            if (connectedAccount === 'No account connected') {
                showTestTokenResponse('Please connect your MetaMask wallet first.', 'warning');
                return;
            }

            // Disable button and show loading
            $btn.prop('disabled', true);
            $btn.html('<i class="fa fa-spinner fa-spin"></i> Requesting...');

            // Hide previous response
            $response.hide();

            // Make AJAX request to backend
            $.ajax({
                url: '/test-tokens/request', // Update this route as needed
                type: 'POST',
                data: {
                    wallet_address: connectedAccount,
                    blockchain_id: currentNetwork ? currentNetwork.chainId : 1, // Use current network or default to Ethereum mainnet
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 'success') {
                        showTestTokenResponse(
                            'Test tokens sent successfully! Transaction Hash: ' + (response.transaction_hash || 'N/A'),
                            'success'
                        );
                        // Disable button after successful request
                        $btn.prop('disabled', true);
                        $btn.html('<i class="fa fa-check"></i> Tokens Sent');
                    } else {
                        showTestTokenResponse(response.message || 'Failed to send test tokens.', 'danger');
                        // Re-enable button on error
                        $btn.prop('disabled', false);
                        $btn.html('<i class="fa fa-gift"></i> Get Test Token');
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'Failed to request test tokens.';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.status === 422) {
                        errorMessage = 'Validation error. Please check your wallet address.';
                    } else if (xhr.status === 500) {
                        errorMessage = 'Server error. Please try again later.';
                    }

                    showTestTokenResponse(errorMessage, 'danger');

                    // Re-enable button on error
                    $btn.prop('disabled', false);
                    $btn.html('<i class="fa fa-gift"></i> Get Test Token');
                }
            });
        });

        // Function to show test token response
        function showTestTokenResponse(message, type) {
            const $response = $('#test-token-response');
            const $alert = $('#test-token-alert');
            const $message = $('#test-token-message');

            $alert.removeClass().addClass('alert alert-' + type);
            $message.text(message);
            $response.show();

            // Auto-hide after 10 seconds for success messages
            if (type === 'success') {
                setTimeout(function() {
                    $response.fadeOut();
                }, 10000);
            }
        }

        // Initialize
        if (checkMetaMask()) {
            // Check if already connected
            window.ethereum.request({ method: 'eth_accounts' }).then(function(accounts) {
                if (accounts.length > 0) {
                    $('#connect-metamask').click();
                }
            });
        }
    }
});
