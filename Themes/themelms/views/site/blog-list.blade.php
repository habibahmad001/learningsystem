@extends('layouts.sitelayout')

@section('content')
    <?php
                                    $items = Cart::getContent();
                                    $total = \Cart::getTotal();
                                    $cart_empty=\Cart::isEmpty();
                                    ?>
    <!-- Start main-content -->
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header blog__header text-white" style="background-image:url('<?=UPLOADS.'images/blogHeader_bg.jpg'?>');">
            <div class="container">
                <!-- Section Content -->
                <h2>BLOG</h2>
                <p>The best news, views and engaging content galore! Join the conversation and fill your life with interesting information. Tips and advice, fun and excitement and words of wisdom all coming your way!</p>
                {{--<a href="#">Travel & Tourism</a>--}}
                <ol class="breadcrumb d-none">
                                <li><a href="{{url('/')}}">Home</a></li>
                                <li><a href="{{url('/blogs')}}">Blogs</a></li>
                                @if($category)
                                <li class="active"> {{$category->category}}</li>
                                @endif
                                {{--<li class="active">Blog Articles</li>--}}
                            </ol>
            </div>
        </section>
        <!-- Section: Blog -->
        <section class="popular-BlogSection populr_courses pt-60">
            <div class="container">
                <h2 class="sectiontitle">Most Popular Blogs</h2>
            </div>

            <div class="popular__blogs-slide owl-carousel owl-theme">
                @if($posts)
                    @foreach($posts as $post)
                        <div class="item blog-item">
                            @include('site.partials.blog_widget')
                        </div>
                    @endforeach
                @endif
            </div>

        </section>
        <!-- 4 - Blog Body -->
        <section class="blog_bodySection pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <span id="loading" style="display: none;" class="loader col-md-12 pt-30 pb-30 text-center">
                            <img class="lazy" id="loading-image" height="90" title="working..." src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/ajax-loader.gif" style="">
                        </span>
                        <div class="row multi-row-clearfix loadajax">
                            @if(count($posts)>0)
                                @foreach($posts as $post)
                                    <div class="col-sm-6 col-md-6 col-lg-4">

                                        @include('site.partials.blog_widget')
                                    </div>
                                @endforeach
                            @else
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div role="alert" class="alert alert-warning"> <strong>Sorry!</strong> No blog records found for keyword <strong>{{$keyword}}</strong>.</div>
                                </div>
                                @foreach($latest_posts as $post)
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        @include('site.partials.blog_widget')
                                    </div>
                                @endforeach
                            @endif

                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                            <a href="javascript:void(0);" id="moreload" data-value="1" class="btn theme-btn text-uppercase text-white loadMore_btn">Load More</a>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        <aside>
                            @include('site.partials.subscribe_widget')

                            <div class="widget ads-widget"><img src="<?=UPLOADS?>images/blog_ads.jpg" class=""></div>
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

    </div>
    <!-- end main-content -->



@stop
@section('footer_scripts')

    <script language="JavaScript">
        /***** Blog Load More ******/
        $(document).ready(function(){
            $("#moreload").click(function(){
                var loadcount = Number($(this).attr("data-value"))+1;
                $(this).attr("data-value", loadcount);
                $.ajax({
                    beforeSend: function () {
                        $('#loading').css("display", "block");

                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',

                    url: '{{url::to('blogajaxcall')}}/'+loadcount,

                    success: function (response) {
                        console.log(response);
                        if (response.success){
                            $('.loadajax').html(response.html);
                            $('#moreload').addClass('removefocus');
                        }

                        if (response.removeload){
                            $('#moreload').hide(300);
                        }

                    },
                    complete: function () {
                        $('#loading').css("display", "none");

                    }
                });
            });
        });
        /***** Blog Load More ******/

        $('.popular__blogs-slide').owlCarousel({
            loop: true,
            margin:20,
            nav: false,
            center: true,
            dots: false,
            autoplay: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: false
                },
                640: {
                    items: 2
                },
                1024: {
                    items: 2
                },
                1280: {
                    items: 3
                },
                1440: {
                    items: 4
                },
                1921: {
                    items:5
                }
            }
        });
    </script>

@stop