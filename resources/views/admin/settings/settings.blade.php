@extends('admin.layout.base')

@section('title', 'Site Settings ')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                <h5> @lang('admin.include.site_setting')</h5>

                <form class="form-horizontal" action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data" role="form">
                    {{csrf_field()}}

                    <div class="form-group row">
                        <label for="site_title" class="col-xs-2 col-form-label">@lang('admin.site_name')</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('site_title', 'Ico Investors')  }}" name="site_title" required id="site_title" placeholder="Site Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="site_logo" class="col-xs-2 col-form-label">@lang('admin.site_logo')</label>
                        <div class="col-xs-10">
                            @if(Setting::get('site_logo')!='')
                                <img style="height: 90px; margin-bottom: 15px;" src="{{ img(Setting::get('site_logo', asset('logo-black.png'))) }}">
                            @endif
                            <input type="file" accept="image/*" name="site_logo" class="dropify form-control-file" id="site_logo" aria-describedby="fileHelp">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="site_icon" class="col-xs-2 col-form-label">@lang('admin.site_icon')</label>
                        <div class="col-xs-10">
                            @if(Setting::get('site_icon')!='')
                                <img style="height: 90px; margin-bottom: 15px;" src="{{ img(Setting::get('site_icon')) }}">
                            @endif
                            <input type="file" accept="image/*" name="site_icon" class="dropify form-control-file" id="site_icon" aria-describedby="fileHelp">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tax_percentage" class="col-xs-2 col-form-label">@lang('admin.copyright')</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('site_copyright', '&copy; '.date('Y').' Appoets') }}" name="site_copyright" id="site_copyright" placeholder="Site Copyright" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="support_mail" class="col-xs-2 col-form-label">Support Mail Address</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('support_mail') }}" name="support_mail" id="support_mail" placeholder="support@exchange.com" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="enquiry_mail" class="col-xs-2 col-form-label">Enquiry Mail Address</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('enquiry_mail') }}" name="enquiry_mail" id="enquiry_mail" placeholder="enquiries@exchange.com" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="number" class="col-xs-2 col-form-label">Support Number</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('number') }}" name="number" id="number" placeholder="+1 242425252" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="instagram" class="col-xs-2 col-form-label">instagram Url</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('instagram') }}" name="instagram" id="instagram" placeholder="" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="twitter" class="col-xs-2 col-form-label">Twitter Url</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('twitter') }}" name="twitter" id="twitter" placeholder="" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="facebook" class="col-xs-2 col-form-label">Facebook Url</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('facebook') }}" name="facebook" id="facebook" placeholder="" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="admin_commission" class="col-xs-2 col-form-label">Admin Commission</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="number" value="{{ Setting::get('admin_commission') }}" name="admin_commission" id="admin_commission" placeholder="" step="any" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-2 col-form-label" for="default_currency">Default Currency</label>
                        <div class="col-xs-10">
                            <select class="form-control" name="default_currency" id="default_currency">
                                <option value="USD" @if(Setting::get('default_currency') == 'USD') selected="" @endif>USD</option>
                                {{-- <option value="CAD" @if(Setting::get('default_currency') == 'CAD') selected="" @endif>CAD</option> --}}
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="stripe_secret_key" class="col-xs-2 col-form-label">@lang('admin.kyc_man') </label>
                        <div class="col-xs-10">
                            <div class="float-xs-left mr-1"><input @if(Setting::get('kyc_approval') == 1) checked @endif  name="kyc_approval" type="checkbox" class="js-switch" data-color="#43b968"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="zipcode" class="col-xs-2 col-form-label"></label>
                        <div class="col-xs-10">
                            <button type="submit" class="btn btn-primary">@lang('admin.update_setting')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
