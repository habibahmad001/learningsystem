@extends('layouts.sitelayout')

@section('content')
    <?php
                                    $items = Cart::getContent();
                                    $total = \Cart::getTotal();
                                    $cart_empty=\Cart::isEmpty();
                                    ?>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=119007884852167&autoLogAppEvents=1"></script>

    <!-- Start main-content -->
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header blog_detailHeader populr_courses">
            <div class="container">
            <!-- Section Content -->
                <h2>{{$title}}</h2>
                <ol class="breadcrumb">
                                <li><a href="{{url('/')}}">Home</a></li>
                                <li><a href="{{url('/blogs')}}">Blogs</a></li>
                                @if($blog_category)
                                <li><a href="{{url('/blogs/'.$blog_category->slug)}}">{{$blog_category->category}}</a></li>
                                @endif
                    <li class="active">{{$title}}</li>
                </ol>
            </div>
        </section>

        <!-- Section: Blog -->
        <section class="artical_blogDetail">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="blog-posts single-post">
                            <article class="post clearfix mb-0">
                                <div class="entry-header">
                                    <div class="post-thumb">
                                        @if($record->image)
                                            <a href="{{url('/blog/'.$record->slug)}}"><img src="{{ getBlogImgPath($record->image,'blog') }}" alt="{{$record->title}}" class="img-fullwidth"  ></a>
                                        @else
                                            <img src="https://picsum.photos/370/245/?random" class="img-fullwidth" alt="">
                                        @endif
                                    </div>
                                    <div class="meta-tag">
                                        <p>Post by <a href="#">Admin</a> <span><i class="fas fa-clock-o"></i> 11/4 /2020</span></p>
                                        <ul>
                                            <li><i class="fa fa-share-alt"></i> Share:</li>
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <h3 class="post-title">{{$title}}</h3>

                                <div class="entry-content">
                                    {!! $record->description !!}
                                  {{--  <p class="mt-20 mb-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <p class="mb-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <blockquote class="theme-colored pt-20 pb-20">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                        <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                                    </blockquote>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna et sed aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                   --}}

                                    <div class="mt-30 mb-0">
                                        <h5 class="pull-left mt-10 mr-20 text-theme-colored2">Share:</h5>
                                        <ul class="styled-icons icon-circled m-0">
                                            <li><a href="#" data-bg-color="#3A5795"><i class="fa fa-facebook text-white"></i></a></li>
                                            <li><a href="#" data-bg-color="#55ACEE"><i class="fa fa-twitter text-white"></i></a></li>
                                            <li><a href="#" data-bg-color="#A11312"><i class="fa fa-google-plus text-white"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                            <div class="tagline p-0 pt-20 mt-5">
                                <div class="row">
                                    <div class="col-md-8 col-xs-6">
                                        <div class="tags">
                                            <p class="mb-0"><i class="fa fa-tags text-theme-colored"></i> <span>Tags:</span>{{$record->tags}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-6">
                                        <div class="share text-right flip">
                                            <p style="text-align:right !important;"><i class="fa fa-share-alt text-theme-colored"></i> Share</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           {{-- <div class="author-details media-post">
                                <a href="#" class="post-thumb mb-0 pull-left flip pr-20"><img class="img-thumbnail" alt="" src="images/blog/author.jpg"></a>
                                <div class="post-right">
                                    <h5 class="post-title mt-0 mb-0"><a href="#" class="font-18">John Doe</a></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna et sed aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    <ul class="styled-icons square-sm m-0">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>--}}
                            <div class="comments-area">
                                <div class="fb-comments" data-href="<?=url()->full();?>"  data-width="100%"  data-numposts="5"></div>

                                {{--<h5 class="comments-title">Comments</h5>
                                <ul class="comment-list">
                                    <li>
                                        <div class="media comment-author"> <a class="media-left" href="#"><img class="media-object img-thumbnail" src="images/blog/comment1.jpg" alt=""></a>
                                            <div class="media-body">
                                                <h5 class="media-heading comment-heading">John Doe says:</h5>
                                                <div class="comment-date">23/06/2014</div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna et sed aliqua. Ut enim ea commodo consequat...</p>
                                                <a class="replay-icon pull-right flip text-theme-colored" href="#"> <i class="fa fa-commenting-o text-theme-colored"></i> Replay</a> </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media comment-author"> <a class="media-left" href="#"><img class="media-object img-thumbnail" src="images/blog/comment2.jpg" alt=""></a>
                                            <div class="media-body">
                                                <h5 class="media-heading comment-heading">John Doe says:</h5>
                                                <div class="comment-date">23/06/2014</div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna et sed aliqua. Ut enim ea commodo consequat...</p>
                                                <a class="replay-icon pull-right flip text-theme-colored" href="#"> <i class="fa fa-commenting-o text-theme-colored"></i> Replay</a>
                                                <div class="clearfix"></div>
                                                <div class="media comment-author nested-comment"> <a href="#" class="media-left"><img class="media-object img-thumbnail" src="images/blog/comment3.jpg" alt=""></a>
                                                    <div class="media-body p-20 bg-lighter">
                                                        <h5 class="media-heading comment-heading">John Doe says:</h5>
                                                        <div class="comment-date">23/06/2014</div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna et sed aliqua. Ut enim ea commodo consequat...</p>
                                                        <a class="replay-icon pull-right flip text-theme-colored" href="#"> <i class="fa fa-commenting-o text-theme-colored"></i> Replay</a>
                                                    </div>
                                                </div>
                                                <div class="media comment-author nested-comment"> <a href="#" class="media-left"><img class="media-object img-thumbnail" src="images/blog/comment2.jpg" alt=""></a>
                                                    <div class="media-body p-20 bg-lighter">
                                                        <h5 class="media-heading comment-heading">John Doe says:</h5>
                                                        <div class="comment-date">23/06/2014</div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna et sed aliqua. Ut enim ea commodo consequat...</p>
                                                        <a class="replay-icon pull-right flip text-theme-colored" href="#"> <i class="fa fa-commenting-o text-theme-colored"></i> Replay</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media comment-author"> <a class="media-left" href="#"><img class="media-object img-thumbnail" src="images/blog/comment2.jpg" alt=""></a>
                                            <div class="media-body">
                                                <h5 class="media-heading comment-heading">John Doe says:</h5>
                                                <div class="comment-date">23/06/2014</div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna et sed aliqua. Ut enim ea commodo consequat...</p>
                                                <a class="replay-icon pull-right flip text-theme-colored" href="#"> <i class="fa fa-commenting-o text-theme-colored"></i> Replay</a> </div>
                                        </div>
                                    </li>
                                </ul>--}}
                            </div>
                            {{--<div class="comment-box">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5>Leave a Comment</h5>
                                        <div class="row">
                                            <form role="form" id="comment-form">
                                                <div class="col-sm-6 pt-0 pb-0">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" required name="contact_name" id="contact_name" placeholder="Enter Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" required class="form-control" name="contact_email2" id="contact_email2" placeholder="Enter Email">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Enter Website" required class="form-control" name="subject">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <textarea class="form-control" required name="contact_message2" id="contact_message2"  placeholder="Enter Message" rows="7"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-dark btn-flat pull-right m-0" data-loading-text="Please wait...">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <aside>
                            @include('site.partials.subscribe_widget')

                            @include('site.partials.latest_posts')

                            <div class="widget ads-widget"><img src="<?=UPLOADS?>images/blog_ads.jpg"></div>
                        </aside>

                         <div class="sidebar sidebar-left mt-sm-30 d-none">
                             @include('site.partials.posts_search')
                             @include('site.partials.latest_posts')
                             @include('site.partials.post_categories')
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="popular-BlogSection blogDetail_slidr pt-60 d-none">
            <div class="container">
                <h2 class="sectiontitle">Most Popular Blogs</h2>
                <div class="popular__blogs-slide owl-carousel owl-theme">
                    <div class="item"></div>
                </div>
            </div>
        </section>


    </div>
    <!-- end main-content -->



@stop
@section('footer_scripts')
    <script>
        $('.popular__blogs-slide').owlCarousel({
            loop: true,
            margin:20,
            nav: false,
            center: true,
            dots: false,
            autoplay: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                640: {
                    items: 1
                },
                1024: {
                    items: 2
                },
                1280: {
                    items: 2
                },
                1440: {
                    items: 3
                },
                1921: {
                    items:4
                }
            }
        });
        window.dataLayer=window.dataLayer||[];
        dataLayer.push({
            'pageType': 'blog',
            'country': '<?php echo strtolower(ip_info("Visitor", "Country Code")); ?>',  //Should be based on IP
            'article_title': '{!! $record->title !!}',
            'comments': 0,

        });


    </script>
@stop