@extends('layouts.sitelayout')
<style>
    .new__formStyle .field .error{
        border: #d50e0e solid 1px !important;
    }
    .social-btns .btn .fa {
        line-height: 40px;
    }
    @media screen and (min-width:320px) and (max-width:966px) {
        .social-btns .btn .fa {line-height:28px;}
    }

</style>
@section('content')
    <div class="main-content inner_pages">

        <section class="instructor_Banner" style="background-image:url('<?=UPLOADS.'images/Instructor-Slider.jpg'?>');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-7 col-sm-8 col-xs-9 col-12">
                        <h3 class="text-uppercase">Do You Want To <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Become An Instructor?</span></h3>
                        <p>Here's a great opportunity to join leading instructors at Next Learn Academy who tutor thousands of students.</p>
                    </div>
                </div>
            </div>
        </section>


        <section  id="instructor" class="new__formSection">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"></div>
                    <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">
                        <div class="section-title text-center mb-0">
                            <h2 class="title text-uppercase">Apply <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">now</span></h2>
                            <p>Here's a great opportunity to join leading instructors at Next Learn Academy who tutor thousands of students.</p>
                        </div>
                        @if (session('delete'))

                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                    {{ session('delete') }}
                                </h4>
                                <p>
                                    We have already received your application and would like to thank you for showing interest as instructor in Next Learn Academy.
                                    we will review your application and update you as soon as possible.
                                </p>
                                <hr/>
                                <p>
                                    Talk to you soon,<br/>
                                    <strong>Next Learn Academy</strong>
                                </p>
                            </div>
                        @endif
                        @if (session('status'))

                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                            {{ session('status') }}
                                </h4>
                                <p>
                                    We have received your application and would like to thank you for showing interest as instructor in Next Learn Academy.
                                    we will review your application and update you as soon as possible.
                                </p>
                                <hr/>
                                <p>
                                    Talk to you soon,<br/>
                                    <strong>Next Learn Academy</strong>
                                </p>
                            </div>
                        @else
                        <form id="demo-form2" method="post" action="{{ route('apply.instructor')}}" data-parsley-validate class="new__formStyle form_instructor row " enctype="multipart/form-data">
                            @include('errors.errors', ["removeIT" => "removeDiv"])
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id"  value="@if($userflag) {{$user->id}} @endif" />
                            <div class="form-group col-sm-6">
                                <div class="field">
                                    <input type="text" class=""   required="required" name="fname" id="fname" placeholder="Please Enter First Name" value="{{ old('fname',($userflag)?trim($user->first_name):'')}}" required>
                                    <label for="fname">First Name:<span>*</span></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="field">
                                    <input type="text" class=""   required="required" name="lname" id="lname" placeholder="Please Enter Last Name" value="{{ old('lname',($userflag)?trim($user->last_name):'')}}" required>
                                    <label for="lname">Last Name:<span>*</span></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <div class="field">
                                    <input type="email"  class="" name="email" id="email" required placeholder="Please Enter Email" value="{{ old('email',($userflag)?trim($user->email):'')}}">
                                    <label for="email">Email:<span>*</span></label>
                                </div>
                            </div>

                           {{-- <div class="form-group col-sm-6">
                                <div class="field">
                                    <input type="date" class="" name="dob" id="date" value="{{ old('dob')}}" required>
                                    <label for="date">Date of Birth:<span>*</span></label>
                                </div>
                            </div>--}}
                            <div class="form-group col-sm-12">
                                <div class="field">
                                    <input type="text" class="" name="mobile" id="mobile" placeholder="Please Enter Contact No." value="{{ old('mobile',($userflag)?trim($user->phone):'')}}">
                                    <label for="mobile">Contact No:</label>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="field">
                                    <textarea name="subject" rows="5"  class="" id="subject" placeholder="Subject" required>{{ old('subject')}}</textarea>
                                    <label for="subject">Subject:<span>*</span></label>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="field">
                                    <textarea name="detail" rows="5"  class="" id="detail" placeholder="Message" required>{{ old('detail')}}</textarea>
                                    <label for="detail">Additional comments:<span>*</span></label>
                                </div>
                            </div>

                            <div class="form-group col-sm-6">
                                <div class="field">
                                    <input type="file" class="form-control" name="file" id="file" value="" required>
                                    <label for="file">Upload Resume:<span>*</span></label>
                                </div>
                            </div>

                            <div class="form-group col-sm-6">
                                <div class="field">
                                    <input type="file" class="form-control" name="image"  id="image">
                                    <label for="image">Upload Image:<sup class="redstar"></sup></label>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 mt-10">
                                @if($rechaptcha_status == 'yes')
                                    <div class="{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        {!! app('captcha')->display() !!}
                                        {{--{!! NoCaptcha::displaySubmit('registrationForm', 'Register Now', ['data-theme' => 'dark','class'=>'btn btn-success','id'=>'submit']) !!}--}}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group mb-0 text-center col-sm-12 mt-10">
                                <button type="submit" id="submitform" class="btn btn-primary theme-btn btn-block">{{ getPhrase('Submit') }}</button>
                                <div style="display: none;" id="genloader">
                                    <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/ajax-loader.gif" width="50"> Application Submitting ...
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"></div>
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
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/16xero.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/17vodafone.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/18standford.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/19fundingcircle.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/20king.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/21hmrc.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/22yell.png"></div></div>
                    <div class="col-lg-15 col-md-15 col-sm-4 col-xs-6"><div class="img__box"><img src="<?=UPLOADS?>images/logos/23royalsurrey.png"></div></div>
                </div>
            </div>
        </section>

    </div>
@stop
@section('footer_scripts')
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{JS}}datepicker.min.js"></script>
    <script>
        var tagsArr = [];
        function loadTags() {
            $.ajax({
                url: "{{route('get-course-tags')}}",
                success: function(data) {
                    console.log(data);
                    tagsArr = data.split(',');
                    // console.log(tagsArr);
                    // testt=nameArr;
                    $('#course_tags').tagsInput({

                        'autocomplete': {
                            source: tagsArr
                        }

                    });
                }
            });
        }


        $(document).ready(function() {
            loadTags();

        });


        $( document ).ready(function($) {


            //Get all the inputs...
            const inputs = document.querySelectorAll('input, select, textarea');

// Loop through them...

            for(let input of inputs) {

                // Just before submit, the invalid event will fire, let's apply our class there.
                input.addEventListener('invalid', (event) => {
                    event.preventDefault();
                    //console.log("inside invalid");
                    input.classList.add('error');
                    $('html, body').animate({
                        scrollTop: ($('.error').first().offset().top-200)
                    },500);

                }, true);


                input.addEventListener('focus', (event) => {
                    input.classList.remove('error');

                }),
                    input.addEventListener('valid', (event) => {
                        input.classList.remove('error');
                    })

            }

            $(document).on('keyup','input',function(){

                $(this).removeClass('error');
            });




        });



        $( ".form_instructor" ).submit(function( event ) {
            console.log( "Handler for .submit() called." );

                $('#genloader').show();
                $('#submitform').hide();


        });


    </script>

@endsection