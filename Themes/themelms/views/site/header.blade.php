<!-- Header -->
<?php
$cartCollection = \Cart::getContent();
$total = \Cart::getTotal();

if(Auth::check()){
    $user=Auth::user();

}
?>

<header id="header" class="header  navbar-scrolltofixed">
    @if($Promo->content_status == "active")
        @if($Promo->bannerBG == "IMGUPLOAD")
            <a  href="{!! (isset($Promo->content_link)) ? $Promo->content_link : "javascript:void(0);" !!}">
                <img class="topbar-img" src="<?=UPLOADS?>promobanner/{!! $Promo->content_area !!}" width="100%" />
                {{--<img class="mobile-topbar-img" src="<?=UPLOADS?>promobanner/MobileStrip.png" />--}}
                <img class="mobile-topbar-img" src="<?= ($Promo->mobile_img) ? UPLOADS . "promobanner/BG/" . $Promo->mobile_img : UPLOADS . "promobanner/MobileStrip.png"?>" />
                @if(isset($Promo->timmer))
                    <div class="timerOuter" id="timerOuter"><div class="topbartimer" id="topbartimer"></div></div>
                @endif
            </a>
        @else
            <div class="alert alert-hide alert-success mb-0 text-center" role="alert" {!! (json_decode($Promo->bannerBG, true)["BackgroundType"] == "bgimg") ? "style=\"background-color: '".UPLOADS."promobanner/BG/".json_decode($Promo->bannerBG, true)["BackgroundContent"]."';\"" : 'style="background-color: '.json_decode($Promo->bannerBG, true)["BackgroundContent"].';"' !!}><a  href="{!! (isset($Promo->content_link)) ? $Promo->content_link : "javascript:void(0);" !!}"><b>{!! (isset($Promo->content_type) && $Promo->content_type == "textcontent") ? $Promo->content_area : "" !!}</b></a></div>
        @endif
    @endif
    <div class="header-top bg-theme-colored border-top-theme-colored2-2px d-none">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-12 d-sm-none">
                    <div class="widget">
                        <ul class="styled-icons icon-sm icon-white">
                            {{--<li><a href="{{getSetting('facebook_link', 'site_settings')}}" target="_blank"><i class="fa fa-facebook"></i></a></li>--}}
                            {{--<li><a href="{{getSetting('twitter_link', 'site_settings')}}" target="_blank"><i class="fa fa-twitter"></i></a></li>--}}
                            {{--<li><a href="{{getSetting('linkedin_link', 'site_settings')}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>--}}
                            {{--<li><a href="{{getSetting('instagram_link', 'site_settings')}}" target="_blank"><i class="fa fa-instagram"></i></a></li>--}}

                            <li><a href="https://www.facebook.com/Infinity-Learning-119333166501818" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/Infinitylearn3" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.linkedin.com/company/infinity-learning-global" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="https://www.instagram.com/infinitylearninguk/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                        <ul class="list-inline  flip sm-text-center">
                            <li class="text-white">|</li>
                            <li>
                                <a class="text-white" href="tel:00442081269090"><i class="fa fa-phone-square"></i> 0208 126 9090</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6  col-xs-12">
                    <!-- <div id="side-panel-trigger" class="side-panel-trigger ml-15 mt-8 pull-right sm-pull-none"><a href="#"><i class="fa fa-bars font-24"></i></a>
                    </div> -->
                    <div class="widget">
                        <ul class="list-inline text-right flip sm-text-right">
                            {{-- <li>
                                 <a class="text-white" href="register.php"><i class="fa fa-unlock-alt"></i> Login</a>
                             </li>
                             <li class="text-white">|</li>
                             <li>
                                 <a class="text-white" href="register.php"><i class="fa fa-user"></i> Sign up</a>
                             </li>--}}

                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="header-nav">



        <div class="header-nav-wrapper bg-white">
            <div class="container">
                <!-- Desktop Nav -->
                <nav class="desktop__nav">
                    <a href="<?=url('/')?>" class="header__logo"><img src="<?=UPLOADS.'images/nla_NewLogo.png'?>" alt="Next Learn Academy" width="230"></a>

                    <div class="main-nav-wrap">
                        <div class="mobile-overlay"></div>
                        <ul class="mobile-main-nav">
                            <div class="mobile-menu-helper-top"></div>
                            <li class="has-children">
                                <a href="{{url('/all-courses')}}">
                                    <i class="fas fa-th d-inline"></i>
                                    <span>Courses</span>
                                    <span class="has-sub-category"><i class="fas fa-angle-right"></i></span>
                                </a>
                                <ul class="category corner-triangle top-left is-hidden">
                                    <li class="go-back"><a href=""><i class="fas fa-angle-left"></i>Menu</a></li>
                                    @php $i = 0; @endphp
                                    @foreach ($menu_categories as $category)
                                        @if($category->slug!='other')
                                            @if($i == 0)
{{--                                            <li >--}}
{{--                                                <a href="{{url('/all-courses')}}">--}}
{{--                                                    <span class="icon"><i class="fa fa-list" aria-hidden="true"></i></span>--}}
{{--                                                    <span>All Courses</span>--}}

{{--                                                </a>--}}
{{--                                            </li>--}}
                                            @endif
                                            <li class="has-children">
                                                <a href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$category->slug}}">
                                                    <span class="icon"><i class="{!! $category->icon !!}"></i></span>
                                                    <span>{{$category->category}}</span>
                                                    @if($category->children->count()>0)
                                                        <span class="has-sub-category"><i class="fas fa-angle-right"></i></span>
                                                    @endif
                                                </a>
                                                @if($category->children->count()>0)
                                                    <ul class="sub-category is-hidden">

                                                        <li class="go-back-menu"><a href=""><i class="fas fa-angle-left"></i>Menu</a></li>

                                                        <li class="go-back"><a href="">
                                                                <i class="fas fa-angle-left"></i>
                                                                <span class="icon"><i class="{{$category->icon}}"></i></span>
                                                                {{$category->category}}                            </a></li>
                                                        @foreach ($category->children as $subcat)
                                                            <li><a href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$subcat->slug}}">{{$subcat->category}} </a></li>
                                                        @endforeach
                                                        {{--<li><a href="http://creativeitem.com/demo/academy/home/category/mobile-app-development/5">Mobile App Development</a></li>--}}
                                                        {{--<li><a href="http://creativeitem.com/demo/academy/home/category/game-development/6">Game Development</a></li>--}}
                                                    </ul>
                                                @endif

                                        </li>
                                        @endif
                                    @php $i++; @endphp
                                    @endforeach
                                    <li class="has-children">
                                        <a href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/other'}}">
                                            <span class="icon"><i class="fas fa-laptop"></i></span>
                                            <span>Other</span>
                                            {{--@if($category->children->count()>0)--}}
                                            {{--<span class="has-sub-category"><i class="fas fa-angle-right"></i></span>--}}
                                            {{--@endif--}}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <div class="mobile-menu-helper-bottom"></div>
                        </ul>
                    </div>

                    @include('site.partials.search_form')

                    <div class="header__btns">
                        <div class="dsk_btns link__btn hid_tlbs" {{ isActive($active_class, 'about-us') }}><a href="<?=url('/about-us')?>">About</a></div>
                    </div>

                    <div class="header__btns">
                        <div class="dsk_btns link__btn" {{ isActive($active_class, 'contact_us') }}><a href="{{ URL_SITE_CONTACTUS }}">{{getPhrase('contact')}}</a></div>
                    </div>

                    <div class="header__btns">
                        <div class="dsk_btns link__btn" {{ isActive($active_class, 'faqs') }}><a href="{{ URL_FAQS }}">{{getPhrase('Help')}}</a></div>
                    </div>

                    <div class="header__btns">
                        <a href="javascript:showwishlist();" id="headerwishlist" class="dsk_btns wish__btn"><i class="fa fa-heart"></i><span id="wish_count" class="badge wish_count">{!! (Auth::user()) ? App\Http\Controllers\SiteController::CountWishlistedItem() : (session()->has('Course_ids') ? count(session()->get('Course_ids')) : 0) !!}</span></a>
                    </div>

                    <div class="header__btns dropdown">
                        <a href="#" class="dsk_btns crt__btn dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-shopping-cart"></i>
                                @if(!urlHasString("savegift"))
                                    <span class="badge cart_count"><?=$cartCollection->count();?></span>
                                @endif
                        </a>
                        {{--<a href="#" id="cart" class=""></a>--}}

                        <ul class="dropdown-menu dropdown-cart cart_area" >
                            @include('site.cart')
                        </ul>
                    </div>

                    @if(Auth::check())
                        <div class="header__btns dropdown">
                            <a class="signIn_btns dsk_btns dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <div id="notificationTitle">
                                    @if($user->image)
                                        <img src="{{IMAGE_PATH_PROFILE_THUMBNAIL.$user->image}}" class="dropdown-user-circle"  alt="{{$user->name}}">
                                    @else
                                    <?php
                            $initials = null;
