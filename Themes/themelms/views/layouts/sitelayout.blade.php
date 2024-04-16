<?php  ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta Tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width,initial-scale=1.0"/> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="{{trim(strip_tags(getSetting('meta_description', 'seo_settings')))}}"/>
    <meta name="keywords" content="education,school,university,educational,learn,learning,teaching,workshop"/>
    <meta name="author" content="Next Learn Academy"/>

    <meta name="googlebot" content="{{(getSetting('discourage_search','seo_settings'))?'noindex':'index'}}">
    <meta name="robots" content="{{(getSetting('discourage_search','seo_settings'))?'noindex':'index'}}">
    <meta name="facebook-domain-verification" content="z1kotsdgxucg8qvutblqkuqqdlw71k" />
    <meta property="og:title" content="{{ isset($title) ? $title : getSetting('site_title','site_settings') }}"/>
    <meta property="og:type" content="education"/>
    <meta property="og:url" content="{{'https://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]}}"/>
    <meta property="og:image" content="{{IMAGE_PATH_SETTINGS.getSetting('background_image', 'site_settings')}}"/>
    <meta property="og:image:width" content="768" />
    <meta property="og:image:height" content="460" />
    <meta property="og:site_name" content="Next Learn Academy"/>
    {{--<meta property="fb:admins" content="USER_ID"/>--}}
    <meta property="og:description"
          content="{{strip_tags(getSetting('meta_description', 'seo_settings'))}}"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link  rel="canonical" href="{{'https://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]}}">
    <link rel="home" href="{{'https://'.$_SERVER["SERVER_NAME"]}}/">
    <!-- Favicon and Touch Icons -->
    <link href="{{UPLOADS.'images/favicon.png'}}" rel="shortcut icon" type="image/png">
    {{--<link href="images/apple-touch-icon.png" rel="apple-touch-icon">--}}
    {{--<link href="images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">--}}
    {{--<link href="images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">--}}
    {{--<link href="images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">--}}


    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{IMAGE_PATH_SETTINGS.getSetting('site_favicon', 'site_settings')}}" type="image/x-icon"/>
    <title> @yield('title') {{ isset($title) ? $title : getSetting('site_title','site_settings') }}</title>


    @yield('header_scripts')

    <link href="{{themes('site/css/bootstrap.min.css')}}" rel="preload"  as="style">
    <link href="{{themes('site/css/jquery-ui.min.css')}}"  rel="preload"  as="style">
    <link href="{{themes('site/css/menuzord-megamenu.css')}}"  rel="preload"  as="style">
    <link href="{{themes('site/css/css-plugin-collections.css')}}"  rel="preload"  as="style">
    <link href="{{themes('site/css/style-main.css')}}"  rel="preload"  as="style">
    <link href="{{themes('site/css/style.css')}}"  rel="preload"  as="style">
    <link href="{{themes('site/css/custom.min.css')}}"  rel="preload"  as="style">
    <link href="{{themes('site/css/videopopup.css')}}"  rel="preload"  as="style">


    <link href="{{themes('site/css/bootstrap.min.css')}}"  rel="stylesheet">
    <link href="{{themes('site/css/jquery-ui.min.css')}}"  rel="stylesheet">
    <link href="{{themes('site/css/menuzord-megamenu.css')}}"  rel="stylesheet">
    <link href="{{themes('site/css/css-plugin-collections.css')}}"  rel="stylesheet">
    <link href="{{themes('site/css/style-main.css')}}"  rel="stylesheet">
    <link href="{{themes('site/css/style.css')}}"  rel="stylesheet">
    <link href="{{themes('site/css/custom.min.css')}}"  rel="stylesheet">
    <link href="{{themes('site/css/videopopup.css')}}"  rel="stylesheet">




    @include('site.scripts.style')

    @include('student.lms.scripts.exam-style')


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/v4-shims.css">
    <script src="{{themes('site/js/jquery-3.1.1.min.js')}}"   ></script>


    <script src="{{themes('site/js/custom.js')}}" defer  ></script>
    {{--@yield('home_css_scripts')--}}
    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.11/jquery.lazy.min.js"></script>--}}

    @toastr_css


<!-- Start of  Zendesk Widget script -->
    {{--<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=34f51e00-0701-45d2-a021-954b08fbfc8e"> </script>--}}
    <!-- End of  Zendesk Widget script -->

</head>
<body ng-app="academia" class="has-side-panel side-panel-right fullwidth-page">
{!! getSetting('google_tag_manager_body', 'site_settings') !!}
<div id="fb-root"></div>

<div id="wrapper" class="clearfix" ng-controller="frontSite">
    <!-- preloader -->
   {{-- <div id="preloader">
        <div id="spinner">
            <img alt="" src="{{url('/images/preloaders/5.gif')}}">
        </div>
        <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
    </div>
--}}

    <!-- Navigation -->

@include('site.header')




@yield('content')


@include('site.footer')
</div>
<!-- jQuery -->
    <!-- Footer Scripts -->



    <script src="{{themes('site/js/jquery-ui.min.js')}} " defer></script>
    <script src="{{themes('site/js/bootstrap.min.js')}} " defer></script>
    {{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>--}}
    <script src="{{themes('site/js/jquery-plugin-small.js')}}"  defer ></script>



    <script src="{{themes('site/js/main.js')}}"  defer ></script>
    <script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>

<script async src="{{themes('site/js/videopopup.js')}}"></script>
@toastr_js
@toastr_render
    @include('site.scripts.front-js')
{!! getSetting('google_tag_manager_head', 'site_settings') !!}
    @include('errors.formMessages')

    <script type= "text/javascript">
        showAlert = function() {
            jQuery('body').addClass('alert-show');
        }

        hideAlert = function() {
            jQuery('body').removeClass('alert-show');
        }

        // auto show
        setTimeout(function() {
            showAlert();
        }, 1000);

        // auto hide
        setTimeout(function() {
            hideAlert();
        }, 5000);



        jQuery(document).ready(function($){
            $('.venobox').venobox();

        });


        $('.lazy').lazy();
    </script>
    @yield('footer_scripts')

    {!!getSetting('google_analytics', 'seo_settings')!!}



</body>

</html>