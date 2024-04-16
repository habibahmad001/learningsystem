@extends('layouts.sitelayout')
<style>
    .social-btns .btn .fa {line-height: 40px;}
    .btn-save {
        cursor: pointer;
        color: #fff;
        width: 100%;
    }
    .img-setting {
        width: 75%;
    }
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
                        <h3>Next Learn Academy Certificates</h3>
                        {{--<p>We offer all our learners a Student ID card that offers amazing savings across the UK.</p>--}}
                        <p>Get an official Certificate from us</p>
                        <a href="#card-area" class="btn btn-primary">Get yours now</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-60 pb-60" id="card-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <img src="{!! UPLOADS . 'lms/series/offerbanner/379849448.jpg' !!}" class="img-setting" />
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <br /><br /><br /><br />
                        <div class="section-title text-center">
                            <h2 class="title text-uppercase">Apply <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">now</span></h2>
                            <p> Enter your details upon submission.</p>
                        </div>

                        @if(isset($_REQUEST["success"]))
                        <div class="alert alert-success" role="alert">
                            <b>Your Order has been send successfully!!</b>
                        </div>
                        @endif
<?php


                            $user = (auth()->user()) ? auth()->user() : "";
                            $user_id=isset($user->id) ? $user->id : 0;
                            $user_name=isset($user->name) ? $user->name : "";
                            $user_email=isset($user->email) ? $user->email : "";
                            $user_phone=isset($user->phone) ? $user->phone : "";

                        ?>
                        <form class="studentId_form new__formStyle form_with_payment" name="std_frm" id="std_frm" method="post" enctype="multipart/form-data" action="{!! URL::to("/freelance_pay_certificate_fee") !!}" onSubmit="javascript:return freelancervalidation('');">
                            @include('errors.errors')
                            <h4 onclick="javascript:$('.basicInfo').toggle(300); ($(this).find('i').attr('class') == 'fa fa-angle-down angle-position') ? $(this).find('i').attr('class', 'fa fa-angle-up angle-position') : $(this).find('i').attr('class', 'fa fa-angle-down angle-position')">Your Details <i class="fa fa-angle-up angle-position" aria-hidden="true"></i></h4>
                            {{ csrf_field() }}


                            <div class="row basicInfo">


                                <div class="form-content">
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="text" name="user_name" id="user_name" value="{{$user_name}}" placeholder="User Name"  required="required">
                                            <label for="user_name">Full Name <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="email" name="user_email" id="user_email" value="{{$user_email}}" placeholder="Email"  required="required">
                                            <label for="user_email">Email Address <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="tel" name="user_phone" id="user_phone" value="{{$user_phone}}" placeholder="Contact Number"  required="required">
                                            <label for="user_phone">Contact no. <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="text" name="course_title" id="course_title" readonly value="{!! ucwords(str_replace("-", " ", collect(request()->segments())->pull(1))) !!}" placeholder="Course Title">
                                            <label for="course_title">Course Name <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="submit" class="btn btn-primary btn-save" value="submit">
                                    </div>


                                </div>



                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </section>


@stop
@section('footer_scripts')
    <script>
        $(document).ready(function() {

            $(".topbar-img").hide();
            $(".mobile-topbar-img").hide();

            $('input[name="optradio"]').change(function() {
                ($(this).data("price") == 45.00) ? $("#card_price").text("{{getSetting('currency_code','site_settings')}} " + (Number($(this).data("price")) + (0)) + ".00") : $("#card_price").text("{{getSetting('currency_code','site_settings')}} " + (Number($(this).data("price")) + (0)));
                $("#after_discount").val((Number($(this).data("price")) + (0)));
                $("#actual_cost").val((Number($(this).data("price")) + (0)));
                $("input[name=\"order_amount\"]").val((Number($(this).data("price")) + (0)));
            });

        });
    </script>
@endsection