//                            $words = explode(" ", $user->name);
//                            if(count($words )>1){
//                                            foreach ($words as $w) {
//                                                 $initials .= $w[0];
//                                            }
//                                        }else{
//                                        $initials=substr($user->name,0,2);
//                                        }
                                       $initials= generate($user->name);
                                    $background_colors = array('#282E33','#5aed86','#19b530','#0588bc','#dbea7c','#d642c0','#812ec1','#112187', '#25373A', '#164852', '#495E67', '#FF3838');

                                    $myColor = $background_colors[array_rand($background_colors)];
                                        ?>
                                        <div class="circle "  style="background-color: <?=$myColor?>; float: left">
                                            <span class="initials"> {{$initials}}</span>
                                        </div>

                                        {{--                                                            <img src="{{IMAGE_PATH_PROFILE_THUMBNAIL_DEFAULT}}" alt="">--}}
                                    @endif
                                    {{--<img src="https://demo.infinitylearning.org.uk/public/uploads/users/thumbnail/12.jpeg" class="dropdown-user-circle" alt="user">--}}
                                    <div class="user-detailss">
                                        {{$user->name}}
                                        <br>
                                       {{$user->email}}<br>
                                       <p class="badge badge-success">{{ucwords(getRole())}}</p>

                                    </div>
                                </div>
                                {{--@if(getRole()=="instructor")
                                     <a href="{{URL_DASHBOARD."?view=student"}}" style="color: #008dd6;"><i class="fas fa-toggle-on"></i> Switch to Student View</a>
                                @elseif(getRole()=="student")
                                     <a href="{{URL_DASHBOARD."?view=instructor"}}"  style="color: #008dd6;"><i class="fas fa-toggle-on"></i> Switch to Instructor View</a>
                                @endif--}}
                                <a href="{{URL_DASHBOARD}}"><i class="fa fa-dashboard"></i>{{ucwords(getRole())}} {{getPhrase('dashboard')}}</a>
                                <a href="{{URL_STUDENT_LMS_SERIES}}"><i class="fa fa-diamond"></i> My Courses</a>
                                <a href="{{URL_STUDENT_LMS_WISHLIST}}"><i class="fa fa-heart"></i> My Wishlist</a>
                                <a href="{{URL_MESSAGES}}"><i class="fa fa-envelope"></i> My Messages</a>
                                {{--<a href="{{URL_PAYMENTS_LIST.$user->slug}}"><i class="fa fa-shopping-cart"></i> Purchase History</a>--}}
                                <a href="{{URL_USERS_EDIT.$user->slug}}"><i class="fa fa-user"></i> My Profile</a>
                                @if(getRole()=="student")
                                    {{--<a href="#" data-toggle="modal"   data-target="#myModalinstructor" ><i class="fa fa-user"></i> Become an Instructor</a>--}}
                                    <a href="{{url('/instructor')}}"><i class="fa fa-user"></i> Become an Instructor</a>
                                @endif
                                    <a class="logout" href="{{URL_USERS_LOGOUT}}"> {{getPhrase('logout')}}</a>
                            </div>
                        </div>
                    @else
                        <div class="header__btns"><a href="{{URL_USERS_LOGIN}}" class="dsk_btns signIn_btns"><span>{{getPhrase('Log_in')}}</span></a></div>
                        <div class="header__btns"><a href="{{URL_USERS_REGISTER}}" class="dsk_btns signUp_btns">{{getPhrase('Sign_up')}}</a></div>
                    @endif
                    <?php
                    $ub=getBrowserInfo();
                    $chromeflag=$ub['browser']=="Chrome"?true:false;
                    ?>
                    <div class="header__btns dsk_btns2">
                        <select id="currency" class="currency-selector" style="{{$ub['browser']!="Chrome"?'width:55px !important;':''}}" disabled="disabled">
                            @foreach ($menu_currencies as $currency)
                              <option  data-symbol="{{$currency->currency_symbol}}" data-symbol-code="{{'&#x'.$currency->symbol_code.';'}}" data-short="{{$currency->currency_short}}" data-id="{{$currency->id}}" value="{{$currency->rate}}"   {{session('currency_short')==$currency->currency_short ? 'selected' : ''}}>{{ $currency->currency_short}}</option>
                            @endforeach
                        </select>
                    </div>
                </nav>

                <!-- Tablet & Mobile Nav -->
                <nav class="mobile__nav">
                    <!-- open sidebar menu -->
                    <a class="mob_infty__btn toggle open-menu" href="#" role="button"><i class="fa fa-bars"></i></a>
                    {{--<div class="button-space mob_infty__btn"></div>--}}
                    <a href="javascript:void(0);" id="" onclick="javascript: @if(Auth::check()) window.location = '{{ URL_STUDENT_LMS_WISHLIST }}'; @else window.location = '{{ url('/wishlist') }}'; @endif" class="mob_infty__btn wish__btn"><i class="fa fa-heart"></i><span class="badge wish_count">{!! (Auth::user()) ? App\Http\Controllers\SiteController::CountWishlistedItem() : (session()->has('Course_ids') ? count(session()->get('Course_ids')) : 0) !!}</span></a>
                    <a class="header__logo" href="<?=url('/')?>"><img src="<?=UPLOADS.'images/nla_NewLogo.png'?>" width="110" alt=""></a>

                    <a href="javascript:void(0);" class="mob_infty__btn btn_serch search-form-tigger"  data-toggle="search-form"><i class="fas fa-search"></i></a>

                    <a href="javascript:void(0);" id="cart" class="mob_infty__btn btn_cart">
                        <i class="fa fa-shopping-cart"></i><span class="badge cart_count"><?=$cartCollection->count();?></span>
                    </a>
                    <ul class="shopping-cart mobile_dropdown dropdown-cart cart_area">
                        @include('site.cart')
                    </ul>

                    <div class="dsk_btns2">
                        <select id="currency" class="currency-selector"  disabled="disabled">
                            @foreach ($menu_currencies as $currency)
                                <option  data-symbol="{{$currency->currency_symbol}}" data-symbol-code="{{$currency->symbol_code}}" data-short="{{$currency->currency_short}}" data-id="{{$currency->id}}" value="{{$currency->rate}}"   {{session('currency_short')==$currency->currency_short ? 'selected' : ''}}>{{  $currency->currency_short}}</option>
                            @endforeach
                        </select>
                    </div>
                </nav>
                <div class="search-form-wrappers">
                    @include('site.partials.search_form')
                </div>

            </div>
        </div>
    </div>
    <!-- Left sidebar -->
    <nav class="sidebar">
        <!-- close sidebar menu -->
        <div class="dismiss"><i class="fas fa-arrow-left"></i></div>
        <!--<div class="logo"><h3><a href="/"></a></h3></div>-->
        <ul class="list-unstyled menu-elements">

            @if(Auth::check())
                <li class="loginaftr__div">
                    <a href="#loginDropdown" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="loginDropdown">
                        @if($user->image)
                            <img src="{{IMAGE_PATH_PROFILE_THUMBNAIL.$user->image}}" class="dropdown-user-circle"  alt="{{$user->name}}">
                        @else
                            <?php
                            $initials = null;
