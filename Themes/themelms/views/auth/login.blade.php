@extends('layouts.sitelayout')
@section('content')
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

?>
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

 <div class="main-content"  style="background-image:linear-gradient(to right, #a0dcfb,#fbfbfb,#f4ffc3)">  {{--linear-gradient(to right, #156e9b,#156e9b,#b6d433);--}}
     <!-- Section: inner-header -->
     <section class="inner-header divider layer-overlay hide overlay-theme-colored-7" >
         <div class="container pt-20 pb-60">
             <!-- Section Content -->
             <div class="section-content">
                 <div class="row">
                     <div class="col-md-6">
                         <h2 class="text-theme-colored2 font-36">Login</h2>
                         {{--<ol class="breadcrumb text-left mt-10 white">--}}
                             {{--<li><a href="/">Home</a></li>--}}
                             {{--<li><a href="#">Pages</a></li>--}}
                             {{--<li class="active">Current Page</li>--}}
                         {{--</ol>--}}
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <section class="pt-80 pb-50">
         <div class="container">

             <div class="row d-flex">

                 <div class="col-xl-5 col-lg-6 col-md-7 col-sm-8 col-xs-12 ml-auto mr-auto login_tabs">

                     @include('site.partials.login_form')

                 </div>
             </div>
         </div>
     </section>

     {{--<div class="form-group">
                         @if($rechaptcha_status == 'yes')
                             <div class="  form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                 {!! app('captcha')->display() !!}
                             </div>
                         @endif
                     </div>--}}

     <section>
         <div class="container">
             <div class="row">
        {{--login form --}}
                 <div class="col-md-8 col-md-offset-2">


                 </div>
             </div>
         </div>


     </section>
 </div>
<style>
    #footer {
        margin-top: 0px !important;

    }
    .tab-content {
        padding: 15px 0;
    }
    .nav-tabs.nav-justified>li {
        float: left;
        width: 50%;border: none !important;
    }
    .nav-tabs.nav-justified>li>a {
        background-color:#fff;
        border:none;
    }
    .detail_tabs .nav-tabs.nav-justified>.active>a, .nav-tabs.nav-justified>.active>a:focus, .nav-tabs.nav-justified>.active>a:hover {
        border:none !important;
    }
</style>
@stop



@section('footer_scripts')
       @include('common.validations', array('isLoaded'=>true))
		     	{{-- <script src="{{JS}}recaptcha.js"></script> --}}
		     		<script src='https://www.google.com/recaptcha/api.js'></script>

@stop
