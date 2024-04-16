@extends('layouts.sitelayout')
@section('content')

    <div class="main-content"  style="background-image: linear-gradient(to right, #156e9b,#156e9b,#b6d433);">

        <section>
            <div class="container">
                <div class="row d-flex">
                    <div class="col-xl-6 col-lg-8 col-md-8 col-sm-8 col-xs-12 ml-auto mr-auto">
                        @include('errors.errors')
                        <div class="login-form instructor__signUP">
                            <a href="<?=url('/')?>" class="header__logo"><img src="<?=UPLOADS.'images/nla_NewLogo.png'?>" alt="Next Learn Academy" width="180"></a>
                            <h2 class="">Instructor Sign up</h2>
                            {!! Form::open(array('url' => URL_USERS_REGISTER_INSTRUCTOR, 'method' => 'POST', 'id'=>'registrationForm ', 'novalidate'=>'', 'class'=>"form-div pl-20 pr-20", 'name'=>"registrationForm",  'enctype'=>"multipart/form-data")) !!}

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>First Name <span>*</span></label>
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
                                        @csrf
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Last Name <span>*</span></label>
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
                                        <label>Email Address <span>*</span></label>
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
                                        <label>Choose Username <span>*</span></label>
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
                                        <label>Choose Password <span>*</span></label>
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
                                        <label>Re-enter Password <span>*</span></label>
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
                                <div class="row row-sm-padding">


                                    <div class="form-group col-md-6">
                                        <label>Date Of Birth <span>*</span></label>
                                        <input type="date" class="form-control " name="dob" id="date" value="" required="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Gender <span>*</span></label>
                                        <select class="form-control" name="gender" id="gender" required="">
                                            <option value="none" selected="">Select an Option</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Contact No <span>*</span></label>
                                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Please Enter Contact No." value="" required="">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Detail <span>*</span></label>
                                        <textarea name="detail" rows="5" class="form-control" id="detail" placeholder="" required="" spellcheck="false"></textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Upload Resume <span>*</span></label>
                                        <input type="file" class="form-control" name="file" id="file" value="" required="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Upload Image <span>*</span></label>
                                        <input type="file" class="form-control" name="image" id="image" required="">
                                    </div>
                                    <div class="form-group  col-md-12">
                                        @if($rechaptcha_status == 'yes')
                                            <div class="{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}" >
                                                {!! app('captcha')->display() !!}
                                                {{--{!! NoCaptcha::displaySubmit('registrationForm', 'Register Now', ['data-theme' => 'dark','class'=>'btn btn-success','id'=>'submit']) !!}--}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group pl-10 pr-20" style="display: inline-flex">
                                        {{ Form::checkbox('agree-term', $value = null , $attributes = array('class'=>'',
                                              'ng-model'=>'agree-term',
                                              'required'=> 'true',
                                              'ng-class'=>'{"has-error": registrationForm.agree-term.$touched && registrationForm.agree-term.$invalid}',

                                          )) }}
                                        {{--<input type="checkbox" name="agree-term" id="agree-term" class="agree-term">--}}
                                        <label for="agree-term" class="label-agree-term pl-10"><span></span>I agree all statements in <a target="_blank" href="<?=url('/terms-and-conditions')?>" class="term-service">Terms of service</a></label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="hidden" name="is_instructor" value="1">
                                        <button type="submit" class="btn btn-primary theme-btn btn-block" ng-disabled='!registrationForm.$valid'>{{getPhrase('register_now')}}</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>


                    </div>
                </div>
            </div>
        </section>

    </div>
@stop
@section('footer_scripts')
    @include('common.validations', array('isLoaded'=>true))
    {{-- <script src="{{JS}}recaptcha.js"></script> --}}
    <script src='https://www.google.com/recaptcha/api.js'></script>

@stop