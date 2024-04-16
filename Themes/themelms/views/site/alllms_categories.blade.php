@extends('layouts.sitelayout')

@section('content')

<?php
//echo count($count_series);
?>
    <!-- Start main-content -->
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider layer-overlay overlay-theme-colored-7 d-none">
            <div class="container pt-60 pb-60">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="text-theme-colored2 font-36">{{$title}} </h2>
                            <ol class="breadcrumb text-left mt-10 white">
                                <li><a href="<?=url('/')?>">Home</a></li>
                                <li><a href="{{url('/all-courses')}}">Categories</a></li>
                                @if($ptitle)
                                    <li><a href="{{url('/courses/'.$plink)}}">{{$ptitle}}</a></li>
                                @endif
                                <li class="active">{{$title}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- new page style  -->
        <section class="newCategories__style">
            <span id="loading" style="display: none;"  class="loader col-md-12 pt-30 pb-30 text-center">
                <img class="lazy" id="loading-image"   src="<?=UPLOADS.'images/ajax-loader.gif'?>"    height="90"  title="" />
            </span>

            <div class="container">
                <div class="row filter_vewArea">
                    <div class="col-lg-3 col-md-4">

                        @include('site.partials.search_sidebar', ['all_series' => $all_series,'count_series' => $count_series])
                    </div>

                    <div class="col-lg-9 col-md-8" id="courses">

                        <div id="categoryContent">
                        <div class="main_cateTitle">
                            <h3>{{$title}}</h3>
                            <ul class="subcats breadcrumb d-none" data-overflow="right">
                              {{--  @if(count($lms_cates))
                                    <!--<h4>{{getPhrase($title.' Categories')}}</h4>-->
                                    @foreach($lms_cates as $category)
                                        <li>
                                            <a class="" href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$category->slug}}">
                                                <div class="mr-10" id={{$category->slug}}><i class="fa fa-dot-circle-o" aria-hidden="true"></i> {{$category->category}}</div> --}}{{--<span>(0)</span>--}}{{--
                                            </a>
                                        </li>
                                @endforeach
                                @else
                                        --}}{{--<h4>{{getPhrase('no_categories_are_available')}}</h4>--}}{{--
                                @endif--}}
                            </ul>
                            <p class=" ">{{$description}}</p>
                        </div>
                            <?php
                            $populars= $all_series->where('setpopular', 'yes')->all();
                            $newest= $all_series->sortByDesc('created_at')->take(15);

                            ?>

                        <ul class="nav new_tbs">
                            <li class="active"><a href="#all_tb" data-toggle="tab">All Courses ({{$all_series->total()}})</a></li>
                            <li><a href="#popular_tb" data-toggle="tab">Popular Courses ({{count($populars)}})</a></li>
                            <li><a href="#newest_tb" data-toggle="tab">Newest Courses ({{count($newest)}})</a></li>
                          {{--  <li><a href="#high_tb">High Rated (7)</a></li>
                            <li><a href="#instructors_tb">Instructors (30)</a></li>--}}
                        </ul>
                        <div class="div-content section-content tab-content clearfix pt-10 pl-0 pr-0 pb-0">
                            <div class="tab-pane active" id="all_tb">
                            @if(count($all_series))
                                <?php
                                $cr_ids=array();
                                $cr_names=array();
                                $cr_prices=array();
                                $cr_awb=array();

                                ?>
                                    <div class="row">
                                        @foreach($all_series as $series)
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ss w-xxs-50">
                                                @include('site.partials.course_widget')
                                                <?php
                                                array_push($cr_ids, "'".$series->id."'");
                                                array_push($cr_names, "'".$series->title."'");
                                                array_push($cr_prices, "'".$series->cost."'");
                                                array_push($cr_awb, "'".$series->accreditedby->name."'");
                                                ?>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Pagination -->
                                    <div class="row text-center">
                                        <div class="col-sm-12">
                                            <ul class="pagination cs-pagination mb-0">
                                                {{ $all_series->links() }}
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Pagination -->

                            @else
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h4 class="extr_space">{{getPhrase('no_courses_are_available')}}</h4>
                                        </div>
                                    </div>
                            @endif
                                @if(count($all_series))
                            <script>
                                window.dataLayer=window.dataLayer||[];
                                dataLayer.push({
                                    'pageType': 'category',
                                    'country': '<?php echo strtolower(ip_info("Visitor", "Country Code")); ?>',  //Should be based on IP
                                    'courseId': [<?php echo implode(', ', $cr_ids)?>],
                                    'courseName': [<?php echo implode(', ', $cr_names)?>],
                                    'coursePrice': [<?php echo implode(', ', $cr_prices)?>],
                                    'currency':'GBP',
                                    'courseAwardingBody': [<?php echo implode(', ', $cr_awb)?>]
                                });
                            </script>
                            @endif
                        </div>
                            <div class="tab-pane pb-0 " id="popular_tb">

                                @if(count($populars))

                                    <div class="row">
                                        @foreach($populars as $series)
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ss w-xxs-100">
                                                @include('site.partials.course_widget')

                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Pagination -->
                                    <div class="row text-center">
                                        <div class="col-sm-12">
                                            <ul class="pagination cs-pagination mb-0">
                                                {{--{{ $populars->links() }}--}}
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Pagination -->

                                @else
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h4 class="extr_space">{{getPhrase('no_courses_are_available')}}</h4>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane " id="newest_tb">
                                @if(count($newest))

                                    <div class="row">
                                        @foreach($newest as $series)
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ss w-xxs-100">
                                                @include('site.partials.course_widget')

                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Pagination -->
                                    <div class="row text-center">
                                        <div class="col-sm-12">
                                            <ul class="pagination cs-pagination mb-0">
                                                {{--{{ $populars->links() }}--}}
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Pagination -->

                                @else
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h4 class="extr_space">{{getPhrase('no_courses_are_available')}}</h4>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        </div>
                        @include('site.partials.featured_carousel')
                        @include('site.partials.reviews_section')
                        @include('site.partials.top_companies')
                   </div>

                </div>
            </div>
        </section>

        <section class="pt-50 pb-50 business__associates d-none">
            <div class="container pt-0 pb-0 text-center">
                <div class="section-title">
                    <h2 class="title text-uppercase">Top Business Associates choose Next Learn Academy</h2>
                </div>

                <div class="adv-companies">
                    <img src="<?=UPLOADS?>images/logo-businss/1salesforce-h.png" alt="" style="height:38px;">
                    <img src="<?=UPLOADS?>images/logo-businss/2ring central-h.png" alt="">
                    <img src="<?=UPLOADS?>images/logo-businss/3amazon-h.png" alt="">
                    <img src="<?=UPLOADS?>images/logo-businss/4cloudiq-h.png" alt="">
                    <img src="<?=UPLOADS?>images/logo-businss/5vertiv-h.png" alt="">
                    <img src="<?=UPLOADS?>images/logo-businss/6royalmail-h.png" alt="">
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