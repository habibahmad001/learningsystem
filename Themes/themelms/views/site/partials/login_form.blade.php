<?php
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.
$url.= $_SERVER['HTTP_HOST'];
$url.= $_SERVER['REQUEST_URI'];

$loginactive='active';
$registeractive='';

if(strpos($url, 'register')){
    $loginactive='';
    $registeractive='active';

}
$logohide=false;
if (strpos($url, 'cart') || strpos($url, 'course')){
    $logohide=true;
}
  $rechaptcha_status          = getSetting('enable_rechaptcha','recaptcha_settings');

?>
<style>
    @media (min-width: 768px){
        .newlogin__from .modal-dialog {width: 450px !important;}
    }
</style>
<input type="hidden" name="pageurl" id="pageurl" value="{!! $url !!}">

<div class="">
    <a href="<?=url('/')?>" class="header__logo <?=$logohide?'d-none':''?> ">
        <img src="<?=UPLOADS.'images/nla_NewLogo.png'?>" class="d-none" alt="Next Learn Academy" width="180"></a>
    {{--<div class="ajax-loader login-loader" id="ajax_loader"><img src="{{AJAXLOADER}}"> {{getPhrase('please_wait')}}...</div>--}}
    <ul class="nav nav-justified nav-tabs" id="myTab" role="tablist">
        {{--<li class="nav-item {{$loginactive}}"><!--#login_div-->  <!--#register_div-->  <!--  data-toggle="tab" -->
            <a class="nav-link {{$loginactive}} show" id="login-tab" href="{!! URL::to('/login') !!}" role="tab" aria-controls="login_div" aria-selected="true">Log in</a>
        </li>
        <li class="nav-item {{$registeractive}}">
            <a class="nav-link {{$registeractive}}" id="register-tab" href="{!! URL::to('/register') !!}" role="tab" aria-controls="register_div" aria-selected="false">Sign Up</a>
        </li>
        --}}

        <li class="nav-item {{$loginactive}}"><!--#login_div-->  <!--#register_div-->  <!--  data-toggle="tab" -->
            <a class="nav-link {{$loginactive}} show" id="login-tab" href="#login_div"  data-toggle="tab" role="tab" aria-controls="login_div" aria-selected="true">Log in</a>
        </li>
        <li class="nav-item {{$registeractive}}">
            <a class="nav-link {{$registeractive}}" id="register-tab" href="#register_div"  data-toggle="tab" role="tab" aria-controls="register_div" aria-selected="false">Sign Up</a>
        </li>



    </ul>
    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade {{$loginactive}} in" id="login_div" role="tabpanel" aria-labelledby="login-tab">

        <!--div class="social__icons d-flex">
                                     @if(getSetting('facebook_login', 'module') || getSetting('google_plus_login', 'module'))
            @if(getSetting('facebook_login', 'module'))
                <a href="{!! URL::to("/facebook") !!}" class="facebook__btn"><i class="fa fa-facebook"></i>{{getPhrase('facebook')}}</a>
                                         @endif
            @if(getSetting('google_plus_login', 'module'))
                {{--{{URL_GOOGLE_LOGIN}}--}}
                        <a href="javascript:void(0);" class="google__btn"><i class="fa fa-google-plus"></i>{{getPhrase('google')}}</a>
                                         @endif
        @endif
                </div>

                <span class="or_div"><span>OR</span></span-->
            <h3>Login Account</h3>
            <div class="alert alert-danger ajaxloginmsg" style="display: none;" role="alert">
                Please make sure you have entered correct email or password
            </div>

            {!! Form::open(array('url' => URL_USERS_LOGIN, 'method' => 'POST', 'name'=>'loginForm ', 'novalidate'=>'', 'class'=>"form-div", 'id'=>"loginForm")) !!}
            @include('errors.errors')
            @if(isset($_REQUEST["msg"]))
                @if($_REQUEST["msg"] == 1)
                    <div class="alert alert-danger emailNot" role="alert">
                        email not existed , Thanks!
                    </div>
                @elseif($_REQUEST["msg"] == 2)
                    <div class="alert alert-success" role="alert">
                        Email has been submitted, Thanks!!
                    </div>
                @elseif($_REQUEST["msg"] == 3)
                    <div class="alert alert-danger" role="alert">
                       Login information is not correct, Please check it again, Thanks!!
                    </div>
                @elseif($_REQUEST["msg"] == 5)
                    <div class="alert alert-danger" role="alert">
                        This user is already exist, Please try some other email, Thanks!!
                    </div>
                @endif
            @endif
            <div class="row row-sm-padding">
            <div class="form-group col-md-12">
                {{--{{ csrf_field() }}--}}
                <!--input type="hidden" id="hiddenfield" name="hiddenfield" autofocus-->
                {{--<label>Username/Email</label>--}}
                {{ Form::text('email', $value = null , $attributes = array('class'=>'form-control',
                       'ng-model'=>'email',
                       'required'=> 'true',
                       'id'=> 'email',
                       'placeholder' => getPhrase('username').'/'.getPhrase('email'),
                       'ng-class'=>'{"has-error": loginForm.email.$touched && loginForm.email.$invalid}',
                )) }}
                <div class="validation-error" ng-messages="loginForm.email.$error" >
                    {!! getValidationMessage()!!}
                </div>
                {{--<input type="text" class="form-control">--}}
            </div>
            <div class="form-group col-md-12">
                {{--<label>Password</label>--}}
                {{ Form::password('password', $attributes = array('class'=>'form-control instruction-call',
                         'placeholder' => getPhrase("password"),
                         'ng-model'=>'registration.password',
                         'required'=> 'true',
                         'id'=> 'password',
                         'ng-class'=>'{"has-error": loginForm.password.$touched && loginForm.password.$invalid}',
                         'ng-minlength' => 5
                         )) }}
                <div class="validation-error" ng-messages="loginForm.password.$error" >
                    {!! getValidationMessage()!!}
                </div>
            </div>
            <div class="text-right pt-10 pr-20 pl-20 pb-10 w-100">
                <a href="javascript:void(0);" class="" data-toggle="modal" data-target="#forgetPasswordModal"><i class="icon icon-question"></i> {{getPhrase('forgot_password?')}}</a>
            </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-block text-uppercase" ng-disabled='!loginForm.$valid' onclick="javascript: ajaxcheckLogin();" >{{getPhrase('login')}}</button>
                </div>
            {{--<p>Do not have an account? <a href="{{url('/register')}}">Register now</a></p>--}}
            {!! Form::close() !!}
            </div>
        </div>
        {{--Register--}}
        <div class="tab-pane fade {{$registeractive}} in" id="register_div" role="tabpanel" aria-labelledby="register-tab">
        <!--div class="social__icons d-flex">
                                     @if(getSetting('facebook_login', 'module') || getSetting('google_plus_login', 'module'))
            @if(getSetting('facebook_login', 'module'))
                <a href="{{URL_FACEBOOK_LOGIN}}" class="facebook__btn"><i class="fa fa-facebook-official"></i>{{getPhrase('facebook')}}</a>
                                         @endif
            @if(getSetting('google_plus_login', 'module'))
                <a href="{{URL_GOOGLE_LOGIN}}" class="google__btn"><i class="fa fa-google-plus"></i>{{getPhrase('google')}}</a>
                                             @endif
        @endif
                </div>

                <span class="or_div"><span>OR</span></span-->
            <h3>Create an Account</h3>

            {!! Form::open(array('url' => URL_USERS_REGISTER, 'method' => 'POST', 'id'=>'registrationForm ', 'novalidate'=>'', 'class'=>"register-form form-div", 'name'=>"registrationForm")) !!}
            @include('errors.errors')

                {{--{{ csrf_field() }}--}}
                <div class="row row-sm-padding">

                        <div class="form-group col-md-6">
                            {{--<label>First Name</label>--}}
                            {{ Form::text('first_name', $value = null , $attributes = array('class'=>'form-control',
                               'placeholder' => getPhrase("First Name"),
                               'ng-model'=>'first_name',
                               'ng-pattern' => getRegexPatternwithspace('first_name'),
                               'required'=> 'true',
                               'ng-class'=>'{"has-error": registrationForm.first_name.$touched && registrationForm.first_name.$invalid}',
                               'ng-minlength' => '2',
                           )) }}
                            <div class="validation-error" ng-messages="registrationForm.first_name.$error" >
                                <p ng-message="required">This field is required and only character are allowed.</p>
                            </div>
                            {{--<input type="text" class="form-control">--}}
                        </div>
                        <div class="form-group col-md-6">
                            {{--<label>Last Name</label>--}}
                            {{ Form::text('last_name', $value = null , $attributes = array('class'=>'form-control',
                               'placeholder' => getPhrase("Last Name"),
                               'ng-model'=>'last_name',
                               'ng-pattern' => getRegexPatternwithspace('last_name'),
                               'required'=> 'true',
                               'ng-class'=>'{"has-error": registrationForm.last_name.$touched && registrationForm.last_name.$invalid}',
                               'ng-minlength' => '2',
                           )) }}
                            <div class="validation-error" ng-messages="registrationForm.last_name.$error" >
                                <p ng-message="required">This field is required and only character are allowed.</p>
                            </div>
                            {{--<input type="text" class="form-control">--}}
                        </div>

                        <div class="form-group col-md-12">
                            {{--<label>Email Address</label>--}}
                            {{ Form::email('email', $value = null , $attributes = array('class'=>'form-control',
                               'placeholder' => getPhrase("email"),
                               'ng-model'=>'email',
                               'ng-pattern' => getRegexPatternwithspace('email'),
                               'required'=> 'true',
                               'ng-class'=>'{"has-error": registrationForm.email.$touched && registrationForm.email.$invalid}',
                           )) }}

                            <div class="validation-error" ng-messages="registrationForm.email.$error" >
                                {!! getValidationMessage('email')!!}
                            </div>
                            {{--<input type="email" class="form-control">--}}
                        </div>
                        <div class="form-group col-md-12">
                            {{--<label>Choose Username</label>--}}
                            {{ Form::text('username', $value = null , $attributes = array('class'=>'form-control',
                           'placeholder' => getPhrase("username"),
                           'ng-model'=>'username',
                           'required'=> 'true',
                           'ng-class'=>'{"has-error": registrationForm.username.$touched && registrationForm.username.$invalid}',
                           'ng-minlength' => '4',
                       )) }}

                            <div class="validation-error" ng-messages="registrationForm.username.$error" >
                                <p ng-message="required">This field is required and length must be greater then 4.</p>
                            </div>
                            {{--<input type="text" class="form-control">--}}
                        </div>

                        <div class="form-group col-md-12">
                            {{--<label>Choose Password</label>--}}
                            {{ Form::password('password', $attributes = array('class'=>'form-control instruction-call',
                           'placeholder' => getPhrase("password"),
                           'ng-model'=>'registration.password',
                           'required'=> 'true',
                           'ng-class'=>'{"has-error": registrationForm.password.$touched && registrationForm.password.$invalid}',
                           'ng-minlength' => 5
                       )) }}

                            <div class="validation-error" ng-messages="registrationForm.password.$error" >
                                <p ng-message="required">This field is required and length must be greater then 5.</p>
                            </div>
                            {{--<input type="text" class="form-control">--}}
                        </div>
                        <div class="form-group col-md-12">
                            {{--<label>Re-enter Password</label>--}}
                            {{ Form::password('password_confirmation', $attributes = array('class'=>'form-control instruction-call',
                           'placeholder' => getPhrase("password_confirmation"),
                           'ng-model'=>'registration.password_confirmation',
                           'required'=> 'true',
                           'ng-class'=>'{"has-error": registrationForm.password_confirmation.$touched && registrationForm.password_confirmation.$invalid}',
                           'ng-minlength' => 5,
                           'compare-to' =>"registration.password"
                       )) }}

                            <div class="validation-error" ng-messages="registrationForm.password_confirmation.$error" >
                                <p ng-message="required">This field is required & length must be greater then 5 & should match with password.</p>
                            </div>
                            {{--<input type="text" class="form-control">--}}
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
            <div class="form-group col-md-12">
                {{--@if($registeractive=='active')--}}
                    @if($rechaptcha_status == 'yes')
                            {!! app('captcha')->display() !!}
                    @endif
                 {{--@endif--}}
            </div>
            <div class="form-group col-md-12">
                {{ Form::checkbox('agree-term', $value = null , $attributes = array('class'=>'',
                      'ng-model'=>'agree-term',
                      'required'=> 'true',
                      'ng-class'=>'{"has-error": registrationForm.agree-term.$touched && registrationForm.agree-term.$invalid}',

                  )) }}
                {{--<input type="checkbox" name="agree-term" id="agree-term" class="agree-term">--}}
                <label for="agree-term" class="label-agree-term"><span></span>I agree all statements in <a target="_blank" href="<?=url('/terms-and-conditions')?>" class="term-service">Terms of service</a></label>
            </div>

            <p class="pl-20 pr-20 d-none">Already have an account? <a href="{{url('/login')}}">Login</a></p>
            <button type="submit" class="btn btn-block text-uppercase" ng-disabled='!registrationForm.$valid'>{{getPhrase('register_now')}}</button>

            {!! Form::close() !!}
                </div>

        </div>

        </div>

    {{--<form action="#" class="login-form">--}}
</div>