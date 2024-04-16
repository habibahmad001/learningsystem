@extends('layouts.sitelayout')

@section('content')


    <!-- Start main-content -->
    <div class="main-content">
        <!-- Section: inner-header -->
        @if(urlHasString("all-courses"))
            {{--<section id="home" class="all__coursesHeader overlay-dark-6" style="background-image: url('<?=UPLOADS?>images/all_courses.jpg'); "  >--}}
                {{--<div class="container-fluid pt-80 pb-80 pt-xs-50 pb-xs-50 position-relative text-center  ">--}}
                    {{--<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">--}}
                        {{--<a href="javascript:void(0);">--}}
                            {{--<img src="<?=UPLOADS?>images/80.png" />--}}
                        {{--</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"></div>--}}
                {{--</div>--}}
            {{--</section>--}}

{{--            <section id="home" class="all__coursesHeader overlay-dark-6" style="background-image: url('<?=UPLOADS?>images/all_courses_bg_fb.jpg'); "  >--}}
{{--                <div class="container-fluid pt-80 pb-80 pt-xs-50 pb-xs-50 position-relative text-center  ">--}}
{{--                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">--}}
{{--                        <a href="javascript:void(0);">--}}
{{--                            <img src="<?=UPLOADS?>images/all_courses_text_fb.png" />--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </section>--}}

            <section id="home" class="all__coursesHeader overlay-dark-6">
                <a href="{!! (GetPromoBanner(3) && GetPromoBanner(3)->content_link !== NULL) ? GetPromoBanner(3)->content_link : "javascript:void(0);" !!}">
                    @if(GetPromoBanner(3) && GetPromoBanner(3)->content_area !== NULL)
                        <img src="{!! getSettings('lms')->allcourse.json_decode(GetPromoBanner(3)->content_area, true)["Main_Banner"] !!}" class="all_course_full_banner_class" />
                        <img src="{!! getSettings('lms')->allcourse.json_decode(GetPromoBanner(3)->content_area, true)["Mobile_Banner"] !!}" class="all_course_mobile_banner_class" />
                    @else
                        <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/promobanner/all_course_banner.jpg" class="all_course_full_banner_class" />
                        <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/promobanner/all_course_banner_mobile.jpg" class="all_course_mobile_banner_class" />
                    @endif
                </a>
            </section>

{{--            <section id="home" class="all__coursesHeader overlay-dark-6">--}}
{{--                <a href="{!! (GetPromoBanner(3) && GetPromoBanner(3)->content_link !== NULL) ? GetPromoBanner(3)->content_link : "javascript:void(0);" !!}">--}}
{{--                    <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/promobanner/all_course_banner.jpg" class="all_course_full_banner_class" />--}}
{{--                    <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/promobanner/all_course_banner_mobile.jpg" class="all_course_mobile_banner_class" />--}}
{{--                </a>--}}
{{--            </section>--}}
        @else
        <section class="inner-header divider layer-overlay overlay-theme-colored-7" data-bg-img="<?=url('/images/bg1.jpg')?>">
            <div class="container pt-40 pb-60">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-6">
                            @if(queryString('price','discounted'))
                                <h2 class="text-theme-colored2 font-36">Discounted Courses </h2>
                            @elseif(queryString('price','free'))
                                <h2 class="text-theme-colored2 font-36">Free Courses </h2>
                            @elseif(queryString('sort','popular'))
                                <h2 class="text-theme-colored2 font-36">Popular Courses </h2>
                            @elseif(queryString('sort','new'))
                                <h2 class="text-theme-colored2 font-36">New Courses </h2>
                            @else
                                <h2 class="text-theme-colored2 font-36">{{$all_series->total()}} Search Results for "{{$title}}" </h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!-- new page style  -->
        <section class="newCategories__style">
            <span id="loading" style="display: none;"  class="loader col-md-12 pt-30 pb-30 text-center">
                <img class="lazy" id="loading-image" src="<?=UPLOADS.'images/ajax-loader.gif'?>"    height="90"  title="" />
            </span>

            <div class="container">

                <div class="row filter_vewArea">
                    <div class="col-lg-3 col-md-4">
                        @include('site.partials.search_sidebar')
                    </div>

                    <div class="col-lg-9 col-md-8" id="courses">
                        @include('site.partials.search_body')

                        @include('site.partials.featured_carousel')

                        @include('site.partials.reviews_section')
                        @include('site.partials.top_companies')
                    </div>

                </div>
            </div>
        </section>



    </div>
    <!-- end main-content -->

    <?php

    //    echo ip_info("Visitor", "Country"); // India
    //    echo ip_info("Visitor", "Country Code"); // IN
    //    echo ip_info("Visitor", "State"); // Andhra Pradesh
    //    echo ip_info("Visitor", "City"); // Proddatur
    //    echo ip_info("Visitor", "Address"); // Proddatur, Andhra Pradesh, India
    //
    //    print_r(ip_info("Visitor", "Location")); // Array ( [city] => Proddatur [state] => Andhra Pradesh [country] => India [country_code] => IN [continent] => Asia [continent_code] => AS )

    ?>



@stop

@section('footer_scripts')
    <script>
        var my_slug  = "{{$lms_cat_slug}}";

        if(!my_slug){

            $(".cs-icon-list li").first().addClass("active");
        }
        else{

            $("#"+my_slug).addClass("active");
        }
    </script>

    <script src="{{themes('site/js/jquery-asBreadcrumbs.js')}} " defer></script>
    <script type="text/javascript">
        jQuery(function($) {
            $('.breadcrumb').asBreadcrumbs({
                namespace: 'breadcrumb'
            });
        });
    </script>
@stop