//                            $words = explode(" ", $user->name);
//                            if(count($words )>1){
//                                            foreach ($words as $w) {
//                                                 $initials .= $w[0];
//                                            }
//                                        }else{
//                                        $initials=substr($user->name,0,2);
//                                        }
                                       $initials= generate($user->name);
                        $background_colors = array('#282E33','#5aed86','#19b530','#0588bc','#dbea7c','#d642c0','#812ec1','#112187', '#25373A', '#164852', '#495E67', '#FF3838');

                        $myColor = $background_colors[array_rand($background_colors)];
                            ?>
                            <div class="circle "  style="background-color: <?=$myColor?>">
                                <span class="initials"> {{$initials}}</span>
                            </div>

                         @endif

                         <div class="user-detailss">
                            {{$user->name}} - {{getRole()}}
                            <br>
                            {{$user->email}}
                        </div>
                    </a>
                    <ul class="collapse list-unstyled" id="loginDropdown">
                        <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-dashboard"></i> {{getPhrase('dashboard')}}</a></li>
                        <li><a href="{{URL_STUDENT_LMS_SERIES}}"><i class="fa fa-diamond"></i> My Courses</a></li>
                        <li><a href="{{URL_STUDENT_LMS_WISHLIST}}"><i class="fa fa-heart"></i> My Wishlist</a></li>
                        <li><a href="{{URL_MESSAGES}}"><i class="far fa-envelope"></i> My Messages</a></li>
                        <li><a href="{{URL_PAYMENTS_LIST.$user->slug}}"><i class="fa fa-shopping-cart"></i> Purchase History</a></li>
                        <li><a href="{{URL_USERS_EDIT.$user->slug}}"><i class="fa fa-user"></i> My Profile</a></li>
                        <li><a href="{{URL::to('/instructor')}}" ><i class="fa fa-user"></i> Become an Instructor</a></li>
                        <li><a class="logout" href="{{URL_USERS_LOGOUT}}"> {{getPhrase('logout')}}</a></li>
                    </ul>
                </li>
            @else
                <li><a href="{{URL_USERS_LOGIN}}" class="dsk_btns signIn_btns"><span>{{getPhrase('Log_in')}}</span></a></li>
                <li><a href="{{URL_USERS_REGISTER}}" class="dsk_btns signUp_btns">{{getPhrase('Sign_up')}}</a></li>
            @endif

            <li {{ isActive($active_class, 'faqs') }}><a class="" href="{{ URL_FAQS }}">{{getPhrase('Help')}}</a></li>
            <li {{ isActive($active_class, 'about-us') }}><a href="<?=url('/about-us')?>">About Us</a></li>
            <li {{ isActive($active_class, 'contact-us') }}><a href="{{ URL_SITE_CONTACTUS }}">{{getPhrase('contact_us')}}</a></li>

                <li class="mobile_courses_nav">
                    <a href="#coursesDropdown" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="coursesDropdown">Courses</a>
                    <ul class="collapse list-unstyled" id="coursesDropdown">
                        @php $i = 0; @endphp
                        @foreach ($menu_categories as $category)
                            @if($category->slug!='other')
                                @if($i == 0)
                                    <li >
                                        <a href="{{url('/all-courses')}}">
                                            <span class="icon"><i class="fa fa-list" aria-hidden="true"></i></span>
                                            <span>All Courses</span>
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="#{{$category->id}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle downIcon" role="button" aria-controls="{{$category->id}}">
                                        <a href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$category->slug}}">
                                            <span class="icon"><i class="{{$category->icon}}"></i></span>
                                            {{$category->category}}
                                        </a>
                                    </a>
                                    @if($category->children->count()>0)
                                        <ul class="collapse list-unstyled" id="{{$category->id}}">
                                            @foreach ($category->children as $subcat)
                                                <li><a href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$subcat->slug}}">- {{$subcat->category}} </a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif
                                @php $i++; @endphp
                        @endforeach
                        <li>
                            <a href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/other'}}">
                                <span class="icon"><i class="fas fa-laptop"></i></span>
                                <span>Other</span>
                            </a>
                        </li>
                    </ul>
                </li>

            <li id="mobile_courses_menu" class="parent_nav" style="display:none !important;">
                {{--{{ SITE_PAGES_ABOUT_US }}--}}
                <a href="javascript:void(0)">Courses <i class="fas fa-angle-down pull-right"></i></a>
                <ul class="dropdown m-0 child_nav">
                    @php $i = 0; @endphp
                    @foreach ($menu_categories as $category)
                        @if($category->slug!='other')
                            @if($i == 0)
                                <li >
                                    <a href="{{url('/all-courses')}}">
                                        <span class="icon"><i class="fa fa-list" aria-hidden="true"></i></span>
                                        <span>All Courses</span>

                                    </a>
                                </li>
                            @endif
                            <li class="sub_child_nav">
                                <a href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$category->slug}}">
                                    <span class="icon"><i class="{{$category->icon}}"></i></span>
                                    <span>{{$category->category}}</span>
                                </a>
                                @if($category->children->count()>0)
                                    <span class="has-sub-category"><i class="fas fa-angle-down" style="margin-top:5px;"></i></span>
                                @endif
                                @if($category->children->count()>0)
                                    <ul class="dropdown" style="display:none">
                                        {{--<li class="go-back-menu"><a href=""><i class="fas fa-angle-left"></i>Menu</a></li>--}}
                                        <li><a href="">
                                                {{--<i class="fas fa-angle-left"></i>--}}
                                                {{--<span class="icon"><i class="fas fa-laptop"></i></span>--}}
                                                {{$category->category}}                            </a></li>
                                        @foreach ($category->children as $subcat)
                                            <li><a href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$subcat->slug}}">{{$subcat->category}} </a></li>
                                        @endforeach
                                        {{--<li><a href="http://creativeitem.com/demo/academy/home/category/mobile-app-development/5">Mobile App Development</a></li>--}}
                                        {{--<li><a href="http://creativeitem.com/demo/academy/home/category/game-development/6">Game Development</a></li>--}}
                                    </ul>
                                @endif
                            </li>
                        @endif
                            @php $i++; @endphp
                    @endforeach
                </ul>
            </li>
        </ul>
    </nav>
    <!-- Sidebar Overlay -->
    <div class="overlay"></div>
