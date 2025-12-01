@extends('issuer.layout.base')
@section('content')
    <!-- Start Page Content here -->
    <div class="content-page-inner">

        <!-- Header Banner Start -->
        <div class="header-breadcrumbs">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Whitelist Requests</h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="breadcrumb-four" style="text-align: right;">
                            <ul class="breadcrumb">
                                <li><a href="{{ url('issuer/dashboard') }}"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-box">
                                            <path
                                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                            </path>
                                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                        </svg> <span>Dashboard</span></a></li>
                                <li class="active"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-cpu">
                                            <rect x="4" y="4" width="16" height="16" rx="2"
                                                ry="2"></rect>
                                            <rect x="9" y="9" width="6" height="6"></rect>
                                            <line x1="9" y1="1" x2="9" y2="4"></line>
                                            <line x1="15" y1="1" x2="15" y2="4"></line>
                                            <line x1="9" y1="20" x2="9" y2="23"></line>
                                            <line x1="15" y1="20" x2="15" y2="23"></line>
                                            <line x1="20" y1="9" x2="23" y2="9"></line>
                                            <line x1="20" y1="14" x2="23" y2="14"></line>
                                            <line x1="1" y1="9" x2="4" y2="9"></line>
                                            <line x1="1" y1="14" x2="4" y2="14"></line>
                                        </svg> <span>Whitelist Requests</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Banner Start -->

        <div class="header-breadcrumbs">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12" style="text-align:right;">
                        <a href="{{ url('/issuer/whitelist_users') }}" class="btn btn-primary">Whitelisted users</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <!-- Start container-fluid -->
            <div class="container-fluid wizard-border">
                <!-- start  -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <div>
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>User</th>
                                        <th>Wallet address</th>
                                        <th>Property Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($whitelistRequests as $index => $value)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$value->user->name}}</td>
                                        <td>{{$value->wallet_address}}</td>
                                        <td>{{$value->property->propertyName}}</td>
                                        <td>{{$value->status}}</td>
                                        <td>
                                            <!-- <a href="{{ url('issuer/update_whitelist_request', [$value->id, 'Approved']) }}" class="btn btn-success">Approve</a> -->
                                             <button class="btn btn-success action-button" onclick="ApproveInvestor('{{$value->id}}', '{{$value->wallet_address}}')">Approve</button>
                                             <button class="btn btn-danger action-button" onclick="RejectInvestor('{{$value->id}}', '{{$value->user->eth_address}}')">Reject</button>
                                            <!-- <a href="{{ url('issuer/update_whitelist_request', [$value->id, 'null', 'Cancelled']) }}" class="btn btn-danger">Reject</a> -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end content -->
        <!-- Footer Start -->
          <footer class="footer">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="d-flex flex-wrap justify-content-between align-content-center">
                            <ul class="social">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            </ul>
                            <p>Copyright © <script>document.write(new Date().getFullYear());</script> {{ $project_name }}. All rights reserved.</p>
                        </div>
                      </div>
                  </div>
              </div>
          </footer>
        <!-- end Footer -->

    </div>
    <!-- END content-page -->
