@extends('layout.app')

@section('content')
<!-- Breadcrumb -->
<div class="page-content">
    <div class="pro-breadcrumbs">
        <div class="container">
            <a href="{{url('/dashboard')}}" class="pro-breadcrumbs-item">Home</a>
            <span>/</span>
            <a href="#" class="pro-breadcrumbs-item">Blog</a>
        </div>
    </div>
    <!-- End Breadcrumb -->
    <!-- Property Head Starts -->
    <div class="property-head grey-bg pt30">
        <div class="container">
            <div class="property-head-btm row">
                <div class="col-md-12">
                    <h2 class="pro-head-tit">BLOG</h2>
                    <p class="pro-head-txt">We Love To Write Blog And Also Love To Design Logo For A Project. Follow Us For More News

                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Property Head Ends -->
    <!-- Blog content -->
    <div class="post-wrap">
        <section class="post-content">
            <div class="container">
                <div class="row">
                    <article class="post-small col-md-12">
                        <div class="col-md-1">
                            <div class="post-date pull-right">
                                <div class="date">20
                                    <br>Jan</div>
                                <div class="like">
                                    <a href="#"><i class="fa fa-heart"></i> 02</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <img src="{{asset('asset/package/demo/blog/1.jpg')}}" class="img-responsive" alt="" />
                            <a href="{{url('/blogDetail')}}">
                                <h4>amazing Post Here To Attract Your Customers</h4>
                            </a>
                            <div class="post-meta"><span>By: <a href="#">VicksThemes</a></span> <em>|</em> <span><a href="#">01 Comments</a></span> <em>|</em> <span>In <a href="#">Business</a>, <a href="#">Photography</a>, <a href="#">Health</a>, <a href="#">Web design</a></span></div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum semper porta. Vivamus lacinia diam nec dignissim imperdiet. In purus dolor, porta ut auctor vitae, fermentum vitae ante. Duis hendrerit sed mauris eu lacinia. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum semper porta. Vivamus lacinia diam nec dignissim imperdiet. In purus dolor, porta ut auctor vitae, fermentum vitae ante. Duis hendrerit sed mauris eu lacinia.</p>
                            <a class="btn1 btn2" href="#">Read More</a>
                        </div>
                    </article>
                    <div class="clear"></div>
                    <article class="post-small col-md-12">
                        <div class="col-md-1">
                            <div class="post-date pull-right">
                                <div class="date">20
                                    <br>Jan</div>
                                <div class="like">
                                    <a href="#"><i class="fa fa-heart"></i> 02</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <img src="{{asset('asset/package/demo/blog/2.jpg')}}" class="img-responsive" alt="" />
                            <a href="{{url('/blogDetail')}}">
                                <h4>amazing Post Here To Attract Your Customers</h4>
                            </a>
                            <div class="post-meta"><span>By: <a href="#">VicksThemes</a></span> <em>|</em> <span><a href="#">01 Comments</a></span> <em>|</em> <span>In <a href="#">Business</a>, <a href="#">Photography</a>, <a href="#">Health</a>, <a href="#">Web design</a></span></div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum semper porta. Vivamus lacinia diam nec dignissim imperdiet. In purus dolor, porta ut auctor vitae, fermentum vitae ante. Duis hendrerit sed mauris eu lacinia. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum semper porta. Vivamus lacinia diam nec dignissim imperdiet. In purus dolor, porta ut auctor vitae, fermentum vitae ante. Duis hendrerit sed mauris eu lacinia.</p>
                            <a class="btn1 btn2" href="#">Read More</a>
                        </div>
                    </article>
                    <div class="clear"></div>
                    <article class="post-small-last col-md-12">
                        <div class="col-md-1">
                            <div class="post-date pull-right">
                                <div class="date">20
                                    <br>Jan</div>
                                <div class="like">
                                    <a href="#"><i class="fa fa-heart"></i> 02</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <img src="{{asset('asset/package/demo/blog/3.jpg')}}" class="img-responsive" alt="" />
                            <a href="{{url('/blogDetail')}}">
                                <h4>amazing Post Here To Attract Your Customers</h4>
                            </a>
                            <div class="post-meta"><span>By: <a href="#">VicksThemes</a></span> <em>|</em> <span><a href="#">01 Comments</a></span> <em>|</em> <span>In <a href="#">Business</a>, <a href="#">Photography</a>, <a href="#">Health</a>, <a href="#">Web design</a></span></div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum semper porta. Vivamus lacinia diam nec dignissim imperdiet. In purus dolor, porta ut auctor vitae, fermentum vitae ante. Duis hendrerit sed mauris eu lacinia. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum semper porta. Vivamus lacinia diam nec dignissim imperdiet. In purus dolor, porta ut auctor vitae, fermentum vitae ante. Duis hendrerit sed mauris eu lacinia.</p>
                            <a class="btn1 btn2" href="#">Read More</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </div>
    <!-- Blog content -->
</div>
@endsection


@section('scripts')

@endsection
