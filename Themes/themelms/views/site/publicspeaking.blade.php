@extends('layouts.sitelayout')
<style>
    .panel-body span {
        font-weight: 300 !important;
        color: #000 !important;
    }
    .li-setting span, .li-setting div {
        display: inline-block;
    }
    .main-price {
        font-size: 30px;
        line-height: 40px;
        font-weight: 700;
        color: #fff;
    }
    h2.main-buy-now {
        /*margin: 0 0 0 4%;*/
    }

</style>
@section('content')
    <section class="main_section2">

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-white">
                    <h2 class="main-title">{!! $lms_series->title ?? "" !!}</h2>
                    <p>Preparing and delivering effective speeches and presentations is vital in any professional environment. Stand out from the crowd and learn the art of clear and effective Public Speaking.</p>
                    <h2 class="main-price">£199</h2>
                    <h2 class="main-buy-now">
                    <?php $randid=rand(1,111);?>
                        <a href="javascript:void(0);"
                           data-course-id="{{$lms_series->id}}"
                           data-course-name="{{addslashes($lms_series->title)}}"
                           data-course-price="199"
                           data-course-awarding-body="{{$lms_series->accreditedby->name ?? ""}}"
                           data-quantity="1"
                           data-image="{{$lms_series->image}}"
                           class="btn btn-buy-now" id="{{'buy_'.$lms_series->id.'_'.$randid}}"  onclick="buyNow({{$lms_series->id}},'{{addslashes($lms_series->title)}}','199','1','{{$lms_series->image}}','{{$lms_series->slug}}','{{$lms_series->id.'_'.$randid}}')">Buy Now</a>
                    </h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 position-relative text-center">
                    <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/dots2.png" class="dots1">
                    <div class="video_section">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#videoModal"><i class="fa fa-play-circle"></i></a>
                        <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/video_img2.png" class="img-fluid">
                    </div>
                    <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/dots2.png" class="dots2">
                </div>
            </div>
        </div>

        <svg width="1366" height="748" viewBox="0 0 1366 748" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M-4.51344 0.5H1363.63L1365.81 726.505C1365.81 726.505 1221.93 664.396 975.239 707.729C851.4 729.482 658.051 785.616 427.75 707.729C197.45 629.842 -1.44232 726.505 -1.44232 726.505L-4.51344 0.5Z" fill="#F2F3F5"/>
        </svg>
        <svg width="1366" height="770" viewBox="0 0 1366 770" fill="none" class="nth-child" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H1365.89L1366 769C1366 769 1219.45 682.304 973.17 725.614C849.535 747.355 657.107 803.459 427.187 725.614C197.267 647.768 0 769.5 0 769.5V0Z" fill="#202249"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H1365.89L1366 769C1366 769 1219.45 682.304 973.17 725.614C849.535 747.355 657.107 803.459 427.187 725.614C197.267 647.768 0 769.5 0 769.5V0Z" fill="url(#paint0_linear_89_244)"/>
            <defs>
                <linearGradient id="paint0_linear_89_244" x1="65.5359" y1="140.924" x2="1301.08" y2="688.105" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#063349"/>
                    <stop offset="0.5625" stop-color="#0D4F70"/>
                    <stop offset="1" stop-color="#146B98"/>
                </linearGradient>
            </defs>
        </svg>
    </section>