@endsection
<!-- <script src="{{ asset('js/whitelist.js') }}"></script> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/ethers@5.6.2/dist/ethers.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
<script>
    const Whitelist = '0x55c1504929D93B245fA1e9DDe2F896266a06c710';
    const ABI = [{"inputs":[{"internalType":"uint256","name":"_initialSupply","type":"uint256"},{"internalType":"string","name":"_name","type":"string"},{"internalType":"string","name":"_symbol","type":"string"},{"internalType":"uint64","name":"_allowedInvestors","type":"uint64"},{"internalType":"uint8","name":"_decimalsPlaces","type":"uint8"},{"internalType":"string","name":"_ShareCertificate","type":"string"},{"internalType":"string","name":"_CompanyHomepage","type":"string"},{"internalType":"string","name":"_CompanyLegalDocs","type":"string"},{"internalType":"address","name":"_atomicSwapContractAddress","type":"address"},{"internalType":"uint64","name":"_tradingHoldingPeriod","type":"uint64"}],"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"uint64","name":"_allowedInvestors","type":"uint64"}],"name":"AllowedInvestorsReset","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"account","type":"address"},{"indexed":false,"internalType":"uint256","name":"amount","type":"uint256"}],"name":"BurnTokens","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"string","name":"_CompanyHomepage","type":"string"}],"name":"CompanyHomepageReset","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"string","name":"_CompanyLegalDocs","type":"string"}],"name":"CompanyLegalDocsReset","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"uint64","name":"_tradingHoldingPeriod","type":"uint64"}],"name":"HoldingPeriodReset","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"amount","type":"uint256"}],"name":"IssuerForceTransfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"account","type":"address"},{"indexed":false,"internalType":"uint256","name":"receiveRestriction","type":"uint256"},{"indexed":false,"internalType":"uint256","name":"sendRestriction","type":"uint256"}],"name":"KYCDataForUserSet","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"account","type":"address"},{"indexed":false,"internalType":"uint256","name":"amount","type":"uint256"}],"name":"MintTokens","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"string","name":"_ShareCertificate","type":"string"}],"name":"ShareCertificateReset","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":true,"internalType":"address","name":"sender","type":"address"},{"indexed":true,"internalType":"address","name":"recipient","type":"address"},{"indexed":false,"internalType":"uint256","name":"amount","type":"uint256"}],"name":"TransferFrom","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"string","name":"message","type":"string"},{"indexed":false,"internalType":"uint8","name":"errorCode","type":"uint8"}],"name":"TransferRestrictionDetected","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"user","type":"address"}],"name":"WhitelistAuthorityStatusRemoved","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"user","type":"address"}],"name":"WhitelistAuthorityStatusSet","type":"event"},{"inputs":[],"name":"CompanyHomepage","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"CompanyLegalDocs","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"IssuancePlatform","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"ShareCertificate","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"allowedInvestors","outputs":[{"internalType":"uint64","name":"","type":"uint64"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address[]","name":"account","type":"address[]"},{"internalType":"uint256","name":"receiveRestriction","type":"uint256"},{"internalType":"uint256","name":"sendRestriction","type":"uint256"}],"name":"bulkWhitelistWallets","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"currentTotalInvestors","outputs":[{"internalType":"uint64","name":"","type":"uint64"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"_from","type":"address"},{"internalType":"address","name":"_to","type":"address"},{"internalType":"uint256","name":"value","type":"uint256"}],"name":"detectTransferRestriction","outputs":[{"internalType":"uint8","name":"status","type":"uint8"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"from","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"forceTransferToken","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"user","type":"address"}],"name":"getKYCData","outputs":[{"internalType":"uint256","name":"","type":"uint256"},{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"user","type":"address"}],"name":"getWhitelistAuthorityStatus","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"issuanceProtocol","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint8","name":"restrictionCode","type":"uint8"}],"name":"messageForTransferRestriction","outputs":[{"internalType":"string","name":"message","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"},{"internalType":"uint256","name":"receiveRestriction","type":"uint256"},{"internalType":"uint256","name":"sendRestriction","type":"uint256"}],"name":"modifyKYCData","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"user","type":"address"}],"name":"removeWhitelistAuthorityStatus","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"renounceOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint64","name":"_allowedInvestors","type":"uint64"}],"name":"resetAllowedInvestors","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"string","name":"_CompanyHomepage","type":"string"}],"name":"resetCompanyHomepage","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"string","name":"_CompanyLegalDocs","type":"string"}],"name":"resetCompanyLegalDocs","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"string","name":"_ShareCertificate","type":"string"}],"name":"resetShareCertificate","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint64","name":"_tradingHoldingPeriod","type":"uint64"}],"name":"setTradingHoldingPeriod","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"user","type":"address"}],"name":"setWhitelistAuthorityStatus","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"tradingHoldingPeriod","outputs":[{"internalType":"uint64","name":"","type":"uint64"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"version","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"}];
    provider = new ethers.providers.JsonRpcProvider('https://sepolia.infura.io/v3/348e7786d20b43dab6b6038d43d85900');


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

    async function ApproveInvestor(id, wallet){

        var user = @json($user);
        console.log(user.ETH);
        if(user.ETH < 0.001){
            show_message('error','error','Insufficient ETH balance to whitelist investor.');
            setTimeout(() => {
                location.reload();
            }, 2000);
            return;
        }

        $('.action-button').attr('disabled', true);

        key = '{{$key}}'
        const Signer = new ethers.Wallet(key, provider);
        const WhitelistContract = new ethers.Contract(Whitelist, ABI, Signer);
        const currentEpochTimeInSeconds = Math.floor(Date.now() / 1000);
        // console.log(currentEpochTimeInSeconds);
        var gasPrice = await provider.getGasPrice();
        WhitelistContract.modifyKYCData(wallet, currentEpochTimeInSeconds, currentEpochTimeInSeconds, { gasPrice:gasPrice, gasLimit: 200000 }).then((res)=>{
            console.log(res);
            console.log(res.hash);
            $.ajax({
                type : "GET",
                url : "/issuer/update_whitelist_request/"+id+"/"+res.hash+"/Approved",
            }).done(async function(result){
                if(result == 1){

                    await $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/issuer/withdraw_share/"+id,
                        type: "GET",
                    }).then(async function(res){
                        console.log(res);
                        if(res == 'success'){
                            show_message('success','success','Whitelisted and token transfered successfully');
                        }else if(res == 'Key error'){
                            show_message('error','error','Unable to get key');
                        }else{
                            show_message('error','error','Transaction failed');
                        }
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }).catch((err)=>{
                        console.log(err);
                        show_message('error','error','Something went wrong');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    })
                }else{
                    show_message('error','error','Unable to update the record');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
                return;
            })
        }).catch((err)=>{
            console.log(err);
            show_message('error','Error',err);
            setTimeout(() => {
                location.reload();
            }, 2000);
            return;
        })
    }

    async function RejectInvestor(id,wallet){

        $('.action-button').attr('disabled', true);

        $.ajax({
                type : "GET",
                url : "/issuer/update_whitelist_request/"+id+"/null/Cancelled",
            }).done(function(result){
                if(result == 1){
                    show_message('success','success','Request rejected successfully');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }else{
                    show_message('error','error','Unable to update the record');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
                return;
            })
    }


</script>
