@extends('layout.app')

@section('content')
<style>
.page-content
{
  padding: 50px 0px !important;
}
.property-list-sec.pos-rel
{
  padding: 50px 0px;
}
</style>

<!-- Breadcrumb -->
    <div class="page-content">
        <div class="pro-breadcrumbs" style="display:none;">
            <div class="container">
                <a href="{{url('/dashboard')}}" class="pro-breadcrumbs-item">Home</a>
                <span>/</span>
                <a href="#" class="pro-breadcrumbs-item">Our Company</a>
            </div>
        </div>
        <!-- End Breadcrumb -->
        <!-- Property Head Starts -->
        <div class="property-head grey-bg pt30" style="display:none;">
            <div class="container">
                <div class="property-head-btm row">
                    <div class="col-md-12">
                        <h2 class="pro-head-tit">Our Company</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Property Head Ends -->

        <div class="page-content">
            <!-- Property List Starts -->
            <div class="property-list-sec pos-rel">
              <div class="container">
                <div class="row">
                  <div class="col-sm-12 text-center animated bounceIn"><img src="asset/package/images/constructions.jpg" style="width:40%;"></div>
                </div>
              </div>
            </div>
            <!-- Property List Ends -->
        </div>
    </div>
@endsection


@section('scripts')

@endsection
