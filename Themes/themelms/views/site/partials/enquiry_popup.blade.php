{{-- <script src="{{JS}}recaptcha.js"></script> --}}
<script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit'></script>
<section class="thankyou_section pt-10 pb-10" style="display: none;" id="thankyou">
    <div class=" text-center">
        <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/thanksyou.png" class="">
        <h4>Your message has been sent successfully!</h4>
        <h5>Thank you for your enquiry. Our support team will look into that and get back to you as soon as possible.</h5>
        <h6>Stay safe, Have a Nice day.</h6>
        <div class="text-center links-social hide">
            <span>Follow us</span>
            <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" class="youtube"><i class="fab fa-youtube"></i></a>
            <a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <div class="text-center pt-20">
            <button id="close_ebtn" class="btn close_ebtn" onclick="javascript: resetenqform();">Close</button>
        </div>
    </div>
</section>

<section class="thankyou_section pt-10 pb-10" style="display: none;" id="errormsg">
    <div class=" text-center">
        {{--<img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/thanksyou.png" class="">--}}
        <h4>Your message has some spam contents you can email to info@nextlearnacademy.com!</h4>
        <h5>Sorry for the inconveniene. Our support team will look into that and get back to you as soon as possible.</h5>
        <h6>Stay safe, Have a Nice day.</h6>

        <div class="text-center pt-20">
            <button id="close_ebtn" class="btn close_ebtn" onclick="javascript: resetenqform();">Close</button>
        </div>
    </div>
</section>



<section class=" pt-10 pb-10 imran" id="form-section">
<style>
    form#enquiry-form label {
        color: black;
    }
    section .thankyou_section img {
        margin-bottom: 20px;width: 80%;
    }
    section .thankyou_section h5 {
        font-size: 18px;
    }
</style>
<!-- Contact Form -->
{{--{!! Form::open(array('url'=>URL_SEND_CONTACTUS, 'name'=>'user-contact' ,'id'=>'enquiry-form','class'=>'contact-form-transparent'))  !!}--}}
    @if (Request::is('course/*'))
    <h4 class="modal-title" id="myModalRequestLabel">Contact a Course Advisor</h4>
@else
    <h4 class="modal-title" id="myModalRequestLabel">Enquire Now</h4>
    <h6 class="">Please, fill in the form to get in touch!</h6>
@endif
<form name="enquiry_form" id="enquiry-form" class="contact-form-transparent new__formStyle" method="post" action="">
    {{ csrf_field() }}

    <div class="form-group">
        <div class="field">
            <input type="text" class="" name="first_name" id="first_name" onkeyup="javascript:($(this).val()) ? $(this).removeClass('errorimp') : $(this).addClass('errorimp')" placeholder="Your Name">
            <label for="first_name">Name:<span>*</span></label>
            <div class="valmsg" id="namemsg"><p class="signuperrorp">Please enter charater only.</p></div>
        </div>
    </div>

    <div class="form-group">
        <div class="field">
            <input name="email" id="remail" class="required email" type="email" onkeyup="javascript:($(this).val()) ? $(this).removeClass('errorimp') : $(this).addClass('errorimp')" placeholder="Email">
            <label for="remail">Email:<span>*</span></label>
        </div>
    </div>


    <div class="form-group">
        <div class="field">
            <input type="text" name="phone" id="phone" class=""  placeholder="Telephone no">
            <label for="phone">Telephone no.</label>
            <div class="valmsg" id="phonemsg"><p class="signuperrorp">Please enter valid phone number.</p></div>
        </div>
    </div>

    {{--<div class="form-group">--}}
        {{--<div class="field select_div">--}}
            {{--<select id="country" class="" name="country">--}}
                {{--<option value=""></option>--}}
                {{--@if(count(App\Http\Controllers\SiteController::AllCountries()) > 0)--}}
                    {{--@foreach(App\Http\Controllers\SiteController::AllCountries() as $county)--}}
                        {{--<option value="{!! $county->nicename !!}">{!! $county->name !!}</option>--}}
                    {{--@endforeach--}}
                {{--@endif--}}
            {{--</select>--}}
            {{--<label for="country">Select Country</label>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="form-group">
        <div class="field select_div">
            <select id="enquiry_type" class="" onkeyup="javascript:($(this).val()) ? $(this).removeClass('errorimp') : $(this).addClass('errorimp')" name="enquiry_type">
                <option value=""> Enquiry Type </option>

                <option @if (Request::is('course/*')) selected="selected" @endif  value="Course Enquiry">Course Enquiry</option>

                <option value="General">General Query</option>
                <option value="Presale">Presale</option>
                <option value="Technical">Technical</option>
                <option value="Other">Other</option>

            </select>
            {{--<label for="enquiry_type">Enquiry Type</label>--}}
        </div>
    </div>

    @if (Request::is('course/*'))

    <input type="hidden" name="course_id" id="course_id" value="{!! $lms_series->id ?? '' !!}">
    <input type="hidden" name="course_title" id="course_title" value="{!! $lms_series->title ?? '' !!}">
    <input type="hidden" name="course_slug" id="course_slug" value="{!! $lms_series->slug  ?? ''!!}">
    <input type="hidden" name="backurl" id="backurl" value="course/{!! $lms_series->slug  ?? ''!!}">
@else
        <input type="hidden" name="course_id" id="course_id" value="">
        <input type="hidden" name="course_title" id="course_title" value="">
        <input type="hidden" name="course_slug" id="course_slug" value="">
        <input type="hidden" name="backurl" id="backurl" value="">

    @endif
    <div class="form-group">
        <div class="field">
            <textarea name="msg" id="msg" class="required" required="" rows="5" placeholder="Message"></textarea>
            <label for="msg">Message<span>*</span></label>
        </div>
    </div>

    <div class="form-group" style="display: none;" id="captcha_msg">
        <div class="alert alert-danger" role="alert">
            <b>Please check captcha before submit !!</b>
        </div>
    </div>
    <div class="form-group">
        <div class="field" id="html_element">
        </div>
    </div>
    {{--<div class="form-group">
        <div class="field rechaptcha_div">
            <?php $class=""; ?>
            @if(getSetting('enable_rechaptcha','recaptcha_settings') == 'yes')
                @if(!empty($errors))
                    @if($errors->any())
                      <?php
                        if($errors->has('g-recaptcha-response')){
                            $class=' has-error';
                        }else{
                            $class='';
                        }
                        ?>
                        @endif
                @endif
                <div class="{{$class}}" style="margin:15px 0 0">
                    {!! app('captcha')->display() !!}
                    --}}{{--{!! NoCaptcha::displaySubmit('registrationForm', 'Register Now', ['data-theme' => 'dark','class'=>'btn btn-success','id'=>'submit']) !!}--}}{{--
                </div>
            @endif
        </div>
    </div>--}}

    <div class="form-group checks_div">
        <label class="" for="defaultCheck1">
            <input class="form-check-input" type="checkbox" name="sub" value="Yes" id="defaultCheck1">
            Subscribe me to receive the latest promotions and courses.
        </label>
        <label class="" for="defaultCheck2">
            {{--<input class="form-check-input" type="checkbox" name="agree" value="1" id="defaultCheck2">--}}
            I have read and agreed to the <a href="{!! URL::to("/privacy-policy") !!}" target="_blank" style="color:#51ac37">Privacy Policy</a>
        </label>
    </div>

    <div class="row">

    </div>


    <div class="form-group">
        <input name="form_botcheck" class="form-control" type="hidden" value="" />
        {{--<button type="submit" class="btn btn-primary btn-shadow">{{getPhrase('send_message')}}</button>--}}
        <button type="button" id="sendEnquiry"   name="saveenq" class="btn btn-dark btn-theme-colored btn-flat btn-block" data-loading-text="Please wait...">SEND YOUR ENQUIRY</button>
    </div>
</form>
{{--{!! Form::close() !!}--}}
</section>