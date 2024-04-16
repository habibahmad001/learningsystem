@extends('layouts.sitelayout')

@section('content')

 <!--  <section class="cs-primary-bg cs-page-banner" style="margin-top:100px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="cs-page-banner-title text-center">{{getPhrase('create_a_new_account')}}</h2>
                </div>
            </div>
        </div>
    </section> -->

  <!-- Login Section -->
 <!-- Start main-content -->
 <style>

     .login-form p{
         float: right;
     }
     .login-form a{
         color: #156e9b;

     }
     a.btn-face{
         color: #fff;

     }

     .btn-face {
         color: #fff;
         background-color: #3b5998;
     }
     .btn-face, .btn-google {
         /* font-family: Montserrat-SemiBold; */
         font-size: 18px;
         line-height: 1.2;
         display: -webkit-box;
         display: -webkit-flex;
         display: -moz-box;
         display: -ms-flexbox;
         display: flex;
         justify-content: center;
         align-items: center;
         padding: 15px;
         width: calc((100% - 20px) / 3);
         height: 70px;
         border-radius: 10px;
         box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
         -moz-box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
         -webkit-box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
         -o-box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
         -ms-box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
         -webkit-transition: all 0.4s;
         -o-transition: all 0.4s;
         -moz-transition: all 0.4s;
         transition: all 0.4s;
         position: relative;
         z-index: 1;
     }
     .btn-google {
         color: #555555;
         background-color: #fff;
     }
     .btn-face:hover{
         color: #fff;
         box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
     }
     .btn-google:hover {

         box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
     }
     .btn-google::before, .btn-face::before {
         content: "";
         display: block;
         position: absolute;
         z-index: -1;
         width: 100%;
         height: 100%;
         border-radius: 10px;
         top: 0;
         left: 0;
         background: #a64bf4;
         background: -webkit-linear-gradient(45deg, #00dbde, #fc00ff);
         background: -o-linear-gradient(45deg, #00dbde, #fc00ff);
         background: -moz-linear-gradient(45deg, #00dbde, #fc00ff);
         background: linear-gradient(45deg, #00dbde, #fc00ff);
         opacity: 0;
         -webkit-transition: all 0.4s;
         -o-transition: all 0.4s;
         -moz-transition: all 0.4s;
         transition: all 0.4s;
     }

     .btn-face i {
         font-size: 30px;
         margin-right: 17px;
         padding-bottom: 3px;
     }
     .btn-google img {
         width: 30px;
         margin-right: 15px;
         padding-bottom: 3px;
     }

 </style>
 <div class="main-content"  style="background-image: linear-gradient(to right, #156e9b,#156e9b,#b6d433);">



     <!-- Section: inner-header -->
     <section class="inner-header divider layer-overlay hide overlay-theme-colored-7"  data-bg-img="<?=url('/images/bg1.jpg')?>">
         <div class="container pt-20 pb-60">
             <!-- Section Content -->
             <div class="section-content">
                 <div class="row">
                     <div class="col-md-6">
                         <h2 class="text-theme-colored2 font-36">Login / Singup</h2>
                         <ol class="breadcrumb text-left mt-10 white">
                             <li><a href="/">Home</a></li>
                             <li><a href="#">Pages</a></li>
                             <li class="active">Current Page</li>
                         </ol>
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <section>
         <div class="container">
             <div class="row">

                 {{--Register form --}}
                 <div class="col-md-8 col-md-offset-2">

<div class="login-form">
                     {{--<form action="#"  class="login-form">--}}
                         {!! Form::open(array('url' => URL_USERS_REGISTER, 'method' => 'POST', 'id'=>'registrationForm ', 'novalidate'=>'', 'class'=>"register-form heading-line-bottom", 'name'=>"registrationForm")) !!}
                     <div class="heading-line-bottom">
                         <h2 class="heading-title">Register and Start Learning!</h2>
                     </div>  @include('errors.errors')

                         <div class="row">
                             <div class="form-group col-md-6">
                                 <label>First Name</label>
                                 {{ Form::text('first_name', $value = null , $attributes = array('class'=>'form-control',
									'placeholder' => getPhrase(""),
									'ng-model'=>'first_name',
									'ng-pattern' => getRegexPattern('name'),
									'required'=> 'true',
									'ng-class'=>'{"has-error": registrationForm.first_name.$touched && registrationForm.first_name.$invalid}',
									'ng-minlength' => '2',
								)) }}
                                 <div class="validation-error" ng-messages="registrationForm.first_name.$error" >
                                     {!! getValidationMessage()!!}
                                     {!! getValidationMessage('minlength')!!}
                                     {!! getValidationMessage('pattern')!!}
                                 </div>
                                 {{--<input type="text" class="form-control">--}}
                             </div>
                             <div class="form-group col-md-6">
                                 <label>Last Name</label>
                                 {{ Form::text('last_name', $value = null , $attributes = array('class'=>'form-control',
									'placeholder' => getPhrase(""),
									'ng-model'=>'last_name',
									'ng-pattern' => getRegexPattern('name'),
									'required'=> 'true',
									'ng-class'=>'{"has-error": registrationForm.last_name.$touched && registrationForm.last_name.$invalid}',
									'ng-minlength' => '2',
								)) }}
                                 <div class="validation-error" ng-messages="registrationForm.last_name.$error" >
                                     {!! getValidationMessage()!!}
                                     {!! getValidationMessage('minlength')!!}
                                     {!! getValidationMessage('pattern')!!}
                                 </div>
                                 {{--<input type="text" class="form-control">--}}
                             </div>
                             <div class="form-group col-md-6">
                                 <label>Email Address</label>
                                 {{ Form::email('email', $value = null , $attributes = array('class'=>'form-control',
									'placeholder' => getPhrase("email"),
									'ng-model'=>'email',
									'required'=> 'true',
									'ng-class'=>'{"has-error": registrationForm.email.$touched && registrationForm.email.$invalid}',
								)) }}

                                 <div class="validation-error" ng-messages="registrationForm.email.$error" >
                                     {!! getValidationMessage()!!}
                                     {!! getValidationMessage('email')!!}
                                 </div>
                                 {{--<input type="email" class="form-control">--}}
                             </div>


                             <div class="form-group col-md-6">
                                 <label>Choose Username</label>
                                 {{ Form::text('username', $value = null , $attributes = array('class'=>'form-control',
								'placeholder' => getPhrase("username"),
								'ng-model'=>'username',
								'required'=> 'true',
								'ng-class'=>'{"has-error": registrationForm.username.$touched && registrationForm.username.$invalid}',
								'ng-minlength' => '4',
							)) }}

                                 <div class="validation-error" ng-messages="registrationForm.username.$error" >
                                     {!! getValidationMessage()!!}
                                     {!! getValidationMessage('minlength')!!}
                                     {!! getValidationMessage('pattern')!!}
                                 </div>
                                 {{--<input type="text" class="form-control">--}}
                             </div>
                         </div>
                         <div class="row">
                             <div class="form-group col-md-6">
                                 <label>Choose Password</label>
                                 {{ Form::password('password', $attributes = array('class'=>'form-control instruction-call',
								'placeholder' => getPhrase("password"),
								'ng-model'=>'registration.password',
								'required'=> 'true',
								'ng-class'=>'{"has-error": registrationForm.password.$touched && registrationForm.password.$invalid}',
								'ng-minlength' => 5
							)) }}

                                 <div class="validation-error" ng-messages="registrationForm.password.$error" >
                                     {!! getValidationMessage()!!}
                                     {!! getValidationMessage('password')!!}
                                 </div>
                                 {{--<input type="text" class="form-control">--}}
                             </div>
                             <div class="form-group col-md-6">
                                 <label>Re-enter Password</label>
                                 {{ Form::password('password_confirmation', $attributes = array('class'=>'form-control instruction-call',
								'placeholder' => getPhrase("password_confirmation"),
								'ng-model'=>'registration.password_confirmation',
								'required'=> 'true',
								'ng-class'=>'{"has-error": registrationForm.password_confirmation.$touched && registrationForm.password_confirmation.$invalid}',
								'ng-minlength' => 5,
								'compare-to' =>"registration.password"
							)) }}

                                 <div class="validation-error" ng-messages="registrationForm.password_confirmation.$error" >
                                     {!! getValidationMessage()!!}
                                     {!! getValidationMessage('minlength')!!}
                                     {!! getValidationMessage('confirmPassword')!!}
                                 </div>
                                 {{--<input type="text" class="form-control">--}}
                             </div>
                         </div>
                     <input type="hidden" name="is_student" value="1">
                         <?php $parent_module = getSetting('parent', 'module'); ?>
                         @if(!$parent_module)
                             {{--<input type="hidden" name="is_student" value="0">--}}
                         @else
                            {{-- <div class="form-group">
                                 <div class="col-md-12">
                                </div>
                                 <div class="col-md-12">
                                     <ul class="login-links mt-2">
                                         <li>
                                             {{ Form::radio('is_student', 0, true, array('id'=>'free')) }}
                                             <label for="free"> <span class="  radio-button"> <i class="mdi mdi-check active"></i> </span> {{getPhrase('i_am_a_student')}}</label>
                                         </li>
                                         <li>
                                             {{ Form::radio('is_student', 1, false, array('id'=>'paid' )) }}
                                             <label for="paid">
                                                 <span class="  radio-button"> <i class="mdi mdi-check active"></i> </span> {{getPhrase('i_am_a_parent')}} </label>
                                         </li>
                                     </ul>
                                 </div>

                             </div>--}}

                         @endif
                     <div class="form-group">
                         @if($rechaptcha_status == 'yes')
                             <div class="{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}" style="margin-top: 15px">
                                 {!! app('captcha')->display() !!}
                                 {{--{!! NoCaptcha::displaySubmit('registrationForm', 'Register Now', ['data-theme' => 'dark','class'=>'btn btn-success','id'=>'submit']) !!}--}}
                             </div>
                         @endif
                     </div>
                     <div class="form-group">
                         {{ Form::checkbox('agree-term', $value = null , $attributes = array('class'=>'',
                               'ng-model'=>'agree-term',
                               'required'=> 'true',
                               'ng-class'=>'{"has-error": registrationForm.agree-term.$touched && registrationForm.agree-term.$invalid}',

                           )) }}




                         {{--<input type="checkbox" name="agree-term" id="agree-term" class="agree-term">--}}
                         <label for="agree-term" class="label-agree-term"><span></span>I agree all statements in <a target="_blank" href="<?=url('/page/terms-and-conditions')?>" class="term-service">Terms of service</a></label>
                     </div>
                         <div class="form-group">
                             <button type="submit" class="btn   btn-success font-16 border-radius-5px " ng-disabled='!registrationForm.$valid'>{{getPhrase('register_now')}}</button>
                             <p>Already have an account? <a href="{{url('/login')}}">Login</a></p>
                             {{--<button type="submit" class="btn   btn-success">Register Now</button>--}}
                         </div>
    {!! Form::close() !!}

    @if(getSetting('facebook_login', 'module') || getSetting('google_plus_login', 'module'))
        <div class="pb-10 or_sign" style="display: flex;">
            <span class="text-left font-15 mr-15 or_sign_txt display-block">Or Sign Up Using</span>
            @if(getSetting('facebook_login', 'module'))
                <a href="{{URL_FACEBOOK_LOGIN}}" class="btn-face float-left display-block mb-5">
                    <i class="fa fa-facebook-official"></i>{{getPhrase('facebook')}}
                </a>
            @endif
            @if(getSetting('google_plus_login', 'module'))
                <a href="{{URL_GOOGLE_LOGIN}}" class="btn-google float-right display-block mb-5">
                    <img src="https://colorlib.com/etc/lf/Login_v5/images/icons/icon-google.png" alt="GOOGLE">
                    {{getPhrase('google')}}
                </a>
            @endif
        </div>
    @endif
</div>
                 </div>


             </div>
         </div>




     </section>
 </div>

@stop



@section('footer_scripts')

	@include('common.validations')
		     	{{-- <script src="{{JS}}recaptcha.js"></script> --}}
		     		<script src='https://www.google.com/recaptcha/api.js'></script>



@stop