</header>
 <!--end shopping-cart -->
<!-- Header -->
{{--<header id="header" class="header">
    <div class="header-top bg-theme-colored border-top-theme-colored2-2px sm-text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="widget">
                        <ul class="styled-icons icon-sm icon-white">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="side-panel-trigger" class="side-panel-trigger ml-15 mt-8 pull-right sm-pull-none"><a href="#"><i class="fa fa-bars font-24"></i></a>
                    </div>
                    <div class="widget">
                        <ul class="list-inline text-right flip sm-text-center">
                            <li>
                                <a class="text-white" href="#">FAQ</a>
                            </li>
                            <li class="text-white">|</li>
                            <li>
                                <a class="text-white" href="#">Help Desk</a>
                            </li>
                            <li class="text-white">|</li>
                            <li>
                                <a class="text-white" href="#">Support</a>
                            </li>
                            @if(Auth::check())

                                <li><a href="{{PREFIX}}" class="text-white"> {{getPhrase('dashboard')}}</a></li>
                                <li><a href="{{URL_USERS_LOGOUT}}" class="text-white"> {{getPhrase('logout')}}</a></li>
                            @else
                                <li><a href="{{URL_USERS_REGISTER}}" class="text-white"> {{getPhrase('create_account')}}</a></li>
                                <li><a href="{{URL_USERS_LOGIN}}" class="text-white"><span>{{getPhrase('sign_in')}}</span><i class="icon icon-User " aria-hidden="true"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav">
        <div class="header-nav-wrapper navbar-scrolltofixed bg-white">
            <div class="container">
                <nav id="menuzord-right" class="menuzord default theme-colored"><a class="menuzord-brand pull-left flip mt-20 mt-sm-10 mb-sm-20 pt-5" href="{{URL_HOME }}"><img src="{{IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')}}" alt=""></a>
                    <ul class="menuzord-menu">
                        <li {{ isActive($active_class, 'home') }}><a href="{{URL_HOME }}">{{getPhrase('home')}}</a></li>
                        <li {{ isActive($active_class, 'practice_exams') }} > <a href="{{ URL_VIEW_ALL_PRACTICE_EXAMS }}">{{getPhrase('practice_exams')}}</a></li>
                        <li {{ isActive($active_class, 'lms') }} ><a href="{{ URL_VIEW_ALL_LMS_CATEGORIES }}">Courses</a></li>
                        --}}{{--<li {{ isActive($active_class, 'courses') }} ><a href="{{ URL_VIEW_SITE_COURSES }}">{{getPhrase('courses')}}</a></li>--}}{{--
                        <li {{ isActive($active_class, 'pattren') }} ><a href="{{ URL_VIEW_SITE_PATTREN }}">{{getPhrase('pattern')}}</a></li>
                        <li {{ isActive($active_class, 'pricing') }} ><a href="{{ URL_VIEW_SITE_PRICING }}">{{getPhrase('pricing')}}</a></li>
                        <li {{ isActive($active_class, 'syllabus') }} ><a href="{{ URL_VIEW_SITE_SYALLABUS }}">{{getPhrase('syllabus')}}</a></li>
                        --}}{{-- <li {{ isActive($active_class, 'practice_exams') }} ><a href="{{ SITE_PAGES_PRIVACY }}">{{ getPhrase('privacy_and_policy') }}</a></li>
                        <li {{ isActive($active_class, 'practice_exams') }} ><a href="{{ SITE_PAGES_TERMS }}">{{getPhrase('terms_and_conditions')}}</a></li> --}}{{--
                        <li {{ isActive($active_class, 'about-us') }} ><a href="{{ SITE_PAGES_ABOUT_US }}">{{getPhrase('about_us')}}</a></li>
                        <li {{ isActive($active_class, 'contact-us') }} ><a href="{{ URL_SITE_CONTACTUS }}">{{getPhrase('contact_us')}}</a></li>



                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>--}}
