@extends('admin.layout.base')

@section('title', 'Add User ')

@section('content')

<style>
.d-none{display: none !important;}
.d-block{display: block !important;}
.mt-2{margin-bottom: 10px;
  margin-top: 10px;}

  .mb-4{margin-top: 2em; margin-bottom: 4em;}
  .file-input {
    background-color: #f7f7f7;
    padding: 10px;
    margin-bottom: 10px;
    display: -webkit-box;
  }
  p.file-success {
    text-align: center;
    margin-top: 30px;
    background-color: #4CAF50;
    display: -webkit-inline-box;
    padding: 10px;
    width: 35px;
    border-radius: 30px;
    color: #fff;
  }
  .modal-backdrop.fade {
    filter: alpha(opacity=0);
    opacity: .6 !important;
}




/* Loader 3 */
.loader-3 {
 display: block;
 z-index: 10000;
 height: 60px;
 width: 60px;
 margin: 0 auto;
}
.loader-3 span {
display: block;
position: absolute;
top: 0;
left: 0;
/* bottom: 0; */
right: 0;
top: 40%;
margin: auto;
height: 32px;
width: 32px;
}
.loader-3 span::before {
content: "";
display: block;
position: absolute;
top: 0;
left: 0;
bottom: 0;
z-index: 10000;
right: 0;
margin: auto;
height: 60px;
width: 60px;
border: 5px solid #3d9be9;
border-bottom: 5px solid transparent;
border-radius: 50%;
-webkit-animation: loader-3-1 1.5s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
animation: loader-3-1 1.5s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
}
@-webkit-keyframes loader-3-1 {
0%   { -webkit-transform: rotate(0deg); }
40%  { -webkit-transform: rotate(180deg); }
60%  { -webkit-transform: rotate(180deg); }
100% { -webkit-transform: rotate(360deg); }
}
@keyframes loader-3-1 {
0%   { transform: rotate(0deg); }
40%  { transform: rotate(180deg); }
60%  { transform: rotate(180deg); }
100% { transform: rotate(360deg); }
}
.loader-3 span::after {
content: "";
position: absolute;
top: 0;
left: 25px;
z-index: 1050;
bottom: 0;
right: 0;
margin: auto;
width: 10px;
height: 10px;
background: #3d9be9;
border-radius: 50%;
-webkit-animation: loader-3-2 1.5s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
animation: loader-3-2 1.5s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
}
@-webkit-keyframes loader-3-2 {
0%   { -webkit-transform: translate3d(0, -32px, 0) scale(0, 2); opacity: 0; }
50%  { -webkit-transform: translate3d(0, 0, 0) scale(1.25, 1.25); opacity: 1; }
100% { -webkit-transform: translate3d(0, 8px, 0) scale(0, 0); opacity: 0; }
}
@keyframes loader-3-2 {
0%   { transform: translate3d(0, -32px, 0) scale(0, 2); opacity: 0; }
50%  { transform: translate3d(0, 0, 0) scale(1.25, 1.25); opacity: 1; }
100% { transform: translate3d(0, 8px, 0) scale(0, 0); opacity: 0; }
}
</style>
<div class="content-area py-1">
  <div class="container-fluid">
    <div class="box box-block bg-white">
      <a href="{{ route('admin.tokenizerindex') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

      <h5 style="margin-bottom: 2em;">Add Token</h5>

      
      <form  method="POST" enctype="multipart/form-data" role="form" id="contractform_data">
        {{csrf_field()}}
        <div class="row mt-2 adddetail">
          <div class="col-md-10 col-md-offset-1 ">
            <h5  class="mb-2">Reward Token Step 1</h5>
            <div class="row">
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" class="form-control" id="tokenname" placeholder="" name="tokenname" required="">
                  <span id="name_error" class="error"></span>
                </div>
                <div class="form-group">
                  <label for="">Symbol Name</label>
                  <input type="text" class="form-control" id="tokensymbol" placeholder="" name="tokensymbol" required="">
                  <span id="email_error" class="error"></span>
                </div>  
                <div class="form-group">
                  <label for="">Token Value (USD)</label>
                  <input type="number" class="form-control" id="tokenvalue" placeholder="" name="tokenvalue" required="">
                  <span id="privacy_error" class="error"></span>
                </div> 
                <div class="form-group">
                  <label for="">Token Supply</label>
                  <input type="number" class="form-control" id="tokensupply" placeholder="" name="tokensupply" required="">
                  <span id="terms_error" class="error"></span>
                </div>
                <div class="form-group">
                  <label for="">Decimal</label>
                  <input type="number" class="form-control" id="decimal" placeholder="" name="decimal" required="">
                  <span id="decimal_error" class="error"></span>
                </div>
                <div class="form-group">
                  <label for="">Token Image</label>
                  <input type="file" class="form-control" id="token_image" placeholder="" name="token_image" required="">
                  <span id="token_error" class="error"></span>
                </div>

                <div class="form-group">
                  <label for="">Title</label>
                  <input type="text" class="form-control" id="title" placeholder="" name="title" required="">
                  <span id="title_error" class="error"></span>
                </div>

                <div class="form-group">
                  <label for="">Content</label>
                  <textarea class="form-control" id="content" placeholder="" name="content" required=""> </textarea>
                  <span id="content_error" class="error"></span>
                </div>

                <div class="form-group">
                  <label for="">Token Banner</label>
                  <input type="file" class="form-control" id="banner_image" placeholder="" name="banner_image" required="">
                  <span id="banner_error" class="error"></span>
                </div>

              </div>
            </div>


            <div class="row mt-3">              
              <!-- <div class="col-md-4">
                <button type="button" class="btn btn-info cmn-btn  btn-contue">Save as Draft</button>
              </div> -->
              <div class="col-md-4">
                <button type="button" class="btn btn-primary cmn-btn btn-contue">Continue <i class="fa fa-arrow-right"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-2 addtotal d-none">
          <div class="col-md-7 col-md-offset-1">
            <h5  class="mb-2">Step 2</h5>
            <div class="row">
              <div class="col-md-12 col-12">
                <div class="form-row file-input">
                  <div class="col-md-9 form-group ">
                    <label for="exampleInputFile">Acquistion</label>
                    <input type="file" id="acquistion" name="acquistion" required="">
                    <span id="acquistionl_error" class="error"></span>
                    <p class="help-block">Example block-level help text here.</p>
                  </div>
                  <div class="col-md-3"><div ><p class="file-success" id="file-1" style="display:none"> <i class="fa fa-1x fa-check" aria-hidden="true"></i>
                  </p></div></div>
                </div>
                <div class="form-row file-input">
                  <div class="col-md-9 form-group ">
                    <label for="exampleInputFile">Usage</label>
                    <input type="file" id="usage" name="usage" required="">
                    <span id="usage_error" class="error"></span>
                    <p class="help-block">Example block-level help text here.</p>
                  </div>
                  <div class="col-md-3"><div ><p class="file-success" id="file-2" style="display:none"> <i class="fa fa-1x fa-check" aria-hidden="true"></i>
                  </p></div></div>
                </div>
                <div class="form-row file-input">
                  <div class="col-md-9 form-group ">
                    <label for="exampleInputFile">Redemption</label>
                    <input type="file" id="redemption" name="redemption" required="">
                    <span id="redemption_error" class="error"></span>
                    <p class="help-block">Example block-level help text here.</p>
                  </div>
                  <div class="col-md-3"><div ><p class="file-success" id="file-3" style="display:none"> <i class="fa fa-1x fa-check" aria-hidden="true"></i>
                  </p></div></div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="row mt-3">
                <div class="col-md-4">
                  <button type="button" class="btn btn-warning cmn-btn step2back"><i class="fa fa-arrow-left"></i> Back</button>
                </div>
                
                <!-- <div class="col-md-4">
                  <button type="button" class=" btn btn-info cmn-btn">Save as Draft</button>
                </div> -->

                <div class="col-md-4">
                  <button type="button" class="btn btn-primary cmn-btn step2contue">Continue <i class="fa fa-arrow-right"></i></button>
                </div>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <h5 class="mb-2">Step 2</h5>
            <h6>1.Acquistion</h6>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
            <h6>2.Usage</h6>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
            <h6>3.Redemption</h6>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>

          </div>
        </div>
        <div class="row mt-2 choosepatment d-none">
          <div class="col-md-10 col-md-offset-1">
            <div class="row">
              <div class="col-md-6 mb-4">
                <button type="button" class="btn btn-success cmn-btn" id="check_bal">Create Token</button>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col-md-4">
                <button type="button" class="btn btn-warning cmn-btn chooseback-btn"><i class="fa fa-arrow-left"></i> Back</button>
              </div>

            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="loader_div" class="loader-div" style="display:none">
  <div class="loader-inner-div">
    <img src="{{asset('/img/loader.gif')}}" />
  </div>
