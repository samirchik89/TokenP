@extends('admin.layout.base')

@section('title', 'Edit Token ')

@section('content')

<div class="content-area py-1">
  <div class="container-fluid">
    <div class="box box-block bg-white">
      <a href="{{ route('admin.tokenizerindex') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

      <h5 style="margin-bottom: 2em;">Edit Token</h5>

      
      <form  method="POST" enctype="multipart/form-data" role="form" id="contractform_data" action="{{route('admin.tokenizerupdate')}}">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$token->id}}">                  
        
        <div class="row mt-2 adddetail">
          <div class="col-md-12 ">
           
            <div class="row">
              <div class="col-md-6 col-12">
                
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" class="form-control" id="tokenname" placeholder="" value="{{$token->tokenname}}" readonly>                  
                </div>

                <div class="form-group">
                  <label for="">Symbol Name</label>
                  <input type="text" class="form-control" id="tokensymbol" placeholder="" value="{{$token->tokensymbol}}" readonly>                  
                </div>  

                <div class="form-group">
                  <label for="">Token Value (USD)</label>
                  <input type="number" class="form-control" id="tokenvalue" placeholder="" value="{{$token->tokenvalue}}" readonly>                  
                </div> 

                <div class="form-group">
                  <label for="">Token Image</label>
                  <input type="file" class="form-control" id="token_image" placeholder="" name="token_image" required="">
                  <br>
                  <img src="{{img($token->token_image)}}" width="150" />                  
                </div>

                <!-- <div class="form-group">
                  <label for="">Token Bonus (In Percentage)</label>
                  <input type="number" class="form-control" id="tokenvalue" placeholder="" name="bonus" value="{{$token->bonus}}" required="">                  
                </div>  --> 

                <div class="form-group">
                  <label for="">Title</label>
                  <input type="text" class="form-control" id="title" placeholder="" name="title" required="" value="{{$token->title}}" >
                  
                </div>

                <div class="form-group">
                  <label for="">Content</label>
                  <textarea class="form-control" id="content" placeholder="" name="content" required="">{{$token->content}}</textarea>
                  
                </div>

                <div class="form-group">
                  <label for="">Token Banner</label>
                  <input type="file" class="form-control" id="banner_image" placeholder="" name="banner_image" required="">
                  
                  @if($token->banner_image)
                    <br>                 
                    <img src="{{img($token->banner_image)}}" width="250" />  
                  @endif
                
                </div>
                <div class="form-group">
                  <label for="">Vesting periods</label>
                  <input type="text" class="form-control" id="VestingPeriod" readonly="" value="{{$token->vesting_period}}" name="vesting_period" required="">
                  <span id="content_error" class="error"></span>
                </div>

              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="">Pre seed sale</label>
                  <input type="text" class="form-control" id="Pre_seed_sale" readonly="" value="{{date('d/m/Y',strtotime($token->pre_seed_sale_fdate))}} - {{date('d/m/Y',strtotime($token->pre_seed_sale_tdate))}}">
                  <span id="Pre_seed_sale_error" class="error"></span>
                </div>

                <div class="form-group">
                  <label for="">Seed sale</label>
                  <input type="text" class="form-control" id="Seed_sale" readonly="" value="{{date('d/m/Y',strtotime($token->seed_sale_fdate))}} - {{date('d/m/Y',strtotime($token->seed_sale_tdate))}}">
                  <span id="Seed_sale_error" class="error"></span>
                </div>

                <div class="form-group">
                  <label for="">Private sale</label>
                  <input type="text" class="form-control" id="Private_sale" readonly="" value="{{date('d/m/Y',strtotime($token->private_sale_fdate))}} - {{date('d/m/Y',strtotime($token->private_sale_tdate))}}">
                  <span id="Private_sale_error" class="error"></span>
                </div>

                <div class="form-group">
                  <label for="">Main sale</label>
                  <input type="text" class="form-control" id="Main_sale" readonly="" value="{{date('d/m/Y',strtotime($token->main_sale_fdate))}} - {{date('d/m/Y',strtotime($token->main_sale_tdate))}}">
                  <span id="Main_sale_error" class="error"></span>
                </div>
                
                <div class="form-group">      
                  <label for="">Country</label>
                  <select id="country_create" multiple="multiple" name="country[]">
                    @foreach($country as $value)
                      <option value="{{$value->id}}" @if(in_array($value->id, $banned_country))  selected @endif >{{$value->countryname}}</option>
                    @endforeach 
                  </select>
                </div>

                <div class="form-group">
                  <label for="">Presale discounts</label>
                  <div class="inpGrpdate">
                    <input type="text" class="form-control" id="Main_sale" placeholder="" name="presale_discount_date" @if($presale) value="{{date('d/m/Y',strtotime($presale->fdate))}} - {{date('d/m/Y',strtotime($presale->tdate))}}" @endif >

                    <input type="text" class="form-control" id="presaleDiscount" placeholder="" name="discount_value" value="@if($presale) {{$presale->discount_value}} @endif">
                  </div>
                  <span id="presale_error" class="error"></span>
                </div>

                <div class="form-group">
                  <label for="">Investors tokens - <span style="font-size: 85%; opacity: 0.8">( Regulatory Requirement )</span></label>
                  <span class="inputChkGrp">
                    <input type="radio" class="form-control" id="equityToken" placeholder="" name="investor_token_usa_type" value="1"  @if($token->investor_token_usa_type==1) checked @endif >
                    <label for="equityToken">USA 1999 maximum investors for equity tokens</label>
                  </span>
                  <span class="inputChkGrp">
                    <input type="radio" class="form-control" id="fundToken" placeholder="" name="investor_token_usa_type" value="2" @if($token->investor_token_usa_type==2) checked @endif >
                    <label for="fundToken">USA 99 maximum investor for Asset</label>
                  </span>

                  <span class="inputChkGrp">
                    <input type="radio" class="form-control" id="investorMaxfund" placeholder="" name="investor_token_usa_type" required="">
                    <label for="investorMaxfund">USA 2,499 maximum investors in Asset</label>
                  </span>

                  <span id="InvestorsToken_error" class="error"></span>
                </div>

                <div class="form-group">
                  <label for="">Tokens to be issued</label>
                  <div class="row">
                    <div class="col-sm-5">
                      <span class="inputChkGrp">
                        @if($token->token_type==1)  
                          Common Equity 
                        @elseif($token->token_type==2)  
                          Prefered Equity
                        @elseif($token->token_type==3)  
                          Convertible Debt
                        @elseif($token->token_type==4)  
                          Debt
                        @elseif($token->token_type==5)  
                          Investment Contract
                        @elseif($token->token_type==6)  
                          Fund LP SPV Equity
                        @elseif($token->token_type==7)  
                          Asset backed Token
                        @elseif($token->token_type==8)  
                          Real Estate backed Token
                        @elseif($token->token_type==9)  
                          Environmental Upgrade Agreemeny SPC Equity
                        @endif
                      </span>
                    </div>                              
                  </div>
                </div>

                <div class="form-group">
                  <label for="">Trade Locked</label>
                  <div class="switch">
                   @if($token->trade_locked==1) <span class="text-up"><i class="fa fa-check"></i> Yes</span> @else <span class="text-down"><i class="fa fa-close"></i> No</span> @endif 
                  </div>
                </div>

                <div class="form-group">
                  <label for="">Token burn</label>
                  <div class="switch">
                    @if($token->trade_burn==1) <span class="text-up"><i class="fa fa-check"></i> Yes</span> @else <span class="text-down"><i class="fa fa-close"></i> No</span> @endif 
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="row mt-2 choosepatment d-none">
          <div class="col-md-12 mb-4 text-center">
            
            <button type="submit" class="btn btn-success cmn-btn" id="check_bal">Update Token</button>
              
          </div>
        </div>

      </form>

    </div>
  </div>
</div>
@endsection  




@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {

        $('input[name="pre_seed_sale"]').daterangepicker({locale: {
            format: 'DD/MM/YYYY'}});
        $('input[name="seed_sale"]').daterangepicker({locale: {
            format: 'DD/MM/YYYY'}});
        $('input[name="private_sale"]').daterangepicker({locale: {
            format: 'DD/MM/YYYY'}});
        $('input[name="main_sale"]').daterangepicker({locale: {
            format: 'DD/MM/YYYY'}});
        $('input[name="presale_discount_date"]').daterangepicker({locale: {
            format: 'DD/MM/YYYY'}});
        $('#country_create').multiselect();

     
        /*$('#country_create').multiselect({
            enableFiltering: true,
            filterPlaceholder: 'Search for something...'
        });*/

    });
  </script>
@endsection