@extends('layouts.sitelayout')
<style>
    .social-btns .btn .fa {line-height: 40px;}
    @media screen and (min-width:320px) and (max-width:966px) {
        .social-btns .btn .fa {line-height:28px; }
    }
</style>
@section('content')
    <div class="main-content inner_pages">

        <section class="corporate_section" style="background-image:url('<?=UPLOADS.'images/instructor_slider_img.jpg'?>');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-7 col-sm-8 col-xs-9 col-12">
                        <h3 class="text-uppercase">Contact us for more <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Information</span></h3>
                        <p>For more information, you can fill in the form and we will get back to you at our earliest. We ensure our customers are taken care of and have an efficient support team to process all your requests.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="new__formSection">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="title text-uppercase"> <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;"></span></h2>
                        <p>You can let us know in detail the course you are interested in. Our priority is to ensure your requirements are met right away and help achieve your training goals.</p>
                        <blockquote>
                            We provide outstanding content, material and plenty of resources along with a dedicated tutor to cater to each and every requirement during their time of learning at our centre. We also provide customised corporate packages that will meet specific ideas and ideals. A key benefit of corporate packages is that it is an effective investment for individuals and the organisation than in-person training.
                            <br/><br/>
                            Training correlates to improved productivity and creates opportunities for career development. It is a crucial part of the journey of every employee. Well-planned training prepares employees to take on the challenges just as much as the objectives, and to keep abreast with technology, innovation and evolving purpose.
                        </blockquote>
                    </div>
                    <div class="col-md-6">
                        @if(isset($_REQUEST["success"]))
                            <div class="alert alert-success" role="alert">
                                <b>Your request has been send successfully !!</b>
                            </div>
                        @endif
                        @include('errors.errors')
                        <form name="corporateT" id="corporateT" method="post" enctype="multipart/form-data" action="{!! URL::to('/corporate') !!}" class="latest_form" onSubmit="return corporate('');">
                            <div class="form-group">
                                <input class="form-control{!! $errors->has('f_name') ? ' error' : '' !!}" type="text" name="f_name" id="f-name" value="{!! old('f_name') !!}" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="First Name *">
                            </div>{{ csrf_field() }}
                            <div class="form-group">
                                <input class="form-control{!! $errors->has('l_name') ? ' error' : '' !!}" type="text" name="l_name" id="l-name" value="{!! old('l_name') !!}" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Last Name *">
                            </div>
                            <div class="form-group">
                                <input class="form-control{!! $errors->has('email') ? ' error' : '' !!}" type="email" name="email" id="coremail" value="{!! old('email') !!}" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Work Email *">
                            </div>
                            <div id="contactmsg" class="alert alert-danger" style="display: none;" role="alert">
                                Phone number is not valid, Please check it !!
                            </div>
                            <div class="form-group">
                                <input class="form-control{!! $errors->has('contact') ? ' error' : '' !!}" type="tel" name="contact" id="contact" value="{!! old('contact') !!}" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Phone Number *">
                            </div>
                            <div class="form-group">
                                <input class="form-control{!! $errors->has('c_name') ? ' error' : '' !!}" type="text" name="c_name" id="c-name" value="{!! old('c_name') !!}" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Company Name *">
                            </div>
                            <div class="form-group">
                                <input class="form-control{!! $errors->has('j_title') ? ' error' : '' !!}" type="text" name="j_title" id="j-title" value="{!! old('j_title') !!}" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Job Title *">
                            </div>
                            <div class="form-group">
                                    <textarea class="form-control{!! $errors->has('whatare') ? ' error' : '' !!}" name="whatare" id="whatare" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="What are your training needs?"></textarea>
                            </div>
                            <div class="form-group">
                                @if($rechaptcha_status == 'yes')
                                    <div class="{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}" style="margin: 15px 0px">
                                        {!! app('captcha')->display() !!}
                                        {{--{!! NoCaptcha::displaySubmit('registrationForm', 'Register Now', ['data-theme' => 'dark','class'=>'btn btn-success','id'=>'submit']) !!}--}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group form-row">
                                <div class="col-md-8 col-sm-8 col-xs-12"><p class="mb-0">I’d like to receive news, insights, and promotions from NLA for Business</p></div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="switch_btn">
                                        <span>No</span>
                                        <label class="switch"><input type="checkbox" checked><span class="slider round"></span></label>
                                        <span>Yes</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" name="CorporateSave-btn" id="CorporateSave-btn" class="btn btn-primary btn-block">Get in touch</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="corporate_section d-none" style="background-image:url('<?=UPLOADS.'images/header_bg/bg_5.jpg'?>');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-8 col-xs-9 col-12">
                        <h3>Upskill workforce performance with our corporate training solutions</h3>
                        <p>Effective corporate workshops can significantly boost your employees' skills in different ways.</p>
                        <a href="#learnmore" class="btn btn-primary">know more about us</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="corAbout_section pt-60 pb-60 d-none">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                        <img src="<?=UPLOADS?>images/img__1.jpg" class="">
                        <h2 id="learnmore" class="title text-uppercase">Next Learn <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Academy</span></h2>
                        <p>Next Learn Academy is a leader in online learning and offers complete corporate packages for employees of all levels and capabilities. It is an excellent method of learning combined with convenience and flexibility to give employees the opportunity to grow and develop. This encourages your staff to sharpen their skills, develop their leadership abilities and keep up with the newest trends.</p>
                        <p>We provide outstanding content, material and plenty of resources along with a dedicated tutor to cater to each and every requirement during their time of learning at our centre. We also provide customised corporate packages that will meet specific ideas and ideals. A key benefit of corporate packages is that it is an effective investment for individuals and the organisation than in-person training.</p>
                        <p>Training correlates to improved productivity and creates opportunities for career development. It is a crucial part of the journey of every employee. Well-planned training prepares employees to take on the challenges just as much as the objectives, and to keep abreast with technology, innovation and evolving purpose.</p>
                    </div>
                </div>
            </div>
        </section>


        <!-- Section: Popular Courses -->
        <section class="populr_courses corporate__courses d-none">
            <div class="container">
                <div class="section-title text-center pt-20">
                    <h2 class="title text-uppercase">Our Popular Corporate <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Trainings</span></h2>
                </div>
                <div class="row">
                    <div class="col-lg-15 col-md-3 col-sm-4 col-xs-6">
                        <div class="course-box mt-20">
                            <a href="#">
                                    <div class="course-image">
                                        <img src="<?=UPLOADS?>images/leadershipTraining-for-Managers.jpg" alt="Corporate Finance ACCREDITED BY CPD" class="img-responsive">
                                    </div>
                            </a>
                                <div class="course-details">
                                    <a href="#"><h5 class="title">Leadership Training for Managers</h5></a>


                                    <div class="price text-left">   <a href="#" data-toggle="modal" data-target="#myModalRequest" type="button"  class="btn btn-success btn-sm float-right">Enquire Now
                                        </a>
                                    </div>


                                </div>
                            </div>                                    </div>

                    <div class="col-lg-15 col-md-3 col-sm-4 col-xs-6">
                            <div class="course-box mt-20">

                                <a href="#">
                                    <div class="course-image">
                                        <img src="<?=UPLOADS?>images/CV-writing-and-Job-hunting-workshop.jpg" alt="Corporate Finance ACCREDITED BY CPD" class="img-responsive">



                                    </div>   </a>
                                <div class="course-details">
                                    <a href="#"><h5 class="title">CV writing and Job hunting workshop</h5></a>



                                    <div class="price text-left">   <a href="#" data-toggle="modal" data-target="#myModalRequest" type="button"  class="btn btn-success btn-sm float-right">Enquire Now
                                        </a>
                                    </div>


                                </div>
                            </div>                                    </div>
                    <div class="col-lg-15 col-md-3 col-sm-4 col-xs-6">
                            <div class="course-box mt-20">

                                <a href="#">
                                    <div class="course-image">
                                        <img src="<?=UPLOADS?>images/business-AnalysisTraining.jpg" alt="Corporate Finance ACCREDITED BY CPD" class="img-responsive">
                                    </div>
                                </a>
                                <div class="course-details">
                                    <a href="#"><h5 class="title">Business Analysis Training workshop</h5></a>



                                    <div class="price text-left">   <a href="#" data-toggle="modal" data-target="#myModalRequest" type="button"  class="btn btn-success btn-sm float-right">Enquire Now
                                        </a>
                                    </div>


                                </div>
                            </div>                                    </div>
                    <div class="col-lg-15 col-md-3 col-sm-4 col-xs-6">
                            <div class="course-box mt-20">

                                <a href="#">
                                    <div class="course-image">
                                        <img src="<?=UPLOADS?>images/finance-for-non-finance.jpg" alt="Corporate Finance ACCREDITED BY CPD" class="img-responsive">



                                    </div>   </a>
                                <div class="course-details">
                                    <a href="#"><h5 class="title">Finance for Non Finance Managers</h5></a>



                                    <div class="price text-left">   <a href="#" data-toggle="modal" data-target="#myModalRequest" type="button"  class="btn btn-success btn-sm float-right">Enquire Now
                                        </a>
                                    </div>


                                </div>
                            </div>                                    </div>
                    <div class="col-lg-15 col-md-3 col-sm-4 col-xs-6">
                            <div class="course-box mt-20">

                                <a href="#">
                                    <div class="course-image">
                                        <img src="<?=UPLOADS?>images/Coaching-Mentoring-Workshop.jpg" alt="Coaching & Mentoring Workshop" class="img-responsive">



                                    </div>   </a>
                                <div class="course-details">
                                    <a href="#"><h5 class="title">Coaching & Mentoring Workshop</h5></a>


                                    <div class="price text-left">   <a href="#" data-toggle="modal" data-target="#myModalRequest" type="button"  class="btn btn-success btn-sm float-right">Enquire Now
                                        </a>
                                    </div>


                                </div>
                            </div>                                    </div>



                  {{--  <div class="modal fade in" id="myModalRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content enquiry__from">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <div class="w3l_form"></div>
                                <div class="w3_info">
                                    <style>
                                        form#enquiry-form label {
                                            color: black;
                                        }
                                    </style>
                                    <h4 class="modal-title" id="myModalRequestLabel">Contact Next Learn Academy Team</h4>
                                    <form name="enquiry_form" id="enquiry-form" class="contact-form-transparent" method="post" action="{{ URL::to( PREFIX . 'send/enquiry') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group input-effect">
                                            <input name="first_name" id="first_name" class="form-control effect-20" type="text" placeholder="" required="">
                                            <label>Name *</label>
                                            <span class="focus-border"><i></i></span>
                                        </div>

                                        <div class="form-group input-effect">
                                            <input name="phone" id="phone" class="form-control effect-20" type="text" placeholder="">
                                            <label>Telephone no.</label>
                                            <span class="focus-border"><i></i></span>
                                        </div>

                                        <div class="form-group input-effect">
                                            <input name="email" id="email" class="form-control effect-20 required email" required type="email" placeholder="">
                                            <label>Email*</label>
                                            <span class="focus-border"><i></i></span>
                                        </div>

                                        <div class="form-group input-effect">
                                            <select id="inputState" class="form-control effect-20" name="country">
                                                <option value=""></option>
                                                @if(count(App\Http\Controllers\SiteController::AllCountries()) > 0)
                                                    @foreach(App\Http\Controllers\SiteController::AllCountries() as $county)
                                                        <option value="{!! $county->nicename !!}">{!! $county->name !!}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <label for="inputState">Select Country</label>
                                            <span class="focus-border"><i></i></span>
                                        </div>


                                        <div class="form-group input-effect">
                                            <textarea name="msg" id="msg" class="form-control effect-20 required" required="" rows="5" placeholder=""></textarea>
                                            <label>Message*</label>
                                            <span class="focus-border"><i></i></span>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="sub" value="Yes" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">Subscribe me to receive the latest promotions and courses.</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="agree" value="1" id="defaultCheck2">
                                                <label class="form-check-label" for="defaultCheck2">I have read and agreed to the <a href="#">Privacy Policy</a>*</label>
                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <input name="form_botcheck" class="form-control" type="hidden" value="" />
                                            --}}{{--<button type="submit" class="btn btn-primary btn-shadow">{{getPhrase('send_message')}}</button>--}}{{--
                                            <button type="submit" id="saveenq" name="saveenq" class="btn btn-dark btn-theme-colored btn-flat btn-block" data-loading-text="Please wait...">SEND YOUR ENQUIRY</button>
                                        </div>
                                    </form>
                                    --}}{{--{!! Form::close() !!}--}}{{--
                                </div>
                                <div class="row" style="display: none;">
                                    <div class="col-sm-8"><h4 style="margin: 0">Enquire Now</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                  --}}  <!--End Enquiry Model Share close -->

                    <div class="col-md-12 text-center pt-20 d-none">
                        <a href="#" class="btn btn-primary">View more</a>
                    </div>
                </div>
            </div>
        </section>


        <!-- 5 - Contact Us -->
        <section class="corporate_form pt-60 pb-60 d-none" id="corporate-form">
            <div class="container">
                <div class="section-title text-center mb-10">
                    <h2 class="title text-uppercase">Contact us for more <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Information</span></h2>
                    <p>For more information, you can fill in the form and we will get back to you at our earliest. We ensure our customers are taken care of and have an efficient support team to process all your requests. You can let us know in detail the course you are interested in. Our priority is to ensure your requirements are met right away and help achieve your training goals.</p>
                </div>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        @if(isset($_REQUEST["success"]))
                            <div class="alert alert-success" role="alert">
                                <b>Your request has been send successfully !!</b>
                            </div>
                        @endif
                        <form name="corporateT" id="corporateT" method="post" enctype="multipart/form-data" action="{!! URL::to('/corporate') !!}" class="corprt_Inform_form new__formStyle" onSubmit="return validate('');">
                            <div class="form-group col-sm-6">
                                <div class="field">
                                    <input type="text" name="f_name" id="f-name" placeholder="First Name">
                                    <label for="f-name">First Name <span>*</span></label>
                                </div>
                            </div>
                            {{ csrf_field() }}
                            <div class="form-group col-sm-6">
                                <div class="field">
                                    <input type="text" name="l_name" id="l-name" placeholder="Last Name">
                                    <label for="l-name">Last name <span>*</span></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="field">
                                    <input type="text" name="c_name" id="c-name" placeholder="Company Name">
                                    <label for="c-name">Company Name <span>*</span></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="field">
                                    <input type="text" name="n_delegates" id="n-delegates" placeholder="No. of Delegates">
                                    <label for="n-delegates">No. of Delegates <span>*</span></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <div class="field">
                                    <input type="text" name="c_address" id="c-address" placeholder="Complete Address">
                                    <label for="c-address">Complete Address <span>*</span></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="field">
                                    <input type="text" name="city" id="city" placeholder="City">
                                    <label for="city">City <span>*</span></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="field">
                                    <input type="text" name="cs_region" id="cs-region" placeholder="County / State / Region">
                                    <label for="cs-region">County / State / Region <span>*</span></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="field">
                                    <input type="text" name="zip_code" id="zip-code" placeholder="ZIP / Postal Code">
                                    <label for="zip-code">ZIP / Postal Code <span>*</span></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="field select_div">
                                    <select name="country" id="country" placeholder="country">
                                        <option>Country</option>
                                        @if(count(App\Http\Controllers\SiteController::AllCountries()) > 0)
                                            @foreach(App\Http\Controllers\SiteController::AllCountries() as $county)
                                                <option value="{!! $county->nicename !!}">{!! $county->name !!}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label for="zip-code">{{--Select Country <span>*</span>--}}&nbsp;</label>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="field">
                                    <input type="email" name="email" id="coremail" placeholder="Email Address">
                                    <label for="coremail">Email Address <span>*</span></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="field">
                                    <input type="tel" name="contact" id="contact" placeholder="Contact no.">
                                    <label for="contact">Contact no. <span>*</span></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="field select_div">
                                    <select name="training" id="training" placeholder="Training Required?">
                                        <option>Training Required?</option>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                    <label for="training">{{--Training Required? <span>*</span>--}}&nbsp;</label>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="field">
                                    <input type="text" name="expected" id="expected" placeholder="Expected Intake">
                                    <label for="expected">Expected Intake <span>*</span></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="field select_div">
                                    <select name="methods" id="method" placeholder="Training Method">
                                        <option>Training Method</option>
                                        <option>Method 1</option>
                                        <option>Method 2</option>
                                    </select>
                                    <label for="method">{{--Training Method<span>*</span>--}} &nbsp;</label>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <div class="field">
                                    <textarea name="message" id="message" placeholder="Enter your message"></textarea>
                                    <label for="message">Enter your message</label>
                                </div>
                            </div>
                            <div class="form-group col-sm-12 text-center mb-0">
                                <button type="submit" name="CorporateSave-btn" id="CorporateSave-btn" class="btn btn-primary text-uppercase">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </section>

        <section class="reviews__section pt-40">
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
        <!-- Section: Popular Courses -->
        <section class="business__logo">
            <div class="container">
                <p>We work with small and global businesses, training thousands of marketers and marketing leaders</p>
                <div class="row">
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/1salesforce.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/2ringcentral.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/3amazon.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/4cloudiq.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/5vertiv.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/6royalmail.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/7dhl.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/8nhs.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/9royalhooloyway.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/10unioflondon.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/11barclays.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/12hsbc.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/13teamwork.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/14sagepublising.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/15tso.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box logo_16x"><img src="<?=UPLOADS?>images/logos/16xero.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/17vodafone.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/18standford.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/19fundingcircle.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/20king.png"></div></div>
                    <div class="col-lg-15 col-md-15 d-sm-none d-xs-none"><div class="img__box"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/21hmrc.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/22yell.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-12"><div class="img__box"><img src="<?=UPLOADS?>images/logos/23royalsurrey.png"></div></div>
                </div>
            </div>
        </section>

        <!--8 - Client Testimonials-->
        <section class="client__testimonials pt-50 pb-50 d-none">
            <div class="container">
                <h2 class="title text-uppercase text-center">Client <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Testimonial</span></h2>

                <div id="sdnt__testimonial" class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="sdnt-box text-center">
                            <div class="userN"><img src="<?=UPLOADS?>images/user__1.png"/></div>
                            <h5 class="userName">Nicole Adams</h5>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="sdnt-box text-center">
                            <div class="userN"><img src="<?=UPLOADS?>images/user__2.png"/></div>
                            <h5 class="userName">Nicole Adams</h5>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="sdnt-box text-center">
                            <div class="userN"><img src="<?=UPLOADS?>images/user__3.png"/></div>
                            <h5 class="userName">Nicole Adams</h5>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="sdnt-box text-center">
                            <div class="userN"><img src="<?=UPLOADS?>images/user__3.png"/></div>
                            <h5 class="userName">Nicole Adams</h5>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>

@stop
@section('footer_scripts')
    {{-- <script src="{{JS}}recaptcha.js"></script> --}}
    <script src='https://www.google.com/recaptcha/api.js'></script>
<script src="{{JS}}datepicker.min.js"></script>
    <script>
        $(function () {
            // $('#expected').datepicker({
            //     autoclose: true,
            //     startDate: "0d",
            //     format: 'yyyy-mm-dd',
            // });

            $('#sdnt__testimonial').owlCarousel({
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
                        items: 3
                    }
                }
            });
        });
    </script>
@endsection