{{--    <section class="form_section">--}}
{{--        <div class="container">--}}
{{--            <form>--}}
{{--                <div class="row">--}}
{{--                    <div class="form-group col-lg-5 col-md-4 col-sm-6 col-xs-12">--}}
{{--                        <div class="row">--}}
{{--                            <label class="col-md-2">Name</label>--}}
{{--                            <div class="col-md-10">--}}
{{--                                <input class="form-control" type="text" placeholder="Full name">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group col-lg-5 col-md-4 col-sm-6 col-xs-12">--}}
{{--                        <div class="row">--}}
{{--                            <label class="col-md-2">Email</label>--}}
{{--                            <div class="col-md-10">--}}
{{--                                <input class="form-control" type="email" placeholder="Email address">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">--}}
{{--                        <button type="submit" class="btn w-100 btn-primary">Get Started</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </section>--}}

    <section class="course_benifits">
        <div class="container">
            <div class="row row align-items-lg-center justify-content-center">
                <div class="col-md-6 col-sm-12 col-xs-12 text-center position-relative">
                    <img class="img-fluid" src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/about_img3.png"/>
                    <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/box4.png" class="img5">
                    <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/box5.png" class="img6">
                    <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/box6.png" class="img7">
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 mt-20">
                    <h2 class="main-title">Why should you choose this course?</h2>
                    <p>Preparing and delivering effective speeches and presentations is vital in any professional environment.</p>
                    <ul class="course-list">
                        <li><i class="fa fa-check"></i>Overcome doubt, stage fright, and anxiety.</li>
                        <li><i class="fa fa-check"></i>Create a basic outline to organise your speech.</li>
                        <li><i class="fa fa-check"></i>Speak with confidence anywhere, anytime.</li>
                        <li><i class="fa fa-check"></i>Put together a great office presentation.</li>
                    </ul>
{{--                    <a href="{!! url("/redeem_a_voucher?coursenamepost=" . $lms_series->title) !!}" class="btn btn-secondary">Redeem a Voucher</a>--}}
                    <a href="javascript:void(0);"
                       data-course-id="{{$lms_series->id}}"
                       data-course-name="{{addslashes($lms_series->title)}}"
                       data-course-price="199"
                       data-course-awarding-body="{{$lms_series->accreditedby->name ?? ""}}"
                       data-quantity="1"
                       data-image="{{$lms_series->image}}"
                       class="btn btn-buy-now" id="{{'buy_'.$lms_series->id.'_'.$randid}}"  onclick="buyNow({{$lms_series->id}},'{{addslashes($lms_series->title)}}','199','1','{{$lms_series->image}}','{{$lms_series->slug}}','{{$lms_series->id.'_'.$randid}}')">Buy Now</a>
                </div>
            </div>
        </div>
    </section>

    <section class="description_box description-box">
        <div class="container">
            <div class="row row-sm-padding">



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
                        <p>FREE Student ID Card<br></p>
                    </div>
                </div>

                <div class="col-lg-15 col-md-4 col-sm-4 col-xs-12 col-12">
                    <div class="why-join-box text-center">
                        <picture class="n_key_job"></picture>
                        <p>FREE Printed Certificates</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="course_benifits">
        <div class="container">
            <div class="row row align-items-center justify-content-center">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <h2 class="main-title">Benefits of our Public Speaking Course</h2>
                    <ul class="course-list">
                        <li><i class="fa fa-check"></i>Accredited By: CPD</li>
                        <li><i class="fa fa-check"></i>Course Level: Certificate</li>
                        <li><i class="fa fa-check"></i>Course Duration: 365 Days</li>
                        <li><i class="fa fa-check"></i>Number of Modules: 12</li>
                        <li><i class="fa fa-check"></i>Guided Learning Hours: 7</li>
                        <li><i class="fa fa-check"></i>Course Certificate: At completion</li>
                    </ul>
{{--                    <a href="{!! url("/redeem_a_voucher?coursenamepost=" . $lms_series->title) !!}" class="btn btn-secondary">Redeem a Voucher</a>--}}
                    <a href="javascript:void(0);"
                       data-course-id="{{$lms_series->id}}"
                       data-course-name="{{addslashes($lms_series->title)}}"
                       data-course-price="199"
                       data-course-awarding-body="{{$lms_series->accreditedby->name ?? ""}}"
                       data-quantity="1"
                       data-image="{{$lms_series->image}}"
                       class="btn btn-buy-now" id="{{'buy_'.$lms_series->id.'_'.$randid}}"  onclick="buyNow({{$lms_series->id}},'{{addslashes($lms_series->title)}}','199','1','{{$lms_series->image}}','{{$lms_series->slug}}','{{$lms_series->id.'_'.$randid}}')">Buy Now</a>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 text-center mt-20">
                    <img class="img-fluid" src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/about_img4.png"/>
                </div>
            </div>
        </div>
    </section>

    <section class="happy_students">
        <div class="container">
            <div class="student_content">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-12">
                        <div class="count">
                            <span class="counter">23,000</span>+
                            <p>Active Students</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-12">
                        <div class="count">
                            <span class="counter">2000</span>+
                            <p>Courses</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12">
                        <h4>Trusted by 23,000+ happy Students are joining with us for achieve their goal</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="course_curricullum pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <h2 class="main-title">Course Curricullum</h2>
                    <div class="panel-group" id="accordion">
                        @foreach($lms_sections as $section)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a class="accordion-toggle active" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$section->id}}" aria-expanded="true">
                                        <span class="glyphicon glyphicon-plus"></span>
                                        {{$section->section_name}}
                                    </a>
                                </div>
                                <div id="collapseOne{{$section->id}}" class="panel-collapse collapse" aria-expanded="true" style="">
                                    <div class="panel-body">
                                        <ul class="links">
                                            @foreach($section->contents as $content)
                                                <li class="li-setting">
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
                                                        <span class="text {!! (Time_Formates_Units($content->content_type, $content->video_length) != "") ? "text-title" : '' !!}">{{ucwords(strtolower($content->title))}}</span>
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
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{--                        <div class="panel panel-default">--}}
                        {{--                            <div class="panel-heading">--}}
                        {{--                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne115" aria-expanded="false">--}}
                        {{--                                    <span class="glyphicon glyphicon-plus"></span>--}}
                        {{--                                    Module 2 - Identifying Your Audience--}}
                        {{--                                </a>--}}
                        {{--                            </div>--}}
                        {{--                            <div id="collapseOne115" class="panel-collapse collapse" aria-expanded="false">--}}
                        {{--                                <div class="panel-body">--}}
                        {{--                                    4564--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

        </div>
    </section>

    @if(count($lms_series->userReviews) > 0)
        <section class="student_testimonial light_color_lnd pt-50 pb-50">
            <div class="container-fluid text-center">
                <h2 class="main-title">Student Testimonials</h2>
                <div class="row">
                    <div id="testimonial-slide" class="owl-carousel owl-theme">
                        @foreach($lms_series->userReviews as $review)
                            <div class="item">
                                <div class="bg-white h-100 w-100">
                                    <div class="name__info__">
                                        @if($review->image)
                                            <img src="{{IMAGE_PATH_PROFILE_THUMBNAIL.$review->image}}"
                                                 alt="">
                                        @else
                                            @php color_avatar($review->name) @endphp
                                        @endif
                                        <div>
                                            <h3 class="mt-0">{{$review->name}}</h3>
                                            <h6>{{$review->pivot->review_title}}</h6>
                                        </div>
                                    </div>
                                    <p>{{$review->pivot->comment}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif


    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5>Preview</h5>
                    <h4>{!! $lms_series->title ?? "" !!}</h4>
                    <video width="100%" height="100%" poster="https://dgzyo31xc1vmh.cloudfront.net/lms/series/widget/1033-image.jpg" controls="">
                        <source src="https://dgzyo31xc1vmh.cloudfront.net/lms/series/videos/1648465339-video.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
    <!-- End Video Modal -->
@stop
@section('footer_scripts')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js'></script>
    <script src='https://cdn.jsdelivr.net/jquery.counterup/1.0/jquery.counterup.min.js'></script>
    <script>
        $(document).ready(function() {
            $('#testimonial-slide').owlCarousel({
                loop:true,
                margin:15,
                nav:false,
                dots:true,
                //navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                responsiveClass:true,
                items:2,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:3
                    }
                }
            })
        });

        $('.collapse').on('shown.bs.collapse', function () {
            $(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
        }).on('hidden.bs.collapse', function () {
            $(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
        });

        $('.counter').counterUp({
            delay: 10,
            time: 2000
        });
        $('.counter').addClass('animated fadeInDownBig');

        $('#videoModal').on('hidden.bs.modal', function () {
            $("video").each(function(){
                $(this).get(0).pause();
            });
        })

    </script>
@stop