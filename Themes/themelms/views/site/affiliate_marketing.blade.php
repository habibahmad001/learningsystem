@extends('layouts.sitelayout')
<style>
    .social-btns .btn .fa {
        line-height: 40px;
    }

    .affiliate_marketing .affiliate_section {
        background-position: left top !important;
        background-image: url("<?=UPLOADS.'affiliatemarketing/top-banner.png'?>");
        background-size: cover;
        background-repeat: no-repeat;
    }

    @media screen and (min-width:320px) and (max-width:966px) {
        .social-btns .btn .fa {
            line-height: 28px;
        }
    }
</style>
<link href="{{themes('site/css/affiliate_marketing.css')}}"  rel="stylesheet">
@section('content')
<div class="affiliate_marketing main-content inner_pages bg-white">

    <section class="affiliate_section">
        <div class="container top-banner">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-7 col-sm-8 col-xs-12">
                    <p class="commission">What are you waiting for?</p>
                    <h3 class="banner-header">Join Now!</h3>
                    <p class="description">Apply to join and start earning with Next Learn Academy
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="details_body bg-white pt-40">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="how_section">
{{--                        <h5 class="section_title">Info</h5>--}}
                        <div class="info-header pt-20 text-center text-md-left">Join one of the top affiliate programs in the online education industry!</div>
                        <div class="row pt-40">
                            <div class="col-xs-1 pl-10">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="col-xs-11 pl-20">
                                <div class="column_header">Step 01</div>
                                <div class="column_description pt-10">
                                    <p>Sign up for our affiliate programme.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-20">
                            <div class="col-xs-1 pl-10">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="col-xs-11 pl-20">
                                <div class="column_header">Step 02</div>
                                <div class="column_description pt-10">
                                    <p>Promote our online courses on your platforms.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-20">
                            <div class="col-xs-1 pl-10">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="col-xs-11 pl-20">
                                <div class="column_header">Step 03</div>
                                <div class="column_description pt-10">Make money when people purchase courses using your links.</div>
                            </div>
                        </div>
                    </div>
                    <!-- benefits section -->
                    <div class="benefits_section pt-20 pb-20">
                        <h5 class="section_title">Benefits</h5>
                        <div class="benefits_container pl-sm-40">
                            <div class="benefits_row pt-10">
                                <span><i class="fas fa-circle pr-10"></i>
                                    Earn generous commission on every sale</span>
                            </div>
                            <div class="benefits_row">
                                <span><i class="fas fa-circle pr-10"></i>
                                    Over 800 accredited course to promote</span>
                            </div>
                            <div class="benefits_row">
                                <span><i class="fas fa-circle pr-10"></i>
                                    750,000 happy students currently enrolled on our courses</span>
                            </div>
                            <div class="benefits_row">
                                <span><i class="fas fa-circle pr-10"></i>
                                    Easy Tracking Payment direct to your PayPal or bank account</span>
                            </div>
                        </div>
                    </div>
                    <!-- ! benefits section -->


                </div>
                <!-- form section -->
                <section class="affiliate-form">
                    <div class="col-md-6">
                        <div class="form-container">
                            @if(isset($_REQUEST["success"]))
                            <div class="alert alert-success" role="alert">
                                <b>Your request has been send successfully !!</b>
                            </div>
                            @endif
                            @include('errors.errors')
                            <div class="form bg-light rounded pb-50">
                                <div class="form-header">
                                    <h3 class="text-center p-10">Apply to join</h3>
                                </div>
                                <p class="form-description pr-30 pl-30">Complete the quick enquiry form below and one of our student advisers will be in touch shortly</p>
                                <form name="affiliateT" id="affiliateT" method="post" enctype="multipart/form-data" action="{!! URL::to( PREFIX . 'affiliate_marketing') !!}" class="latest_form pl-20 pr-20 pl-lg-50 pr-lg-50" onSubmit="return Affiliatevalidation('');">
                                    <div class="form-group">
                                        <input class="form-control{!! $errors->has('f_name') ? ' error' : '' !!}" type="text" name="f_name" id="f-name" value="{!! old('f_name') !!}" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="First Name *">
                                    </div>{{ csrf_field() }}
                                    <div class="form-group">
                                        <input class="form-control{!! $errors->has('l_name') ? ' error' : '' !!}" type="text" name="l_name" id="l-name" value="{!! old('l_name') !!}" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Last Name *">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control{!! $errors->has('contact') ? ' error' : '' !!}" type="tel" name="contact" id="contact" value="{!! old('contact') !!}" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Contact Number *">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control{!! $errors->has('email') ? ' error' : '' !!}" type="email" name="email" id="coremail" value="{!! old('email') !!}" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Email Address *">
                                    </div>
                                    <div id="contactmsg" class="alert alert-danger" style="display: none;" role="alert">
                                        Phone number is not valid, Please check it !!
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control{!! $errors->has('c_name') ? ' error' : '' !!}" type="text" name="c_name" id="c-name" value="{!! old('c_name') !!}" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Business Website *">
                                    </div>
                                    <div class="form-group">
                                        <div class="field select_div">
                                            <select id="how_do_you_intend" class="form-control" onkeyup="javascript:($(this).val()) ? $(this).removeClass('errorimp') : $(this).addClass('errorimp')" name="enquiry_type">
                                                <option disabled selected value="">How do you intend to promote our courses?</option>
                                                <option value="General">General Query</option>
                                                <option value="Presale">Presale</option>
                                                <option value="Technical">Technical</option>
                                                <option value="Other">Other</option>

                                            </select>
                                            {{--<label for="enquiry_type">Enquiry Type</label>--}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="field select_div">
                                            <select id="what_is_the_current_size" class="form-control" onkeyup="javascript:($(this).val()) ? $(this).removeClass('errorimp') : $(this).addClass('errorimp')" name="network">
                                                <option disabled selected value=""> What is the current size of your database/network/reach? </option>
                                                <option value="General">General Query</option>
                                                <option value="Presale">Presale</option>
                                                <option value="Technical">Technical</option>
                                                <option value="Other">Other</option>

                                            </select>
                                            {{--<label for="enquiry_type">Enquiry Type</label>--}}
                                        </div>
                                    </div>
                                    <div class="form-group checks_div col-lg-12 col-md-12">
                                        <label class="" for="defaultCheck1">
                                            <input class="form-check-input" type="checkbox" name="sub" value="Yes" id="defaultCheck1">
                                            I have a marketing budget to promote our courses
                                        </label>
                                    </div>
                                    <div class="form-group">

                                        <textarea class="form-control{!! $errors->has('c_name') ? ' error' : '' !!}" type="text" name="comments" id="comments" value="{!! old('c_name') !!}" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Additional information / comments"></textarea>

                                    </div>

                                    <div class="form-group" style="display: none;" id="captcha_msg_conc">
                                        <div class="alert alert-danger" role="alert">
                                            <b>Please check captcha before submit !!</b>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        @if($rechaptcha_status == 'yes')
                                        <div class="{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}" style="margin: 15px 0px">
                                            {!! app('captcha')->display() !!}
                                            {{--{!! NoCaptcha::displaySubmit('registrationForm', 'Register Now', ['data-theme' => 'dark','class'=>'btn btn-success','id'=>'submit']) !!}--}}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-0 text-center pt-20">
                                        <button type="submit" name="join-submit-btn" id="join-submit-btn" class="join-submit-btn p-10 pr-50 pl-50">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- !form section -->
            </div>
        </div>
    </section>
    <!-- bottom body section -->
    <section class="bottom_body_section pb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <section class="faqs frequently_ask_section">
                        <h3 class="header pb-20 pt-20 text-center text-md-left">Frequently Ask Questions</h3>

                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            Is there any cost to join?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            Is there a minimum term contract?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                            Do you have terms and conditions?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                            Is there any cost to join?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFive" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            Is there a minimum term contract?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                                            Do you have terms and conditions?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSix" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                        </div>



                    </section>
                </div>
                <div class="col-md-6">
                    <section class="learn_with_confidance">
                        <h3 class="header pb-20 pt-20 text-center text-md-left">Learn with confidence</h3>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="img__box"><img src="<?=UPLOADS.'images/logos/1salesforce.png'?>"></div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="img__box"><img src="<?=UPLOADS.'images/logos/4cloudiq.png'?>"></div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="img__box"><img src="<?=UPLOADS.'images/logos/5vertiv.png'?>"></div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="img__box"><img src="<?=UPLOADS.'images/logos/7dhl.png'?>"></div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="img__box"><img src="<?=UPLOADS.'images/logo-businss/9reed-h.png'?>"></div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="img__box"><img src="<?=UPLOADS.'images/logo-businss/10hmrc-h.png'?>"></div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="img__box"><img src="<?=UPLOADS.'images/logos/11barclays.png'?>"></div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="img__box"><img src="<?=UPLOADS.'images/logos/2ringcentral.png'?>"></div>
                            </div>
                            <div class="col-lg-15 col-md-4 col-sm-4 col-xs-4">
                                <div class="img__box"><img src="<?=UPLOADS.'images/logos/3amazon.png'?>"></div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <section class="bottom_banner" style="background-image:url({{ URL::asset('public/asset/images/bottom_banner.png')}});">
        <div class="bottom-banner-wrapper position-relative ">
            <div class="container z-index-1 position-relative p-50 p-md-20 p-lg-0">
                <div class="row">
                    <div class="col-md-6  ebook-container">
                        <img src="<?=UPLOADS.'affiliatemarketing/ebook.png'?>" alt="" srcset="" class="e-book position-relative">
                    </div>
                    <div class="col-md-6 pt-lg-100 pt-md-20">
                        <p class="section_title subscribe">Subscribe us</p>
                        <h3 class="banner-header pb-50">Get a Free Course</h3>
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est.Sed dignissim, metus nec fringilla accumsan risus sem sollicitudin lacus, ut interdum tellus elit sed risus.

                        </p>
                        <form name="affiliateT" id="affiliateT" method="post" enctype="multipart/form-data" action="{!! URL::to( PREFIX . 'affiliatesubscribe') !!}" class="latest_form" onSubmit="return affiliatesubscribevalidation('');">
                            <div class="form-group">
                                <input class="form-control{!! $errors->has('name') ? ' error' : '' !!}" type="text" name="name" id="name" value="{!! old('name') !!}" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Your name">
                            </div>{{ csrf_field() }}
                            <div class="form-group">
                                <input class="form-control{!! $errors->has('email') ? ' error' : '' !!}" type="text" name="email" id="email" value="{!! old('email') !!}" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Enter your email address">
                            </div>
                            <div class="form-group mb-0 pt-10">
                                <button type="submit" name="affiliateSave-btn" id="affiliateSave-btn" class="subscribe-btn pr-50 pl-50 p-10">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="overlay gradient-dark"></div>
        </div>
    </section>


    <!--8 - Client Testimonials-->
    <section class="client__testimonials pt-50 pb-50 bg-light">
        <div class="container">
            <div class="row">
                <div class='col-md-offset-2 col-md-8 text-center'>
                    <h2>What are people saying about us?</h2>
                </div>
{{--                <div class='col-md-offset-2 col-md-8 text-center'>--}}
{{--                    <h6>Reviews</h6>--}}
{{--                </div>--}}
            </div>
            <div class='row'>
                <div class='col-md-offset-2 col-md-8 col-sm-10 col-xs-offset-1 col-xs-10 '>
                    <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                        <!-- Bottom Carousel Indicators -->
                        <!-- <ol class="carousel-indicators">
                            <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#quote-carousel" data-slide-to="1"></li>
                            <li data-target="#quote-carousel" data-slide-to="2"></li>
                        </ol> -->

                        <!-- Carousel Slides / Quotes -->
                        <div class="carousel-inner">

                            <!-- Quote 1 -->
                            <div class="item active">
                                <blockquote class="pb-20 pl-20 bg-white">
                                    <div class="row p-20">
                                        <div class="col-sm-3 text-center pl-20 pt-30">
                                            <img class="img-circle" src="<?=UPLOADS.'lms/series/offerbanner/2042749436.jpg'?>" style="width: 100px;height:100px;">
                                            <!--<img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" style="width: 100px;height:100px;">-->
                                        </div>
                                        <div class="col-sm-9">
                                            <h3>PRINCE2 Foundation - Great learning platform</h3>
                                            <p class="">Really intuitive & easy-to-use platform and excellent support from the team whenever questions have been asked. Especially supportive during the COVID-19 lockdowns.</p>
                                            <small>Sophie Moore</small>
                                        </div>
                                    </div>
                                </blockquote>
                                <div class="testimonials-star-rating text-center pt-10">
                                    <strong class="testimonials-star-rating">
                                        <small class="bp_blank_stars"><small style="width: 100%" class="bp_filled_stars"></small></small>
                                    </strong>
                                </div>
                            </div>

                            <!-- Quote 2 -->
                            <div class="item">
                                <blockquote class="pb-20 pl-20 bg-white">
                                    <div class="row p-20">
                                        <div class="col-sm-3 text-center pt-30">
                                            <img class="img-circle" src="<?=UPLOADS.'lms/series/offerbanner/1823511547.jpg'?>" style="width: 100px;height:100px;">
                                            <!--<img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" style="width: 100px;height:100px;">-->
                                        </div>
                                        <div class="col-sm-9">
                                            <h3>Lorem Ipsum: is simply dummy text </h3>
                                            <p class="">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                            <small>Alena</small>
                                        </div>
                                    </div>

                                </blockquote>
                                <div class="testimonials-star-rating text-center pt-10">
                                    <strong class="testimonials-star-rating">
                                        <small class="bp_blank_stars"><small style="width: 100%" class="bp_filled_stars"></small></small>
                                    </strong>
                                </div>
                            </div>
                            <!-- Quote 3 -->
                            <div class="item">
                                <blockquote class="pb-20 pl-20 bg-white">
                                    <div class="row p-20">
                                        <div class="col-sm-3 text-center pt-30">
                                            <img class="img-circle" src="<?=UPLOADS.'lms/series/offerbanner/9473874.jpg'?>" style="width: 100px;height:100px;">
                                            <!--<img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" style="width: 100px;height:100px;">-->
                                        </div>
                                        <div class="col-sm-9">
                                            <h3>Translations: Can you help translate this</h3>
                                            <p class="">The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                                            <small>John Lee</small>
                                        </div>
                                    </div>

                                </blockquote>
                                <div class="testimonials-star-rating text-center pt-10">
                                    <strong class="testimonials-star-rating">
                                        <small class="bp_blank_stars"><small style="width: 100%" class="bp_filled_stars"></small></small>
                                    </strong>
                                </div>
                            </div>
                            <!-- Quote 4 -->
                            <div class="item">
                                <blockquote class="pb-20 pl-20 bg-white">
                                    <div class="row p-20">
                                        <div class="col-sm-3 text-center pt-30">
                                            <img class="img-circle" src="<?=UPLOADS.'lms/series/offerbanner/2018142340.jpg'?>" style="width: 100px;height:100px;">
                                            <!--<img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" style="width: 100px;height:100px;">-->
                                        </div>
                                        <div class="col-sm-9">
                                            <h3>Donate Bitcoin: 16UQLq1HZ3CNwhvgrarV6pMoA2CDjb4tyF</h3>
                                            <p class="">Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text,</p>
                                            <small>Warner</small>
                                        </div>
                                    </div>

                                </blockquote>
                                <div class="testimonials-star-rating text-center pt-10">
                                    <strong class="testimonials-star-rating">
                                        <small class="bp_blank_stars"><small style="width: 100%" class="bp_filled_stars"></small></small>
                                    </strong>
                                </div>
                            </div>
                        </div>

                        <!-- Carousel Buttons Next/Prev -->
                        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
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
    $(function() {
        $(".topbar-img").hide();
        $(".mobile-topbar-img").hide();
        // $('#expected').datepicker({
        //     autoclose: true,
        //     startDate: "0d",
        //     format: 'yyyy-mm-dd',
        // });

        $('#sdnt__testimonial').owlCarousel({
            loop: true,
            margin: 15,
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
@section('footer_scripts')
<script>
    $(function() {
        // Since there's no list-group/tab integration in Bootstrap
        $('.list-group-item').on('click', function(e) {
            var previous = $(this).closest(".list-group").children(".active");
            previous.removeClass('active'); // previous list-item
            console.log(e.target);
            $(e.target).addClass('active'); // activated list-item
        });
    });
</script>
@endsection