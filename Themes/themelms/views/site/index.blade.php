@extends('layouts.sitelayout')

@section('content')
    <link rel="preload" href="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/videos/nla_video.m4v" as="video" type="video/m4v">

    <!-- Start main-content -->
    <div class="main-content" ng-click='containerClicked();'>
        <!-- Section: home -->

        <section id="home" class="top__searchSec" style="background-image:url(<?=UPLOADS.'images/slider_pic_o_1.jpg'?>);background-repeat:no-repeat !important; background-size:cover;  background-position:top left;">
            <div class="container pt-0 pb-0">
                <h2 class="text-dark mt-0 mb-0">Find Your <span class="text-theme-colored2" >Course</span><br> Change your Life</h2>
                <div class="search-container mt-15">
                    <div class="newsletter-form">
                        <form class="" action="<?=  url('/courses/search')  ?>" method="get">
                            <div class="input-group">
                                <input  autocomplete="off"  id="search_s" placeholder="Find Your Course...." name="search_term" ng-keyup='fetchUsers("1")'
                                        ng-click='searchboxClicked($event)' ng-model='searchText_1' class="form-control input-lg font-16" type="text">
                                <span class="input-group-btn"><button class="btn btn-theme-colored3 font-20 text-white m-0" type="submit"><i class="fa fa-search font-20"></i>{{-- Search Courses--}}</button></span>
                            </div>
                                                <div id="search-container-2">
                                                    <ul id='searchResult_1' class="searchResult">
                                                        <div class="scrollable">
                                                            <li ng-click='setValue($index,$event)' ng-repeat="result in searchResult_1" ng-bind-html="boldText(result.title,result.slug)">
                                                                {{--<% result.title %>--}}
                                                            </li>
                                                        </div>
                                                    </ul>
                                                </div>
                        </form>

                                            {{--<div class="item ml-20"><a href="#" style="font-weight:bold !important; font-size:14px;">Free Courses</a></div>
                                            <div class="item  ml-20"><a href="#" style="font-weight:bold !important; font-size:14px;">Popular Courses</a></div>
                                            <div class="item  ml-20"><a href="#" style="font-weight:bold !important; font-size:14px;">New Courses</a></div>
                                            <div class="item  ml-20 "><a href="#" style="font-weight:bold !important; font-size:14px;">Discounted Courses</a></div>--}}
                        <div id="quickLinkscourse" class="quickLinkscourse quick-links-container slider">
                            {{--<div class="item"><a href="#" style="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>--}}
                            <div class="item"><a href="<?=url('/popular-courses')?>" style="">Popular Courses</a></div>
                            <div class="item"><a href="<?=url('/discounted-courses')?>" style="">Discounted Courses</a></div>
                            <div class="item"><a href="<?=url('/free-courses')?>" style="">Free Courses</a></div>
                            <div class="item"><a href="<?=url('/new-courses')?>" style="">New Courses</a></div>
                            @foreach($lms_allcats as $category)
                                <div class="item"><a href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$category->slug}}">{{$category->category}}</a></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--<a class="btn btn-transparent btn-default btn-circled btn-lg mt-15 mr-15 pr-40 pl-40" href="#">Start a Free Trail Now</a>-->
            </div>
        </section>

        <section id="awarding_bodies" class="parallax" style="background-color: rgb(255, 255, 255);border-bottom: 1px solid rgba(204, 221, 204, 0.867);display: none;">
            <div class="container pt-15 pb-15">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Section: Clients -->
                        <div class="owl-carousel-7col clients-logo transparent text-center">
                            <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/awarding/awarding-1.jpg" alt=""></div>
                            <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/awarding/awarding-3.jpg" alt=""></div>
                            {{--<div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/awarding/awarding-5.jpg" alt=""></div>--}}
                            {{--<div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/awarding/awarding-7.jpg" alt=""></div>--}}
                            <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/awarding/awarding-8.jpg" alt=""></div>
                            {{--<div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/awarding/awarding-9.jpg" alt=""></div>--}}
                            <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/awarding/awarding-10.jpg" alt=""></div>
                            <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/awarding/awarding-13.jpg" alt=""></div>
                            <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/awarding/awarding-14.jpg" alt=""></div>
                            <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/awarding/awarding-16.jpg" alt=""></div>
                            <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/awarding/awarding-18.jpg" alt=""></div>
                            <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/awarding/awarding-20.jpg" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="home-hero-gradient-new cards__Links pt-0 pb-10">
            <div class="container pt-0 pb-0">
                <div class="row">
                    <!--Grid column-->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6   wow fadeInUp  " data-wow-delay="200ms" data-wow-duration="1000ms">
                        <a href="<?=url('/free-courses')?>" class="d-flex gradient-card align-items-center">
                            <div class="align-self-left">
                                <h3 class="card-title card-title-first">Free</h3>
                                <h3 class="card-title card-title-second">Courses</h3>
                            </div>
                            <span class="icon fas fa-angle-double-right"></span>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 wow fadeInUp" data-wow-delay="400ms" data-wow-duration="800ms">
                        <a href="<?=url('/discounted-courses')?>" class="d-flex gradient-card align-items-center">
                            <div class="align-self-left">
                                <h3 class="card-title card-title-first">Discounted</h3>
                                <h3 class="card-title card-title-second">Courses</h3>
                            </div>
                            <span class="icon fas fa-angle-double-right"></span>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6   wow fadeInUp" data-wow-delay="600ms" data-wow-duration="800ms">
                        <a href="<?=url('/popular-courses')?>" class="d-flex gradient-card align-items-center">
                            <div class="align-self-left">
                                <h3 class="card-title card-title-first">Popular</h3>
                                <h3 class="card-title card-title-second">Courses</h3>
                            </div>
                            <span class="icon fas fa-angle-double-right"></span>
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6  wow fadeInUp" data-wow-delay="800ms" data-wow-duration="800ms">
                        <a href="<?=url('/new-courses')?>" class="d-flex gradient-card align-items-center">
                            <div class="align-self-left">
                                <h3 class="card-title card-title-first">New</h3>
                                <h3 class="card-title card-title-second">Courses</h3>
                            </div>
                            <span class="icon fas fa-angle-double-right"></span>
                        </a>
                    </div>


                </div>


            </div>
        </section>



    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts pt-40 pb-40">
        <div class="container pt-0 pb-0">
            <div class="section-title text-center mb-10">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="title text-uppercase mb-5">FUTURE READY  <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">TODAY</span></h2>
                        <p class="text-center">Educating everyone today to achieve for tomorrow in a global economy and community</p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center counters">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-6 text-center pt-20">
                            <i class="fas fa-graduation-cap fa-3x"></i>
                            <span data-toggle="counter-up">600+</span>
                            <h5>Online Courses</h5>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-6 text-center pt-20">
                            <i class="fas fa-users fa-3x"></i>
                            <span data-toggle="counter-up">150,000+</span>
                            <h5>Active Learners</h5>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-6 text-center pt-20">
                            <i class="fas fa-chalkboard-teacher fa-3x"></i>
                            <span data-toggle="counter-up">100+</span>
                            <h5>Expert Instructors</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 text-center pt-20">
                    <div class="preview-video-box homeVideo">
                        <img class="img-fullwidth" src="<?=UPLOADS?>images/about/who-we-are.jpg" alt="About Us">
                        <a href="#"  data-toggle="modal" data-target="#mainVideoModal"><i class="fas fa-play-circle"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Counts Section -->

        <!-- Video Modal -->
        <div class="modal fade" id="mainVideoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <video width="100%" height="400" preload="<?=UPLOADS?>images/about/Who We Are1.jpg" src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/videos/nla_video.m4v" type="video/mp4" controls></video>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Video Modal -->

     <!--<section>
          <div class="container">
          <img class="lazy" data-src="https://www.globaledulink.co.uk/wp-content/uploads/2020/08/Banner-student-ID.gif">
          </div>
      </section>-->
         <!-- Section: Popular Courses -->
        <section id="courses" class="populr_courses">
            <div class="container">
                <div class="section-title text-center mb-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="title text-uppercase mb-5">Popular <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Courses</span></h2>
                            {{--<h5 class="font-16 text-gray-darkgray mt-5">Choose your Desired Course</h5>--}}
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs text-left" id="myTab" role="tablist" data-ng-init="init(25)">
                    @foreach($lms_allcats as $category)
                    <li class="nav-item <?=($category->id==25)?'active':''?>">
                        <a ng-click='fetchCourses("{{$category->id}}")'  class="nav-link" id="ht{{$category->id}}-tab" data-toggle="tab" href="#ht1_{{$category->id}}" role="tab" aria-controls="home" aria-selected=" <?=($category->id==25)?'true':'false'?>">{{$category->category}}</a>
                    </li>
                    @endforeach
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <span id="load" style="display: none;"  class="loader col-md-12 pt-30 pb-30 text-center"><img class="lazy" src="<?=UPLOADS.'images/ajax-loader.gif'?>" id="ajaxSpinnerImage"  height="90"  title="" /></span>
                    @foreach($lms_allcats as $category)
                        <div class="tab-pane <?=($category->id==25)?'active':''?>" id="ht1_{{$category->id}}" role="tabpanel" aria-labelledby="ht{{$category->id}}-tab">
                            <div  id="content_{{$category->id}}" class="row row-md-padding">
                                    @if($category->id==25)
                                        @foreach($default_cat as $series)
                                            <div class=" col-xs-6 col-sm-6 col-md-15 col-lg-15"   >
                                                @include('site.partials.course_widget')
                                            </div>
                                            @endforeach
                                    @endif
                            </div>
                            <div class="w-100 text-center mt-30"><a href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$category->slug}}" class="btn btn-block btn-primary w-320">{{$category->category}} Courses</a> </div>
                        </div>
                    @endforeach

                </div>
                 
            </div>
        </section>

<script>


    $("document").ready(function() {
        //var activetab = $.cookie("activetab");
        // if(activetab){
        //     console.log("#"+activetab);
        //     $("#"+activetab).trigger('click');
        // }

        // $scope.triggerClick = function () {
        //     $timeout(function() {
               // angular.element("#"+activetab).trigger('click');
       //     }, 100);
        //};


    });
</script>
<section class="reviews__section pt-40 pb-40">
    <div class="container">
        <script src="https://widget.reviews.co.uk/rich-snippet-reviews-widgets/dist.js"></script>
        <div id="carousel-inline-widget-1210" style="width:100%;display:inline-block;"></div>
        <script>
            richSnippetReviewsWidgets('carousel-inline-widget-1210', {
                store: 'nextlearnacademy.com',
                widgetName: 'carousel-inline',
                primaryClr: '#f47e27',
                neutralClr: '#f4f4f4',
                reviewTextClr:'#2f2f2f',
                ratingTextClr:'#2f2f2f',
                layout:'fullWidth',
                numReviews: 21
            });
        </script>
    </div>
</section>

        <section class="ptb-lg-50 ptb-md-40 ptb-sm-30 ptb-xs-30" style="background-color:#f9f8f8;">
            <div class="container ptb-0">
                <div class="section-title text-center mb-10">
                    <h2 class="title text-uppercase">Discounted <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;"> Courses</span></h2>
                </div>

                <div id="trending__maincourse" class="owl-carousel owl-theme">
                    @foreach(DiscountedCourses() as $series)
                    @include('site.partials.course_widget')
                        @endforeach
                </div>
            </div>
        </section>


        <section class="ptnr__logos ptb-lg-50 ptb-md-40 ptb-sm-30 ptb-xs-30">
            <div class="container ptb-0">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                        <h2 class="title text-uppercase mb-5">Learn CPD <br><span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Accredited Courses</span></h2>

                        <p>CPD accredited courses are practical qualifications that point to the learner's continuous development and the opportunity to improve and enhance their vocational skills. It provides learners a structured approach to learning that requires them to be proactive and reactive. It is to ensure learners are able to upskill and re-skill. </p>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                        <div class="partner text-center">
                            <div class="item">
                                <img class="lazy" src="<?=UPLOADS.'images/cpdlogo_new.png'?>"   class="img-responsive">
                            </div>
                            <a href="<?=url('/all-courses')?>" class="btn btn-dark btn-theme-colored2 font-16 btn-lg w-sm-250 mt-20" style="background: rgb(81, 172, 55) !important;">Browse Courses</a>


                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="mainAbout__section ptb-lg-50 ptb-md-40 ptb-sm-30 ptb-xs-30" style="background-color: #f3f8f9;">
            <div class="container ptb-0">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center"><img class="lazy" data-src="<?=UPLOADS?>images/homeIdImg.png" class="img-fluid"/></div>
                    <div class="col-md-6">
                        <h2 class="title text-uppercase mb-5">Student <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">ID CARD</span></h2>
                        <p>Amazing savings not just with learning your favourite courses, but also with fabulous offers at the store of your choice. Enjoy dining out at scrumptious restaurants, watch the latest movies in town, keep fit with discounted gym memberships or take a breather to relax at the library. This and so much more with our Student ID card.</p>
                        <div class="w-100 text-sm-center">
                            <a href="<?=url('/student-id-card')?>" class="btn btn-dark btn-theme-colored2 font-16 btn-lg w-sm-250 text-uppercase" style="background: rgb(81, 172, 55) !important;">Apply Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TOp Categories -->
        <section class="categories-section ptb-lg-50 ptb-md-40 ptb-sm-30 ptb-xs-30">
            <div class="container ptb-0">
                <div class="section-title text-center mb-25">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="title text-uppercase mb-5">Find your <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">career</span></h2>
                            {{--<h5 class="font-16 text-gray-darkgray mt-5">See Our Most Popular Categories</h5>--}}
                        </div>
                    </div>
                </div>
                <div class="section-content">
                    <div class="row">
                        @if(isset($lms_allcats))
                            @foreach($lms_allcats as $cat)
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                    <div class="single-course-thumb mb-20">
                                        <img class="border-radius-8px img-fullwidth"
                                             src="{{IMAGE_PATH_UPLOAD_LMS_CATEGORIES.$cat->image}}" alt="" style="height: 175px;">
                                        <a href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$cat->slug}}">
                                            <div class="overlay-shade"></div>
                                            <div class="course-info">
                                                <h5 class="text-white font-20 font-weight-600 mb-5">{{ucfirst($cat->category)}}</h5>
                                                <p class="font-15 font-weight-400" style="text-align:center;display:none;">{{count($cat->countCourses)}} Courses</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </section>

        <!-- Divider: Clients -->
        <section class="clients ptb-lg-50 ptb-md-40 ptb-sm-30 ptb-xs-30" style="background-color:#f9f8f8;">
            <div class="container ptb-0">
                <div class="section-title text-center mb-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="title text-uppercase mb-5">Business  <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Associates</span></h2>
                            {{--<h5 class="font-16 text-gray-darkgray mt-5">See Our Associates</h5>--}}
                        </div>
                    </div>
                </div>
                <!-- Section: Clients -->
                {{--<div class="owl-carousel-6col clients-logo transparent text-center">--}}
                <div class="clients-logo home_page_Clogo transparent text-center">

                        <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/logos/1salesforce.png" alt=""></div>
                        <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/logos/2ringcentral.png" alt=""></div>
                        <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/logos/3amazon.png" alt=""></div>
                        <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/logos/4cloudiq.png" alt=""></div>
                        <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/logos/5vertiv.png" alt=""></div>
                        <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/logos/6royalmail.png" alt=""></div>
                        <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/logos/7dhl.png" alt=""></div>
                        <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/logos/8nhs.png" alt=""></div>
                        <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/logo-businss/9reed-h.png" alt=""></div>
                        <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/logo-businss/10hmrc-h.png" alt=""></div>
                        <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/logos/11barclays.png" alt=""></div>
                        <!--div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/partners/ring.png" alt=""></div>
                        <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/partners/royalmail.png" alt=""></div>
                        <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/partners/salesforce.png" alt=""></div>
                        <div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/partners/vertiv.png" alt=""></div-->

                <!--<div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/partners/partner-9.jpg" alt=""></div>-->
                <!--<div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/partners/partner-10.jpg" alt=""></div>-->
                <!-- {{--<div class="item"><img class="lazy" data-src="<?=UPLOADS?>images/partners/partner-11.jpg" alt=""></div>--}} -->
                </div>
            </div>
        </section>

        <section class="become__business ptb-lg-50 ptb-md-40 ptb-sm-30 ptb-xs-30">
            <div class="container ptb-0">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><img class="lazy" data-src="<?=UPLOADS?>images/left_img.jpg" class="img-fluid" /></div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="content__Info">
                            <div class="section-title mb-10">
                                <h2 class="title text-uppercase">Do You Want To <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Become An Instructor?</span></h2>
                            </div>
                            <p>Here's a great opportunity to join leading instructors at Next Learn Academy who tutor thousands of students. Expand your horizons in
                                teaching by becoming a part of this worldwide community of tutors and instructors and showcase your practical
                                skills and expertise to the learning community.</p>
                            {{--@if(Auth::check())--}}
                            {{--<a class="btn btn-dark btn-theme-colored2 font-16 btn-lg text-uppercase"  href="#" data-toggle="modal" data-target="#myModalinstructor" style="background: rgb(81, 172, 55) !important;">Start teaching today</a>--}}
                            {{--@else--}}
                            <a class="btn btn-dark btn-theme-colored2 font-16 btn-lg text-uppercase"  href="<?=url('/instructor')?>" style="background: rgb(81, 172, 55) !important;">Start teaching today</a>
                            {{--@endif--}}
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-md-push-6">
                        <img class="lazy" src="<?=UPLOADS?>images/right_img.jpg" class="img-fluid become__businessImg" />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-md-pull-6">
                        <div class="content__Info">
                            <div class="section-title mb-10">
                                <h2 class="title text-uppercase">Next Learn Academy <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">for Business</span></h2>
                            </div>
                            <p>We will be providing complete training packages for companies that want to train their employees in cutting-edge learning solutions, training providers
                                who want to re-sell courses separately, as well as customised training solutions.</p>
                            <a class="btn btn-dark btn-theme-colored2 font-16 btn-lg text-uppercase" href="<?=url('/corporate')?>" style="background: rgb(81, 172, 55) !important;">Next learn Academy for business</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Divider: Testimonials -->

        <section class="main__testi ptb-lg-50 ptb-md-40 ptb-sm-30 ptb-xs-30">
            <div class="container ptb-0">
                <div class="section-title text-center mb-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="title text-uppercase mb-5">Our  <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Students Say</span></h2>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel owl-theme testi1 ">
                    <!-- item -->
                    @foreach ($testimonies as $testmony)
                        <div class="item testi-item">
                            <div class="row no-gutter">
                                <div class="col-md-4">
                                    <div class="user-info">
                                        <div class="name__info__">
                                            {{color_avatar($testmony->name)}}
                                            {{--<img class="lazy" data-src="{{ getProfilePath($testmony->image,'profile')}}" alt="wrapkit" />--}}
                                        </div>
                                        <div class="name">{{$testmony->name}}</div>
                                        <span class="designation">Student</span>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="desc">
                                        <h6 class="font-weight-normal">{{$testmony->title}}</h6>
                                        {{ substr($testmony->description,0,200) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        <!-- Section About -->
        <!--<section id="about">
            <div class="container pt-0 pb-0">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-12 col-xs-12 about_section">
                        <h2 class="text-white text-uppercase">ABOUT <span class="text-theme-colored2">INFINITY</span> LEARNING</h2>
                        <article class="about_infinity">
                            We are privileged to have been able to teach thousands of students both in the UK and outside. Our priority has always been to help them achieve their career goals and dreams. With access to a wide range of globally recognised courses from multi-disciplines, you can get certified in your favourite area of study with us. And the best part? You can actually do this from the comfort of your home! To help ensure the best standards, our highly qualified online instructors will guide you throughout. We also provide you with engaging and high quality online learning materials. We strive to bring you the best possible learning experience because your success, is our success, always.
                        </article>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 video about-video">
                        <video width="100%" controls="controls" poster="https://i.vimeocdn.com/video/693769104.webp?mw=1700&mh=956">
                            <source src="https://player.vimeo.com/video/264080306?byline=0" type="video/mp4">
                        </video>
                        {{--<iframe src="https://player.vimeo.com/video/264080306?byline=0" width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>--}}
                    </div>
                </div>
            </div>
        </section>-->

        <!--Divider Call to Action-->

        <section class="related_courses ptb-lg-50 ptb-md-40 ptb-sm-30 ptb-xs-30">
            <div class="container ptb-0">
                <div class="section-title text-center mb-25">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="title text-uppercase mb-5">Our Blog <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Posts</span></h2>
                            {{--<h5 class="font-16 text-gray-darkgray">See Our Recent Blogs</h5>--}}
                        </div>
                    </div>
                </div>
                <!-- Section: Clients -->
                <div id="main__blogSL" class="owl-carousel owl-theme transparent text-left"   data-nav="true" data-dots="false">
                    @if($posts)
                        @foreach($posts as $post)
                            <div class="item blog-item">
                                @include('site.partials.blog_widget')
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="text-center w-100">
                    <a class="btn btn-dark btn-theme-colored2 btn-lg w-sm-250 text-uppercase" href="<?=url('/blogs')?>" style="background: rgb(81, 172, 55) !important;">View more</a>
                </div>

            </div>
        </section>

    </div>
    <!-- end main-content -->

@stop

@section('footer_scripts')

@if($snow)
<script src="{{themes('site/js/jquery.snow.js')}}" ></script>
<style>
.snowflake {
  -webkit-animation: spin 4s linear infinite;
  -moz-animation: spin 4s linear infinite;
  animation: spin 4s linear infinite;
}

@-moz-keyframes 
spin { 100% {
  -moz-transform: rotate(360deg);
}
}

@-webkit-keyframes 
spin { 100% {
  -webkit-transform: rotate(360deg);
}
}

@keyframes 
spin { 100% {
  -webkit-transform: rotate(360deg);
  transform:rotate(360deg);
}
}
</style>
<script type="text/javascript">
jQuery("#wrapper").snow({

    // default options
    intensity: 10,
    sizeRange: [5, 20],
    opacityRange: [0.5, 1],
    driftRange: [-2, 2],
    speedRange: [25, 80]
    
    });


    </script>

@endif
    <script type="text/javascript">





        $(".cs-nav-pills li").first().addClass("active");
        $(".lms-cats li").first().addClass("active");
//$("#load").hide();

        window.dataLayer=window.dataLayer||[];
        dataLayer.push({
            'pageType': 'home',
            'country': '<?php echo strtolower(ip_info("Visitor", "Country Code")); ?>'  //Should be based on IP
        });


        // $(".quick-links-container").owlCarousel({
        //     autoplay: false,
        //     dots: false,
        //     loop: true,
        //     items: 4,
        //      startPosition: 1

        // });


/*
        const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;

        let countDown = new Date('Sep 30, 2020 00:00:00').getTime(),
            x = setInterval(function() {

                let now = new Date().getTime(),
                    distance = countDown - now;

                document.getElementById('days').innerText = Math.floor(distance / (day)),
                    document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
                    document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
                    document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);

                //do something later when date is reached
                //if (distance < 0) {
                //  clearInterval(x);
                //  'IT'S MY BIRTHDAY!;
                //}

            }, second)*/
    </script>
    <script>
        jQuery(document).ready(function ($) {
            $('#myTab').find('#ht43-tab').parent().insertAfter('#myTab li:last-child');

            $('.testi1').owlCarousel({
                loop: true,
                margin: 30,
                nav: false,
                dots: true,
                autoplay: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    1024: {
                        items: 2
                    }
                }
            });
            $(".testimonials-carousel").owlCarousel({
                autoplay: true,
                dots: true,
                loop: true,
                items: 1
            });

            $('.owl-prev').hide();
            $('.owl-next').click(function () {
                $('.owl-prev').show();
            });



       /* $('#quick-linksMain').owlCarousel({
            startPosition: start,
            //center:false,
            loop: false,
            margin:15,
            items: 4,
            dots: false,
            autoplay: false,
            nav:true,
            navText: [
                '<i class="fa fa-chevron-left"></i>',
                '<i class="fa fa-chevron-right"></i>'
            ],
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2
                },
                425: {
                    items: 2
                },
                500: {
                    items: 2
                },
                600: {
                    items: 2
                },
                750: {
                    items: 3
                },
                960: {
                    items: 3
                },
                1170: {
                    items: 4
                },
                1300: {
                    items: 4
                }
            }
        });
*/
            $('.quickLinkscourse').slick({
                dots: false,
                infinite: false,
                speed:400,
                slidesToShow: 4,
                slidesToScroll: 1,
                nextArrow: '<i class="fa fa-angle-right"></i>',
                prevArrow: '<i class="fa fa-angle-left"></i>',
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });


        $('#trending__maincourse').owlCarousel({
            loop: true,
            margin:20,
            nav: true,
            dots: false,
            autoplay: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                375: {
                    items: 2
                },
                640: {
                    items: 3
                },
                1024: {
                    items: 3
                },
                1280: {
                    items: 4
                },
                1440: {
                    items: 5
                }
            }
        });
        $('#main__blogSL').owlCarousel({
            loop: true,
            margin:15,
            nav: true,
            dots: false,
            autoplay: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                375: {
                    items: 1
                },
                414: {
                    items: 2
                },
                768: {
                    items: 3
                },
                1024: {
                    items: 3
                },
                1280: {
                    items: 4
                },
                1440: {
                    items: 4
                }
            }
        });

        });

        $(document).ready(function () {
            /*$('.addToWishlist').click(function () {


                // $('#lesson_list_area').hide();
                //$('#lesson_list_loader').show();
                var user_id = $(this).data("user");
                var course_id = $(this).data("course");

                if(user_id == "") {
                    window.location.href = "{!! PREFIX !!}login";
                }


                $.ajax({
                    beforeSend: function () {
                        //$('#load').css("display", "block");
                        $('.wishlist_button').css("display", "none");
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    type: 'POST',
                    url: '{{url('add/wishlist')}}',
                    data : { course_id: course_id },
                    success : function (response) {
                        var wishes=parseInt($('.wish_count').text());
                        if (response == 1) {
                            $('a[data-course="'+course_id+'"]').find("i").removeClass('fa-heart-o');
                            $('a[data-course="'+course_id+'"]').find("i").addClass('fa-heart');
                            $('.wish_count').text(wishes++);
                        } else {
                            $('a[data-course="'+course_id+'"]').find("i").removeClass('fa-heart');
                            $('a[data-course="'+course_id+'"]').find("i").addClass('fa-heart-o');
                            $('.wish_count').text(wishes--);
                        }
                        //currentProgress = response;
                        //$('#lesson_list_area').show();
                        //$('#lesson_list_loader').hide();
                    },
                    complete: function () {
                        $('#load').css("display", "none");
                        $('.wishlist_button').css("display", "block");
                    }
                });
            });*/
        });
    </script>

@stop
