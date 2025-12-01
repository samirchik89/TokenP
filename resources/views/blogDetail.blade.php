@extends('layout.app')

@section('content')
<!-- Breadcrumb -->
<div class="page-content">
    <div class="pro-breadcrumbs">
        <div class="container">
            <a href="{{url('/dashboard')}}" class="pro-breadcrumbs-item">Home</a>
            <span>/</span>
            <a href="{{url('/blog')}}" class="pro-breadcrumbs-item">Blog</a>
            <span>/</span>
            <a href="#" class="pro-breadcrumbs-item">Amazing Post Here To Attract Your Customers</a>
        </div>
    </div>
    <!-- End Breadcrumb -->
    <!-- Property Head Starts -->
    <div class="property-head grey-bg pt30">
        <div class="container">
            <div class="property-head-btm row">
                <div class="col-md-12">
                    <h2 class="pro-head-tit">Blog</h2>
                    <p class="pro-head-txt">Amazing Post Here To Attract Your Customers</p>
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
                    <article class="post-detail">
                        <div class="col-md-1">
                            <div class="post-date pull-right">
                                <div class="date">20
                                    <br>Jan</div>
                                <div class="like"><a href="#"><i class="fa fa-heart"></i> 02</a></div>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <img src="{{asset('asset/package/demo/blog/1.jpg')}}" class="img-responsive" alt="" />
                            <h4>amazing Post Here To Attract Your Customers</h4>
                            <div class="post-meta"><span>By: <a href="#">VicksThemes</a></span> <em>|</em> <span><a href="#">01 Comments</a></span> <em>|</em> <span>In <a href="#">Business</a>, <a href="#">Photography</a>, <a href="#">Health</a>, <a href="#">Web design</a></span></div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum semper porta. Vivamus lacinia diam nec dignissim imperdiet. In purus dolor, porta ut auctor vitae, fermentum vitae ante. Duis hendrerit sed mauris eu lacinia. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum semper porta. Vivamus lacinia diam nec dignissim imperdiet. In purus dolor, porta ut auctor vitae, fermentum vitae ante. Duis hendrerit sed mauris eu lacinia.</p>
                            <blockquote>Gorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum semper porta. Vivamus lacinia diam nec dignissim imperdiet. In purus dolor, porta ut auctor vitae, fermentum vitae ante. Duis hendrerit sed mauris eu lacinia. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum semper porta. Vivamus lacinia diam nec dignissim imperdiet. In purus dolor, porta ut auctor vitae, fermentum vitae ante. Duis hendrerit sed mauris eu lacinia.</blockquote>
                            <p>Suspendisse mauris. Fusce accumsan mollis eros. Pellentesque a diam sit amet mi ullamcorper vehicula. Integer adipiscing risus a sem. Nullam quis massa sit amet nibh viverra malesuada. Nunc sem lacus, accumsan quis, faucibus non, congue vel, arcu. Ut scelerisque hendrerit tellus. Integer sagittis. Vivamus a mauris eget arcu gravida tristique. Nunc iaculis mi in ante. Vivamus imperdiet nibh feugiat est. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                            <div class="comments">
                                <h3>Comments (01)</h3>
                                <div class="comment-content">
                                    <div class="comment-avatar"><img src="{{asset('asset/package/demo/author1.png')}}" alt="" /></div>
                                    <div class="comment-info">
                                        <h5>John Luke <span>18 June 2013</span></h5>
                                        <p>To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advtage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure.</p>
                                    </div>
                                    <div class="line-comment"> <span><a href="#">Reply <i class="fa fa-angle-double-right"></i></a></span></div>
                                </div>
                                <div class="comment-content sub-comment">
                                    <div class="comment-avatar"><img src="{{asset('asset/package/demo/author2.png')}}" alt="" /></div>
                                    <div class="comment-info">
                                        <h5>John Luke <span>18 June 2013</span></h5>
                                        <p>To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advtage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure.</p>
                                    </div>
                                    <div class="line-comment"> <span><a href="#">Reply <i class="fa fa-angle-double-right"></i></a></span></div>
                                </div>
                            </div>
                            <div class="space80"></div>
                            <div class="comment-form">
                                <h3>Post a comment</h3>
                                <form>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Your Name (required)</label>
                                            <input type="text" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Your E-mail (required)</label>
                                            <input type="email" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <label>Your Message (required)</label>
                                            <textarea rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <a href="#" class="btn1 pull-right">Comment</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection


@section('scripts')

@endsection
