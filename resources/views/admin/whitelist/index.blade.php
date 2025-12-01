@extends('admin.layout.base')

@section('title', 'White List Request')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

            <h5 class="mb-1">White List Request</h5>
            <button class="btn btn-primary" id="Connect_wallet">Connect Wallet</button>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User</th>
                        <th>Wallet Address</th>
                        <th>Approved</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $value)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->eth_address}}</td>
                        <td>{{$value->approved}}</td>
                        <td>
                            <!-- <a href="{{url('admin/update_whitelist_request',[$value->id,'Confirm'])}}" class="btn btn-primary">Approve</a> -->
                             <button class="btn btn-primary" onclick="SetWhiteList('{{$value->eth_address}}','{{$value->id}}')">Approve</button>
                            <a href="{{url('admin/update_whitelist_request',[$value->id,'Cancel'])}}" class="btn btn-danger">Cancel</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/ethers@5.6.2/dist/ethers.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
    <script>

        function show_message(type='',title='',msg=''){
            var options = { closeButton: true, timeOut: 2000, progressBar: true, allowHtml: true };
            if(type != ''){

                if(type == 'error'){
                    toastr.error(msg,title,options);

                }else if(type == 'success'){
                    toastr.success(msg,title,options);

                }else if(type == 'info'){
                    toastr.info(msg,title,options);

                }else if(type == 'warning'){
                    toastr.warning(msg,title,options);

                }

            }
        }

        const WhiteList = '0x55c1504929D93B245fA1e9DDe2F896266a06c710';
        const WhiteList_ABI = [{"inputs":[{"internalType":"uint256","name":"_initialSupply","type":"uint256"},{"internalType":"string","name":"_name","type":"string"},{"internalType":"string","name":"_symbol","type":"string"},{"internalType":"uint64","name":"_allowedInvestors","type":"uint64"},{"internalType":"uint8","name":"_decimalsPlaces","type":"uint8"},{"internalType":"string","name":"_ShareCertificate","type":"string"},{"internalType":"string","name":"_CompanyHomepage","type":"string"},{"internalType":"string","name":"_CompanyLegalDocs","type":"string"},{"internalType":"address","name":"_atomicSwapContractAddress","type":"address"},{"internalType":"uint64","name":"_tradingHoldingPeriod","type":"uint64"}],"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"uint64","name":"_allowedInvestors","type":"uint64"}],"name":"AllowedInvestorsReset","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"account","type":"address"},{"indexed":false,"internalType":"uint256","name":"amount","type":"uint256"}],"name":"BurnTokens","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"string","name":"_CompanyHomepage","type":"string"}],"name":"CompanyHomepageReset","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"string","name":"_CompanyLegalDocs","type":"string"}],"name":"CompanyLegalDocsReset","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"uint64","name":"_tradingHoldingPeriod","type":"uint64"}],"name":"HoldingPeriodReset","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"amount","type":"uint256"}],"name":"IssuerForceTransfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"account","type":"address"},{"indexed":false,"internalType":"uint256","name":"receiveRestriction","type":"uint256"},{"indexed":false,"internalType":"uint256","name":"sendRestriction","type":"uint256"}],"name":"KYCDataForUserSet","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"account","type":"address"},{"indexed":false,"internalType":"uint256","name":"amount","type":"uint256"}],"name":"MintTokens","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"string","name":"_ShareCertificate","type":"string"}],"name":"ShareCertificateReset","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":true,"internalType":"address","name":"sender","type":"address"},{"indexed":true,"internalType":"address","name":"recipient","type":"address"},{"indexed":false,"internalType":"uint256","name":"amount","type":"uint256"}],"name":"TransferFrom","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"string","name":"message","type":"string"},{"indexed":false,"internalType":"uint8","name":"errorCode","type":"uint8"}],"name":"TransferRestrictionDetected","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"user","type":"address"}],"name":"WhitelistAuthorityStatusRemoved","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"user","type":"address"}],"name":"WhitelistAuthorityStatusSet","type":"event"},{"inputs":[],"name":"CompanyHomepage","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"CompanyLegalDocs","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"IssuancePlatform","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"ShareCertificate","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"allowedInvestors","outputs":[{"internalType":"uint64","name":"","type":"uint64"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address[]","name":"account","type":"address[]"},{"internalType":"uint256","name":"receiveRestriction","type":"uint256"},{"internalType":"uint256","name":"sendRestriction","type":"uint256"}],"name":"bulkWhitelistWallets","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"currentTotalInvestors","outputs":[{"internalType":"uint64","name":"","type":"uint64"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"_from","type":"address"},{"internalType":"address","name":"_to","type":"address"},{"internalType":"uint256","name":"value","type":"uint256"}],"name":"detectTransferRestriction","outputs":[{"internalType":"uint8","name":"status","type":"uint8"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"from","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"forceTransferToken","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"user","type":"address"}],"name":"getKYCData","outputs":[{"internalType":"uint256","name":"","type":"uint256"},{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"user","type":"address"}],"name":"getWhitelistAuthorityStatus","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"issuanceProtocol","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint8","name":"restrictionCode","type":"uint8"}],"name":"messageForTransferRestriction","outputs":[{"internalType":"string","name":"message","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"},{"internalType":"uint256","name":"receiveRestriction","type":"uint256"},{"internalType":"uint256","name":"sendRestriction","type":"uint256"}],"name":"modifyKYCData","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"user","type":"address"}],"name":"removeWhitelistAuthorityStatus","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"renounceOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint64","name":"_allowedInvestors","type":"uint64"}],"name":"resetAllowedInvestors","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"string","name":"_CompanyHomepage","type":"string"}],"name":"resetCompanyHomepage","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"string","name":"_CompanyLegalDocs","type":"string"}],"name":"resetCompanyLegalDocs","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"string","name":"_ShareCertificate","type":"string"}],"name":"resetShareCertificate","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint64","name":"_tradingHoldingPeriod","type":"uint64"}],"name":"setTradingHoldingPeriod","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"user","type":"address"}],"name":"setWhitelistAuthorityStatus","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"tradingHoldingPeriod","outputs":[{"internalType":"uint64","name":"","type":"uint64"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"version","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"}];
        provider = new ethers.providers.JsonRpcProvider('https://sepolia.infura.io/v3/348e7786d20b43dab6b6038d43d85900');
        const WhiteListInstance = new ethers.Contract(WhiteList,WhiteList_ABI,provider);

        $('#Connect_wallet').click(async function(){
            if (typeof window.ethereum == 'undefined') {
                show_message('error','Oops!','Kindly install the metamask extension');
            } else {
                console.log(WhiteListInstance)
                checkUsers();
            }
        })

        async function checkUsers() {
            var address=  await getAccounts();
            if(address==0){
                show_message('error','Oops!','Please choose Admin  Address!');
                return false;
            }
            var networkId = window.ethereum.networkVersion;
            if (networkId != 11155111) {
                show_message('error','Oops!','Please choose ethers sepolia Network!');
                return false;
            }
            $('#Connect_wallet').hide();
            show_message('success','Address connected successfully');
        }

        async function getAccounts() {
            accounts = await ethereum.request({
                method: 'eth_requestAccounts'
            });
            var selectedAccount = window.ethereum.selectedAddress;
            console.log(selectedAccount);
            let approveTxn = await WhiteListInstance.owner().then(function(res) {
                            if(res.toUpperCase()==selectedAccount.toUpperCase()){
                                account = accounts[0];
                                return account;
                            }else{
                                return 0;
                            }
                        }).catch((error) => {
                            console.log(error);
                            show_message('error', 'Oops!', JSON.stringify(error.message))
                            setTimeout  (function() { window.location.reload(); }, 2000);

                        });
                return approveTxn;
        }

        async function SetWhiteList(address, id){
            var provider = new ethers.providers.Web3Provider(window.ethereum);
            var signer = provider.getSigner();

            var WhiteListInstanceWithSigner = WhiteListInstance.connect(signer);

            try {
                let setWhitelist = await WhiteListInstanceWithSigner.setWhitelistAuthorityStatus(address);
                let transaction = await setWhitelist.wait();
                console.log(transaction);
                $.ajax({
                    type: "GET",
                    url: "/admin/update_whitelist_request/"+id+"/Confirm",
                }).done(function(result){
                    if(result == 1){
                        show_message('success', 'Address whitelisted successfully');
                        setTimeout(() => {
                            location.reload();
                        }, 200);
                    }else{
                        show_message('error', 'Try again later');
                    }
                })
            } catch (err) {
                show_message('error', err.message);
            }
        }
    </script>
@endsection
