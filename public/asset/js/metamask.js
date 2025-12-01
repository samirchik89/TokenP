// const provider = new ethers.providers.JsonRpcProvider('https://bsc-dataseed.binance.org/');
const provider = new ethers.providers.Web3Provider(window.ethereum);
var token = $('#csrf_token').val();
let signer;

function isMobileDevice() {    
    return /Mobi|Android|iPhone|iPad|iPod|Windows Phone|KFAPWI/i.test(navigator.userAgent);
} 
function isSmallScreen() {    
    return window.innerWidth <= 600;
}

$('#WalletConnect').on('click', async function(){
    if (typeof window.ethereum == 'undefined') 
    {        
        if (isMobileDevice() || isSmallScreen()) {        
            window.location.href = 'https://metamask.app.link/dapp/platform.rwa.win';
            return false;
        } else {        
            alert("Please install metamask");
            return false;
        }        
    }else{
        await getAccount().then(async function(account){
            if(account){
                signer = provider.getSigner();
                $('#WalletConnect').text(account)
                console.log(account)
                $('#DepositDiv').show();
            }
        })
        
        var chainId = window.ethereum.chainId;
        console.log(chainId);
        if(chainId != '0xaa36a7'){
            // 0x38
            // 0x61
            await window.ethereum.request({
                method: 'wallet_switchEthereumChain',
                params: [{ chainId: '0xaa36a7' }],
            });
            location.reload();
        }
    }
});

async function getAccount(){
    if(typeof window.ethereum !== 'undefined'){
        const accounts = await ethereum.request({
            method: "eth_requestAccounts",
        });
        const account = accounts[0];
        return account;
    }else{
        if (isMobileDevice() || isSmallScreen()) {        
            window.location.href = 'https://metamask.app.link/dapp/platform.rwa.win';
            return false;
        } else {        
            alert("Please install metamask");
            return false;
        }    
    }
};

$('#DepositFunds').on('click', async function() {
    $('.page-loader').show()
    const ERC20_ABI = [{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}]
        const Asset = document.getElementById('SelectAsset').value;
        const toAddress = document.getElementById('AdminAddress').value;
        const amount = document.getElementById('DepositAmount').value;
        console.log(Asset, toAddress, amount);
        const accounts = await window.ethereum.request({ method: "eth_requestAccounts" });
        const userAddress = accounts[0];
        console.log("connected_address", userAddress);
        console.log(toAddress, amount, Asset);

        if (!toAddress || !amount) {
            $('.page-loader').hide()
            toast('Kindly fill the required details', 'failed');
            return;
        }

        if(Asset == 'USDT'){
            token_address = '0xAE8858D603CcAFb37c0040553C356cf51E4ef6f2';
            decimals = 6;
        }else if(Asset == 'USDC'){
            token_address = '0xa7BD1A3C74e5c3248a7BD65CDb396d2205855F9B';
            decimals = 6;
        }else{
            token_address = '0x5512CF7B063512c5b7BaE60d47318077447Fd3FE';
            decimals = 18;
        }

        const usdcContract = new ethers.Contract(
            token_address,
            ERC20_ABI,
            signer
        );

        try {
            const amountInSmallestUnit = ethers.utils.parseUnits(amount, decimals);
            console.log(amountInSmallestUnit, typeof amountInSmallestUnit)
            const tx = await usdcContract.transfer(toAddress, amountInSmallestUnit);
            await tx.wait();
            console.log('Trx', tx);
            console.log("Transaction hash:", tx.hash);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/deposit_crypto",
                type: "POST",
                data: {
                    hash: tx.hash,
                    coin: Asset,
                    amount : amount,
                    proof : 'Not needed',
                    admin_address : toAddress,
                    type : 'metamask'
                },
            }).done(function(result){
                console.log(result);
                if(result.status == 'success'){
                    $('.page-loader').hide()
                    toast('Deposited successfully', 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                    return;
                }else{
                    $('.page-loader').hide()
                    toast('Try again later', 'failed');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                    return;
                }
            });
        } catch (err) {
            $('.page-loader').hide()
            console.error("Error:", err.message);
            toast(err.message, 'failed');
            setTimeout(() => {
                location.reload();
            }, 2000);
            return;
        }
});

$("#IssuerDepositFunds").on('click', async function() {
    $('.page-loader').show()
    const ERC20_ABI = [{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}]
        const Asset = document.getElementById('SelectAsset').value;
        const toAddress = $('#AdminAddress').val();
        const amount = document.getElementById('DepositAmount').value;
        const accounts = await window.ethereum.request({ method: "eth_requestAccounts" });
        const userAddress = accounts[0];
        console.log("connected_address", userAddress);
        console.log(toAddress, amount, Asset)

        if (!toAddress || !amount) {
            $('.page-loader').hide()
            toastr.error('Kindly fill the required details');
            return;
        }

        if(Asset == 'USDT'){
            token_address = '0xAE8858D603CcAFb37c0040553C356cf51E4ef6f2';
            decimals = 6;
        }else if(Asset == 'USDC'){
            token_address = '0xa7BD1A3C74e5c3248a7BD65CDb396d2205855F9B';
            decimals = 6;
        }else{
            token_address = '0x5512CF7B063512c5b7BaE60d47318077447Fd3FE';
            decimals = 18;
        }
        
        const usdcContract = new ethers.Contract(
            token_address,
            ERC20_ABI,
            signer
        );

        try {
            const amountInSmallestUnit = ethers.utils.parseUnits(amount, decimals);
            console.log(amountInSmallestUnit, typeof amountInSmallestUnit)
            const tx = await usdcContract.transfer(toAddress, amountInSmallestUnit);
            await tx.wait();
            console.log('Trx', tx);
            console.log("Transaction hash:", tx.hash);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/issuer/deposit_crypto",
                type: "POST",
                data: {
                    hash: tx.hash,
                    coin: Asset,
                    amount : amount,
                    proof : 'Not needed',
                    admin_address : toAddress,
                    type : 'metamask'
                },
            }).done(function(result){
                console.log(result);
                if(result.status == 'success'){
                    $('.page-loader').hide()
                    toastr.success('Deposited successfully')
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                    return;
                }else{
                    $('.page-loader').hide()
                    toastr.error('Try again later');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                    return;
                }
            });
        } catch (err) {
            $('.page-loader').hide()
            console.error("Error:", err.message);
            toastr.error(err.message)
            setTimeout(() => {
                location.reload();
            }, 2000);
            return;
        }
});

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
  //   alert.slideDown();
  //     window.setTimeout(function() {
  //       alert.slideUp();
  //     }, 2500);
  toastr.error(err.message)
  }

function toast(message, status) {
    if (status == 'success') {
        Toastify({
            text: message,
            close: true,
            position: "right",
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
        }).showToast();
    }
    else {
        Toastify({
            text: message,
            close: true,
            position: "right",
            style: {
                background: "linear-gradient(to right, #D62121, #C72C2C)",
            },
        }).showToast();
    }
}