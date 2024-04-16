@extends('layouts.sitelayout')
<style>
    .social-btns .btn .fa {line-height: 40px;}
    @media screen and (min-width:320px) and (max-width:966px) {
        .social-btns .btn .fa {line-height:28px; }
    }
</style>
@section('content')
    <div class="main-content inner_pages">
        <section class="corporate_section certificate__HeaderSect" style="background-image:url('<?=UPLOADS.'images/header_bg/certificate_fee.jpg'?>');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-7 col-sm-8 col-12">
                        {{--<h3>A Whole Bunch of Amazing benefits for your Student Card</h3>--}}
                        <h3>Next Learn Academy FREE E-Certificates</h3>
                        {{--<p>We offer all our learners a Student ID card that offers amazing savings across the UK.</p>--}}
                        <p>Get an official FREE E-Certificate from us</p>
                        <a href="#card-area" class="btn btn-primary">Get yours now</a>
                    </div>
                </div>
            </div>
        </section>

@if($certificate)
            <section class="pt-60 pb-60" id="card-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"></div>
                        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">
                            <div class="section-title text-center">
                                <h2 class="title text-uppercase">Your E certificate request is already received</h2>
                                <p> Soon you will receive the certificate at your below mailing address.</p>
                                <p> {{$certificate->user_name}}</p>
                                <p> {{$certificate->address1}} {{$certificate->address2}} </p>
                                <p> {{$certificate->city}} {{$certificate->zipcode}}</p>
                                <p> {{$certificate->country}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @else
    
        <section class="pt-60 pb-60" id="card-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"></div>
                    <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">
                        @if (isset($_REQUEST['contact']))
    @php
        //
        toastr()->success('Thanks! Our Team will contact you soon');
    @endphp
    <div class="prc_wrap contact_successMsg">
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading contactok">
            <i class="fa fa-check-circle" aria-hidden="true"></i>
            <br/>
            {{ session('status')?session('status'):'Thank You for Your E-Certficiate Request' }}
        </h4>
        <p>
            We have received your FREE E-Certficiate request and would like to thank you for writing to us. If your inquiry is urgent, please use the telephone number listed below to talk to one of our staff members. Otherwise, we will reply by email as soon as possible.
        </p>
        <hr/>
        <p>
            Talk to you soon,<br/>
            <strong>Next Learn Academy</strong>
        </p>
    </div>
</div>
@else
                        <div class="section-title text-center">
                            <h2 class="title text-uppercase">Request <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">now</span></h2>
                            <p> Enter your details upon submission.</p>
                        </div>

                        @if(isset($_REQUEST["success"]))
                        <div class="alert alert-success" role="alert">
                            <b>Your Request has been sent successfully!!</b>
                        </div>
                        @endif
 
                        <form class="studentId_form new__formStyle form_with_payment" name="std_frm" id="std_frm" method="post" enctype="multipart/form-data" action="{{ URL::to("/post_ecertificate_request") }}">
                            @include('errors.errors')
                            <h4>Your Details </h4>
                            {{ csrf_field() }}
                            <div class="row basicInfo">
                                <div class="form-content">                                     
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="text" name="first_name"  required="required" id="first_name" value="" placeholder="First Name">
                                            <label for="first_name">First Name <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="text" name="last_name"  required="required" id="last_name" value="" placeholder="Last Name">
                                            <label for="last_name">Last Name <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="email" name="user_email"  required="required" id="user_email" value="" placeholder="Email">
                                            <label for="user_email">Email Address <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="tel" name="user_phone"  required="required" id="user_phone" value="" placeholder="Contact Number">
                                            <label for="user_phone">Contact no. <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="field">
                                            <input type="text" name="course_title" id="course_title" value="" placeholder="Course Title">
                                            <label for="course_title">Course Name <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12">
                                        @if($rechaptcha_status == 'yes')
                                            <div class="{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}" style="margin: 15px 0px">
                                                {!! app('captcha')->display() !!}
                                                {{--{!! NoCaptcha::displaySubmit('registrationForm', 'Register Now', ['data-theme' => 'dark','class'=>'btn btn-success','id'=>'submit']) !!}--}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="field">
                                            <button type="submit" id="submitrequest" class="btn btn-primary pull-right" >Submit Request</button>
                                           
                                        </div>
                                    </div>

                                </div>



                            </div>
                            <div class="spacer-div"></div>
                            <div class="form-content">

                                 

                                <div class="spacer-div"></div>
                                <input type="hidden" type='text' value="12" name="user_id">
                                <input type="hidden" type='text' value="888" name="course_id">
                                <input type="hidden" name="type" ng-model="item_type" value="e-certificate">
                                <input type="hidden" name="course_type" id="course_type" value="ecert">

                                 
                            </div>

                        </form>

                    </div>
                    @endif
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"></div>
                </div>
            </div>

        </section>

@endif


@stop
@section('footer_scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        $(document).ready(function() {

  
        });
    </script>
@endsection