</div>
@endsection  
    
@section('scripts')
  <script type="text/javascript" src="{{ asset('js/ethereumjs-tx-1.3.3.min.js')}}"></script>
  <script src="{{ asset('js/web3.min.js') }}"></script> 

  <script>
    	$(document).ready(function() {

        $('.btn-contue').click(function() {

          $('.error').html('');

          var tokenname=$('#tokenname').val();
          var tokensymbol=$('#tokensymbol').val();
          var tokenvalue=$('#tokenvalue').val();
          var tokensupply=$('#tokensupply').val();
          var decimal = $("#decimal").val();
          var token_image = $("#token_image").val();
          var title = $("#title").val();
          var content = $("#content").val();
          var banner_image = $("#token_image").val();

          if(tokenname!="" && tokensymbol!="" && tokenvalue !="" && tokensupply != "" && decimal != "" && token_image != "" && title != "" && content != "" && banner_image != ""){
            
                        
            $('.adddetail').addClass('d-none');            
            $('.addtotal').addClass('d-block').removeClass('d-none').fadeIn(500);

          }else{

            if(tokenname==""){
              $("#name_error").html('This field is required');
            }

            if(tokensymbol==""){
              $("#email_error").html('This field is required');
            }

            if(tokenvalue == ""){
              $("#privacy_error").html('This field is required');
            } 

            if(tokensupply == ""){
              $("#terms_error").html('This field is required');
            }

            if(decimal == ""){
              $("#decimal_error").html('This field is required');
            }

            if(token_image == ""){
              $("#token_error").html("This field is required");
            }
            
            if(title == ""){
              $("#title_error").html("This field is required");
            }
            
            //if(content == ""){
            //if ($.trim(content).length > 0){
            if (!$.trim(content)) {
              $("#content_error").html("This field is required");
            }
            

            if(banner_image == ""){
              $("#banner_error").html("This field is required");
            }
          }          
        });
        
        /**
         * Script for Upload Image Tick show and hide
         */

        $("#acquistion").change(function(){
           if($(this).val() != "")
           {
             $("#file-1").css("display", "block");
           }
           else
           {
             $("#file-1").css("display", "none");
           }
        });

        $("#usage").change(function(){
           if($(this).val() != "")
           {
             $("#file-2").css("display", "block");
           }
           else
           {
             $("#file-2").css("display", "none");
           }
        });

        $("#redemption").change(function(){
           if($(this).val() != "")
           {
             $("#file-3").css("display", "block");
           }
           else
           {
             $("#file-3").css("display", "none");
           }
        });

        $('.step2back').click(function() {
           $('.adddetail').removeClass('d-none').fadeIn(500);
           $('.addtotal').addClass('d-none').removeClass('d-block');
        });

        $('.step2contue').click(function() {

           var acquistion=$('#acquistion').val();
           var usage=$('#usage').val();
           var redemption=$('#redemption').val();
            //alert(acquistion);
            if(acquistion!= "" && usage!= "" && redemption != ""){
              $('.addtotal').addClass('d-none').removeClass('d-block');
              $('.choosepatment').addClass('d-block').removeClass('d-none').fadeIn(500);
            }else{
              if(acquistion=== ""){
                $("#acquistionl_error").html('This field is required');
              }

              if(usage === ""){
                $("#usage_error").html('This field is required');
              } 

              if(redemption === ""){
                $("#redemption_error").html('This field is required');
              }
            }
        });

        $('.chooseback-btn').click(function() {
           $('.addtotal').addClass('d-block').removeClass('d-none').fadeIn(500);
           $('.choosepatment').addClass('d-none').removeClass('d-block');
        });

      });


      $("#check_bal").click(function(){

        var tokenname=$('#tokenname').val();
        var tokensymbol=$('#tokensymbol').val();
        var tokenvalue=$('#tokenvalue').val();
        var tokensupply=$('#tokensupply').val();
        var acquistion=$('#acquistion').val();
        var redemption=$('#redemption').val();
        var usage=$('#usage').val();
        var decimal=$('#decimal').val();
        var token_image=$('#token_image').val();
        var title = $("#title").val();
        var content = $("#content").val();
        var banner_image = $("#token_image").val();


        $( "<div class='modal-backdrop fade show'></div>" ).insertBefore( ".footer" );
        $('.loader-3').css('display','block');

        var formData = new FormData($('#contractform_data')[0] );

        // alert(formData);
        
        $.ajax({

          url: "{{url('/admin/contractcreate')}}",
          type: "POST",

          // data:{'tokenname':tokenname,'tokensymbol':tokensymbol,'tokenvalue':tokenvalue,'tokensupply':tokensupply,'acquistion':acquistion,'usage':usage,'redemption':redemption,'decimal':decimal,'token_image':token_image, "_token": "{{ csrf_token() }}"},

          data : formData,
          headers: {
           'X-CSRF-TOKEN': '{{ csrf_token()}}'
          },
          contentType: false,
          processData: false,
          success: function( data, textStatus, jQxhr ){

            $('.loader-3').css('display','none');
            $(".modal-backdrop").remove();

            if(data.status == 1){
              alert('Your Balance is too low.Purchase token')
              window.location.href = '{{url("/tokenizerindex")}}';
            }else{


              var token_id = data.id;
              var token_name= data.tokenname;
              var token_symbol = data.tokensymbol;
              var token_value = data.tokenvalue;
              var token_supply = data.tokensupply;

              var token_acquistion= data.acquistion;
              var token_usage = data.usage;
              var token_redemption= data.redemption;
              var token_decimal = data.decimal;
              var token_image=data.token_image;

              //Load a specific compiler version
              // BrowserSolc.getVersions(function(soljsonSources, soljsonReleases) {
              //   console.log(soljsonSources);acquistion
              //   console.log(soljsonReleases);
              // });

              // BrowserSolc.loadVersion("soljson-v0.4.24+commit.e67f0147.js", function(compiler) {
                console.log(data.tokenname);
                source =  data;
                optimize = 1;

                console.log(Web3);
                
                //var myweb3 = new Web3(new Web3.providers.HttpProvider('http://68.183.79.75:22000'));
                var myweb3 = new Web3(new Web3.providers.HttpProvider('http://3.17.77.216:22000'));
                      
                //var ethereumProvider = web3.currentProvider;
                //var myweb3 = new Web3(ethereumProvider);

                //result = compiler.compile(source, optimize);

                // var token = token_name +'_Token';
                //console.log(result);

                var bytecode = '60806040523480156200001157600080fd5b50604051620018653803806200186583398101806040528101908080518201929190602001805182019291906020018051906020019092919080519060200190929190505050336000806101000a81548173ffffffffffffffffffffffffffffffffffffffff021916908373ffffffffffffffffffffffffffffffffffffffff1602179055506000809054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16600073ffffffffffffffffffffffffffffffffffffffff167f8be0079c531659141344cd1fd0a4f28419497f9722a3daafe3b4186f6b6457e060405160405180910390a333600160006101000a81548173ffffffffffffffffffffffffffffffffffffffff021916908373ffffffffffffffffffffffffffffffffffffffff16021790555083600290805190602001906200016c92919062000253565b5082600390805190602001906200018592919062000253565b5081600481905550600454600a0a8102600581905550600554600660003373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff168152602001908152602001600020819055503373ffffffffffffffffffffffffffffffffffffffff16600073ffffffffffffffffffffffffffffffffffffffff167fddf252ad1be2c89b69c2b068fc378daa952ba7f163c4a11628f55a4df523b3ef6005546040518082815260200191505060405180910390a35050505062000302565b828054600181600116156101000203166002900490600052602060002090601f016020900481019282601f106200029657805160ff1916838001178555620002c7565b82800160010185558215620002c7579182015b82811115620002c6578251825591602001919060010190620002a9565b5b509050620002d69190620002da565b5090565b620002ff91905b80821115620002fb576000816000905550600101620002e1565b5090565b90565b61155380620003126000396000f3006080604052600436106100fc576000357c0100000000000000000000000000000000000000000000000000000000900463ffffffff16806306fdde0314610101578063095ea7b31461019157806318160ddd146101f657806323b872dd14610221578063313ce567146102a65780633eaaf86b146102d157806340c10f19146102fc57806342966c681461036157806370a082311461038e578063715018a6146103e55780638da5cb5b146103fc5780638f32d59b1461045357806395d89b4114610482578063a9059cbb14610512578063aa271e1a14610577578063dc39d06d146105d2578063dd62ed3e14610637578063f2fde38b146106ae575b600080fd5b34801561010d57600080fd5b506101166106f1565b6040518080602001828103825283818151815260200191508051906020019080838360005b8381101561015657808201518184015260208101905061013b565b50505050905090810190601f1680156101835780820380516001836020036101000a031916815260200191505b509250505060405180910390f35b34801561019d57600080fd5b506101dc600480360381019080803573ffffffffffffffffffffffffffffffffffffffff1690602001909291908035906020019092919050505061078f565b604051808215151515815260200191505060405180910390f35b34801561020257600080fd5b5061020b610881565b6040518082815260200191505060405180910390f35b34801561022d57600080fd5b5061028c600480360381019080803573ffffffffffffffffffffffffffffffffffffffff169060200190929190803573ffffffffffffffffffffffffffffffffffffffff169060200190929190803590602001909291905050506108cc565b604051808215151515815260200191505060405180910390f35b3480156102b257600080fd5b506102bb610b5c565b6040518082815260200191505060405180910390f35b3480156102dd57600080fd5b506102e6610b62565b6040518082815260200191505060405180910390f35b34801561030857600080fd5b50610347600480360381019080803573ffffffffffffffffffffffffffffffffffffffff16906020019092919080359060200190929190505050610b68565b604051808215151515815260200191505060405180910390f35b34801561036d57600080fd5b5061038c60048036038101908080359060200190929190505050610b92565b005b34801561039a57600080fd5b506103cf600480360381019080803573ffffffffffffffffffffffffffffffffffffffff169060200190929190505050610b9f565b6040518082815260200191505060405180910390f35b3480156103f157600080fd5b506103fa610be8565b005b34801561040857600080fd5b50610411610cba565b604051808273ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200191505060405180910390f35b34801561045f57600080fd5b50610468610ce3565b604051808215151515815260200191505060405180910390f35b34801561048e57600080fd5b50610497610d3a565b6040518080602001828103825283818151815260200191508051906020019080838360005b838110156104d75780820151818401526020810190506104bc565b50505050905090810190601f1680156105045780820380516001836020036101000a031916815260200191505b509250505060405180910390f35b34801561051e57600080fd5b5061055d600480360381019080803573ffffffffffffffffffffffffffffffffffffffff16906020019092919080359060200190929190505050610dd8565b604051808215151515815260200191505060405180910390f35b34801561058357600080fd5b506105b8600480360381019080803573ffffffffffffffffffffffffffffffffffffffff169060200190929190505050610f61565b604051808215151515815260200191505060405180910390f35b3480156105de57600080fd5b5061061d600480360381019080803573ffffffffffffffffffffffffffffffffffffffff16906020019092919080359060200190929190505050610fbb565b604051808215151515815260200191505060405180910390f35b34801561064357600080fd5b50610698600480360381019080803573ffffffffffffffffffffffffffffffffffffffff169060200190929190803573ffffffffffffffffffffffffffffffffffffffff1690602001909291905050506110bd565b6040518082815260200191505060405180910390f35b3480156106ba57600080fd5b506106ef600480360381019080803573ffffffffffffffffffffffffffffffffffffffff169060200190929190505050611144565b005b60038054600181600116156101000203166002900480601f0160208091040260200160405190810160405280929190818152602001828054600181600116156101000203166002900480156107875780601f1061075c57610100808354040283529160200191610787565b820191906000526020600020905b81548152906001019060200180831161076a57829003601f168201915b505050505081565b600081600760003373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200190815260200160002060008573ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff168152602001908152602001600020819055508273ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff167f8c5be1e5ebec7d5bd14f71427d1e84f3dd0314c0f7b2291e5b200ac8c7c3b925846040518082815260200191505060405180910390a36001905092915050565b6000600660008073ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020019081526020016000205460055403905090565b6000610917600660008673ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020019081526020016000205483611163565b600660008673ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff168152602001908152602001600020819055506109e0600760008673ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200190815260200160002060003373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020019081526020016000205483611163565b600760008673ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200190815260200160002060003373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200190815260200160002081905550610aa9600660008573ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020019081526020016000205483611184565b600660008573ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff168152602001908152602001600020819055508273ffffffffffffffffffffffffffffffffffffffff168473ffffffffffffffffffffffffffffffffffffffff167fddf252ad1be2c89b69c2b068fc378daa952ba7f163c4a11628f55a4df523b3ef846040518082815260200191505060405180910390a3600190509392505050565b60045481565b60055481565b6000610b7333610f61565b1515610b7e57600080fd5b610b8883836111a5565b6001905092915050565b610b9c33826112e9565b50565b6000600660008373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff168152602001908152602001600020549050919050565b610bf0610ce3565b1515610bfb57600080fd5b600073ffffffffffffffffffffffffffffffffffffffff166000809054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff167f8be0079c531659141344cd1fd0a4f28419497f9722a3daafe3b4186f6b6457e060405160405180910390a360008060006101000a81548173ffffffffffffffffffffffffffffffffffffffff021916908373ffffffffffffffffffffffffffffffffffffffff160217905550565b60008060009054906101000a900473ffffffffffffffffffffffffffffffffffffffff16905090565b60008060009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff1614905090565b60028054600181600116156101000203166002900480601f016020809104026020016040519081016040528092919081815260200182805460018160011615610100020316600290048015610dd05780601f10610da557610100808354040283529160200191610dd0565b820191906000526020600020905b815481529060010190602001808311610db357829003601f168201915b505050505081565b6000610e23600660003373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020019081526020016000205483611163565b600660003373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200190815260200160002081905550610eaf600660008573ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020019081526020016000205483611184565b600660008573ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff168152602001908152602001600020819055508273ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff167fddf252ad1be2c89b69c2b068fc378daa952ba7f163c4a11628f55a4df523b3ef846040518082815260200191505060405180910390a36001905092915050565b6000600160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff168273ffffffffffffffffffffffffffffffffffffffff16149050919050565b6000610fc5610ce3565b1515610fd057600080fd5b8273ffffffffffffffffffffffffffffffffffffffff1663a9059cbb610ff4610cba565b846040518363ffffffff167c0100000000000000000000000000000000000000000000000000000000028152600401808373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200182815260200192505050602060405180830381600087803b15801561107a57600080fd5b505af115801561108e573d6000803e3d6000fd5b505050506040513d60208110156110a457600080fd5b8101908080519060200190929190505050905092915050565b6000600760008473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200190815260200160002060008373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200190815260200160002054905092915050565b61114c610ce3565b151561115757600080fd5b6111608161142d565b50565b60008083831115151561117557600080fd5b82840390508091505092915050565b600080828401905083811015151561119b57600080fd5b8091505092915050565b600073ffffffffffffffffffffffffffffffffffffffff168273ffffffffffffffffffffffffffffffffffffffff16141515156111e157600080fd5b6111ed60055482611184565b60058190555061123c600660008473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020019081526020016000205482611184565b600660008473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff168152602001908152602001600020819055508173ffffffffffffffffffffffffffffffffffffffff16600073ffffffffffffffffffffffffffffffffffffffff167fddf252ad1be2c89b69c2b068fc378daa952ba7f163c4a11628f55a4df523b3ef836040518082815260200191505060405180910390a35050565b600073ffffffffffffffffffffffffffffffffffffffff168273ffffffffffffffffffffffffffffffffffffffff161415151561132557600080fd5b61133160055482611163565b600581905550611380600660008473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020019081526020016000205482611163565b600660008473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200190815260200160002081905550600073ffffffffffffffffffffffffffffffffffffffff168273ffffffffffffffffffffffffffffffffffffffff167fddf252ad1be2c89b69c2b068fc378daa952ba7f163c4a11628f55a4df523b3ef836040518082815260200191505060405180910390a35050565b600073ffffffffffffffffffffffffffffffffffffffff168173ffffffffffffffffffffffffffffffffffffffff161415151561146957600080fd5b8073ffffffffffffffffffffffffffffffffffffffff166000809054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff167f8be0079c531659141344cd1fd0a4f28419497f9722a3daafe3b4186f6b6457e060405160405180910390a3806000806101000a81548173ffffffffffffffffffffffffffffffffffffffff021916908373ffffffffffffffffffffffffffffffffffffffff160217905550505600a165627a7a72305820b3a603e4916dc866e01ed55a48218cf33d01f119a755b3384ceea85f7cbe9ced0029';

                var abi = [{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"tokens","type":"uint256"}],"name":"approve","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"from","type":"address"},{"name":"to","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"mint","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"value","type":"uint256"}],"name":"burn","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"tokenOwner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"isOwner","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"account","type":"address"}],"name":"isMinter","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"tokenAddress","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transferAnyERC20Token","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"tokenOwner","type":"address"},{"name":"spender","type":"address"}],"name":"allowance","outputs":[{"name":"remaining","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[{"name":"_symbol","type":"string"},{"name":"_name","type":"string"},{"name":"_decimals","type":"uint256"},{"name":"totalSupply","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"payable":true,"stateMutability":"payable","type":"fallback"},{"anonymous":false,"inputs":[{"indexed":true,"name":"previousOwner","type":"address"},{"indexed":true,"name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"tokens","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"tokenOwner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"tokens","type":"uint256"}],"name":"Approval","type":"event"}];
                    
                  var interface_data = myweb3.eth.contract(abi);                    
                  //console.log("abi",interface_data);
                  //console.log('myweb3',myweb3);

                  var eth_address = '0xaE3D415FE5488C4426A956eC53F1EA45BA181Fe1';

                  var txn_hash = '';
                    
                  // console.log("ethereumProvider", ethereumProvider);
                  //var MyContract = abi;
                  // from: eth_address, // default from address
                  // gasPrice: '50000000000' // default gas price in wei, 20 gwei in this case


                  //var setgas = web3.toWei(0.1, 'ether');
                  // var gasEstimate = myweb3.eth.estimateGas({data: bytecode},function(err,result){
                  //   if(!err){
                  //     console.log('gasresult', result);  
                  //   }else{
                  //     console.log('error_result',err);
                  //   }
                  // });


                  // var myContractReturned = MyContract.new(
                  //   data.tokenname,
                  //   data.tokensymbol,
                  //   data.tokenvalue,
                  //   data.tokensupply,
                  //   { from:eth_address, data:bytecode, gas: gasEstimate }, function(err, myContract){ 
                  //     if(!err) { 
                  //       console.log(myContract.address);
                  //       $('#loader_div').hide();
                  //       if(myContract.address !== undefined){
                  //         alert('success')
                  //       }
                  //     }
                  //   });

                console.log('test',myweb3.eth.gasPrice.toString(10));

                var contractData = null;

                var tokenContract = myweb3.eth.contract(abi);

                var contractData = tokenContract.new.getData( data.tokenname,data.tokensymbol,data.decimal,data.tokensupply, {
                  data: '0x' + bytecode
                });


                myweb3.eth.getTransactionCount(eth_address, (err, txCount) => {
                  var tx = new ethereumjs.Tx({
                    from: eth_address,
                    nonce: myweb3.toHex(txCount),
                            // gasPrice: myweb3.toHex(myweb3.toWei('20', 'gwei')),
                            // gasLimit: myweb3.toHex(8000000),

                            gas:0x47b760,
                            data: contractData,
                            
                });

                console.log("txCount",txCount);

                tx.sign(ethereumjs.Buffer.Buffer.from('7837da9cac53e1e0cffdad11c1b2d669e9024cead657b287a38d19141914ad9f', 'hex'));

                var raw = '0x' + tx.serialize().toString('hex');
                sendtxn();
                function sendtxn(input) {
                  myweb3.eth.sendRawTransaction(raw, function(err, transactionHash) {
                    if(!err){
                      test(transactionHash);
                      //window.location.href = '{{url("/dashboard?acct=success")}}';
                    }
                    else{
                      console.log("error", err);
                      
                      //window.location.href = '{{url("/register?acct=autoerror")}}';
                    }
                  });
                }
                function test(n){
                    //alert(2);
                    txn_hash=n;
                }

                var intervalId;
                intervalId=setInterval(gettran,1000);
                
                function gettran(){
                    //alert(txn_hash);
                    console.log("hash-> "+txn_hash);
                    $( "<div class='modal-backdrop fade show'></div>" ).insertBefore( ".footer" );
                    $('.loader-3').css('display','block');
                    
                    myweb3.eth.getTransactionReceipt(txn_hash, function(err, receipt){
                      if(!err){
                        console.log("txn_hash-> ",receipt);

                        if(receipt.contractAddress!==null ){
                          if(Number(receipt.status) == 1){
                            console.log("in receipt.blockNumber-> ",receipt.contractAddress);
                            var ourContract = tokenContract.at(receipt.contractAddress);
                            console.log("contractsymbol",ourContract.symbol());
                            console.log("contractDecimals",ourContract.decimals().toString());
                            console.log("contractName",ourContract.name());
                            console.log("contractTotalSupply",ourContract.totalSupply().toString());

                            clearInterval(intervalId);
                            $( "<div class='modal-backdrop fade show'></div>" ).insertBefore( ".footer" );
                            $(".loader-3").css("display","block");

                            $.ajax({
                              url: "{{url('/admin/contract/update')}}",
                              type: "POST",
                              data:{"_token": "{{ csrf_token() }}",ico : receipt.contractAddress,contractid : token_id,tokenname: token_name,tokensymbol:token_symbol,tokenvalue : token_value,tokensupply : token_supply,acquistion:token_acquistion,usage:token_usage,redemption:token_redemption,decimal : token_decimal,token_image:token_image},
                              success: function( data, textStatus, jQxhr ){
                                console.log(data);
                                if(data.status==1){
                                  $('.loader-3').css('display','none');
                                  $(".modal-backdrop").remove();

                                  alert('Contract Created');
                                  
                                  window.location.href = '{{url("/tokenizerindex")}}';
                                }
                              }
                            })

                          }                                
                        }
                        else{
                          console.log("Still null");
                        }

                      }else{
                        console.log("err",err);
                      }
                    });
                }

              });



                 // web3.eth.getTransactionCount(currentAddress, (err, txCount) => {

                 //                                    var tx = new ethereumjs.Tx({
                 //                                        from: currentAddress,
                 //                                        nonce: web3.toHex(txCount),
                 //                                        gasLimit: web3.toHex(1000000),
                 //                                        to: contractAddress,
                 //                                        gasPrice: web3.toHex(web3.toWei('10', 'gwei')),
                 //                                        data: contractInstance.transfer.getData(receiverAddress,1000000000000000000),
                 //                                    });
                 //                                    console.log(txCount);
                 //                                     console.log(err);
                 //                                   // alert('testaaaad');
                 //                                    // replace your private key after securely extracting from keystore
                 //                                    tx.sign(ethereumjs.Buffer.Buffer.from('14a1fe62067f19777547c512399030f867feb94324a2d457d5990dd96beb7e55', 'hex'));

                 //                                    var raw = '0x' + tx.serialize().toString('hex');

                 //                                    web3.eth.sendRawTransaction(raw, function(err, transactionHash) {
                 //                                        if(!err){
                 //                                        console.log("token sent", transactionHash);
                 //                                        //window.location.href = '{{url("/dashboard?acct=success")}}';
                 //                                      }
                 //                                      else{
                 //                                        console.log("error", err);
                 //                                        $('#account_failed').modal('show');
                 //                                        //window.location.href = '{{url("/register?acct=autoerror")}}';
                 //                                      }
                 //                                    });
                 //                                }); 
               }
             },
           });
          });

          //sending tokens is not via metamask and hence needs signing transaction with private key
          //for that purpose alone we use ethereumtx-js min file as added
  </script>
@endsection