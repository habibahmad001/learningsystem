@extends('layouts.sitelayout')

@section('content')
<style>
    div#iframe_preload {
        min-height: 400px;
    }
</style>

<!-- Start main-content -->
<div class="main-content">
    @if($preview_mode)
        <section class="inner-header text-center">
            <span class="btn-sm btn-block btn-warning font-13">Course Preview Mode</span>
        </section>
    @endif
    <!-- Section: inner-header -->
    <section class="inner-header divider layer-overlay overlay-theme-colored-9">
        <div class="container pt-20  pb-30">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row">
                    <div class="col-md-8">
                        <ol class="breadcrumb text-left mt-10 white courses-breadcumb">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{url('/all-courses')}}">Courses</a></li>
                            @if($parent_cat_status)
                            <li><a
                                    href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$lms_parent->slug}}">{{$lms_parent->category}}</a>
                            </li>

                            @endif
                            <li><a href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$lms_cat_slug}}">{{$lms_cat_title}}</a></li>
                            <li class="active" style="font-weight:bold;">{!! $lms_series->title !!}</li>
                        </ol>
                        <h2 class="course-heading font-36">{!! $lms_series->title !!}
                            @if($display_edit)
                            <a href="{{$edit_url}}" class="btn btn-sm" target="_blank">Edit Course</a>
                            @endif

                        </h2>
                        <div class="course-header-wrap" style="color: #fff;">

                            <p class="subtitle"> {!! $lms_series->sub_title !!}</p>
                            <div class="rating-row" style="font-weight: bold;">
                                <span class="course-badge best-seller">{{$level->name}}</span>
                                {{rating_stars($lms_series->reviews)}}

                                @if(count($lms_series->reviews)==0)
                                    <span class="d-inline-block average-rating">{{rating_num($lms_series->reviews)}}</span>
                                    <span>({{count($lms_series->reviews)}} Ratings)</span>
                                @else
                                    <span class="d-inline-block average-rating">{{rating_num($lms_series->reviews)}}</span>
                                    <span class="detl_cont">({{count($lms_series->reviews)}} Ratings)</span>
                                @endif
                                @if($lms_series->number_of_students>0)
                                <span class="enrolled-num">{{$lms_series->number_of_students}} Students Enrolled </span>
                                @endif
                            </div>
                            <div class="created-row">
                                <span class="created-by">
                                    ACCREDITED BY
                                    @if($awardingbody->image)
                                    <img src="{{IMAGE_PATH_UPLOAD_LMS_AWARDING_BODIES.$awardingbody->image}}"
                                        alt="{{$awardingbody->name}}" title="{{$awardingbody->name}}" height="60"
                                        alt="{{$awardingbody->name}}">
                                    @else
                                    <img src="{{IMAGE_PATH_EXAMS_DEFAULT}}" height="60">
                                    @endif
                                </span>
                            </div>

                            <div class="lead-share-cta pt-15">
                                <div class="share-and-gift">
                                        <div class="clp-component-render">
                                            <div class="ud-component--course-landing-page-udlite--wishlist"
                                                data-skip-hydration="true" data-component-props="{}" ng-non-bindable="">
                                                <div>
                                                    @if (Auth::check())
                                                    @php
                                                    $wishtt = App\Wishlist::where('user_id',
                                                    Auth::User()->id)->where('course_id', $lms_series->id)->first();
                                                    @endphp
                                                    @if ($wishtt == NULL)
                                                    <button type="button" id="addToWishlist"
                                                        data-course="{{$lms_series->id}}"
                                                        data-user="{{Auth::User()->id}}" data-purpose="toggle-wishlist"
                                                        class="udlite-btn udlite-btn-small udlite-btn-secondary udlite-heading-sm font-16  font-weight-700"
                                                        style="width: 100%;" onclick="addToWishlist('{{Auth::user()->id}}','{{$lms_series->id}}');">
                                                        <span class="wishlist_button">Wishlist<i
                                                                class="fa fa-heart-o font-16   ml-10"
                                                                aria-hidden="true"></i></span>
                                                        <span id="load" style="display: none" class="loader">
                                                            Saving ... <img src="<?=UPLOADS.'images/ajax-loader.gif'?>"
                                                                id="ajaxSpinnerImage" height="16" title="" />
                                                        </span>
                                                    </button>
                                                    @else
                                                    <button type="button" id="addToWishlist"
                                                        data-course="{{$lms_series->id}}"
                                                        data-user="{{Auth::User()->id}}" data-purpose="toggle-wishlist"
                                                        class="udlite-btn udlite-btn-small udlite-btn-secondary udlite-heading-sm font-16  font-weight-700"
                                                        style="width: 100%;" onclick="addToWishlist('{{Auth::user()->id}}','{{$lms_series->id}}');">
                                                        <span class="wishlist_button">Wishlist<i
                                                                class="fa fa-heart font-16   ml-10"
                                                                aria-hidden="true"></i></span>
                                                        <span id="load" style="display: none" class="loader">
                                                            Saving ... <img src="<?=UPLOADS.'images/ajax-loader.gif'?>"
                                                                id="ajaxSpinnerImage" height="16" title="working..." />
                                                        </span>
                                                    </button>
                                                    @endif
                                                    @else
                                                    <a href="javascript:void(0);" type="button"
                                                        class="udlite-btn udlite-btn-small udlite-btn-secondary udlite-heading-sm font-16 font-weight-700"
                                                       data-course="{{$lms_series->id}}"
                                                       onclick="addToWishlist('', {{ $lms_series->id }});"
                                                        style="width: 100%;">
                                                        <span class="wishlist_button">Wishlist<i
                                                                    class="fa fa-heart-o font-16   ml-10"
                                                                    aria-hidden="true"></i></span>
                                                        <span id="load" style="display: none" class="loader">
                                                            Saving ... <img src="<?=UPLOADS.'images/ajax-loader.gif'?>"
                                                                            id="ajaxSpinnerImage" height="16" title="working..." />
                                                        </span>
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clp-component-render">
                                            <div class="ud-component--course-landing-page-udlite--social-share-button"
                                                data-skip-hydration="true" ng-non-bindable="">

                                                <a href="#" data-toggle="modal" data-target="#myModalshare"
                                                    title="share" data-purpose="social-share-button"
                                                    class="udlite-btn udlite-btn-small udlite-btn-secondary udlite-heading-sm font-16  font-weight-700"
                                                    style="width: 100%;">
                                                    <span>Share</span><i
                                                        class="pe-7s-share font-16 font-weight-700 vertical-align-middle   mr-10 ml-5"></i>
                                                </a></div>
                                        </div>
                                        @if($lms_series->is_paid != 0)
                                        <div class="clp-component-render">
                                            <div class="ud-component--course-landing-page-udlite--gift-this-course"
                                                data-skip-hydration="true" data-component-props="{}" ng-non-bindable="">
                                                <a href="#" data-toggle="modal" data-target="#myModalRequest"
                                                    title="Request Details"
                                                    class="udlite-btn udlite-btn-small udlite-btn-secondary udlite-heading-sm  font-16  font-weight-700"
                                                    aria-disabled="false">
                                                    <span>Enquire now</span><i
                                                        class="pe-7s-mail font-16 font-weight-700 vertical-align-middle   mr-10 ml-5"></i></a>
                                            </div>
                                        </div>
                                        @endif
                                        {{--<div class="clp-component-render">--}}
                                            {{--<div class="ud-component--course-landing-page-udlite--gift-this-course"--}}
                                                 {{--data-skip-hydration="true" data-component-props="{}" ng-non-bindable="">--}}
                                                {{--<a href="{!! URL::to('/gift-course') . "/" . $lms_series->slug !!}" title="Gift this course"--}}
                                                   {{--class="udlite-btn udlite-btn-small udlite-btn-secondary udlite-heading-sm  font-16  font-weight-700"--}}
                                                   {{--aria-disabled="false">--}}
                                                    {{--<span>Gift this course</span><i class="pe-7s-gift font-16 vertical-align-middle ml-5"></i></a>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        <!--Model Share start-->
                                        <div class="modal fade in " id="myModalshare" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding:0!important;margin:0 !important;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Share this Course</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="box box-primary">
                                                        <div class="modal-body">
                                                            <div class="row">

                                                                @php
                                                                $url= URL::current();
                                                                @endphp

                                                                <!-- The text field -->

                                                                <div class="nav-search col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control"
                                                                            id="myInput" value="{{ $url }}">
                                                                    </div>
                                                                    <button onclick="myFunction()"
                                                                        class="btn btn-primary">Copy Text</button>
                                                                </div>

                                                                <div class="social-icon col-md-6">

                                                                    @php

                                                                    echo Share::currentPage('', [], '<div class="">
                                                                        <ul>')
                                                                            ->facebook()
                                                                            ->twitter()
                                                                            ->linkedin('Extra linkedin summary can be
                                                                            passed here')
                                                                            ->whatsapp()
                                                                            ->telegram();

                                                                            @endphp

                                                                    </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <!--Model Share close -->
                                    <div class="clp-component-render d-none">
                                        <a href="<?=url('/gift-course')?>" class="udlite-btn udlite-btn-small udlite-btn-secondary udlite-heading-sm font-16  font-weight-700">Gift this course
                                            <i class="pe-7s-gift font-16 vertical-align-middle ml-5"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Section: Services Details -->
    <section>
        <div class="container mt-0 pt-0 pb-0">
            <div class="row">
                <div class="col-md-9">
                    <div class="single-service">

                        <div class="text-center mobile__sidrbr">
                            <div class="course-sidebar natural course-page-side-bar text-left" id="mobileview">
                                <div class="preview-video-box">
                                    @if($video)
                                        <?php
                                        $cimage=$image;
                                        if(strpos($cimage,'.jpeg')){
                                            if (@getimagesize(IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET.$cimage)){
                                                $cimage=$image;
                                            }else{
                                                $cimage=str_replace('jpeg','jpg',$cimage);
                                            }
                                        } ?>
                                        <img src="{{IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET.$cimage}}" alt="{{$lms_series->title}}" class="img-responsive" style="height: 194px;">
                                        <a href="#"  data-toggle="modal" data-target="#videoModal">
                                            <i class="fas fa-play-circle"></i>
                                            <span>Preview this course</span>
                                        </a>
                                    @elseif($image)
                                        <?php
                                        $cimage=$image;
                                        if(strpos($cimage,'.jpeg')){
                                            if (@getimagesize(IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET.$cimage)){
                                                $cimage=$image;

                                            }else{
                                                $cimage=str_replace('jpeg','jpg',$cimage);
                                            }
                                        } ?>
                                        <img src="{{IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET.$cimage}}" alt="{{$lms_series->title}}"
                                             class="img-responsive" style="height: 194px;">
                                    @else
                                        <img src="{{IMAGE_PATH_EXAMS_DEFAULT}}" alt="{{$lms_series->title}}" class="img-responsive"
                                             style="height: 194px;">
                                    @endif
                                </div>

                                @include('site.partials.course_sidebar')

                                <!--<div class="w-100 text-center gurnted-logo mt-0" style="padding-bottom:10px;">

                                    <img src="<?=UPLOADS?>images/image-removebg-preview1.png" />
                                </div>-->
                            </div>
                        </div>
                        {{--add New section--}}
                        <div class="description-box" style="display:inline-block;max-height:inherit;">
                            @include('errors.errors')
                            <div class="line-bottom-theme-colored2 description-title">Key Features</div>
                            <div class="row row-sm-padding">
                                {{--@if(isset($lms_series->features))--}}
                                    {{--{!! $lms_series->features !!}--}}
                                {{--@else--}}
                                <div class="col-lg-15 col-md-4 col-sm-4 col-xs-6 col-6">
                                    <div class="why-join-box text-center">
                                        <picture class="n_key_user"></picture>
                                        <p>Asynchronous Learning</p>
                                    </div>
                                </div>

                                <div class="col-lg-15 col-md-4 col-sm-4 col-xs-6 col-6">
                                    <div class="why-join-box text-center">
                                        <picture class="n_key_proj"></picture>
                                        <p>Easy Navigation</p>
                                    </div>
                                </div>

                                <div class="col-lg-15 col-md-4 col-sm-4 col-xs-6 col-6">
                                    <div class="why-join-box text-center">
                                        <picture class="n_key_time"></picture>
                                        <p>Support by Phone, Live Chat and Email</p>
                                    </div>
                                </div>

                                <div class="col-lg-15 col-md-4 col-sm-4 col-xs-6 col-6">
                                    <div class="why-join-box text-center">
                                        <picture class="n_key_life"></picture>
                                        <p>FREE Student ID Card<br /></p>
                                    </div>
                                </div>

                                <div class="col-lg-15 col-md-4 col-sm-4 col-xs-12 col-12">
                                    <div class="why-join-box text-center">
                                        <picture class="n_key_job"></picture>
                                        <p>FREE Printed Certificates</p>
                                    </div>
                                </div>
                                {{--@endif--}}
                            </div>
                            <div class="row d-none">
                                <div class="col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="n_li_wrap">
                                        <picture class="n_key_user"></picture>
                                        <span class="n_key_t">42 Hrs Instructor-led Training</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="n_li_wrap">
                                        <picture class="n_key_video"></picture>
                                        <span class="n_key_t">28 Hrs Self-paced Videos</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="n_li_wrap">
                                        <picture class="n_key_proj"></picture>
                                        <span class="n_key_t">56 Hrs Project Work &amp; Exercises</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="n_li_wrap">
                                        <picture class="n_key_time"></picture>
                                        <span class="n_key_t">Flexible Schedule</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="n_li_wrap">
                                        <picture class="n_key_life"></picture>
                                        <span class="n_key_t">24 x 7 Lifetime Support &amp; Access</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="n_li_wrap">
                                        <picture class="n_key_job"></picture>
                                        <span class="n_key_t">Certification and Job Assistance</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End add New section--}}

                        @if($lms_series->what_will_i_learn)
                        <div class="what-you-get-box">
                            <div class="what-you-get-title">What Will I Learn?</div>
                            {!! $lms_series->what_will_i_learn !!}

                        </div>
                        @endif

                        <div class="description-box view-more-parent expanded">

                            <div class="line-bottom-theme-colored2 description-title">Description</div>
                            <div class="description-content-wrap">
                                <div class="description-content">
                                    {!! $short_desc !!}
                                    {!! $desc !!}

                                </div>
                            </div>
                        </div>

                        <div class="description-box view-more-parent expanded">

                            <div class="line-bottom-theme-colored2 description-title">Why You Should Learn at Next Learn Academy?</div>
                            <div class="description-content-wrap">
                                <div class="description-content">
                                    {{--{!! $lms_series->why_consider_nla!!}--}}
                                    {!! ($lms_series->why_consider_nla != '(NULL)')?$lms_series->why_consider_nla:'' !!}

                                </div>
                            </div>
                        </div>

                        <div class="detail_tabs" id="desktop_tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li class="nav-item" class="active"><a href="#entry-r" style="display:block;"
                                        aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true" id="tab-item">entry
                                        requirement</a></li>
                                <li class="nav-item"><a href="#s-attend" style="display:block;" aria-controls="profile"
                                        role="tab" data-toggle="tab" id="tab-item">who should attend</a></li>
                                <li class="nav-item"><a href="#m-assessment" style="display:block;"
                                        aria-controls="messages" role="tab" data-toggle="tab" id="tab-item">Method of assessment</a>
                                </li>
                                <li class="nav-item"><a href="#certification" style="display:block;"
                                        aria-controls="settings" role="tab" data-toggle="tab" id="tab-item">Certification</a></li>
                                <li class="nav-item"><a href="#o-information" style="display:block;"
                                        aria-controls="settings" role="tab" data-toggle="tab" id="tab-item">Other information</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content" id="desktop_tabs_contents">
                                <div role="tabpanel" class="tab-pane active" id="entry-r">
                                    {!! $lms_series->entry_requirements !!}
                                </div>
                                <div role="tabpanel" class="tab-pane" id="s-attend">
                                    {!! $lms_series->who_should_attend !!}
                                </div>
                                <div role="tabpanel" class="tab-pane" id="m-assessment">
                                    {!! $lms_series->method_of_assessment !!}
                                </div>
                                <div role="tabpanel" class="tab-pane" id="certification">
                                    {!! $lms_series->certification !!}
                                </div>
                                <div role="tabpanel" class="tab-pane" id="o-information">
                                    {!! $lms_series->other_information !!}
                                </div>
                            </div>
                        </div>
                        <div class="panel-group " id="accordion_details" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default" style="display:block;">
                                <div class="panel-heading active" role="tab" id="headingOne">
                                    <p class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion_details"
                                            href="#entry_r" aria-expanded="true" aria-controls="collapseOne">
                                            Entry Requirements
                                        </a>
                                    </p>
                                </div>
                                <div id="entry_r" class="panel-collapse collapse in" role="tabpanel"
                                    aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        {!! $lms_series->entry_requirements !!}
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default" style="display:block;">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <p class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                            data-parent="#accordion_details" href="#attend" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            Who Should Attend
                                        </a>
                                    </p>
                                </div>
                                <div id="attend" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        {!! $lms_series->who_should_attend !!}
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default" style="display:block;">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <p class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                            data-parent="#accordion_details" href="#assessment" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Method of Assessment
                                        </a>
                                    </p>
                                </div>
                                <div id="assessment" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        {!! $lms_series->method_of_assessment !!}
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default" style="display:block;">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <p class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                            data-parent="#accordion_details" href="#certification_a"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Certification
                                        </a>
                                    </p>
                                </div>
                                <div id="certification_a" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        {!! $lms_series->certification !!}
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default" style="display:block;">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <p class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                            data-parent="#accordion_details" href="#other_info" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Other Information
                                        </a>
                                    </p>
                                </div>
                                <div id="other_info" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        {!! $lms_series->other_information !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 col-xs-12 col-md-3 ipad__view">
                    <div class="course-sidebar natural course-page-side-bar" id="desktopview" style="top: auto;">
                        <div class="preview-video-box">
                            @if($video)
                                {{--<video   width="316" height="194" controls src="{{VIDEO_PATH_UPLOAD_LMS_SERIES.$video}}">--}}
                                {{--</video>--}}
                                <?php

                                $cimage=$image;
                                if(strpos($cimage,'.jpeg')){
                                    if (@getimagesize(IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET.$cimage)){
                                        $cimage=$image;

                                    }else{
                                        $cimage=str_replace('jpeg','jpg',$cimage);
                                    }
                                } ?>
                                <img src="{{IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET.$cimage}}" alt="{{$lms_series->title}}" class="img-responsive">
                                <a href="javascript:void(0);" class="videoplay d-none" onclick="javascript:detailvideoplay();"></a>
                                <a href="#"  data-toggle="modal" data-target="#videoModal">
                                    <i class="fas fa-play-circle"></i>
                                    <span>Preview this course</span>
                                </a>
                                <!-- Video Modal -->
                                <div class="detailvideo d-none" id="detailvideo">
                                    <div class="close-div" onclick="javascript:$('#detailvideo').hide(300);">X</div>
                                    <video   width="316" height="194" controls src="{{VIDEO_PATH_UPLOAD_LMS_SERIES.$video}}">
                                    </video>
                                </div>
                                <!-- End Video Modal -->
                            @elseif($image)
                            <?php

                                    $cimage=$image;
                                    if(strpos($cimage,'.jpeg')){
                                        if (@getimagesize(IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET.$cimage)){
                                            $cimage=$image;

                                        }else{
                                            $cimage=str_replace('jpeg','jpg',$cimage);
                                        }
                                    } ?>
                            <img src="{{IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET.$cimage}}" alt="{{$lms_series->title}}"
                                class="img-responsive" style="height: 194px;">
                            @else
                            <img src="{{IMAGE_PATH_EXAMS_DEFAULT}}" alt="{{$lms_series->title}}" class="img-responsive"
                                style="height: 194px;">
                            @endif
                        </div>
                        @include('site.partials.course_sidebar')

                    <!--<div class="w-100 text-center gurnted-logo mt-0" style="padding-bottom:10px;">

                            <img src="<?=UPLOADS?>images/image-removebg-preview1.png" />
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="certificate_new_bx mt-40 d-none">
        <div class="container pt-0 pb-0">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="fee_box">
                        <div class="title">Program Fee</div>
                        <div class="emi_info">
                            <span>Starting @</span>
                            <p>?22,000/month</p>
                        </div>
                        <span class="total_title">Total Program Fee</span>
                        <span class="totla_price">?3,25,000 </span>
                    </div>
                </div>
                <div class="col-lg-5 col-md-4 col-sm-12 col-xs-12 text-left">
                    <h2 class="title text-white mb-0">Get a chance to win a scholarship up to Rs.1.10 Lakhs</h2>
                    <div class="certi_btn_cta mt-30" style="text-align:left !important;">
                        <a href="#" class="btn btn-primary">APPLY FOR SCHOLARSHIP</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Curriculum -->
    <section>
        <div class="container mt-0 pt-0 pb-0">
            <div class="row">
                <div class="col-md-9">
                    <div class="single-service">
                        <div class="course-curriculum-box">
                            <div class="course-curriculum-title clearfix">
                                <div class="title float-left line-bottom-theme-colored2">Curriculum</div>
                                <div class="float-right">
                                    @if($display_edit)
                                        <a href="{{URL_LMS_SERIES_ADDSECTIONS.$lms_series->slug}}" class="btn btn-sm"
                                           target="_blank">Edit Sections</a>
                                        <a href="{{URL_LMS_SERIES_UPDATE_SERIES.$lms_series->slug}}" class="btn btn-sm"
                                           target="_blank">Edit Units</a>
                                    @endif
{{--                                    <span class="total-lectures"> {{$lms_series->getContents()->count()}} Units--}}
{{--                                    </span>--}}

                                </div>
                            </div>
                            <div class="all-section-total" style="display: none">
                                <div class="all-section-left">
                                    <span   ><span class="glyphicon glyphicon-th" style="margin-right: 2px;"></span> {!! count($lms_sections) !!} Sections&nbsp;&nbsp;&nbsp;</span>
                                    <span   ><span class="glyphicon glyphicon-save-file" style="margin-right: 2px;"></span> {!! Course_Time($lms_sections)["lec"] !!} Lectures&nbsp;&nbsp;&nbsp;</span>
                                    <span @if(trim(Course_Time($lms_sections)["time"])=='00m') class="d-none" @endif><span class="glyphicon glyphicon-time" style="margin-right: 2px;"></span> {!! Course_Time($lms_sections)["time"] !!}Total Length</span></div>
                                <div class="all-section-right">Expand all sections</div>
                            </div>
                            <div class="count-all-course">
                                <div class="row">
                                    <div class="col">
                                        <div class="d-flex">
                                            <i class="fa fa-list"></i>
                                            <div>
                                                {!! count($lms_sections) !!} <span>Sections</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex">
                                            <i class="fa fa-book"></i>
                                            <div>
                                                {!! Course_Time($lms_sections)["lec"] !!} <span>Lectures</span>
                                            </div>
                                        </div>
                                    </div>
                                    @if(trim(Course_Time($lms_sections)["time"]) !='00m')
                                        <div class="col">
                                            <div class="d-flex">
                                                <i class="far fa-clock"></i>
                                                <div>
                                                    {!! Course_Time($lms_sections)["time"] !!} <span>Total</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                               <div class="panel-group" id="accordion">
                                @foreach($lms_sections as $section)

                                    <div class="panel panel-default ">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapseOne{{$section->id}}">
                                                    <span class="glyphicon glyphicon-plus"></span>
{{--                                                    {{ucwords($section->section_name)}}--}}
                                                    {{$section->section_name}}
                                                    {{--                                                        <span class="badge badge-primary badge-pill">--}}
                                                    {{--                                                            {{count($section->contents)}}Units--}}
                                                    {{--                                                        </span>--}}
                                                    <span class="section-time">{!!  (Section_Time($section) !== "00") ? '<i class="glyphicon glyphicon-save-file" style="margin-right: 2px;"></i> ' . str_pad(count($section->contents), 2, '0', STR_PAD_LEFT) . ' Lectures&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-time" style="margin-right: 2px;"></i> ' . Section_Time($section) . "min" : '' !!}</span>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne{{$section->id}}" class="panel-collapse collapse anidi_services">
                                            <div class="panel-body">
                                                <ul class="links">
                                                    @php
                                                          $total_time = array();
                                                          unset($total_time);
                                                    @endphp
                                                    @foreach($section->contents as $content)
                                                        <li>
                                                            <span class="icon">
                                                                @if($content->content_type=='video_url')<i class="fas fa-play-circle"></i>@endif
                                                                @if($content->content_type=='video')<i class="fas fa-play-circle"></i>@endif
                                                                @if($content->content_type=='file')<i class="far fa-file"></i>@endif
{{--                                                                @if($content->content_type=='iframe')<i class="fas fa-border-all"></i>@endif--}}
                                                                @if($content->content_type=='iframe')<i class="fas fa-play-circle"></i>@endif
                                                                @if($content->content_type=='url')<i class="fas fa-link"></i>@endif
                                                                    {{--   @if($content->image)
                                                                                    <img src="{{IMAGE_PATH_UPLOAD_LMS_CONTENTS.$content->image}}"
                                                                    style="width: 30px;">
                                                                    @else
                                                                    <img src="{{IMAGE_PATH_EXAMS_DEFAULT}}"
                                                                        style="width: 30px;">
                                                                    @endif--}}
                                                            </span>
                                                            <div class="list-item-content">
                                                                <span class="text {!! (Time_Formates_Units($content->content_type, $content->video_length) != "") ? "text-title" : '' !!}">{{$content->title}}</span>
                                                                <span class="hidden--on-mobile"></span>

                                                                @php if($content->preview == "yes") echo '<span class="text-right preview_link"><a href="javascript:void(0)" class="preview_class" data-toggle="modal" data-item="'.$content->id.'">Preview</a></span>' @endphp

                                                                <span class="text-right time_count">@php if(Time_Formates_Units($content->content_type, $content->video_length) != "") { echo '' . Time_Formates_Units($content->content_type, $content->video_length); } $total_time[] = $content->video_length; @endphp</span>
                                                                <?php
                                                                $user = auth()->user();
                                                                if($user != null){
                                                                $arr = App\UserCourses::where('user_id' , $user->id)->pluck('item_id')->toArray();

                                                                if(in_array($user->id,$arr,true)){
                                                                ?>
                                                                @if($content->content_type == 'file')
                                                                    <a href="{{URL_DOWNLOAD_LMS_CONTENT.$content->slug}}">{{getPhrase('download_file')}}</a>
                                                                    <a href="{{IMAGE_PATH_UPLOAD_LMS_CONTENTS.$content->file_path}}" target="_blank">{{getPhrase('view_document')}}</a>
                                                                @elseif($content->content_type == 'url' || $content->content_type ==
                                                                'video_url' || $content->content_type == 'audio_url')

                                                                    <a href="{{$content->file_path}}" target="_blank">{{getPhrase('view')}}</a>

                                                                @elseif($content->content_type == 'iframe')

                                                                    <a href="{{URL_LMS_VIDEO_CONTENT.$content->slug.'/'.$lms_series->id}}"
                                                                       target="_blank">{{getPhrase('view')}}</a>

                                                                @endif
                                                                <?php
                                                                }
                                                                }
                                                                ?>
                                                            </div>
                                                        </li>
                                                        <div class="hiddentotal">@php if(Time_Formates_Units($content->content_type, $content->video_length) != "") { Total_Time_Calculated($total_time); } @endphp</div>
                                                    @endforeach

                                                    @foreach($section->exams as $exam)

                                                        <li><a href="">
                                                                {{--<span class="icon"><i class="fa fa-car"></i></span>--}}
                                                                <span class="icon"><i class="fas fa-question-circle"></i>
                                                            {{--@if($exam->image)
                                                                                <img src="{{IMAGE_PATH_EXAMS.$exam->image}}"
                                                            alt="{{$lms_series->title}}" class="img-responsive">
                                                            @else
                                                            <img src="{{IMAGE_PATH_EXAMS_DEFAULT}}"
                                                                alt="{{$lms_series->title}}" class="img-responsive">
                                                            @endif--}}
                                                        </span>
                                                                {{--<span class="text">{{$exam->exam_type}} -
                                                                {{$exam->title}}</span></a>--}}


                                                                {{--<a href="{{URL_FRONTEND_START_EXAM.$exam->slug}}"><span
                                                                    class="textexam"> {{$exam->exam_type}} Exam -
                                                                    {{$exam->title}}</span></a>--}}
                                                                {{--<a href="#"><span class="textexam"> {{$exam->exam_type}} Exam -
                                                                {{$exam->title}}</span></a>--}}
                                                                <span class="textexam"> {{ucwords($exam->title)}}</span></a>
                                                            <div class="clearfix"></div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                                @if ($lms_series->exams()->count()>0)
                                    <div class="panel panel-default ">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapseOne_exams">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                    Exams
                                                    {{--<span class="badge badge-primary badge-pill"> </span>--}}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_exams" class="panel-collapse collapse anidi_services">
                                            <div class="panel-body">
                                                <ul class="links">
                                                    <?php //dd($lms_series->exams()); ?>
                                                    @foreach($lms_series->exams() as $exam)
                                                        <li><a href="">
                                                                {{--<span class="icon"><i class="fa fa-car"></i></span>--}}
                                                                <span class="icon"><i class="fas fa-question-circle"></i>
                                                            {{-- @if($exam->image)
                                                                                <img src="{{IMAGE_PATH_EXAMS.$exam->image}}"
                                                            alt="{{$lms_series->title}}" class="img-responsive">
                                                            @else
                                                            <img src="{{IMAGE_PATH_EXAMS_DEFAULT}}"
                                                                alt="{{$lms_series->title}}" class="img-responsive">
                                                            @endif--}}
                                                        </span>
                                                                {{--<span class="text">{{$exam->exam_type}} -
                                                                {{$exam->title}}</span></a>--}}


                                                                {{--<a href="{{URL_FRONTEND_START_EXAM.$exam->slug}}"><span
                                                                    class="textexam"> {{$exam->exam_type}} Exam -
                                                                    {{$exam->title}}</span></a>--}}
                                                                {{--<a href="#"><span class="textexam"> {{$exam->exam_type}} Exam -
                                                                {{$exam->title}}</span></a>--}}
                                                                <span class="textexam"> {{$exam->title}}</span></a>
                                                            <div class="clearfix"></div>
                                                        </li>

                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="advertising-banner-2nNLA">
                        <div class="adv-banner-title">Top Companies Trust Next Learn Academy</div>
                        <div class="adv-banner-content">Get your team access to Next Learn Academy's top 600+ courses</div>
                        <div class="adv-top-companies">
                            <img src="<?=UPLOADS?>images/logo-businss/1salesforce-h.png" alt="" style="height:38px;">
                            <img src="<?=UPLOADS?>images/logo-businss/2ring central-h.png" alt="">
                            <img src="<?=UPLOADS?>images/logo-businss/3amazon-h.png" alt="">
                            <img src="<?=UPLOADS?>images/logo-businss/4cloudiq-h.png" alt="">
                            <img src="<?=UPLOADS?>images/logo-businss/5vertiv-h.png" alt="">
                        </div>
                        <a href="<?=url('/corporate')?>" class="btn btn-outline-primary">Try NLA for Business</a>
                    </div>

                    <div class="certificate_new_bx">
                        <div class="">
                            {{--Certificate_new_bx section--}}
                            <div class="">
                                <div class="col-md-12">
                                    <h2 class="title text-dark mb-10 text-center">Preview Certificate and Apply for Student ID Card</h2>
                                    {{--<p class="text-white d-none ">Infin-ty DevOps Engineer Certificate Holders work at 1000s of companies like</p>--}}
                                    <div class="d-flex">
                                        <img class="lazyImages img_ctrs" data-toggle="modal" data-target="#fullcertificate" alt="" src="{{ isset($lms_series->certificate) ? UPLOADS.'lms/certificate/'.$lms_series->certificate : UPLOADS . 'images/sample_crt.jpg'  }}"/>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade " id="fullcertificate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Enlarge Certificate View</h4>
                                                                </div>
                                                                <div class="modal-body" style="padding: 0px">
                                                                    <img   alt="" src="{!! (isset($lms_series->certificate)) ? UPLOADS.'lms/certificate/'.$lms_series->certificate : UPLOADS . 'images/sample_crt.jpg' !!}" style="width:auto !important;" />

                                                                </div>
                                                                {{--<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                        {{--<div data-toggle="modal" data-target="#fullcertificate" class="click_to_zoom text-center"><i class="fa fa-search-plus"></i></div>--}}
                                        <img class="img_ctrs" alt="" src="<?=UPLOADS?>images/StudentID__Card.png">
                                    </div>
                                </div>

                                <div class="col-md-12 certi_holders">

                                    {{--<p class="box_title"></p>--}}
                                    <div class="holder_img"></div>


                                    <div class="modal fade" id="getInTouchModal" tabindex="-1" role="dialog" aria-labelledby="getInTouchModal" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Get In Touch</h4>
                                                </div>
                                                <div class="modal-body bg-light">
                                                    <form class="">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input class="form-control" type="email">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Phone Number</label>
                                                            <input class="form-control" type="tel">
                                                        </div>

                                                        <a href="#" class="btn btn-lg btn-primary btn-block w-100">Submit</a>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            {{--End Certificate_new_bx section--}}
                        </div>
                    </div>

                    @if(count($frequently_bought) > 0)
                        @include('site.partials.frequently_bought')
                    @endif

                    <div class="reviews__section pt-40">
                        <script src="https://widget.reviews.co.uk/rich-snippet-reviews-widgets/dist.js"></script>
                        <div id="carousel-inline-widget-1210" style="width:100%;margin:0 auto;"></div>
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

                    @if(isset($lms_series->faqs) && $lms_series->faqs)
                    <div class="detailpg_faqs">
                        <div class="title float-left line-bottom-theme-colored2">FAQs</div>
                        <div class="panel-group" id="faq-accordion">
                            @foreach(json_decode($lms_series->faqs) as $key=>$faqs)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#faqaccordion" href="#collapsefaq-{!! $key !!}" aria-expanded="false">
                                            <span class="glyphicon glyphicon-chevron-down"></span>
                                            {!! $faqs[0] !!}
                                        </a>
                                    </div>
                                    <div id="collapsefaq-{!! $key !!}" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            {!! $faqs[1] !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <script>
        <?php
            $title_c=str_replace('&amp;','&',$lms_series->title);
            $c_category=str_replace('&amp;','&',getCourseCategory($lms_series->id));

            if($lms_series->is_paid){
                $cost=$lms_series->cost;
            }else{
                $cost=0;
            }
            ?>

        window.dataLayer=window.dataLayer||[];
        dataLayer.push({
            'pageType': 'course',
            'courseId': '{{$lms_series->id}}',
            'courseName': '{!! $title_c !!}',
            'courseCategory': '{!! $c_category !!}' ,

            'coursePrice': '{{currencyPrice($lms_series->cost)}}' ,

            'courseCurrency': '{{ getSetting('currency','site_settings')}}' ,
            'courseType': '{{$lms_series->accreditedby->name}}',
        });
    </script>


    <section>
        <div class="container pt-0">
            <div class="row">
                <div class="col-md-9 single-service">
                    <div class="student-feedback-box">
                        <div class="student-feedback-title line-bottom-theme-colored2">Student Feedback </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="average-rating">

                                        <div class="num">
                                            {{rating_num($lms_series->reviews)}}
                                        </div>
                                        <div class="rating">
                                            {{rating_stars($lms_series->reviews)}}
                                        </div>

                                   <div class="title">Average Rating</div>
                                </div>
                            </div>
                            <div class="col-lg-9">

                                <div class="individual-rating">
                                    <?php
                                    $counter=1;

                                    $user_info = DB::table('reviews')
                                        ->select('rating', DB::raw('count(*) as total'))
                                        ->where('course_id',$lms_series->id)
                                        ->groupBy('rating')
                                        ->orderBy('rating', 'DESC')
                                        ->get();

                                    $arr = json_decode(json_encode($user_info), TRUE);
                                    //print_r($arr);

                                    $total = count($lms_series->reviews);
                                    $percentages=[];



                                    foreach ( $arr as $key=> $item )
                                        $percentages[$item['rating']]= ceil($item['total'] / ($total /100));


                                    ?>
                                    <ul>

                                        {{--@foreach($percentages as $key=>$percentage)--}}
                                        <?php

                                        for($i = 5; $i >= 1; $i--) {

                                        $key=$i;
                                        $empstars=5-$key;
                                        $totstars = array_fill(0, $key, NULL);
                                        $nilstars= 5-count($totstars);
                                        $empstars = array_fill(0, $nilstars, NULL);
                                        if(isset($percentages[$i])){
                                            $percentage=$percentages[$i];
                                        }else{
                                            $percentage=0;
                                        }

                                        ?>
                                        <li>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: {{$percentage}}%"></div>
                                            </div>
                                            <div>
                                                    <span class="rating">
                                                        @foreach($empstars as $item)
                                                            <i class="fas fa-star "></i>
                                                        @endforeach

                                                        @foreach($totstars as $item)
                                                            <i class="fas fa-star filled"></i>
                                                        @endforeach


                                                    </span>
                                                <span>{{$percentage}}%</span>
                                            </div>
                                        </li>
                                        <?php $counter++;

                                        }
                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        @if(count($lms_series->userReviews) > 0)
                            <div class="reviews">
                                <div class="reviews-title">Reviews</div>
                                {{--{{$lms_series->userReviews}}--}}
                                <ul>
                                    @foreach($lms_series->userReviews as $review)
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="reviewer-details clearfix">
                                                        <div class="reviewer-img float-left mb-20">
                                                            @if($review->image)
                                                                <img src="{{IMAGE_PATH_PROFILE_THUMBNAIL.$review->image}}"
                                                                     alt="">
                                                            @else
                                                               @php color_avatar($review->name) @endphp
                                                            @endif
                                                        </div>
                                                        <div class="review-time">
                                                            <div class="time">
                                                                {{--Sun, 07-Oct-2018  --}}
                                                                {{date('D, d-M-Y',strtotime($review->pivot->created_at))}}
                                                            </div>
                                                            <div class="reviewer-name">
                                                                {{$review->name}} </div>
                                                            <?php
                                                            $totstars = array_fill(0, $review->pivot->rating, NULL);
                                                            $nilstars= 5-count($totstars);
                                                            $empstars = array_fill(0, $nilstars, NULL);

                                                            ?>
                                                            <div class="rating">
                                                                @foreach($totstars as $key=>$value )
                                                                    <i class="fas fa-star filled" style="color: #f5c85b;"></i>
                                                                @endforeach
                                                                @foreach($empstars as $key=>$value )
                                                                    <i class="fas fa-star" style="color: #abb0bb;"></i>
                                                                @endforeach


                                                                {{--<i class="fas fa-star filled" style="color: #f5c85b;"></i>
                                                                    <i class="fas fa-star filled" style="color: #f5c85b;"></i>
                                                                    <i class="fas fa-star filled" style="color: #f5c85b;"></i>
                                                                    <i class="fas fa-star filled" style="color: #f5c85b;"></i>
                                                                    <i class="fas fa-star" style="color: #abb0bb;"></i>--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="review-details">


                                                        <div class="review-title">{{$review->pivot->review_title}}</div>
                                                        <div class="review-text">{{$review->pivot->comment}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        @else
                            {{--<br /><center><b style="color: red; font-size: 14px;">No reviews to display</b></center>--}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@if(stripos($lms_series->course_tags,'showinstructor')!==false)
    <section class="instructors__section">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="title float-left line-bottom-theme-colored2">Instructors</div>

                    <div class="instructor__content">
                        <h4>{!! (isset(getInstructor($lms_series->instructor->email)->fname)) ? getInstructor($lms_series->instructor->email)->fname : "" !!} {!! (isset(getInstructor($lms_series->instructor->email)->lname)) ? getInstructor($lms_series->instructor->email)->lname : "" !!}</h4>
                        <?php //$instuctor = \App\Instructor::select('detail')->where('user_id','=',$lms_series->user_id)->first(); ?>
                        <p>{!! (isset(getInstructor($lms_series->instructor->email)->designation)) ? getInstructor($lms_series->instructor->email)->designation : "AI Entrepreneur" !!}</p>
                        <div class="instructor_box">
                            <img src="https://fortmyersradon.com/wp-content/uploads/2019/12/dummy-user-img-1-150x150.png"/>
                            <ul>
                                <li><i class="fa fa-star"></i> {!! (isset(getInstructor($lms_series->instructor->email)->rating)) ? getInstructor($lms_series->instructor->email)->rating : "4.5" !!} Instructor Rating</li>
                                <li><i class="fa fa-certificate"></i> {!! (isset(getInstructor($lms_series->instructor->email)->reviews)) ? getInstructor($lms_series->instructor->email)->reviews : "237,879" !!} Reviews</li>
                                <li><i class="fa fa-users"></i> {!! (isset(getInstructor($lms_series->instructor->email)->students)) ? getInstructor($lms_series->instructor->email)->students : "1,296,815" !!} Students</li>
                                <li><i class="fa fa-play-circle"></i> {!! (isset(getInstructor($lms_series->instructor->email)->ncourses)) ? getInstructor($lms_series->instructor->email)->ncourses : "50" !!} Courses</li>
                            </ul>
                        </div>
                        <div class="instructor__about">
                            <p> </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endif

    @if(count($lms_series_related) > 0)
        <section class="related_courses bg-silver-light" style="display: none;">
            <div class="container pt-40 pb-40">
                <div class="text-left mb-0 d-inline-block">
                    <div class="title float-left line-bottom-theme-colored2 mb-0">Recommended Courses</div>
                    {{--<h2 class="title text-uppercase">Recommended <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Courses</span></h2>--}}
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Section: Clients -->

                        <div class="owl-carousel-5col  transparent text-left" data-nav="true" data-dots="false">
                            @foreach($lms_series_related as $series)


                            <div class="item">
                                @include('site.partials.course_widget')

                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="pt-50 pb-50 business__associates">
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


<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5>Course Preview</h5>
                <h4>{{$lms_series->title}}</h4>
                <video width="100%" height="100%" poster="{{IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET.$lms_series->image}}" controls>
                    <source src="{{VIDEO_PATH_UPLOAD_LMS_SERIES.$video}}" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>
<!-- End Video Modal -->

<!-- Video Modal Ifram -->
<div class="modal fade" id="iframeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5>Course Preview</h5>
                <h4 id="iframe-title">{{$lms_series->title}}</h4>
                <div id="iframe_preload">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/llhtDVnXBzM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Video Modal -->

@stop

@section('footer_scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>

$('#videoModal').on('hidden.bs.modal', function () {
    $("video").each(function(){
        $(this).get(0).pause();
    });
})
$('#iframeModal').on('hidden.bs.modal', function () {
    $("iframe").each(function(){
        $(this).get(0).pause();
    });
})

    var my_slug = "{{$lms_cat_slug}}";

    if (!my_slug) {

        $(".cs-icon-list li").first().addClass("active");
    }
    else {

        $("#" + my_slug).addClass("active");
    }

    function myFunction() {
        /* Get the text field */
        var copyText = document.getElementById("myInput");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");

    }
    $(document).ready(function () {

        $('h1').on('click', function () {
            $('#Modal').modal('show');
        });



        $('.collapse').on('shown.bs.collapse', function () {
            $(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
        }).on('hidden.bs.collapse', function () {
            $(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
        });


   $('.preview_class').click(function () {
        $.ajax({
            beforeSend: function () {

            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            type: 'POST',
            url: '{{url('getpreviewiframe')}}',
            data : { item_id: $(this).attr("data-item") },
            success : function (response) {
                if (response.status == "success") {
                    // console.log(response.data.series.file_path);
                    $("#iframe-title").text(response.data.series.title);
                    $("#iframe_preload").html(response.data.series.file_path);
                    $("#iframeModal").modal('show');
                }
            },
            complete: function () {

            }
                });
            });
        });
</script>



@stop