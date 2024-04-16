<?php
$ub=getBrowserInfo();
?>

@if($ub['browser']=="Safari")
    <style>
        input[type="email"],
        input[type="number"],
        input[type="password"],
        input[type="search"],
        input[type="text"],
        select:focus,
        textarea {
            font-size:15px !important;
        }
        @media screen and (max-width:425px) {
            .search-container .newsletter-form {
                position:relative;
            }
            /*.search-container .newsletter-form input.form-control {
                transition: 0.3s;
                -webkit-rtl-ordering: logical;
                -webkit-user-select: text;
                cursor: auto;
                -webkit-appearance: textfield;
                box-sizing: border-box;
            }*/
        }

        /*** iPhone and iOS Form Input Zoom Fixes ***/
        /* Fix Input Zoom on devices older than iPhone 5: */
        @media screen and (device-aspect-ratio: 2/3) {
            select, textarea, input[type="text"], input[type="password"],
            input[type="datetime"], input[type="datetime-local"],
            input[type="date"], input[type="month"], input[type="time"],
            input[type="week"], input[type="number"], input[type="email"],
            input[type="url"]{ font-size: 16px !important; }
        }

        /* Fix Input Zoom on iPhone 5, 5C, 5S, iPod Touch 5g */
        @media screen and (device-aspect-ratio: 40/71) {
            select, textarea, input[type="text"], input[type="password"],
            input[type="datetime"], input[type="datetime-local"],
            input[type="date"], input[type="month"], input[type="time"],
            input[type="week"], input[type="number"], input[type="email"],
            input[type="url"]{ font-size: 16px !important; }
        }

        /* Fix Input Zoom on iPhone 6, iPhone 6s, iPhone 7  */
        @media screen and (device-aspect-ratio: 375/667) {
            select, textarea, input[type="text"], input[type="password"],
            input[type="datetime"], input[type="datetime-local"],
            input[type="date"], input[type="month"], input[type="time"],
            input[type="week"], input[type="number"], input[type="email"],
            input[type="tel"], input[type="url"]{ font-size: 16px !important; }
        }

        /* Fix Input Zoom on iPhone 6 Plus, iPhone 6s Plus, iPhone 7 Plus, iPhone 8, iPhone X, XS, XS Max  */
        @media screen and (device-aspect-ratio: 9/16) {
            select, textarea, input[type="text"], input[type="password"],
            input[type="datetime"], input[type="datetime-local"],
            input[type="date"], input[type="month"], input[type="time"],
            input[type="week"], input[type="number"], input[type="email"],
            input[type="tel"], input[type="url"]{ font-size: 16px !important; }
        }

        @media screen and (min-width:1280px) and (max-width:1440px) {
            /*.main-nav-wrap>ul>li>ul {overflow:hidden;}*/
            .main-nav-wrap>ul>li>ul li {
                line-height:12px;
            }
            .main-nav-wrap>ul>li>ul>li a {
                padding: 2px 8px 2px 6px;
                font-size: 11px;
                line-height: 12px;
            }
        }
        @media screen and (min-width:1367px) and (max-width:1440px) {
            .newCategories__style:before {
                width: 29.5%;
            }
        }
        @media screen and (min-width:1281px) and (max-width:1366px) {
            .newCategories__style:before {width:28% !important;}
        }

        @media screen and (min-width:1600px) and (max-width:5000px) {
            .filter_vewArea .col-lg-9 {
                -ms-flex: 0 0 75%;
                flex: 0 0 75%;
                max-width: 75%;
            }
            .filter_vewArea .col-lg-3 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%;
            }
        }

        .whyChoose_box figure{
            -webkit-backface-visibility: hidden;
            -moz-backface-visibility: hidden;
            -webkit-transform: translate3d(0, 0, 0);-moz-transform: translate3d(0, 0, 0)
        }
        .whyChoose_box figure img{
            -webkit-backface-visibility: hidden;
            -moz-backface-visibility: hidden;
            -webkit-transform: translate3d(0, 0, 0);-moz-transform: translate3d(0, 0, 0)
        }

        /* Landscape iPhone 8+ */
        @media only screen and (min-device-width: 414px) and (max-device-width: 736px), (-webkit-min-device-pixel-ratio: 3) and (orientation: landscape) {
            .categories-section .single-course-thumb img {height: 215px !important;}
        }
        /* Landscape iPhone 6*/
        @media only screen and (min-device-width: 375px) and (max-device-width: 667px), (-webkit-min-device-pixel-ratio: 2) and (orientation: landscape) {
            .categories-section .single-course-thumb img {height: 215px !important;}
        }

    </style>
    <style>
        @media not all and (min-resolution:.001dpcm) {
            @supports (-webkit-appearance:none) and (display:flow-root) {
                @media screen and (min-width:1600px) and (max-width:1920px) {
                    .newCategories__style:before {
                        width:30.5%;
                    }
                }

            }
        }
    </style>
@endif
@if($ub['browser']=="Firefox")
    <style>
        .currency-selector {
            width:60px !important;
            padding-left:.3rem !important;
        }
    </style>
@endif
<style>

/*.tab-content ul li {
    display: flex;
    margin-bottom: 10px;
    width: 100%;
    padding-left: 26px;
    font-size: 15px;
    position: relative;
}
.tab-content ul li:before {
    font-family: Font Awesome\ 5 Free;
    font-weight: 700;
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
    content: "\f00c";
    color: #000000;
    font-size: 14px;
    position: absolute;
    left: 0;
    top: 4px;
}*/

    table.table.table-striped.tbl-shopping-cart.cart_shoppingTable {
        font-size: 13px;
    }
    .nLAlite-text-sm.box--objectives--3WNla ul li {
        margin-left: 0px !important;
    }

    .continue_shopping{
        padding-bottom: 30px;
        text-align: right;
    }
    .box_cart {

        padding: 20px;
    }
    .amt_col{
        white-space: nowrap;
    }
    .cart_shoppingTable .product-name a, .tbl-shopping-cart .product-name a {
        color: #00719D !important;
        font-size: 13px;
    }
    .cart_shoppingTable .product-quantity input{
        width:46px;text-align: center;border: rgba(0, 0, 0, 0.35) solid 1px;
        border-radius:3px;-webkit-border-radius:3px;-moz-border-radius:3px;
    }
    .ordertotal i{
    font-size: 14px;
    margin-right: 2px;
    /* line-height: 13px; */
    color: black;
    }
    .list_cart .item-price i {
        font-size: 13px;
        margin-right: 1px;
    }
    .course-box .price del i {
        margin-right: 2px;
        margin-left: 0px;
        font-size: 13px !important;
    }
    .all_course_mobile_banner_class {
        display: none;
    }
    .amount i, .tbl-shopping-cart i, .form-check i{
        color: #585858;
        margin-right: 2px;
        font-size: 13px;
    }

    .all_course_mobile_banner_class {
        display: none;
    }

    .course-box .price i {
        margin-right: 0px;
        font-size: 15px;
        margin-left: 2px;
    }
    .price i.fa-dirham-sign:before{
        content: "AED";
    }
    .price i.fas.fa-dirham-sign{
        font-size: 12px !important;
        letter-spacing: 0;
        font-family: 'Open Sans', sans-serif;
        font-weight:600;
    }

    .cart_item .amount i {
        color: #585858;
        margin-right: 2px;
        font-size: 13px;
    }

    .view__cartSummary i {
        color: #585858;
        font-size: 13px;
        margin-right: 2px;
    }

    /*select {*/
        /*font-family: 'FontAwesome' , 'arial' !important;*/
    /*}*/

    .currency-selector {
        position: relative;
        /* left: 0; */
        margin-left: 2px;
        width: 50px;
        height: 26px;
        padding-left: .5rem;
        border: 0;
         -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='1024' height='640'><path d='M1017 68L541 626q-11 12-26 12t-26-12L13 68Q-3 49 6 24.5T39 0h952q24 0 33 24.5t-7 43.5z'></path></svg>") 100%/10px 6px no-repeat;
        font-family: 'FontAwesome' ,"Open Sans", sans-serif;
        color: #333;
        font-size: 14px;
    }
    .currency-selector option {
        font-family: "Font Awesome 5 Free";
        font-family: 'FontAwesome' ,"Open Sans", sans-serif;
    }

    .js-cookie-consent.cookie-consent {
        text-align: center;
        padding: 15px;
        background-color: #176E9B;
        color: white;
        position: fixed;
        bottom: 0;
        width: 100%;
        z-index: 9999;
    }
    .js-cookie-consent.cookie-consent button{
        color: #fff;

        background-color: #51ac37;
        padding: 11px 12px;

        border-radius: 2px;
        line-height: 1.35135;
        font-weight: 600;
        font-size: 14px;
        border:1px solid #409e25

    }



    .social-btns .btn,
    .social-btns .btn:before,
    .social-btns .btn .fa {
        transition: all 0.35s;
        transition-timing-function: cubic-bezier(0.31, -0.105, 0.43, 1.59);
    }
    .social-btns .btn:before {
        top: 90%;
        left: -110%;
    }
    .social-btns .btn .fa {
        transform: scale(0.8);
    }
    .social-btns .btn.facebook:before {
        background-color: #3b5998;
    }
    .social-btns .btn.facebook .fa {
        color: #3b5998;
    }
    .social-btns .btn.twitter:before {
        background-color: #3cf;
    }
    .social-btns .btn.twitter .fa {
        color: #3cf;
    }
    .social-btns .btn.linkedin:before {
        background-color: #006599;
    }
    .social-btns .btn.linkedin .fa {
        color: #006599;
    }
    .social-btns .btn.instagram:before {
        background-color: #527fa6;
    }
    .social-btns .btn.instagram .fa {
        color: #527fa6;
    }
    .social-btns .btn:focus:before,
    .social-btns .btn:hover:before {
        top: -10%;
        left: -10%;
    }
    .social-btns .btn:focus .fa,
    .social-btns .btn:hover .fa {
        color: #fff;
        transform: scale(1);
    }
    .social-btns {
        height: 40px;
        margin: auto;
        font-size: 0;
        text-align: right;
        position: relative;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }
    .social-btns .btn {
        display: inline-block;border-color:transparent;
        background-color: #fff;
        width: 40px;
        height: 40px;
        line-height: 40px;
        margin: 0 8px;
        text-align: center;
        position: relative;
        overflow: hidden;
        border-radius: 28%;
        box-shadow: 0 5px 15px -5px rgba(0,0,0,0.1);
        opacity: 0.99;
        padding: 0;
    }
    .social-btns .btn:before {
        content: '';
        width: 120%;
        height: 120%;
        position: absolute;
        transform: rotate(45deg);
    }
    .social-btns .btn .fa {
        font-size:26px;
        vertical-align: middle;
    }


    .all-section-total div {
        padding: 10px 0px;
    }

    span.message i::before {
        display: none;
    }

    .desktop__nav .dropdown-menu .cart_area {
        min-height: 200px;
        overflow: scroll;
        max-height: 450px;
        overflow-x: hidden;
        overflow-y: auto;
    }

    .pb-0{padding-bottom:0 !important;}

    div#ratings_filter .rating i {
        color: orange;
    }

    div#ratings_filter .rating .empty {
        color: #d1d0cf;
    }
    .owl-carousel {
        display: none;
    }

    .owl-carousel.owl-loaded {
        display: block;
    }
    #loading {
        width: 100%;
        height: 100%;
        top: 150px;
        left: 0;
        position: fixed;

        opacity: 0.7;
        background-color: #fff;
        z-index: 99;
        text-align: center;
    }

    #loading-image {
        position: absolute;
        top: 100px;
        z-index: 100;
    }

    .mobile_div{
        display: none;
    }
    .desk_div{
        display: block;
    }
    .course-box .btn-sm {min-width:87px;}
    .tbl-shopping-cart .product-thumbnail img {
        max-width: 35px;
        max-height: 35px;
        border-radius: 5px;
    }

    .cart_added_popup .modal-body div{
        display: flex;
    }
    .cart_added_popup .modal-dialog{
        margin-top: 200px;
    }
    .cart_added_popup .check_arrow{
        color: green;
        font-size: 30px;
        padding: 0px 10px;
    }
    .cart_added_popup .cart_image{
        width:50px
    }
    .cart_added_popup .cart_image img{
        border-radius: 5px;
    }
    .cart_added_popup .item-name{
        font-size: 14px;
        padding: 6px 12px;
        font-weight: 700;
        vertical-align: top;
        width: 60%;
        line-height: 20px !important;
    }
    .cart_added_popup .item-price{

        display: none;
    }
    .cart_added_popup .item_button a{color: white;}

    .cart_added_popup .close {
        position: unset;
        background: transparent;
        padding: 0px;
        margin: 0px;
        font-size: 24px;
        color: black;
        opacity: 0.6;
        font-weight: 900;
    }
    .gurnted-logo {
        margin-top: 3%;
    }

    .pt_6 {
        margin-top: 6%;
    }
    .fl-right {
        float: right !important;
    }
    .border-one-gray {
        /*border: 1px solid #c5c5c5;*/
        border-radius: 8px;
    }
    .successGreen {
        color: #0F9E5E;
        font-size: 16px;
    }

    .login_popup_form .close{position: unset;
        background: transparent;
        padding: 0px;
        margin: 0px;
        font-size: 24px;
        color: black;
        opacity: 0.6;
        font-weight: 900;
    }
    a.remove {
        cursor: pointer;
    }
    .btn-sm {
        font-size: 12px;
        padding: 5px 10px;
    }
    .searchResult .scrollable li a {
        color: white;
        font-weight: normal;
    }
    .searchResult .scrollable li a:hover {
        color: #bbdb75;
    }
    #feedback {
        height: 0px;
        width: 80px;
        position: fixed;
        right: 0;
        top: 50%;
        z-index:99;
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
    }
    #feedback a {
        display: block;
        background: #51ac37;
        height: 40px;padding-top:8px;width: 140px;
        text-align: center;color: #ffffff;
        font-size:16px;font-weight: bold !important;text-decoration: none;
        border-top-right-radius: 10px;border-top-left-radius: 10px;
    }
    #feedback a:hover {
        background:#00495d;
    }

    .popupforall {
        padding-right: 0px !important;
        position: absolute;
        top: 35%;
        left: 28%;
        z-index: 1041;
    }

    /*css/angular-validation.css*/
    .validation-error {
        display: block;
        background: #fff4f2;
        color: #e4391f;
        padding: 3px 10px;
    }
    .validation-error p {
        margin: 0;
    }
    .instructor__signUP .form-group label span {
        color: red;
    }
    .form-control.has-error {
        border-color: #ffd2ca;
    }
    .form-control.has-error:focus {
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(255, 91, 62, 0.6)
    }
    .form-control + .validation-error {
        display: none;
    }
    .form-control.has-error + .validation-error {
        display: block;
    }
    .form-control.has-error + .validation-error p {
        margin: 0;
        font-size:12px;font-weight:500;

    }
    .validation-align .form-control.has-error + .validation-error p {
        position: static;
    }
    .form-auth-style .form-control.has-error + .validation-error p {
        bottom: -14px;
        left: 0;
    }

    /*##################################################*/
    /*######### INDEX BLADE INLINE STYLES #############*/
    /*##################################################*/

    .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl,
    .col-xl-auto {
        position: relative;padding-right: 15px;padding-left: 15px;
    }
    .partner .item img {
        max-width: 350px !important;
        display: inherit;
    }
    .pro_button{
        background-color: #dff0d8;font-weight: bold;font-size: 20px;padding: 12px 56px;border: 2px solid #059db9 !important;min-width:280px;box-shadow: 0 0 17px 8px #b2d880;border-radius: 50px;color: #000000;
    }
    .pro_button:hover{
        color: yellow;
        background-color: black;
    }
    .btn-dark.btn-theme-colored2 {
        margin-top: 25px;
    }

    /*.message-popup {
        display: none;
        position: absolute;
        z-index: 999;
        background: #ccc;
        color: #fff;
        padding: 15px 20px;
        font-size: 18px;
        margin: 2%;
        box-shadow: 0px 2px 4px 1px #000;
        width: 400px;
        text-align: center;
        left: 40%;
    }
    .message-popup .close-me {
        padding: 10px 15px;
        background: #18aace;
        color: #fff;
        cursor: pointer;
        box-shadow: initial;
    }*/
    #AlertModel .btn-primary, .proceed_btn{
        background-color: #2098d1;
        border-color: #2098d1;
        color: #fff;
    }

    .modal-dialog-centered {
        top: 20%;
        transform: translate(0, 50%) !important;
        -ms-transform: translate(0, 50%) !important; /* IE 9 */
        -webkit-transform: translate(0, 50%) !important; /* Safari and Chrome */
    }
    .search-container .newsletter-form{
        background-color: rgb(0 0 0 / 65%);
        background-color: rgba(0, 0, 0, 0.65);
        padding: 24px 24px 18px 24px;border-radius: 8px;
        margin:0 !important;
    }

    @media (min-width: 1441px) {
        .col-xl-auto {
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: auto;
            max-width: 100%;
        }
        .col-xl-1 {
            -ms-flex: 0 0 8.333333%;
            flex: 0 0 8.333333%;
            max-width: 8.333333%;
        }
        .col-xl-2 {
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }
        .col-xl-3 {
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%;
        }
        .col-xl-4 {
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
        .col-xl-5 {
            -ms-flex: 0 0 41.666667%;
            flex: 0 0 41.666667%;
            max-width: 41.666667%;
        }
        .col-xl-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
        }
        .col-xl-7 {
            -ms-flex: 0 0 58.333333%;
            flex: 0 0 58.333333%;
            max-width: 58.333333%;
        }
        .col-xl-8 {
            -ms-flex: 0 0 66.666667%;
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }
        .col-xl-9 {
            -ms-flex: 0 0 75%;
            flex: 0 0 75%;
            max-width: 75%;
        }
        .col-xl-10 {
            -ms-flex: 0 0 83.333333%;
            flex: 0 0 83.333333%;
            max-width: 83.333333%;
        }
        .col-xl-11 {
            -ms-flex: 0 0 91.666667%;
            flex: 0 0 91.666667%;
            max-width: 91.666667%;
        }
        .col-xl-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }
    }




    div#quick-linksMain {
        max-width: 615px;
    }
    .big {
        font-size: 20px;
        margin: 0.85em 0 1.3em;
    }


    .fw-700, .bolder {
        font-weight: 700;
        font-size: 20px;
    }
    .toast-top-right {
        top: 120px !important;
        right: 12px;
    }
    .error {
        color: red;
    }

    @import url(//fonts.googleapis.com/css?family=Montserrat:300,400,500);
    .testimonial1 {
        font-family: "Montserrat", sans-serif;
        color: #8d97ad;
        font-weight: 300;
    }

    .testimonial1 h1,
    .testimonial1 h2,
    .testimonial1 h3,
    .testimonial1 h4,
    .testimonial1 h5,
    .testimonial1 h6 {
        color: #3e4555;
    }

    .testimonial1 .bg-light {
        background-color: #f4f8fa !important;
    }

    .testimonial1 .subtitle {
        color: #8d97ad;
        line-height: 24px;
    }

    .testimonial1 .testi1 .card-body {
        padding: 35px;
    }

    .testimonial1 .testi1 .thumb {
        padding: 10px 20px 10px;
        padding-left: 90px;
        margin-left: -35px;
    }

    .testimonial1 .testi1 .thumb .thumb-img {
        width: 60px;
        left: 20px;
        top: -10px;
    }

    .testimonial1 .testi1 h5 {
        line-height: 24px;
        font-size: 14px;
        font-weight: normal !important;
    }

    .testimonial1 .testi1 .devider {
        height: 1px;
        background: rgba(120, 130, 140, 0.13);
        width: 100px;
    }

    .testimonial1 .bg-success-gradiant {
        background: #2cdd9b;
        background: -webkit-linear-gradient(legacy-direction(to right), #2cdd9b 0%, #1dc8cc 100%);
        background: -webkit-gradient(linear, left top, right top, from(#2cdd9b), to(#1dc8cc));
        background: -webkit-linear-gradient(left, #2cdd9b 0%, #1dc8cc 100%);
        background: -o-linear-gradient(left, #2cdd9b 0%, #1dc8cc 100%);
        background: linear-gradient(to right, #2cdd9b 0%, #1dc8cc 100%);
    }

    .testimonial1 .card.card-shadow {
        -webkit-box-shadow: 0px 0px 30px rgba(115, 128, 157, 0.1);
        box-shadow: 0px 0px 30px rgba(115, 128, 157, 0.1);
    }

    .testimonial1 .owl-theme .owl-dots .owl-dot.active span,
    .testimonial1 .owl-theme .owl-dots .owl-dot:hover span {
        background: #316ce8;
    }

    @media only screen and (min-width: 992px) {

        .newsletter-form{
            margin: unset !important;
            max-width: 615px !important;
        }

        .search-container .newsletter-form {
            padding: 12px 12px 12px 12px !important;
        }
    }

    @media only screen and (min-width: 769px) and (max-width: 991px){
        .search-container .newsletter-form {
            max-width:560px;
            padding: 12px 12px 12px 12px !important;
            margin-left: 0px;
        }
    }

    /*@media screen and (max-width: 768px) and (min-width: 481px){
        .search-container .newsletter-form {
            max-width: 430px;
            margin-left: 0px;
    }

    @media screen and (max-width: 480px) and (min-width: 320px){
        .search-container .newsletter-form {
            max-width: 325px !important;
            margin-left: 0px;
    }*/

    @media only screen and (min-width: 1599px) {
        .why-icon{
            width: 80px !important;
            margin-left: 80px;
        }


    }


    @media only screen and (max-width: 1598px) {
        .why-icon{
            width: 80px !important;
            margin-left: 55px;
        }
    }

    /*--------------------------------------------------------------
# Counts
--------------------------------------------------------------*/
    section#counts .container{position:relative;z-index:1;}
    .counts {padding-top: 0;}
    .counts .counters i {display:block;    color: rgb(81, 172, 55) !important;}
    .counts .counters span {font-size: 42px;display: block;font-weight: 700;}
    .counts .counters h5 {
        padding: 0;margin: 0 0 5px 0;font-family: "Raleway", sans-serif;font-size:18px;font-weight: 600;
    }


    /*
    .card-title-first{
        text-align: left;
        padding-left: 15px;
        margin-bottom: 0px;
        color: #444;
        margin-top: 0px;
        font-size: 17px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .card-title-second{
        text-align: left;
        padding-left: 15px;
        margin-top: -7px;
        color: #444;
        font-size: 18px;
        font-weight: 700;
        text-transform: uppercase;
        line-height: 1.8;
        margin-bottom: 0px;
    }

    .card-image{
        box-shadow: 0 0 15px 1px rgba(0,0,0,0.15);
        background: #fff;
        border-radius: 5px;
        padding: 15px 0px;
    }
    */


    .icon-box-home{
        font-size: 28px;
        color: rgb(81, 172, 55)  !important;
    }

    .pt-95 {padding-top: 95px;}
    .populr_courses{background-color:#f3f8f9;}
    .populr_courses:before, .populr_courses:after{
        content:'';
        background-size: cover;background-repeat: no-repeat;width:100%;float:left;
    }
    .populr_courses:before{
        background-image:url(<?=UPLOADS.'images/wave_top.jpg'?>);height:116px;
    }
    .populr_courses:after{
        background-image:url(<?=UPLOADS.'images/wave_bottom.jpg'?>);height:144px;
    }

    .populr_courses .nav-tabs > li.active a,
    .populr_courses .nav-tabs > li.active a:hover{
        color: #ffffff !important;
        background-color: #2098d1 !important;
    }


    .owl-carousel .owl-item img {
        display: inline-block;
        width:100%;
        /*max-width: 335px;*/
    }
    /*--------------------------------------------------------------
    # Services
    --------------------------------------------------------------*/
    .services .icon-box {
        text-align: center;
        padding: 20px 20px 20px 20px;
        transition: all ease-in-out 0.3s;
        background: #fff;
        box-shadow: 0px 0 35px 0 rgba(0, 0, 0, 0.08);
    }

    .services .icon-box .icon {
        margin: 0 auto;
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: ease-in-out 0.3s;
        position: relative;
    }

    .services .icon-box .icon i {
        font-size: 36px;
        transition: 0.5s;
        position: relative;
    }

    .services .icon-box .icon svg {
        position: absolute;
        top: 0;
        left: 0;
    }

    .services .icon-box .icon svg path {
        transition: 0.5s;
        fill: #f5f5f5;
    }

    .services .icon-box h4 {
        font-weight: 600;
        margin: 10px 0 15px 0;
        font-size: 22px;
    }

    .services .icon-box h4 a {
        color: #434175;
        transition: ease-in-out 0.3s;
    }

    .services .icon-box p {
        line-height: 24px;
        font-size: 14px;
        margin-bottom: 0;
    }

    .services .icon-box:hover {
        border-color: #fff;
        box-shadow: 0px 0 35px 0 rgba(0, 0, 0, 0.08);
    }

    .services .iconbox-blue i {
        color: #47aeff;
    }

    .services .iconbox-blue:hover .icon i {
        color: #fff;
    }

    .services .iconbox-blue:hover .icon path {
        fill: #47aeff;
    }

    .services .iconbox-orange i {
        color: #ffa76e;
    }

    .services .iconbox-orange:hover .icon i {
        color: #fff;
    }

    .services .iconbox-orange:hover .icon path {
        fill: #ffa76e;
    }

    .services .iconbox-pink i {
        color: #e80368;
    }

    .services .iconbox-pink:hover .icon i {
        color: #fff;
    }

    .services .iconbox-pink:hover .icon path {
        fill: #e80368;
    }

    .services .iconbox-teal i {
        color: #11dbcf;
    }

    .services .iconbox-teal:hover .icon i {
        color: #fff;
    }

    .services .iconbox-teal:hover .icon path {
        fill: #11dbcf;
    }

    .feature-1 .wrap-icon.icon-1 {
        background: rgb(81, 172, 55)  !important;
    }
    .la-umbrella:before {
        content: "\f0e9";
    }
    .feature-1 .wrap-icon {
        margin: 0 auto;
        height: 40px;
        width: 40px;
        border-radius: 50%;
        position: relative;
        box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.2);
    }

    .feature-1 .wrap-icon .icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 1.5rem;
    }


    .single-course-thumb:hover .overlay-shade{
        background-color: rgb(81, 172, 55) !important;
    }

    .single-course-thumb .overlay-shade{
        background-color: rgb(0 0 0 / 57%);
    }

    .nav-tabs > li > a:hover {
        color: #a0ce4e !important;;
        border-bottom: 1px solid rgb(81, 172, 55) !important;;
    }


    .d-flex{
        /*display:flex;*/
        /*flex-wrap: wrap;*/
    }

    .home-hero-gradient-new {
        width:100%;
        background-image: -webkit-gradient(linear,left top,right top,from(#156e9b),color-stop(43%,#21758e),to(#799211));
        background-image: linear-gradient(to right,#156e9b,#21758e 43%,#799211);
    }

    .cards__Links .gradient-card{
        border-radius:4px;padding:15px !important;
        margin-top:25px; position:relative;border:rgba(255, 255, 255, 0.65) solid 1px;
    }
    .cards__Links .gradient-card .card-title{margin:0; padding:0;color:#fff;}
    .cards__Links .gradient-card .card-title.card-title-first{font-size:1.3rem;text-transform:uppercase;}
    .cards__Links .gradient-card .card-title.card-title-second{font-size:.95rem}
    .cards__Links .gradient-card .icon{
        height: 40px;width: 40px;border-radius: 50%;line-height:40px;
        background-color:rgba(255, 255, 255, 0.20); color:rgba(255, 255, 255, 0.95) !important; font-size:1.5rem;
        position: absolute;top: 50%;right:5%;transform: translate(5%, -50%);text-align: center;
        -webkit-transition: all 0.4s ease;
    }
    .cards__Links .gradient-card:hover {
        background: #189fc2;color: #ffffff;border-color: #189fc2;
    }
    .cards__Links .gradient-card:hover .card-title.card-title-first, .cards__Links .gradient-card:hover .card-title.card-title-second {
        color:#ffffff;
    }
    .cards__Links .gradient-card:hover .icon{
        background-color:rgba(255, 255, 255, 0.85); color: rgba(62, 197, 232, 0.95) !important;
        right:5%;transform: translate(5%, -50%);
    }

    /*--------Marketing Stripe----------*/
    .registration-area {position: relative;z-index: 1;}
    .registration-area:before, .registration-area:after{
        position: absolute;content: '';width: 50%;height: 100%;top: 0;bottom: 0;z-index: -1; background-repeat:no-repeat;
    }

    .registration-area .row{background-color:#f5f5f5;margin:0;}
    .registration-area .row .col-md-6{padding:0;}
    .registration-area img{min-height:570px;}


    {{--.registration-area:before {--}}
    {{--    background-image: url(<?=(file_exists(getSettings('lms')->markettingbanner . App\Http\Controllers\PromoBannerController::getBanner()->content_area)) ? getSettings('lms')->markettingbanner . App\Http\Controllers\PromoBannerController::getBanner()->content_area : UPLOADS.'images/new-marketing-image.webp'?>);--}}
    {{--    background-size: cover;left:0;--}}
    {{--}--}}
    {{--.registration-area:after {--}}
    {{--    background-image: url(<?=UPLOADS.'images/information-management.jpg'?>);--}}
    {{--    background-color:#000;--}}
    {{--    background-size: cover; right:0;--}}
    {{--}--}}

    /*.registration-area .col-md-6.countdown{padding-left:90px !important; padding-right:90px !important;}*/
    .registration-area .col-md-6.countdown{padding-left:30px;}
    .registration-area .countdown h2 {
        margin-bottom: 0;
        margin-top: 0;
        color: #000;
        border-radius: 50px;
        padding: 2px;
        box-shadow: 0 0 16px 4px black;
        margin-right: 25px;
    }
    .registration-area .countdown h5 {
        color: #3dc6e4;
        text-transform: uppercase;
        margin-top: 27px;
    }
    .registration-area .countdown ul {overflow: hidden;text-align:left;}
    .registration-area .counter-class {margin-top: 30px;}
    .registration-area .item-list{display:inline-block;width:100%;}
    .countdown .counter-item {
        display: inline-block;font-family: 'Poppins', sans-serif; width:25%;float:left;
        color: #000;font-size: 16px;line-height: 1;font-weight: 500;text-transform: uppercase;text-align: center;
    }
    .countdown .counter-item span {
        display: block;
        font-size: 30px;
        margin: 0 auto 20px;
        font-weight: 600;
        height: 100px;
        width: 100px;
        line-height: 105px;
        text-align: center;
        background: rgba(0, 0, 0, 0.03);
        border-radius: 50%;
        border: 1px dashed rgb(64 192 220);
        box-shadow: 0 0 18px 3px #b0d887;
    }
    .registration-area .countdown ul {
        overflow: hidden;
    }

    .registration-area .countdown ul > li {
        float: left;
        width: 50%;
        color: #000;
        padding-left: 25px;
        position: relative;
        z-index: 1;
        margin-top: 10px;
        font-size: 20px;
        font-weight: 600;
    }

    .registration-area .countdown ul > li::after {
        position: absolute;
        left: 0;
        top: 0;
        font-family: 'Font Awesome 5 Free';
        content: "\f058";
        font-weight: 900;
        font-size: 20px;
        color: #51ac37;
    }


    .testi-item {
        /*background-color: #f3f8f9;border-radius: 10px;padding:30px 40px;*/display:inline-block;padding:0 95px;
    }
    .testi-item .user-info img, .testi-item .user-info .name__info {
        width: 84px;height:84px;object-fit:cover;margin-bottom: 15px;border-radius:100%; overflow:hidden;background-color:#00a4ef;font-size:24px;text-transform:uppercase;
    }
    .testi-item .user-info{
        padding-left:60px; padding-top:10px;
    }
    .testi-item .user-info .name {
        font-size:16px;font-weight:600;margin-bottom: 5px;
    }
    .testi-item .user-info .designation {
        font-size: 14px;color: #555555;font-weight: 500;
    }
    .testi-item .desc {
        padding-left:60px;font-size: 16px;font-style: italic;
    }

    .no-gutter {
        margin-left: 0;margin-right: 0;
    }
    .no-gutter [class*="col-"] {
        padding-left: 0;padding-right: 0;
    }
    .y-middle {
        display: -ms-flexbox;display: -webkit-flex;display: flex; -ms-flex-wrap: wrap;-webkit-flex-wrap: wrap;flex-wrap: wrap;
        -ms-flex-align: center;-webkit-align-items: center;align-items: center;
    }

    .blog-item {
        background: #fff;transition: all 500ms ease;border-radius: 5px;padding:5px;
    }
    .blog-item:hover {
        transform: translateY(-10px);
    }

    .become__business .container{padding-top:0;padding-bottom:0;}
    .become__business .container .row, .become__business .container .row .col-md-6{margin:0 !important;padding:0 !important;background-color:#f9f8f8;}
    .become__business img{width:100%;height:400px;object-fit:cover;}
    .become__business .content__Info {padding:25px 60px;}




    /*----------------------------------*/
    /*##################################################*/
    /*######### COURSE DETAIL PAGE INLINE STYLES #############*/
    /*##################################################*/

    .course-curriculum-box .panel-group .panel-heading .panel-title a{

        color: #131313;
        font-size: 15px;
    }
    .course-curriculum-box .anidi_services ul li a{
        padding: 0px 1px;
        cursor: default;
    }
    .course-curriculum-box .panel-group .panel-heading+.panel-collapse>.list-group, .panel-group .panel-heading+.panel-collapse>.panel-body{
        border: 0px;
    }
    .course-curriculum-box .anidi_services ul li a span.text, .anidi_services ul li a span.icon {
        padding: 8px !important;
        display: block;
    }
    .course-curriculum-box .panel-body {
        padding:0; padding-right:0;
    }
    .course-curriculum-box .panel-body span {
        font-size: 14px !important;
        font-weight: 300 !important;
        color: #000000 !important;
    }
    .course-curriculum-box .panel-body span.text-right {float:right;padding-top:3px;text-align:left;}
    .course-curriculum-box .panel-body span.text-right i {padding-right:5px;}
    /*.course-curriculum-box .panel-body span.text-right span {width:auto !important;}*/
    .why-join-box{padding:20px 15px;margin-top:10px;border:1px solid rgba(0, 119, 145, 0.27);background-color: rgba(32, 152, 209, 0.04);min-height:132px;max-height:132px;border-radius:4px;overflow:hidden;}
    .why-join-box:hover{border:1px solid #b6d433;background-color:#f7fae9;}
    .why-join-box img{margin-bottom:10px;}
    .why-join-box p{margin-bottom:0;font-weight:600;line-height:22px;text-align:center !important;}

    .n_li_wrap {
        -ms-flex-align: center!important;align-items: center!important;display: -ms-flexbox;
        display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-bottom: 11px;
    }
    .n_li_wrap picture{
        background-image: url('<?=UPLOADS.'images/icon-Sprite2.svg'?>');
        width: 70px;height: 70px;
    }
    .why-join-box picture {
        background-image: url('<?=UPLOADS.'images/icon-Sprite2.svg'?>');
        width: 70px;height: 50px;display: inline-block;margin-top:-12px;
    }
    .n_key_t {padding-left: 10px;font-weight: 600;}
    .n_key_user {background-position: -15px -30px;}
    .n_key_video {background-position: -193px -30px;}
    .n_key_proj {background-position: -195px -30px;}
    .n_key_time {background-position: -283px -30px;}
    .n_key_life {background-position: center center;background-image: url('<?=UPLOADS.'images/student-card.svg'?>') !important;background-size: 55%;background-repeat: no-repeat;}
    .n_key_job {background-position: -465px -30px;}

    .awarding-logo{border-top: rgba(0, 0, 0, 0.14) solid 1px;padding-top: 5px;}

    .certificate_new_bx, .cards__Links .gradient-card{
        width:100%;display:inline-block;margin-bottom:15px; padding:15px 0 25px;
    }
    .detail_tabs .nav-tabs > li > a {

        font-weight: 600;
        color: #252525;

        background-color: #2098d124;
    }
    .certificate_new_bx h2.title{font-size:1.75rem;font-weight:600;}
    .certificate_new_bx p.text-white{font-size:.80rem;}
    .main-certi-sec {display: inline-block;width:100%;cursor: pointer;margin:10px auto;}
    .img-back{height: auto;position: relative;text-align: center;width: 100%;}
    .maincertiback {width:auto;}
    .usernamesec {left: 0;margin: 35px auto;position: absolute;right: 0;text-align: center;top: 75px;}
    .usernamesec .username {color: #a0ce4e;font-size: 28.5px;font-weight: normal;}
    .coursenamesec {left: 0;margin: 20px auto;position: absolute;right: 0;text-align: center;top: 173px;}
    .coursenamesec .coursename {color: #444545;font-size: 18px;font-weight: 400;}
    .gradesec {left: 0;margin: 5px auto;position: absolute;right: 0;text-align: center;top: 218px;}
    .gradesec .gradeval {color: #444545;font-size: 12px;font-weight: 300;}
    .certi-id-date-sec {left: 0;margin: 5px auto;position: absolute;right: 0;text-align: center;top: 270px;}
    .cert-id {color: #444545;font-size: 12px;font-weight: 500;left: 0;position: absolute;right: 227px;}
    .cert-date {color: #444545;font-size: 12px;font-weight: 500;left: 39px;position: absolute;right: 0;}
    .dir-sign {color: #444545;font-size: 12px;font-weight: 500;left: 345px;position: absolute;right: 0;}
    .verifylinksec {left: 0;margin: 5px auto;position: absolute;right: 0;text-align: center;top: 297px;}
    .verifylinksec .verifytxt {color: #414042;font-size: 8px;font-weight: 500;}
    .main-certi-sec .click_to_zoom {
        width: 32px;height: 32px;line-height: 32px;font-size: 16px;font-weight: bold;color: #fff;
        text-decoration: underline !important;margin-top: 0;position: absolute;right:46%;bottom:0;background-color: rgb(0 0 0 / 22%);z-index: 1;
    }

    .certi_btn_cta{text-align:center;}
    .certi_btn_cta .btn {padding: 12px 22px;line-height: 1.38;margin: 0 5px;}
    .certi_btn_cta .btn:first-child {background-color:transparent !important; border-color:#fff !important;}



    .id_img{margin:15px auto;}
    .id_img img {
        width: 100%;
        border-radius: 22px;
        box-shadow: 0px 2px 5px 5px rgba(62, 197, 232, 0.10);
        border: 1px solid rgba(62, 197, 232, 0.39);
    }
    .fade.show {opacity: 1;}
    .modal-backdrop.show {opacity: .6;}
    .modal.show .modal-dialog {
        -webkit-transform: translate(0,0) !important;
        transform: translate(0,0) !important;
    }
    .layer-overlay.overlay-theme-colored-9::before {
        background: linear-gradient(to right, #063248, #156e9b);
    }

    .courses-breadcumb a{
        font-weight: bold !important;
    }

    .breadcrumb > li + li::before{
        font-weight: bold;
    }
    .strip-colour {
        color: #cccccc;
    }

    /*.lead-share-cta a {background-color: rgb(81, 172, 55) !important;}*/

    .carousel-inner>.item>a>img,
    .carousel-inner>.item>img,
    .img-responsive,
    .thumbnail a>img,
    .thumbnail>img {
        display: block;
        max-width: 100%;
        height: auto;
        width: 100% !important;
        object-fit: cover;
        object-position: 60% 19%;
    }
    .course-box .course-image img {
        height: 175px;
        object-fit: cover;
        object-position: 50% 30%;
    }
    .lead-share-cta {
        display: inline-block;
    }

    .share-and-gift {
        display: flex;
    }

    .share-and-gift>* {
        margin-right: .8rem;
    }

    .paid-course-landing-page__container .dark-background-inner-text-container .udlite-btn {
        border-color: #fff;
        color: #fff;
    }


    .udlite-btn-secondary,
    .udlite-btn-secondary.udlite-btn-disabled {
        color: #ffffff;
        background-color: transparent;
        border: 1px solid #2896a9;
    }

    .udlite-btn-small {
        height: auto;
    }

    .udlite-btn {
        position: relative;
        align-items: center;
        border-radius: 4px;
        border: 1px solid white;
        cursor: pointer;
        display: inline-flex;
        padding: 10px 15px;
        justify-content: center;
        user-select: none;
        vertical-align: bottom;
        white-space: nowrap;
    }

    .signuperrorp {
        margin: 0;
        font-size: 12px;
        font-weight: 500;
        color: red;
    }

    .valmsg {
        display: none;
    }

    .udlite-heading-sm {
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: -0.02rem;
        font-size: 1.4rem;
    }

    #load {
        width:100%;text-align:center;display:inline-block;
    }

    :root {
        --avatar-size: 4rem;
        /* change this value anything, e.g., 100px, 10rem, etc. */
    }

    .circle {
        /*background-color: #ccc;*/
        border-radius: 50%;
        height: var(--avatar-size);
        text-align: center;
        width: var(--avatar-size);
        margin-right: 18px;
    }
    /* IE 10+ */
    @media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
        .circle {
            /*background-color: #ccc;*/
            border-radius: 50%;
            height: 64px;
            text-align: center;
            width: 64px;
            margin-right: 18px;
        }
        .initials {
            font-size: 1.8rem; /* 50% of parent */
            line-height: 1.5;
            position: relative;
            color: white;
            font-weight: 600;
            top: 0.7rem; /* 25% of parent */
        }
    }

    .initials {
        font-size: calc(var(--avatar-size) / 3); /* 50% of parent */
        line-height: 1.5;
        position: relative;
        color: white;
        font-weight: 600;
        top: calc(var(--avatar-size) / 4); /* 25% of parent */
    }



    /*.avatar-circle i {
        text-align: center;
        border-radius: 50%;
        line-height: 70px;
        width:75px;
        height:75px;
        color: white;
        font-size: 16px;
        font-weight: 700;
        left: 0;
        top: 0;
    }


    i {
        position: absolute;
    }


    i.one {
        top:-15px;
    }*/

    .social-icon ul li {
        display: contents;
        fload: left;

    }

    .social-icon ul li a {
        color: #156e9b;
        padding: 20px 20px;
        font-size: 30px;
    }

    .share-and-gift a:hover {
        color: #fff;
    }

    .share-and-gift button:hover {
        color: #fff;
    }

    .wishlist_button i.fa-heart {
        color: #fff;
    }
    .billing-details input.error,
    .billing-details select.error,
    .billing-details textarea.error {
        outline: none;
        border-color: red !important;
        border-width: 1px;
        border-style: solid;
    }


    .billing-details input:valid {
        border-style: auto;
    }
    .billing-details select:valid {
        border-style: auto;
    }
    .billing-details textarea:valid {
        border-style: auto;
    }

    .error {
        /*border: 2px solid #9cc63d !important;
        color: #9cc63d !important;*/
    }

    .errorimp {
        border: 2px solid #9e0505 !important;
        /*color: #9cc63d !important;*/
    }

    /*------------------------------------------------
    Course Details table
    --------------------------------------------------*/
    /*    .detail_tabs .nav-tabs > li > a {*/
    /*    font-size: 14px;*/
    /*    text-transform: capitalize; color:#000;*/
    /*    font-weight:600;text-align: center;padding:12px 10px;background-color:#e7f4fa;*/
    /*    height: 100%;*/
    /*}*/
    /*.detail_tabs .nav-tabs.nav-justified>.active>a, .nav-tabs.nav-justified>.active>a:focus, .nav-tabs.nav-justified>.active>a:hover {*/
    /*    border: 0px solid #ddd;*/
    /*    color: #fff;*/
    /*}*/
    /*------------------------------------------------ Curruculum --------------------------------------------------*/

    .anidi_services ul li a span.text, .anidi_services ul li a span.icon{
        padding: 10px;
    }
    .row.row-sm-padding{margin-left:-5px;margin-right:-5px;}
    .row-sm-padding > [class*="col-"] { padding-left: 5px !important; padding-right: 5px !important; }
    .course-sidebar-text-box .buy-btns .btn-buy-now{font-size:18px;font-weight:700;
        border: 1px solid #f7951e !important;background: linear-gradient(97deg,#f76b1c,#f5a623);
    }

    .course-sidebar-text-box .buy-btns .btn-already-buy{
        font-size: 18px;
        font-weight: 700;
        border: 1px solid #009688 !important;
        background: linear-gradient(97deg,#009688,#8bc34a);
    }

    /*section > .container, section > .container-fluid{*/
    /*    padding-top:0 !important; padding-bottom:0 !important;*/
    /*}*/

    .row.row-md-padding{margin-left:-10px;margin-right:-10px;}
    .row-md-padding > [class*="col-"] { padding-left:10px !important; padding-right:10px !important; }

    .fee_box {
        background: #ffffff;box-shadow: 5px 10px 30px 0 rgba(26,96,204,0.12);border-radius: 4px;padding: 25px 40px;margin-top:15px;
    }
    .fee_box .title {
        font-size: 30px;font-weight: 600;color: #000000;
    }
    .fee_box .emi_info {width: 210px;border-radius: 4px;border: solid 1px #e8effd;background-color: #f6f9ff;padding: 9px 11px;margin: 15px 0;}
    .fee_box .emi_info span {
        font-size: 14px;color: #4a4a4a;display: inline-block;width: 100%;
    }
    .fee_box .emi_info p {
        font-size: 22px;font-weight: 600;margin: 0;color: #000000;
    }
    .fee_box .total_title {
        font-size: 14px;color: #4a4a4a;display: inline-block;width: 100%;
    }
    .fee_box .totla_price {
        font-size: 18px;color: #000000;display: inline-block;width: 100%;
    }

    .detail_tabs .nav-tabs > li.active a, .detail_tabs .nav-tabs > li.active a:hover, .detail_tabs .nav-tabs > li.active a:focus {
        color: #fff;
        background-color: #2098d1;
    }
    #desktop_tabs.detail_tabs .nav-tabs > li a:hover{
        color: #fff !important;
    }

    /* .reviewer-details .reviewer-img{
         height:75px;width:75px;line-height:75px;text-align:center;overflow:hidden;margin-right:15px;
         border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;
     }
     .reviewer-details .reviewer-img span.txt{
         font-size:20px;font-weight:800;color:#fff;display:inline-block; width:100%;
     }*/
    .student-feedback-box .reviews .reviewer-details .review-time .time {
        font-size: 12px;
    }
    .student-feedback-box .reviews .reviewer-details .reviewer-name{
        font-weight: 600;font-size: 15px;padding:2px 0;
    }


    #myModalRequest .modal-dialog {width:870px;}
    .enquiry__from{
        background-image:url(<?=UPLOADS.'images/enquiry_img.jpg'?>);background-size:cover;background-repeat:no-repeat;
        display: -webkit-box; padding:0 !important;
        display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;overflow:hidden;
    }
    .enquiry__from button.close, #forgetPasswordModal button.close{
        position:absolute;top:17px;right: 0px;font-size:2rem; background: none !important;z-index:99;
    }
    .enquiry__from button.close:hover, #forgetPasswordModal button.close:hover {
        color:#000 !important;
    }
    .w3l_form{
        padding: 0;flex-basis:45%;-webkit-flex-basis: 45%;
    }
    .w3_info {
        flex-basis: 55%;
        -webkit-flex-basis: 55%;padding:2em;box-sizing: border-box;background-color: #fff;
    }
    .w3_info .modal-title, #forgetPasswordModal .modal-title{
        color:#284358;text-transform:uppercase;font-size:28px;font-weight:700;margin-bottom:8px;
    }

    .input-effect{position:relative;z-index:5;}
    .effect-20{border: 1px solid #ebebeb; transition: 0.4s; background: transparent;}

    .effect-20 ~ .focus-border:before,
    .effect-20 ~ .focus-border:after{content: ""; position: absolute; top: 0; left: 0; width: 0; height: 2px; background-color: #284358; transition: 0.3s;}
    .effect-20 ~ .focus-border:after{top: auto; bottom: 0; left: auto; right: 0;}
    .effect-20 ~ .focus-border i:before,
    .effect-20 ~ .focus-border i:after{content: ""; position: absolute; top: 0; left: 0; width: 2px; height: 0; background-color: #284358; transition: 0.4s;}
    .effect-20 ~ .focus-border i:after{left: auto; right: 0; top: auto; bottom: 0;}
    .effect-20:focus ~ .focus-border:before,
    .effect-20:focus ~ .focus-border:after,
    .has-content.effect-20 ~ .focus-border:before,
    .has-content.effect-20 ~ .focus-border:after{width: 100%; transition: 0.3s;}
    .effect-20:focus ~ .focus-border i:before,
    .effect-20:focus ~ .focus-border i:after,
    .has-content.effect-20 ~ .focus-border i:before,
    .has-content.effect-20 ~ .focus-border i:after{height: 100%; transition: 0.4s;}

    .effect-20 ~ label{position: absolute; left: 14px; width: 100%; top: 10px; color: #aaa; transition: 0.3s; z-index: -1; letter-spacing: 0.5px;font-size: 14px;}
    /*.effect-20:focus ~ label,.effect-20:focus + label .has-content.effect-20 ~ label{*/
    /*    top: -9px;left: 10px;font-size: 12px;color: #284358;transition: 0.3s;background-color: #fff;z-index: 1;width: auto;padding: 0 5px;display: inline-block;*/
    /*}*/

    /*.effect-20:focus + label, .effect-20:not(:placeholder-shown) + label {*/
    /*    left:0;width:auto;*/
    /*    transform: translate(0, -2em) scale(.9);*/
    /*}*/
    /*input.effect-20:placeholder-shown + label, textarea.effect-20:placeholder-shown + label {*/
    /*    transform-origin: left bottom;transform: translate(0, 2.425rem) scale(1.4);*/
    /*}*/
    input.effect-20:focus + label, textarea.effect-20:not(:placeholder-shown) + label, textarea.effect-20:focus + label {
        padding:0;transform: translate(0, -22px) scale(1);cursor: pointer;
    }


    /* label{margin-bottom:0; font-size:14px;}
    .form-check-inline label i {padding-right:5px;}
    .form-check-inline input {cursor: pointer;width:18px;height:18px;margin-top:-3px;margin-right:8px;}*/


    .enquiry__from .custom-control {
        position: relative;z-index: 1;display: block;min-height: 1.5rem;padding-left: 1.5rem;
    }

    .enquiry__from .custom-control-inline {
        display: -ms-inline-flexbox;display: inline-flex;margin-right: 1rem;
    }

    .enquiry__from .custom-control-input {
        position: absolute;
        left: 0;z-index: -1;width: 1rem;height: 1.25rem;opacity: 0;
    }

    .custom-control-input:checked~.custom-control-label::before {
        color: #fff;border-color: #284358;background-color: #284358;
    }

    .custom-control-input:focus~.custom-control-label::before {
        box-shadow: 0 0 0 .2rem rgba(0,123,255,.25);
    }

    .custom-control-input:focus:not(:checked)~.custom-control-label::before {
        border-color: #80bdff;
    }

    .custom-control-input:not(:disabled):active~.custom-control-label::before {
        color: #fff;
        background-color: #b3d7ff;
        border-color: #b3d7ff;
    }

    .custom-control-input:disabled~.custom-control-label,.custom-control-input[disabled]~.custom-control-label {
        color: #6c757d;
    }

    .custom-control-input:disabled~.custom-control-label::before,.custom-control-input[disabled]~.custom-control-label::before {
        background-color: #e9ecef;
    }

    .enquiry__from .form-check label{font-size:14px;}
    .enquiry__from .form-check label a{text-decoration:underline;color:#6c757d;}

    .custom-control-label {
        position: relative;
        margin-bottom: 0;
        vertical-align: top;
    }

    .custom-control-label::before {
        position: absolute;
        top: .25rem;
        left: -1.5rem;
        display: block;
        width: 1rem;
        height: 1rem;
        pointer-events: none;
        content: "";
        background-color: #fff;
        border: #adb5bd solid 1px;
    }

    .custom-control-label::after {
        position: absolute;
        top: .25rem;
        left: -1.5rem;
        display: block;
        width: 1rem;
        height: 1rem;
        content: "";
        background: no-repeat 50%/50% 50%;
    }

    .custom-checkbox .custom-control-label::before {
        border-radius: .25rem;
    }

    .custom-checkbox .custom-control-input:checked~.custom-control-label::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26l2.974 2.99L8 2.193z'/%3e%3c/svg%3e");
    }

    .custom-checkbox .custom-control-input:indeterminate~.custom-control-label::before {
        border-color: #007bff;
        background-color: #007bff;
    }

    .custom-checkbox .custom-control-input:indeterminate~.custom-control-label::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4' viewBox='0 0 4 4'%3e%3cpath stroke='%23fff' d='M0 2h4'/%3e%3c/svg%3e");
    }

    .custom-checkbox .custom-control-input:disabled:checked~.custom-control-label::before {
        background-color: rgba(0,123,255,.5);
    }

    .custom-checkbox .custom-control-input:disabled:indeterminate~.custom-control-label::before {
        background-color: rgba(0,123,255,.5);
    }

    .custom-radio .custom-control-label::before {
        border-radius: 50%;
    }

    .custom-radio .custom-control-input:checked~.custom-control-label::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
    }

    .custom-radio .custom-control-input:disabled:checked~.custom-control-label::before {
        background-color: rgba(0,123,255,.5);
    }

    /*##################################################*/
    /*######### CATEGORY BLADE INLINE STYLES #############*/
    /*##################################################*/


    .layer-overlay::before {
        background: linear-gradient(to right, #063248, #156e9b) !important;
    }

    .inner-header h2 {
        color: #fff !important;
    }

    .text-colored2 {
        color: rgb(81, 172, 55) !important;
    }

    .inner-header h2,
    #Title h2,
    .list-group-item,
    .panel-heading h2,
    .panel-body span {
        font-family: 'Poppins', sans-serif !important;
    }

    .catboxes:after {
        font-family: "Font Awesome 5 Free";
        content: "\f138";
        display: inline-block;
        padding-right: 3px;
        vertical-align: middle;
        font-weight: 900;
        float: right;
    }

    .catboxes{
        padding: 10px 10px !important;
        font-size: 14px !important;
    }

    .subcats a:hover{
        transform:scale(1.06);
    }

    .course-box{
        position:relative;
    }
    .course-box .course-details {
        padding:10px !important;
        background-color:#fff;
    }

    .course-box .course-details .title{
        /*height: 60px !important;margin-top:0;*/
    }
    .populr_courses .course-box .course-details .price{
        padding-bottom:0 !important;
    }



    @media screen and (min-width:320px) and (max-width:966px) {
        #myModalRequest .modal-dialog {width: 90%;margin: 30px auto;}
        .w3_info {padding: 1em;}
    }
    @media screen and (min-width:320px) and (max-width:768px) {
        .mobile_div{
            display: block;
        }
        .desk_div{
            display: none;
        }
        #myModalRequest .modal-dialog {width: 90%;}
        .enquiry__from {background-image: none;}
        .w3l_form {display:none;}
        .w3_info {flex-basis:100%;-webkit-flex-basis:100%;}

        .enquiry__from .form-check label{display:inline-block;width:92%;padding-left:6px;}
        .enquiry__from .form-check .form-check-input{float:left;}
    }

    /*common CSS style*/
    .desktop__nav{
        display:-webkit-flex; display:-webkit-box;
        display:-moz-flex; display:-moz-box;
        display:-ms-flexbox; display:flex;
    }
    .desktop__nav .header__btns .dsk_btns, .top-menu-form .input-group{
        display: -webkit-inline-box;display: -moz-inline-box;
        display: -webkit-inline-flex;display: -ms-inline-flexbox;
        display: inline-flex;
    }
    .desktop__nav, .desktop__nav .header__btns .dsk_btns, .cart_added_popup .modal-body div{
        justify-content: center; -webkit-justify-content: center; -webkit-box-pack: center; -ms-flex-pack: center;
        align-items: center; -webkit-align-items: center; -webkit-box-align: center; -ms-flex-align: center;
    }
    .desktop__nav .inline-form.top-menu-form {
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
    }
    /*End common CSS style*/

    /*##################################################*/
    /*######### HEADER BLADE INLINE STYLES #############*/
    /*##################################################*/

    .dt-button-collection .dropdown-menu {
        position:relative !important
    }
    .desktop__nav{
        background-color:#fff;padding:0;
    }
    .desktop__nav .header__logo{
        flex-shrink: 0;
        padding:.5rem 1.2rem .5rem 0; align-items: center;display: flex;
    }
    .desktop__nav .inline-form.top-menu-form {
        margin:0 0 0 8px !important;position:relative;
    }
    .desktop__nav .header__btns{position: relative;}
    .desktop__nav .header__btns .dsk_btns{
        border-radius:3px;  border: none; color:#000; cursor: pointer; padding: 0 .5rem 0 1rem;
        user-select: none;  vertical-align: bottom;  white-space: nowrap; height: 2.5rem; font-size:.95rem !important;
    }
    .desktop__nav .header__btns .dsk_btns a{
        font-weight:400 !important;color:#333;
    }
    .signIn_btns, .signUp_btns{
        margin-left: .8rem; font-size:14px; padding:0 1.1rem !important;  border:#51ac37 solid 1px !important;color:#51ac37;
    }
    .signUp_btns{background-color:#51ac37;color:#fff !important;}
    .crt__btn{padding:.5rem 1rem .5rem .3rem !important; width:2.8rem;}
    .crt__btn .cart_count, .btn_cart .cart_count, .wish__btn .wish_count{
        position: absolute;top:0;right:0px;height:15px;font-size:10px;font-weight:600;padding:2px 4px !important;background-color: #a0ce4e !important;
    }
    .wish__btn .wish_count{top:3px;}
    .crt__btn .cart_count{position: absolute;top:3px;right:12px;}

    .crt__btn:hover, .link__btn:hover, .desktop__nav .header__btns .dsk_btns a:hover{
        color:#51ac37;
    }
    .desktop__nav .top-menu-form .search-box{line-height:normal !important;}
    .desktop__nav .top-menu-form .input-group {width: 100% !important;}
    #search-container-1 {line-height: normal !important;}
    .signUp_btns:hover, .signIn_btns:hover{
        background-color:#51ac37;color:#fff !important;
    }
    .mobile__nav{display:none;}

    .shopping-cart {.desktop__nav .dropdown-menu
    padding: 15px;right: 0;top: 65px;
        box-shadow: 0 4px 16px rgba(20,23,28,.25);
    }

    .desktop__nav .dropdown-menu {
        border-radius:6px;
        box-shadow: 0 0 8px rgba(214, 214, 214, 0.85);list-style: none;
        padding: 0;margin: 0;right: 0;width:300px;border: none;
        transform: translate3d(-223px, 50px, 0px);top:0;left: 0;will-change: transform;
        /* min-height: 200px; */
        /*overflow: scroll;*/
        /*max-height: 450px;*/
        overflow-x: hidden;
        overflow-y: auto;
    }
    .desktop__nav .dropdown-menu .list_cart {
        overflow: scroll;
        max-height: 351px;
        overflow-x: hidden;
        overflow-y: auto;
    }
    .desktop__nav .dropdown-menu a{
        display:inline-block;width:100%;padding:0 1.7rem;
        font-size: 15px;
        text-decoration: none;color: #29303B;font-weight: 400;
        background: #FFF;z-index: 1111111;line-height: 40px;
        border-bottom: 1px solid rgba(215, 215, 215, 0.17);
        -webkit-transition: all .25s ease;-moz-transition: all .25s ease;-ms-transition: all .25s ease;-o-transition: all .25s ease;transition: all .25s ease;
    }
    .desktop__nav .dropdown-menu a i.fa {
        font-size: 15px;color: #A1A7B3;margin-right: 10px;
    }
    .desktop__nav .dropdown-menu a.logout{
        line-height:normal; color:#fff;
        text-align: center;font-weight: bold;padding: 8px;font-size: 15px;border-top: 1px solid transparent;
    }
    .desktop__nav .dropdown-menu-right:before {
        content: "";
        position: absolute;
        width: 0;
        height: 0;
        margin-left: -0.5em;
        right: 0px;
        box-sizing: border-box;
        border: 7px solid black;
        border-color: transparent transparent #FFF #FFF;
        transform-origin: 0 0;
        transform: rotate(135deg);
        box-shadow: -3px 3px 3px -3px rgba(214, 214, 214, 0.78);
    }
    .desktop__nav .dropdown-menu a:hover {
        background-color: #E6E6E6;
    }
    #notificationTitle {
        padding: 14px 10px;font-size: 13px;background-color: #FFF;z-index: 1000;border-bottom: 1px solid #DDD;
    }
    #notificationTitle .dropdown-user-circle, .loginaftr__div .dropdown-user-circle {
        width: 45px;height: 45px;border-radius: 100%;margin-right: 5px;vertical-align: bottom; object-fit: cover;
    }
    #notificationTitle .user-detailss, .loginaftr__div .user-detailss {
        display: inline-block;color: #505763;font-size:14px;font-weight:500;
    }

    @media screen and (min-width:960px) and (max-width:1366px) {
        .desktop__nav .inline-form.top-menu-form {
            /*width:25rem;*/
        }
    }
    @media screen and (min-width:960px) and (max-width:1024px) {
        /*.link__btn {display: none !important;}*/
        .desktop__nav .header__btns:first-child .dsk_btns.link__btn{display: none !important;}
    }
    @media screen and (min-width:320px) and (max-width:966px) {
        .header__logo {
            flex: 1;justify-content: center;display: flex;align-items: center;
        }
        .desktop__nav{display:none !important;}
        .mobile__nav{display:flex;}
        #mobile_courses_menu{display: block !important;}

        .extr_space{
            padding: 70px 0 50px;
            min-height:auto !important;
        }

    }
    /***** Dark overlay *****/
    .overlay {
        display: none; position: fixed; width: 100vw; height:100%;top:0;background: rgba(51, 51, 51, 0.7); z-index: 998; opacity: 0; transition: all .5s ease-in-out;
    }
    .overlay.active {
        display: block; opacity: 1;
    }
    /*-- Tablet & Mobile Nav style --*/
    .open-menu {}
    .mobile__nav{
        align-items: center;background-color: transparent;padding:3px 0;
    }
    .mob_infty__btn{
        position: relative;align-items: center;
        border-radius: 4px;border: none;cursor: pointer;display: inline-flex;
        padding: 0 1.2rem;justify-content: center;user-select: none;vertical-align: bottom;white-space: nowrap;
    }
    .toggle, .btn_cart, .btn_serch, .mob_infty__btn.wish__btn{
        width:auto;font-size:1.2rem;color:#000;position:relative;
    }
    .toggle:hover, .btn_cart:hover, .btn_serch:hover, .mob_infty__btn.wish__btn:hover{
        color:#a0ce4e;
    }
    .toggle{padding:0 1.2rem 0 0;}
    .btn_serch{width:6.8rem;justify-content:flex-end;}
    .btn_cart{padding:0 0 0 .5rem; width:2rem;}
    .btn_cart .cart_count, .mob_infty__btn.wish__btn .wish_count{top: -7px;right:-7px;font-weight:500;font-size:11px;}
    .button-space{
        width: 4.8rem;height: 4.8rem;visibility: hidden;
    }
    .mob_infty__btn.wish__btn{
        padding-right: 0;padding-left: 0;width: auto;
    }

    .sidebar {
        width: 290px; height: 100%; position: fixed; top: 0; left: -295px; z-index: 999;padding-top:0;
        background: #333; color: #fff; transition: all .3s; box-shadow: 3px 3px 3px rgba(51, 51, 51, 0.5);text-align: left;
    }
    .sidebar.active { left: 0; }
    .dismiss {
        width: 35px; height: 35px; position: absolute; top:0; right:0; transition: all .3s;
        background: #444; border-radius: 4px; text-align: center; line-height: 35px; cursor: pointer;z-index:1;
    }
    .dismiss:hover, .dismiss:focus { background: #555; color: #fff; }

    .mobile_courses_nav ul{margin:0 !important;}
    .sidebar ul.menu-elements {
        padding:25px 0 10px; border-bottom: 1px solid #444; transition: all .3s;}
    .sidebar ul.menu-elements li{
        display: inline-block;width: 100%;margin: 0;padding: 0 !important;position:relative;
    }
    .sidebar ul li a {
        display: block; padding:8px 15px; margin:0 !important;
        border: 0; color: #fff; font-size:14px;
    }
    .sidebar ul li a:hover,
    .sidebar ul li a:focus,
    .sidebar ul li.active > a:hover,
    .sidebar ul li.active > a:focus { outline: 0; background: #555; color: #fff; }
    .sidebar ul li a i { margin-right: 5px; }
    .sidebar ul li.active > a, a[aria-expanded="true"] {
        /*background: #444;
        color: #fff;*/
    }
    .sidebar ul ul a {background: #444; padding-left:12px; font-size:13px; position:relative;}
    .sidebar ul ul a .has-sub-category{
        position: absolute;
        top: 0;right: 0;width: 35px;height: 35px;border-left:#ffffff1a solid 1px;text-align: center;
        line-height: 35px;z-index: 999;
    }
    .sidebar ul ul li.active > a { background: #555; }
    .sidebar a[data-toggle="collapse"] {
        position: relative;
    }

    .sidebar .dsk_btns{
        width:75% !important; margin:0 auto 15px !important;
        text-align: center;padding: .7rem 0 !important;border-radius: 5px;
    }
    .sidebar .dsk_btns.signIn_btns {
        margin-top:20px;
    }

    .sidebar .dropdown li {
        border-bottom:#ffffff1a solid 1px;
    }
    .sidebar .dropdown-toggle::after{
        display: block;position: absolute;top:50%;right:10px;transform: translateY(-50%);
    }
    .dropdown-toggle::after{
        display: inline-block;margin-left: .255em;vertical-align: .255em;
        content: "";border-top: .35em solid;border-right: .35em solid transparent;border-bottom: 0;border-left: .35em solid transparent;
    }

    .downIcon{
        position:absolute !important;right:0;z-index:2;top:0;width:38px;height:38px;
    }

    .loginaftr__div{
        background-color: rgba(255, 255, 255, 0.10);
    }
    .loginaftr__div .dropdown-toggle{
        padding-top:28px;padding-bottom:15px;
    }
    .loginaftr__div .dropdown-user-circle {
        width: 40px;height: 40px;
    }
    .loginaftr__div .user-detailss {
        color: #ffffff;font-size: 13px;
    }
    .loginaftr__div ul {
        margin-left:0 !important;
    }
    .loginaftr__div ul li a {font-weight:400;}
    .loginaftr__div ul li a i {color: rgba(255, 255, 255, 0.22);}

    .parent_nav .child_nav{display:none;}
    .parent_nav:hover .child_nav{display:inline-block;width:100%;}
    .parent_nav .child_nav .sub_child_nav{position:relative;}
    .parent_nav .child_nav:hover .sub_child_nav{display:inline-block;width:100%;}

    .parent_nav .child_nav .sub_child_nav:hover ul.dropdown{display:inline-block !important;width:100%;}
    .parent_nav .child_nav .sub_child_nav ul.dropdown{margin:0 !important;padding:0 !important;}
    .parent_nav .child_nav .sub_child_nav ul.dropdown li{}
    .parent_nav .child_nav .sub_child_nav ul.dropdown li a{background: rgb(68 68 68 / 55%);}

    .parent_nav .child_nav .sub_child_nav .has-sub-category{
        position: absolute;
        top: 0;
        right: 0;
        width:41px;
        height: 35px;
        border-left: #ffffff1a solid 1px;
        text-align: center;line-height: 35px;
        z-index: 999;
    }

    .crt__btn.dropdown-toggle::after{
        display:none !important;
    }
    .crt__btn.dropdown-toggle:hover, .crt__btn.dropdown-toggle:focus, .crt__btn.dropdown-toggle:visited{
        background-color:transparent !important;color:#444;
    }


    .dropdown-cart li, .list_cart div{
        display: inline-block; width: 100%;
    }
    #emptycart{padding:25px 0;color: rgba(117, 117, 117, 0.48);}
    #emptycart i{font-size:26px;}
    #emptycart h4{font-size:1.2rem; margin-bottom:0; font-weight:600;color: rgba(117, 117, 117, 0.48);}
    .dropdown-cart a.button{
        /*background-color:#f2f2f2;border-bottom:none !important;*/
        margin:0 !important;
    }
    .dropdown-cart li, .list_cart div {
        margin: 0 0;padding: 10px 10px;border-bottom: rgb(0 0 0 / 12%) solid 1px;
    }

    .list_cart{padding:0 !important;border-bottom:0 !important;}
    .lst_child{padding-top:0 !important;}

    .dropdown-cart img {
        float: left;
        margin-right: 12px;
        height: auto;
        width: 60px !important;
        border-radius: 5px;
    }
    .dropdown-cart .item-name {display: block;font-size: 14px;line-height: 1.2;}
    .dropdown-cart .item-price {color: #000000;margin-right: 8px; font-weight: 600;}
    .dropdown-cart .item-quantity {color: #ABB0BE;}
    .dropdown-cart .item-remove {float: right;cursor: pointer;}
    .cart_area .cartbtn a{
        color: white;
    }
    .cart_area .ordertotal {
        padding: 13px 20px;
        margin: 0px;
        display: inline-block;
        font-size: 16px;
        font-weight: 700;
        text-align: center;
        width: 100%;
    }
    .cart_area .item-name a{
        display: contents;
        padding: inherit;
        line-height: inherit;
    }
    .description-content {
        text-align: justify;
    }
    .cart_area .item-image a{
        display: contents;
    }
    /*.cart_area .cartbtn a:hover{background-color: #2098d1;border-color: #2098d1;}*/
    .dropdown-cart:after {
        bottom: 100%;left: 89%;
        border: solid transparent;content: " ";
        height: 0;width: 0;position: absolute;pointer-events: none;border-bottom-color: white;border-width: 8px;margin-left: -8px;
    }
    .dropdown-cart:after {
        border-color: transparent transparent #e8e9eb;
    }

    .gradient-hd-bg.layer-overlay::before {
        background: linear-gradient(to right,#063248,#156e9b) !important;
    }

    .error {
        border: 2px solid #ee163b !important;
    }

    /*-- End Tablet & Mobile Nav style --*/
    /***** Custom Scroll bar *****/
    .mCustomScrollbar{-ms-touch-action:pinch-zoom;touch-action:pinch-zoom}.mCustomScrollbar.mCS_no_scrollbar,.mCustomScrollbar.mCS_touch_action{-ms-touch-action:auto;touch-action:auto}.mCustomScrollBox{position:relative;overflow:hidden;height:100%;max-width:100%;outline:0;direction:ltr}.mCSB_container{overflow:hidden;width:auto;height:auto}.mCSB_inside>.mCSB_container{margin-right:30px}.mCSB_container.mCS_no_scrollbar_y.mCS_y_hidden{margin-right:0}.mCS-dir-rtl>.mCSB_inside>.mCSB_container{margin-right:0;margin-left:30px}.mCS-dir-rtl>.mCSB_inside>.mCSB_container.mCS_no_scrollbar_y.mCS_y_hidden{margin-left:0}.mCSB_scrollTools{position:absolute;width:16px;height:auto;left:auto;top:0;right:0;bottom:0;opacity:.75;filter:"alpha(opacity=75)";-ms-filter:"alpha(opacity=75)"}.mCSB_outside+.mCSB_scrollTools{right:-26px}.mCS-dir-rtl>.mCSB_inside>.mCSB_scrollTools,.mCS-dir-rtl>.mCSB_outside+.mCSB_scrollTools{right:auto;left:0}.mCS-dir-rtl>.mCSB_outside+.mCSB_scrollTools{left:-26px}.mCSB_scrollTools .mCSB_draggerContainer{position:absolute;top:0;left:0;bottom:0;right:0;height:auto}.mCSB_scrollTools a+.mCSB_draggerContainer{margin:20px 0}.mCSB_scrollTools .mCSB_draggerRail{width:2px;height:100%;margin:0 auto;-webkit-border-radius:16px;-moz-border-radius:16px;border-radius:16px}.mCSB_scrollTools .mCSB_dragger{cursor:pointer;width:100%;height:30px;z-index:1}.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{position:relative;width:4px;height:100%;margin:0 auto;-webkit-border-radius:16px;-moz-border-radius:16px;border-radius:16px;text-align:center}.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded .mCSB_dragger_bar,.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_dragger .mCSB_dragger_bar{width:12px}.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded+.mCSB_draggerRail,.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_draggerRail{width:8px}.mCSB_scrollTools .mCSB_buttonDown,.mCSB_scrollTools .mCSB_buttonUp{display:block;position:absolute;height:20px;width:100%;overflow:hidden;margin:0 auto;cursor:pointer}.mCSB_scrollTools .mCSB_buttonDown{bottom:0}.mCSB_horizontal.mCSB_inside>.mCSB_container{margin-right:0;margin-bottom:30px}.mCSB_horizontal.mCSB_outside>.mCSB_container{min-height:100%}.mCSB_horizontal>.mCSB_container.mCS_no_scrollbar_x.mCS_x_hidden{margin-bottom:0}.mCSB_scrollTools.mCSB_scrollTools_horizontal{width:auto;height:16px;top:auto;right:0;bottom:0;left:0}.mCustomScrollBox+.mCSB_scrollTools+.mCSB_scrollTools.mCSB_scrollTools_horizontal,.mCustomScrollBox+.mCSB_scrollTools.mCSB_scrollTools_horizontal{bottom:-26px}.mCSB_scrollTools.mCSB_scrollTools_horizontal a+.mCSB_draggerContainer{margin:0 20px}.mCSB_scrollTools.mCSB_scrollTools_horizontal .mCSB_draggerRail{width:100%;height:2px;margin:7px 0}.mCSB_scrollTools.mCSB_scrollTools_horizontal .mCSB_dragger{width:30px;height:100%;left:0}.mCSB_scrollTools.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar{width:100%;height:4px;margin:6px auto}.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded .mCSB_dragger_bar,.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_dragger .mCSB_dragger_bar{height:12px;margin:2px auto}.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded+.mCSB_draggerRail,.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_draggerRail{height:8px;margin:4px 0}.mCSB_scrollTools.mCSB_scrollTools_horizontal .mCSB_buttonLeft,.mCSB_scrollTools.mCSB_scrollTools_horizontal .mCSB_buttonRight{display:block;position:absolute;width:20px;height:100%;overflow:hidden;margin:0 auto;cursor:pointer}.mCSB_scrollTools.mCSB_scrollTools_horizontal .mCSB_buttonLeft{left:0}.mCSB_scrollTools.mCSB_scrollTools_horizontal .mCSB_buttonRight{right:0}.mCSB_container_wrapper{position:absolute;height:auto;width:auto;overflow:hidden;top:0;left:0;right:0;bottom:0;margin-right:30px;margin-bottom:30px}.mCSB_container_wrapper>.mCSB_container{padding-right:30px;padding-bottom:30px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}.mCSB_vertical_horizontal>.mCSB_scrollTools.mCSB_scrollTools_vertical{bottom:20px}.mCSB_vertical_horizontal>.mCSB_scrollTools.mCSB_scrollTools_horizontal{right:20px}.mCSB_container_wrapper.mCS_no_scrollbar_x.mCS_x_hidden+.mCSB_scrollTools.mCSB_scrollTools_vertical{bottom:0}.mCS-dir-rtl>.mCustomScrollBox.mCSB_vertical_horizontal.mCSB_inside>.mCSB_scrollTools.mCSB_scrollTools_horizontal,.mCSB_container_wrapper.mCS_no_scrollbar_y.mCS_y_hidden+.mCSB_scrollTools~.mCSB_scrollTools.mCSB_scrollTools_horizontal{right:0}.mCS-dir-rtl>.mCustomScrollBox.mCSB_vertical_horizontal.mCSB_inside>.mCSB_scrollTools.mCSB_scrollTools_horizontal{left:20px}.mCS-dir-rtl>.mCustomScrollBox.mCSB_vertical_horizontal.mCSB_inside>.mCSB_container_wrapper.mCS_no_scrollbar_y.mCS_y_hidden+.mCSB_scrollTools~.mCSB_scrollTools.mCSB_scrollTools_horizontal{left:0}.mCS-dir-rtl>.mCSB_inside>.mCSB_container_wrapper{margin-right:0;margin-left:30px}.mCSB_container_wrapper.mCS_no_scrollbar_y.mCS_y_hidden>.mCSB_container{padding-right:0}.mCSB_container_wrapper.mCS_no_scrollbar_x.mCS_x_hidden>.mCSB_container{padding-bottom:0}.mCustomScrollBox.mCSB_vertical_horizontal.mCSB_inside>.mCSB_container_wrapper.mCS_no_scrollbar_y.mCS_y_hidden{margin-right:0;margin-left:0}.mCustomScrollBox.mCSB_vertical_horizontal.mCSB_inside>.mCSB_container_wrapper.mCS_no_scrollbar_x.mCS_x_hidden{margin-bottom:0}.mCSB_scrollTools,.mCSB_scrollTools .mCSB_buttonDown,.mCSB_scrollTools .mCSB_buttonLeft,.mCSB_scrollTools .mCSB_buttonRight,.mCSB_scrollTools .mCSB_buttonUp,.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{-webkit-transition:opacity .2s ease-in-out,background-color .2s ease-in-out;-moz-transition:opacity .2s ease-in-out,background-color .2s ease-in-out;-o-transition:opacity .2s ease-in-out,background-color .2s ease-in-out;transition:opacity .2s ease-in-out,background-color .2s ease-in-out}.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_draggerRail,.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_dragger_bar,.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_draggerRail,.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_dragger_bar{-webkit-transition:width .2s ease-out .2s,height .2s ease-out .2s,margin-left .2s ease-out .2s,margin-right .2s ease-out .2s,margin-top .2s ease-out .2s,margin-bottom .2s ease-out .2s,opacity .2s ease-in-out,background-color .2s ease-in-out;-moz-transition:width .2s ease-out .2s,height .2s ease-out .2s,margin-left .2s ease-out .2s,margin-right .2s ease-out .2s,margin-top .2s ease-out .2s,margin-bottom .2s ease-out .2s,opacity .2s ease-in-out,background-color .2s ease-in-out;-o-transition:width .2s ease-out .2s,height .2s ease-out .2s,margin-left .2s ease-out .2s,margin-right .2s ease-out .2s,margin-top .2s ease-out .2s,margin-bottom .2s ease-out .2s,opacity .2s ease-in-out,background-color .2s ease-in-out;transition:width .2s ease-out .2s,height .2s ease-out .2s,margin-left .2s ease-out .2s,margin-right .2s ease-out .2s,margin-top .2s ease-out .2s,margin-bottom .2s ease-out .2s,opacity .2s ease-in-out,background-color .2s ease-in-out}.mCS-autoHide>.mCustomScrollBox>.mCSB_scrollTools,.mCS-autoHide>.mCustomScrollBox~.mCSB_scrollTools{opacity:0;filter:"alpha(opacity=0)";-ms-filter:"alpha(opacity=0)"}.mCS-autoHide:hover>.mCustomScrollBox>.mCSB_scrollTools,.mCS-autoHide:hover>.mCustomScrollBox~.mCSB_scrollTools,.mCustomScrollBox:hover>.mCSB_scrollTools,.mCustomScrollBox:hover~.mCSB_scrollTools,.mCustomScrollbar>.mCustomScrollBox>.mCSB_scrollTools.mCSB_scrollTools_onDrag,.mCustomScrollbar>.mCustomScrollBox~.mCSB_scrollTools.mCSB_scrollTools_onDrag{opacity:1;filter:"alpha(opacity=100)";-ms-filter:"alpha(opacity=100)"}.mCSB_scrollTools .mCSB_draggerRail{background-color:#000;background-color:rgba(0,0,0,.4);filter:"alpha(opacity=40)";-ms-filter:"alpha(opacity=40)"}.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{background-color:#fff;background-color:rgba(255,255,255,.75);filter:"alpha(opacity=75)";-ms-filter:"alpha(opacity=75)"}.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{background-color:#fff;background-color:rgba(255,255,255,.85);filter:"alpha(opacity=85)";-ms-filter:"alpha(opacity=85)"}.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar{background-color:#fff;background-color:rgba(255,255,255,.9);filter:"alpha(opacity=90)";-ms-filter:"alpha(opacity=90)"}.mCSB_scrollTools .mCSB_buttonDown,.mCSB_scrollTools .mCSB_buttonLeft,.mCSB_scrollTools .mCSB_buttonRight,.mCSB_scrollTools .mCSB_buttonUp{background-image:url(mCSB_buttons.png);background-repeat:no-repeat;opacity:.4;filter:"alpha(opacity=40)";-ms-filter:"alpha(opacity=40)"}.mCSB_scrollTools .mCSB_buttonUp{background-position:0 0}.mCSB_scrollTools .mCSB_buttonDown{background-position:0 -20px}.mCSB_scrollTools .mCSB_buttonLeft{background-position:0 -40px}.mCSB_scrollTools .mCSB_buttonRight{background-position:0 -56px}.mCSB_scrollTools .mCSB_buttonDown:hover,.mCSB_scrollTools .mCSB_buttonLeft:hover,.mCSB_scrollTools .mCSB_buttonRight:hover,.mCSB_scrollTools .mCSB_buttonUp:hover{opacity:.75;filter:"alpha(opacity=75)";-ms-filter:"alpha(opacity=75)"}.mCSB_scrollTools .mCSB_buttonDown:active,.mCSB_scrollTools .mCSB_buttonLeft:active,.mCSB_scrollTools .mCSB_buttonRight:active,.mCSB_scrollTools .mCSB_buttonUp:active{opacity:.9;filter:"alpha(opacity=90)";-ms-filter:"alpha(opacity=90)"}.mCS-dark.mCSB_scrollTools .mCSB_draggerRail{background-color:#000;background-color:rgba(0,0,0,.15)}.mCS-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.75)}.mCS-dark.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{background-color:rgba(0,0,0,.85)}.mCS-dark.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-dark.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar{background-color:rgba(0,0,0,.9)}.mCS-dark.mCSB_scrollTools .mCSB_buttonUp{background-position:-80px 0}.mCS-dark.mCSB_scrollTools .mCSB_buttonDown{background-position:-80px -20px}.mCS-dark.mCSB_scrollTools .mCSB_buttonLeft{background-position:-80px -40px}.mCS-dark.mCSB_scrollTools .mCSB_buttonRight{background-position:-80px -56px}.mCS-dark-2.mCSB_scrollTools .mCSB_draggerRail,.mCS-light-2.mCSB_scrollTools .mCSB_draggerRail{width:4px;background-color:#fff;background-color:rgba(255,255,255,.1);-webkit-border-radius:1px;-moz-border-radius:1px;border-radius:1px}.mCS-dark-2.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-light-2.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{width:4px;background-color:#fff;background-color:rgba(255,255,255,.75);-webkit-border-radius:1px;-moz-border-radius:1px;border-radius:1px}.mCS-dark-2.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-dark-2.mCSB_scrollTools_horizontal .mCSB_draggerRail,.mCS-light-2.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-light-2.mCSB_scrollTools_horizontal .mCSB_draggerRail{width:100%;height:4px;margin:6px auto}.mCS-light-2.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{background-color:#fff;background-color:rgba(255,255,255,.85)}.mCS-light-2.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-light-2.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar{background-color:#fff;background-color:rgba(255,255,255,.9)}.mCS-light-2.mCSB_scrollTools .mCSB_buttonUp{background-position:-32px 0}.mCS-light-2.mCSB_scrollTools .mCSB_buttonDown{background-position:-32px -20px}.mCS-light-2.mCSB_scrollTools .mCSB_buttonLeft{background-position:-40px -40px}.mCS-light-2.mCSB_scrollTools .mCSB_buttonRight{background-position:-40px -56px}.mCS-dark-2.mCSB_scrollTools .mCSB_draggerRail{background-color:#000;background-color:rgba(0,0,0,.1);-webkit-border-radius:1px;-moz-border-radius:1px;border-radius:1px}.mCS-dark-2.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.75);-webkit-border-radius:1px;-moz-border-radius:1px;border-radius:1px}.mCS-dark-2.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.85)}.mCS-dark-2.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-dark-2.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.9)}.mCS-dark-2.mCSB_scrollTools .mCSB_buttonUp{background-position:-112px 0}.mCS-dark-2.mCSB_scrollTools .mCSB_buttonDown{background-position:-112px -20px}.mCS-dark-2.mCSB_scrollTools .mCSB_buttonLeft{background-position:-120px -40px}.mCS-dark-2.mCSB_scrollTools .mCSB_buttonRight{background-position:-120px -56px}.mCS-dark-thick.mCSB_scrollTools .mCSB_draggerRail,.mCS-light-thick.mCSB_scrollTools .mCSB_draggerRail{width:4px;background-color:#fff;background-color:rgba(255,255,255,.1);-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px}.mCS-dark-thick.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-light-thick.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{width:6px;background-color:#fff;background-color:rgba(255,255,255,.75);-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px}.mCS-dark-thick.mCSB_scrollTools_horizontal .mCSB_draggerRail,.mCS-light-thick.mCSB_scrollTools_horizontal .mCSB_draggerRail{width:100%;height:4px;margin:6px 0}.mCS-dark-thick.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-light-thick.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar{width:100%;height:6px;margin:5px auto}.mCS-light-thick.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{background-color:#fff;background-color:rgba(255,255,255,.85)}.mCS-light-thick.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-light-thick.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar{background-color:#fff;background-color:rgba(255,255,255,.9)}.mCS-light-thick.mCSB_scrollTools .mCSB_buttonUp{background-position:-16px 0}.mCS-light-thick.mCSB_scrollTools .mCSB_buttonDown{background-position:-16px -20px}.mCS-light-thick.mCSB_scrollTools .mCSB_buttonLeft{background-position:-20px -40px}.mCS-light-thick.mCSB_scrollTools .mCSB_buttonRight{background-position:-20px -56px}.mCS-dark-thick.mCSB_scrollTools .mCSB_draggerRail{background-color:#000;background-color:rgba(0,0,0,.1);-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px}.mCS-dark-thick.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.75);-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px}.mCS-dark-thick.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.85)}.mCS-dark-thick.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-dark-thick.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.9)}.mCS-dark-thick.mCSB_scrollTools .mCSB_buttonUp{background-position:-96px 0}.mCS-dark-thick.mCSB_scrollTools .mCSB_buttonDown{background-position:-96px -20px}.mCS-dark-thick.mCSB_scrollTools .mCSB_buttonLeft{background-position:-100px -40px}.mCS-dark-thick.mCSB_scrollTools .mCSB_buttonRight{background-position:-100px -56px}.mCS-light-thin.mCSB_scrollTools .mCSB_draggerRail{background-color:#fff;background-color:rgba(255,255,255,.1)}.mCS-dark-thin.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-light-thin.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{width:2px}.mCS-dark-thin.mCSB_scrollTools_horizontal .mCSB_draggerRail,.mCS-light-thin.mCSB_scrollTools_horizontal .mCSB_draggerRail{width:100%}.mCS-dark-thin.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-light-thin.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar{width:100%;height:2px;margin:7px auto}.mCS-dark-thin.mCSB_scrollTools .mCSB_draggerRail{background-color:#000;background-color:rgba(0,0,0,.15)}.mCS-dark-thin.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.75)}.mCS-dark-thin.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.85)}.mCS-dark-thin.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-dark-thin.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.9)}.mCS-dark-thin.mCSB_scrollTools .mCSB_buttonUp{background-position:-80px 0}.mCS-dark-thin.mCSB_scrollTools .mCSB_buttonDown{background-position:-80px -20px}.mCS-dark-thin.mCSB_scrollTools .mCSB_buttonLeft{background-position:-80px -40px}.mCS-dark-thin.mCSB_scrollTools .mCSB_buttonRight{background-position:-80px -56px}.mCS-rounded.mCSB_scrollTools .mCSB_draggerRail{background-color:#fff;background-color:rgba(255,255,255,.15)}.mCS-rounded-dark.mCSB_scrollTools .mCSB_dragger,.mCS-rounded-dots-dark.mCSB_scrollTools .mCSB_dragger,.mCS-rounded-dots.mCSB_scrollTools .mCSB_dragger,.mCS-rounded.mCSB_scrollTools .mCSB_dragger{height:14px}.mCS-rounded-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-rounded-dots-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-rounded-dots.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-rounded.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{width:14px;margin:0 1px}.mCS-rounded-dark.mCSB_scrollTools_horizontal .mCSB_dragger,.mCS-rounded-dots-dark.mCSB_scrollTools_horizontal .mCSB_dragger,.mCS-rounded-dots.mCSB_scrollTools_horizontal .mCSB_dragger,.mCS-rounded.mCSB_scrollTools_horizontal .mCSB_dragger{width:14px}.mCS-rounded-dark.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-rounded-dots-dark.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-rounded-dots.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-rounded.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar{height:14px;margin:1px 0}.mCS-rounded-dark.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded .mCSB_dragger_bar,.mCS-rounded-dark.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_dragger .mCSB_dragger_bar,.mCS-rounded.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded .mCSB_dragger_bar,.mCS-rounded.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_dragger .mCSB_dragger_bar{width:16px;height:16px;margin:-1px 0}.mCS-rounded-dark.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded+.mCSB_draggerRail,.mCS-rounded-dark.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_draggerRail,.mCS-rounded.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded+.mCSB_draggerRail,.mCS-rounded.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_draggerRail{width:4px}.mCS-rounded-dark.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded .mCSB_dragger_bar,.mCS-rounded-dark.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_dragger .mCSB_dragger_bar,.mCS-rounded.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded .mCSB_dragger_bar,.mCS-rounded.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_dragger .mCSB_dragger_bar{height:16px;width:16px;margin:0 -1px}.mCS-rounded-dark.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded+.mCSB_draggerRail,.mCS-rounded-dark.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_draggerRail,.mCS-rounded.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded+.mCSB_draggerRail,.mCS-rounded.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_draggerRail{height:4px;margin:6px 0}.mCS-rounded.mCSB_scrollTools .mCSB_buttonUp{background-position:0 -72px}.mCS-rounded.mCSB_scrollTools .mCSB_buttonDown{background-position:0 -92px}.mCS-rounded.mCSB_scrollTools .mCSB_buttonLeft{background-position:0 -112px}.mCS-rounded.mCSB_scrollTools .mCSB_buttonRight{background-position:0 -128px}.mCS-rounded-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-rounded-dots-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.75)}.mCS-rounded-dark.mCSB_scrollTools .mCSB_draggerRail{background-color:#000;background-color:rgba(0,0,0,.15)}.mCS-rounded-dark.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar,.mCS-rounded-dots-dark.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.85)}.mCS-rounded-dark.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-rounded-dark.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar,.mCS-rounded-dots-dark.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-rounded-dots-dark.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.9)}.mCS-rounded-dark.mCSB_scrollTools .mCSB_buttonUp{background-position:-80px -72px}.mCS-rounded-dark.mCSB_scrollTools .mCSB_buttonDown{background-position:-80px -92px}.mCS-rounded-dark.mCSB_scrollTools .mCSB_buttonLeft{background-position:-80px -112px}.mCS-rounded-dark.mCSB_scrollTools .mCSB_buttonRight{background-position:-80px -128px}.mCS-rounded-dots-dark.mCSB_scrollTools_vertical .mCSB_draggerRail,.mCS-rounded-dots.mCSB_scrollTools_vertical .mCSB_draggerRail{width:4px}.mCS-rounded-dots-dark.mCSB_scrollTools .mCSB_draggerRail,.mCS-rounded-dots-dark.mCSB_scrollTools_horizontal .mCSB_draggerRail,.mCS-rounded-dots.mCSB_scrollTools .mCSB_draggerRail,.mCS-rounded-dots.mCSB_scrollTools_horizontal .mCSB_draggerRail{background-color:transparent;background-position:center}.mCS-rounded-dots-dark.mCSB_scrollTools .mCSB_draggerRail,.mCS-rounded-dots.mCSB_scrollTools .mCSB_draggerRail{background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAYAAADED76LAAAANElEQVQYV2NkIAAYiVbw//9/Y6DiM1ANJoyMjGdBbLgJQAX/kU0DKgDLkaQAvxW4HEvQFwCRcxIJK1XznAAAAABJRU5ErkJggg==);background-repeat:repeat-y;opacity:.3;filter:"alpha(opacity=30)";-ms-filter:"alpha(opacity=30)"}.mCS-rounded-dots-dark.mCSB_scrollTools_horizontal .mCSB_draggerRail,.mCS-rounded-dots.mCSB_scrollTools_horizontal .mCSB_draggerRail{height:4px;margin:6px 0;background-repeat:repeat-x}.mCS-rounded-dots.mCSB_scrollTools .mCSB_buttonUp{background-position:-16px -72px}.mCS-rounded-dots.mCSB_scrollTools .mCSB_buttonDown{background-position:-16px -92px}.mCS-rounded-dots.mCSB_scrollTools .mCSB_buttonLeft{background-position:-20px -112px}.mCS-rounded-dots.mCSB_scrollTools .mCSB_buttonRight{background-position:-20px -128px}.mCS-rounded-dots-dark.mCSB_scrollTools .mCSB_draggerRail{background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAYAAADED76LAAAALElEQVQYV2NkIAAYSVFgDFR8BqrBBEifBbGRTfiPZhpYjiQFBK3A6l6CvgAAE9kGCd1mvgEAAAAASUVORK5CYII=)}.mCS-rounded-dots-dark.mCSB_scrollTools .mCSB_buttonUp{background-position:-96px -72px}.mCS-rounded-dots-dark.mCSB_scrollTools .mCSB_buttonDown{background-position:-96px -92px}.mCS-rounded-dots-dark.mCSB_scrollTools .mCSB_buttonLeft{background-position:-100px -112px}.mCS-rounded-dots-dark.mCSB_scrollTools .mCSB_buttonRight{background-position:-100px -128px}.mCS-3d-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-3d-thick-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-3d-thick.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-3d.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{background-repeat:repeat-y;background-image:-moz-linear-gradient(left,rgba(255,255,255,.5) 0,rgba(255,255,255,0) 100%);background-image:-webkit-gradient(linear,left top,right top,color-stop(0,rgba(255,255,255,.5)),color-stop(100%,rgba(255,255,255,0)));background-image:-webkit-linear-gradient(left,rgba(255,255,255,.5) 0,rgba(255,255,255,0) 100%);background-image:-o-linear-gradient(left,rgba(255,255,255,.5) 0,rgba(255,255,255,0) 100%);background-image:-ms-linear-gradient(left,rgba(255,255,255,.5) 0,rgba(255,255,255,0) 100%);background-image:linear-gradient(to right,rgba(255,255,255,.5) 0,rgba(255,255,255,0) 100%)}.mCS-3d-dark.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-3d-thick-dark.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-3d-thick.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-3d.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar{background-repeat:repeat-x;background-image:-moz-linear-gradient(top,rgba(255,255,255,.5) 0,rgba(255,255,255,0) 100%);background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0,rgba(255,255,255,.5)),color-stop(100%,rgba(255,255,255,0)));background-image:-webkit-linear-gradient(top,rgba(255,255,255,.5) 0,rgba(255,255,255,0) 100%);background-image:-o-linear-gradient(top,rgba(255,255,255,.5) 0,rgba(255,255,255,0) 100%);background-image:-ms-linear-gradient(top,rgba(255,255,255,.5) 0,rgba(255,255,255,0) 100%);background-image:linear-gradient(to bottom,rgba(255,255,255,.5) 0,rgba(255,255,255,0) 100%)}.mCS-3d-dark.mCSB_scrollTools_vertical .mCSB_dragger,.mCS-3d.mCSB_scrollTools_vertical .mCSB_dragger{height:70px}.mCS-3d-dark.mCSB_scrollTools_horizontal .mCSB_dragger,.mCS-3d.mCSB_scrollTools_horizontal .mCSB_dragger{width:70px}.mCS-3d-dark.mCSB_scrollTools,.mCS-3d.mCSB_scrollTools{opacity:1;filter:"alpha(opacity=30)";-ms-filter:"alpha(opacity=30)"}.mCS-3d-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-3d-dark.mCSB_scrollTools .mCSB_draggerRail,.mCS-3d.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-3d.mCSB_scrollTools .mCSB_draggerRail{-webkit-border-radius:16px;-moz-border-radius:16px;border-radius:16px}.mCS-3d-dark.mCSB_scrollTools .mCSB_draggerRail,.mCS-3d.mCSB_scrollTools .mCSB_draggerRail{width:8px;background-color:#000;background-color:rgba(0,0,0,.2);box-shadow:inset 1px 0 1px rgba(0,0,0,.5),inset -1px 0 1px rgba(255,255,255,.2)}.mCS-3d-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-3d-dark.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-3d-dark.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar,.mCS-3d-dark.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar,.mCS-3d.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-3d.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-3d.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar,.mCS-3d.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{background-color:#555}.mCS-3d-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-3d.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{width:8px}.mCS-3d-dark.mCSB_scrollTools_horizontal .mCSB_draggerRail,.mCS-3d.mCSB_scrollTools_horizontal .mCSB_draggerRail{width:100%;height:8px;margin:4px 0;box-shadow:inset 0 1px 1px rgba(0,0,0,.5),inset 0 -1px 1px rgba(255,255,255,.2)}.mCS-3d-dark.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-3d.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar{width:100%;height:8px;margin:4px auto}.mCS-3d.mCSB_scrollTools .mCSB_buttonUp{background-position:-32px -72px}.mCS-3d.mCSB_scrollTools .mCSB_buttonDown{background-position:-32px -92px}.mCS-3d.mCSB_scrollTools .mCSB_buttonLeft{background-position:-40px -112px}.mCS-3d.mCSB_scrollTools .mCSB_buttonRight{background-position:-40px -128px}.mCS-3d-dark.mCSB_scrollTools .mCSB_draggerRail{background-color:#000;background-color:rgba(0,0,0,.1);box-shadow:inset 1px 0 1px rgba(0,0,0,.1)}.mCS-3d-dark.mCSB_scrollTools_horizontal .mCSB_draggerRail{box-shadow:inset 0 1px 1px rgba(0,0,0,.1)}.mCS-3d-dark.mCSB_scrollTools .mCSB_buttonUp{background-position:-112px -72px}.mCS-3d-dark.mCSB_scrollTools .mCSB_buttonDown{background-position:-112px -92px}.mCS-3d-dark.mCSB_scrollTools .mCSB_buttonLeft{background-position:-120px -112px}.mCS-3d-dark.mCSB_scrollTools .mCSB_buttonRight{background-position:-120px -128px}.mCS-3d-thick-dark.mCSB_scrollTools,.mCS-3d-thick.mCSB_scrollTools{opacity:1;filter:"alpha(opacity=30)";-ms-filter:"alpha(opacity=30)"}.mCS-3d-thick-dark.mCSB_scrollTools,.mCS-3d-thick-dark.mCSB_scrollTools .mCSB_draggerContainer,.mCS-3d-thick.mCSB_scrollTools,.mCS-3d-thick.mCSB_scrollTools .mCSB_draggerContainer{-webkit-border-radius:7px;-moz-border-radius:7px;border-radius:7px}.mCSB_inside+.mCS-3d-thick-dark.mCSB_scrollTools_vertical,.mCSB_inside+.mCS-3d-thick.mCSB_scrollTools_vertical{right:1px}.mCS-3d-thick-dark.mCSB_scrollTools_vertical,.mCS-3d-thick.mCSB_scrollTools_vertical{box-shadow:inset 1px 0 1px rgba(0,0,0,.1),inset 0 0 14px rgba(0,0,0,.5)}.mCS-3d-thick-dark.mCSB_scrollTools_horizontal,.mCS-3d-thick.mCSB_scrollTools_horizontal{bottom:1px;box-shadow:inset 0 1px 1px rgba(0,0,0,.1),inset 0 0 14px rgba(0,0,0,.5)}.mCS-3d-thick-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-3d-thick.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;box-shadow:inset 1px 0 0 rgba(255,255,255,.4);width:12px;margin:2px;position:absolute;height:auto;top:0;bottom:0;left:0;right:0}.mCS-3d-thick-dark.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-3d-thick.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar{box-shadow:inset 0 1px 0 rgba(255,255,255,.4);height:12px;width:auto}.mCS-3d-thick.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-3d-thick.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-3d-thick.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar,.mCS-3d-thick.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{background-color:#555}.mCS-3d-thick.mCSB_scrollTools .mCSB_draggerContainer{background-color:#000;background-color:rgba(0,0,0,.05);box-shadow:inset 1px 1px 16px rgba(0,0,0,.1)}.mCS-3d-thick.mCSB_scrollTools .mCSB_draggerRail{background-color:transparent}.mCS-3d-thick.mCSB_scrollTools .mCSB_buttonUp{background-position:-32px -72px}.mCS-3d-thick.mCSB_scrollTools .mCSB_buttonDown{background-position:-32px -92px}.mCS-3d-thick.mCSB_scrollTools .mCSB_buttonLeft{background-position:-40px -112px}.mCS-3d-thick.mCSB_scrollTools .mCSB_buttonRight{background-position:-40px -128px}.mCS-3d-thick-dark.mCSB_scrollTools{box-shadow:inset 0 0 14px rgba(0,0,0,.2)}.mCS-3d-thick-dark.mCSB_scrollTools_horizontal{box-shadow:inset 0 1px 1px rgba(0,0,0,.1),inset 0 0 14px rgba(0,0,0,.2)}.mCS-3d-thick-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{box-shadow:inset 1px 0 0 rgba(255,255,255,.4),inset -1px 0 0 rgba(0,0,0,.2)}.mCS-3d-thick-dark.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar{box-shadow:inset 0 1px 0 rgba(255,255,255,.4),inset 0 -1px 0 rgba(0,0,0,.2)}.mCS-3d-thick-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-3d-thick-dark.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-3d-thick-dark.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar,.mCS-3d-thick-dark.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{background-color:#777}.mCS-3d-thick-dark.mCSB_scrollTools .mCSB_draggerContainer{background-color:#fff;background-color:rgba(0,0,0,.05);box-shadow:inset 1px 1px 16px rgba(0,0,0,.1)}.mCS-3d-thick-dark.mCSB_scrollTools .mCSB_draggerRail,.mCS-minimal-dark.mCSB_scrollTools .mCSB_draggerRail,.mCS-minimal.mCSB_scrollTools .mCSB_draggerRail{background-color:transparent}.mCS-3d-thick-dark.mCSB_scrollTools .mCSB_buttonUp{background-position:-112px -72px}.mCS-3d-thick-dark.mCSB_scrollTools .mCSB_buttonDown{background-position:-112px -92px}.mCS-3d-thick-dark.mCSB_scrollTools .mCSB_buttonLeft{background-position:-120px -112px}.mCS-3d-thick-dark.mCSB_scrollTools .mCSB_buttonRight{background-position:-120px -128px}.mCSB_outside+.mCS-minimal-dark.mCSB_scrollTools_vertical,.mCSB_outside+.mCS-minimal.mCSB_scrollTools_vertical{right:0;margin:12px 0}.mCustomScrollBox.mCS-minimal+.mCSB_scrollTools+.mCSB_scrollTools.mCSB_scrollTools_horizontal,.mCustomScrollBox.mCS-minimal+.mCSB_scrollTools.mCSB_scrollTools_horizontal,.mCustomScrollBox.mCS-minimal-dark+.mCSB_scrollTools+.mCSB_scrollTools.mCSB_scrollTools_horizontal,.mCustomScrollBox.mCS-minimal-dark+.mCSB_scrollTools.mCSB_scrollTools_horizontal{bottom:0;margin:0 12px}.mCS-dir-rtl>.mCSB_outside+.mCS-minimal-dark.mCSB_scrollTools_vertical,.mCS-dir-rtl>.mCSB_outside+.mCS-minimal.mCSB_scrollTools_vertical{left:0;right:auto}.mCS-minimal-dark.mCSB_scrollTools_vertical .mCSB_dragger,.mCS-minimal.mCSB_scrollTools_vertical .mCSB_dragger{height:50px}.mCS-minimal-dark.mCSB_scrollTools_horizontal .mCSB_dragger,.mCS-minimal.mCSB_scrollTools_horizontal .mCSB_dragger{width:50px}.mCS-minimal.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{background-color:#fff;background-color:rgba(255,255,255,.2);filter:"alpha(opacity=20)";-ms-filter:"alpha(opacity=20)"}.mCS-minimal.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-minimal.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar{background-color:#fff;background-color:rgba(255,255,255,.5);filter:"alpha(opacity=50)";-ms-filter:"alpha(opacity=50)"}.mCS-minimal-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.2);filter:"alpha(opacity=20)";-ms-filter:"alpha(opacity=20)"}.mCS-minimal-dark.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-minimal-dark.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.5);filter:"alpha(opacity=50)";-ms-filter:"alpha(opacity=50)"}.mCS-dark-3.mCSB_scrollTools .mCSB_draggerRail,.mCS-light-3.mCSB_scrollTools .mCSB_draggerRail{width:6px;background-color:#000;background-color:rgba(0,0,0,.2)}.mCS-dark-3.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-light-3.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{width:6px}.mCS-dark-3.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-dark-3.mCSB_scrollTools_horizontal .mCSB_draggerRail,.mCS-light-3.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-light-3.mCSB_scrollTools_horizontal .mCSB_draggerRail{width:100%;height:6px;margin:5px 0}.mCS-dark-3.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded+.mCSB_draggerRail,.mCS-dark-3.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_draggerRail,.mCS-light-3.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded+.mCSB_draggerRail,.mCS-light-3.mCSB_scrollTools_vertical.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_draggerRail{width:12px}.mCS-dark-3.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded+.mCSB_draggerRail,.mCS-dark-3.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_draggerRail,.mCS-light-3.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_dragger.mCSB_dragger_onDrag_expanded+.mCSB_draggerRail,.mCS-light-3.mCSB_scrollTools_horizontal.mCSB_scrollTools_onDrag_expand .mCSB_draggerContainer:hover .mCSB_draggerRail{height:12px;margin:2px 0}.mCS-light-3.mCSB_scrollTools .mCSB_buttonUp{background-position:-32px -72px}.mCS-light-3.mCSB_scrollTools .mCSB_buttonDown{background-position:-32px -92px}.mCS-light-3.mCSB_scrollTools .mCSB_buttonLeft{background-position:-40px -112px}.mCS-light-3.mCSB_scrollTools .mCSB_buttonRight{background-position:-40px -128px}.mCS-dark-3.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.75)}.mCS-dark-3.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.85)}.mCS-dark-3.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-dark-3.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.9)}.mCS-dark-3.mCSB_scrollTools .mCSB_draggerRail{background-color:#000;background-color:rgba(0,0,0,.1)}.mCS-dark-3.mCSB_scrollTools .mCSB_buttonUp{background-position:-112px -72px}.mCS-dark-3.mCSB_scrollTools .mCSB_buttonDown{background-position:-112px -92px}.mCS-dark-3.mCSB_scrollTools .mCSB_buttonLeft{background-position:-120px -112px}.mCS-dark-3.mCSB_scrollTools .mCSB_buttonRight{background-position:-120px -128px}.mCS-inset-2-dark.mCSB_scrollTools .mCSB_draggerRail,.mCS-inset-2.mCSB_scrollTools .mCSB_draggerRail,.mCS-inset-3-dark.mCSB_scrollTools .mCSB_draggerRail,.mCS-inset-3.mCSB_scrollTools .mCSB_draggerRail,.mCS-inset-dark.mCSB_scrollTools .mCSB_draggerRail,.mCS-inset.mCSB_scrollTools .mCSB_draggerRail{width:12px;background-color:#000;background-color:rgba(0,0,0,.2)}.mCS-inset-2-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-inset-2.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-inset-3-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-inset-3.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-inset-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-inset.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{width:6px;margin:3px 5px;position:absolute;height:auto;top:0;bottom:0;left:0;right:0}.mCS-inset-2-dark.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-inset-2.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-inset-3-dark.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-inset-3.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-inset-dark.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,.mCS-inset.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar{height:6px;margin:5px 3px;position:absolute;width:auto;top:0;bottom:0;left:0;right:0}.mCS-inset-2-dark.mCSB_scrollTools_horizontal .mCSB_draggerRail,.mCS-inset-2.mCSB_scrollTools_horizontal .mCSB_draggerRail,.mCS-inset-3-dark.mCSB_scrollTools_horizontal .mCSB_draggerRail,.mCS-inset-3.mCSB_scrollTools_horizontal .mCSB_draggerRail,.mCS-inset-dark.mCSB_scrollTools_horizontal .mCSB_draggerRail,.mCS-inset.mCSB_scrollTools_horizontal .mCSB_draggerRail{width:100%;height:12px;margin:2px 0}.mCS-inset-2.mCSB_scrollTools .mCSB_buttonUp,.mCS-inset-3.mCSB_scrollTools .mCSB_buttonUp,.mCS-inset.mCSB_scrollTools .mCSB_buttonUp{background-position:-32px -72px}.mCS-inset-2.mCSB_scrollTools .mCSB_buttonDown,.mCS-inset-3.mCSB_scrollTools .mCSB_buttonDown,.mCS-inset.mCSB_scrollTools .mCSB_buttonDown{background-position:-32px -92px}.mCS-inset-2.mCSB_scrollTools .mCSB_buttonLeft,.mCS-inset-3.mCSB_scrollTools .mCSB_buttonLeft,.mCS-inset.mCSB_scrollTools .mCSB_buttonLeft{background-position:-40px -112px}.mCS-inset-2.mCSB_scrollTools .mCSB_buttonRight,.mCS-inset-3.mCSB_scrollTools .mCSB_buttonRight,.mCS-inset.mCSB_scrollTools .mCSB_buttonRight{background-position:-40px -128px}.mCS-inset-2-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-inset-3-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.mCS-inset-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.75)}.mCS-inset-2-dark.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar,.mCS-inset-3-dark.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar,.mCS-inset-dark.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.85)}.mCS-inset-2-dark.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-inset-2-dark.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar,.mCS-inset-3-dark.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-inset-3-dark.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar,.mCS-inset-dark.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-inset-dark.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.9)}.mCS-inset-2-dark.mCSB_scrollTools .mCSB_draggerRail,.mCS-inset-3-dark.mCSB_scrollTools .mCSB_draggerRail,.mCS-inset-dark.mCSB_scrollTools .mCSB_draggerRail{background-color:#000;background-color:rgba(0,0,0,.1)}.mCS-inset-2-dark.mCSB_scrollTools .mCSB_buttonUp,.mCS-inset-3-dark.mCSB_scrollTools .mCSB_buttonUp,.mCS-inset-dark.mCSB_scrollTools .mCSB_buttonUp{background-position:-112px -72px}.mCS-inset-2-dark.mCSB_scrollTools .mCSB_buttonDown,.mCS-inset-3-dark.mCSB_scrollTools .mCSB_buttonDown,.mCS-inset-dark.mCSB_scrollTools .mCSB_buttonDown{background-position:-112px -92px}.mCS-inset-2-dark.mCSB_scrollTools .mCSB_buttonLeft,.mCS-inset-3-dark.mCSB_scrollTools .mCSB_buttonLeft,.mCS-inset-dark.mCSB_scrollTools .mCSB_buttonLeft{background-position:-120px -112px}.mCS-inset-2-dark.mCSB_scrollTools .mCSB_buttonRight,.mCS-inset-3-dark.mCSB_scrollTools .mCSB_buttonRight,.mCS-inset-dark.mCSB_scrollTools .mCSB_buttonRight{background-position:-120px -128px}.mCS-inset-2-dark.mCSB_scrollTools .mCSB_draggerRail,.mCS-inset-2.mCSB_scrollTools .mCSB_draggerRail{background-color:transparent;border-width:1px;border-style:solid;border-color:#fff;border-color:rgba(255,255,255,.2);-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}.mCS-inset-2-dark.mCSB_scrollTools .mCSB_draggerRail{border-color:#000;border-color:rgba(0,0,0,.2)}.mCS-inset-3.mCSB_scrollTools .mCSB_draggerRail{background-color:#fff;background-color:rgba(255,255,255,.6)}.mCS-inset-3-dark.mCSB_scrollTools .mCSB_draggerRail{background-color:#000;background-color:rgba(0,0,0,.6)}.mCS-inset-3.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.75)}.mCS-inset-3.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.85)}.mCS-inset-3.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-inset-3.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar{background-color:#000;background-color:rgba(0,0,0,.9)}.mCS-inset-3-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{background-color:#fff;background-color:rgba(255,255,255,.75)}.mCS-inset-3-dark.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{background-color:#fff;background-color:rgba(255,255,255,.85)}.mCS-inset-3-dark.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCS-inset-3-dark.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar{background-color:#fff;background-color:rgba(255,255,255,.9)}

    .row.row-no-padding{margin-left:0;margin-right:0;}
    .row-no-padding > [class*="col-"] { padding-left:0 !important; padding-right:0 !important; }

    .certificate_new_bx {
        border-bottom: 3px solid #156e9b;
        border-top: 3px solid #156e9b;
        background-color: rgba(246, 251, 253, 0.13);
    }
    .maincertiback {
        height: 350px;
        /* border-radius: 10px; */
        border: 2px solid lightblue;
        border-radius: 16px;
        box-shadow: 0px 2px 5px 5px rgba(21, 110, 155, 0.10);
        width: auto !important;
    }


    /*##################################################*/
    /*######### FOOTER BLADE INLINE STYLES #############*/
    /*##################################################*/
    .footer-social-icons {
        padding-left: 10px;
    }

    .footer-text {
        font-size: 14px;
        color: #ffffff;
    }

    .footer-sub-header {
        font-weight: bold;
        font-size: 14px !important;
        color: #ffffff !important;
    }

    .footer-link {
        color: #ffffff !important;
        font-size: 14px !important;
    }

    .footer-link a {
        color: #ffffff !important;
        font-size: 14px !important;
        font-weight: 500 !important;
    }

    .footer-link li {
        padding-bottom: 0px !important;
        margin-bottom: 3px !important;
        padding-left: 0px !important;
    }

    .footer a {
        color: #ffffff !important;
        font-weight: 500 !important;
    }

    .contact-details li {
        font-size: 14px !important;
        color: #ffffff !important;
    }
    .contact-details li a {
        word-break: break-all;
    }

    .footer-link li::before {
        content: none !important;
    }

    #footer {
        background-color: #063248 !important;
    }

    .subs-group-content {
        margin-left: auto;
        margin-right: auto;
        /* background: linear-gradient(to right, rgb(6, 50, 72), rgb(21, 110, 155)) !important; */
    }

    .newsletter-form1 .input-group {
        margin-top: 30px;
        display: block;
        position: relative;
    }

    .newsletter-form1 .form-control {
        width: 100% !important;
        font-size: 16px !important;
        font-weight: 400 !important;
        background-color: #ffffff !important;
        border: 1px solid #ffffff !important;
        padding: 20px 20px 18px !important;
        border-radius: 30px !important;
        height: 60px !important;
    }

    .newsletter-form1 .input-group button {
        border: none;
        position: absolute;
        right: 5px;
        top: 5px;
        min-height: 50px;
        z-index: 9 !important;
        background: #045f8c none repeat scroll 0 0 !important;
        padding: 0 30px;
        border-radius: 30px !important;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        letter-spacing: 1px;
        color: #ffffff;
        text-transform: uppercase;
        transform: scale(1);
    }

    .newsletter-form1 .input-group button:hover{
        transform: scale(0.95);
    }

    .newsletter-form1 .input-group i{
        padding-left:8px !important;
    }

    #subcription .subs-group-content {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
    }
    #subcription .subs-group-content h2{
        font-family: 'Poppins',sans-serif !important;
    }
    #wrapper-subs{
        background-size:cover;
        border-radius:8px;
    }

    @media screen and (max-width: 767px) and (min-width: 320px) {
        .newsletter-form1 .input-group button {

            padding: 0 10px;
            font-size: 13px !important;
            font-weight: 500 !important;

        }


        .all_course_full_banner_class {
            display: none;
        }
        .all_course_mobile_banner_class {
            display: block;
            width: 100%;
        }
    }

    @media not all and (min-resolution:.001dpcm) {

    }



    /*##################################################*/
    /*######### FAQs BLADE INLINE STYLES #############*/
    /*##################################################*/
    .layer-overlay::before {
        background: linear-gradient(to right, #063248, #156e9b) !important;
    }

    .inner-header h2 {
        color: #fff !important;
    }

    .text-colored2 {
        color: rgb(81, 172, 55) !important;
    }

    .inner-header h2,
    #Title h2,
    .list-group-item,
    .panel-heading h2,
    .panel-body span {
        font-family: 'Poppins', sans-serif !important;
    }

    /*--------------------------------------------------------------
    # Tab Nav Css
    --------------------------------------------------------------*/
    .nav-wrapper {
        /*padding: 40px 40px;*/
        /* background: #0b3155; */
    }

    .list-group-item {
        z-index: 2;
        display: inline;
        font-weight: 600;
        padding: .8rem 1.5rem;
        background: #edf0f5;
        border-radius: 4px;
        border: 1px solid #edf0f5 !important;
        margin-right: 0.5rem;
        display: -webkit-inline-box;
        margin-top: 10px;
    }

    .list-group-item:hover {
        border-color: transparent !important;
        color: #337ab7 !important;
    }

    .list-group-item.active {
        /* box-shadow: 10px 10px 51px 0px #011a31ad !important; */
    }

    .list-group-item.active:hover {
        z-index: 2 !important;
        color: #fff !important;
        background-color: #337ab7 !important;
        border-color: #337ab7 !important;
        box-shadow: none !important;
    }

    .nav-tabs {
        text-align: center;
    }

    .tab-content {
        padding: 15px;
        border: none;
        background: none !important;
        /*min-height: 600px;*/
    }

    .panel-heading h2 {
        margin: 0;
        font-size: 1.1rem;
        padding: .95rem 1.25rem;
        font-weight: 500;
        color: #000 !important;
    }
    /*.panel-heading h2:hover {
        color: #337ab7 !important;
    }*/


    .panel-body span {
        font-size: 11pt !important;
        font-weight:bold;
        color: #3584ee;
    }
    .panel-body span.more-times {
       color: #2F80ED !important;
       font-weight:bold !important;
    }
       /*.el-body span {
       font-size: 11pt !important;
       font-weight: 600;
       color: #10bfe4;
   }*/
    .panel-body span.less-times {
        color: #2F80ED !important;
        font-weight:bold !important;
    }

    .panel-group .panel-heading {
        padding: 0;
        background: #f4f4f5;
        border-color: #e6eaf1;
    }

    .panel-group .panel {
        margin-bottom: 20px;
        box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.09);
        border: none;
    }
/*

    .tab-content ul li:before {
        content: "\f00c";
        font-family: 'FontAwesome';
        font-size: 17px;
        color: #51ac37;
        float: left;
        margin-left: -35px;
        font-weight: 900;
    }
*/


    @media screen and (min-width:320px) and (max-width:767px) {
        .list-group-item {
            display: block;
            padding: .8rem 1.5rem;
            background: #edf0f5;
            border-radius: 4px;
            border: 1px solid #edf0f5 !important;
            margin: 10px 10px;
        }

        .panel-body {
            padding: 15px 15px;
        }

        .title.d-flex.border-bottom > h3 {
            text-align: center;
        }

        .reating_area.d-flex {
            margin-left: 61px;
        }
    }

    @media screen and (min-width:768px) and (max-width:1000px) {
        .list-group-item {
            z-index: 2;
            display: inline-block;
            font-weight: 600;
            padding: .8rem 1.5rem;
            background: #edf0f5;
            border-radius: 4px;
            border: 1px solid #edf0f5 !important;
            margin-right: 0;
            margin-top: 20px;
        }
    }

    /*--------------------------------------------------------------
    # Tab Nav Css
    --------------------------------------------------------------*/




    /*##################################################*/
    /*######### COTNACT US BLADE INLINE STYLES #############*/
    /*##################################################*/
    .layer-overlay::before {
        background: linear-gradient(to right,#063248,#156e9b) !important;
    }
    .inner-header h2{
        color:#fff !important;
    }
    .toast-top-right {
        top: 120px !important;
        right: 12px;
    }

    .error {
        color: red;
    }
    .inner-header h2,
    .section-title h2,
    .cn-info-title,
    .cn-info-title p,
    .cn-info-content,
    #contact-details .prc_wrap h2,
    #contact-details .prc_wrap p,
    #btn-submit a
    {
        font-family: 'Poppins',sans-serif;
    }
    .text-colored2{
        color: rgb(81, 172, 55) !important;
    }

    /*--------------------------------------------------------------
    # Contact Us form & Details
    --------------------------------------------------------------*/

    .prc_wrap {
        display: inline-block;
        width: 100%;
        background: rgba(255, 255, 255, 0.34);
        margin-bottom: 30px;
        height: 100%;
        padding:20px 30px;
        border-radius: 0px;
        /*border-top: 1px solid #156e9b;*/
        /*border-bottom: 1px solid #156e9b;*/
        /*box-shadow: 2px 2px 6px 3px rgb(213 213 216);*/
        min-height:450px;
    }

    .cn-info-detail {
        position: relative;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
    }

    .cn-info-icon {
        float: left;
        display: inline-block;
        width: 50px;
        height: 50px;
        margin-right: 20px;text-align:center;
    }

    .cn-info-title {
        font-size: 15px;
        margin-bottom: 2px;
        line-height: 26px;
    }

    .contact .cn-info-icon i {
        font-size: 26px;
        color: rgb(81, 172, 55);
        border-radius: 50%;
        padding: 8px;
        border: 2px dotted rgb(81, 172, 55);
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .contact .cn-info-icon i:hover{
        background:rgb(81, 172, 55);
        color: rgb(255, 255, 255);
    }

    .contact .cn-info-content,
    .contact .cn-info-content a
    {
        color: #647b9c;
        font-size:14px;
        font-weight:500
    }

    #contact-details .prc_wrap{
        padding: 20px;
    }
    .marketing__header1 {
        min-height: 585px;
    }
    .mobile_img {
        display: none;
    }

    .contact-us-map{
        border-radius:0px;
    }
    .map-section{padding: 0px;}
    .map-section .row{margin: 0px !important;}
    .map-section .row .col-md-12{padding: 0px !important;}
    .contact .form-control {
        border: 2px solid #0242671f;
    }

    /*--------------------------------------------------------------
    # Button Css
    --------------------------------------------------------------*/

    /*#btn-submit a{*/
    /*    display: block;*/
    /*    width: 300px;*/
    /*    height: 40px;*/
    /*    line-height: 40px;*/
    /*    font-size: 15px;*/
    /*    font-family: sans-serif;*/
    /*    text-decoration: none;*/
    /*    color: #156e9b;*/
    /*    border: 2px solid #156e9b;*/
    /*    letter-spacing: 2px;*/
    /*    text-align: center;*/
    /*    position: relative;*/
    /*    transition: all .35s;*/
    /*    font-family: 'Poppins',sans-serif !important;*/
    /*    cursor: pointer;*/
    /*}*/

    /*#btn-submit a span{*/
    /*    position: relative;*/
    /*    z-index: 2;*/
    /*}*/

    /*#btn-submit a:after{*/
    /*    position: absolute;*/
    /*    content: "";*/
    /*    top: 0;*/
    /*    left: 0;*/
    /*    width: 0;*/
    /*    height: 100%;*/
    /*    background: rgb(81, 172, 55);*/
    /*    transition: all .35s;*/
    /*}*/

    /*#btn-submit a:hover{*/
    /*    color: #fff;*/
    /*    border: 2px solid rgb(81, 172, 55);*/
    /*}*/

    /*#btn-submit a:hover:after{*/
    /*    width: 100%;*/
    /*}*/


    /*--------------------------------------------------------------
    # Contact
    --------------------------------------------------------------*/
    .contact .info-box {
        color: #444444;
        text-align: center;
        box-shadow: 0 0 30px rgba(214, 215, 216, 0.3);
        padding: 20px 0 30px 0;
    }
    .contact .info-box h3 {
        font-size: 20px;
        color: #777777;
        font-weight: 700;
        margin: 10px 0;
    }

    .contact .info-box p {
        padding: 0;
        line-height: 24px;
        font-size: 14px;
        margin-bottom: 0;
    }

    .contact .php-email-form {
        /*box-shadow: 0 0 30px rgba(214, 215, 216, 0.4);*/
        /*padding:0 10px;*/
    }

    .contact .php-email-form .validate {
        display: none;
        color: red;
        margin: 0 0 15px 0;
        font-weight: 400;
        font-size: 13px;
    }

    .contact .php-email-form .error-message {
        display: none;
        color: #fff;
        background: #ed3c0d;
        text-align: left;
        padding: 15px;
        font-weight: 600;
    }

    .contact .php-email-form .error-message br+br {
        margin-top: 25px;
    }

    .contact .php-email-form .sent-message {
        display: none;
        color: #fff;
        background: #18d26e;
        text-align: center;
        padding: 15px;
        font-weight: 600;
    }

    .contact .php-email-form .loading {
        display: none;
        background: #fff;
        text-align: center;
        padding: 15px;
    }

    .contact .php-email-form .loading:before {
        content: "";
        display: inline-block;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        margin: 0 10px -6px 0;
        border: 3px solid #18d26e;
        border-top-color: #eee;
        -webkit-animation: animate-loading 1s linear infinite;
        animation: animate-loading 1s linear infinite;
    }

    .contact .php-email-form input,
    .contact .php-email-form textarea {
        border-radius: 0;
        box-shadow: none;
        font-size: 14px;
    }

    .contact .php-email-form input:focus,
    .contact .php-email-form textarea:focus {
        border-color: #106eea;
    }

    .contact .php-email-form input {padding: 20px 15px;}
    .contact .php-email-form input.form-check-input {padding:0 !important;width:13px !important;height:13px !important;}

    .contact .php-email-form textarea {
        padding: 12px 15px;
    }

    .contact .php-email-form button[type="submit"] {
        background: #106eea;
        border: 0;
        padding: 10px 30px;
        color: #fff;
        transition: 0.4s;
        border-radius: 4px;
    }

    .contact .php-email-form button[type="submit"]:hover {
        background: #3b8af2;
    }

    /*---- Reponsive media query -----*/
    @media screen and (min-width:320px) and (max-width:991px) {
        .registration-area:before {
            width: 100%;max-height: 300px;left: unset;bottom: unset;top: 0;
        }
        .registration-area:after {
            width: 100%;max-height: 300px; right: unset;top: unset;
        }
    }
    @media screen and (min-width:320px) and (max-width:767px) {
        .prc_wrap {
            padding: 30px 10px;
        }
        #btn-submit a {
            width:100%;
        }
        .form-control {
            height:49px !important;
        }
    }



    /*##################################################*/
    /*######### ABOUT US BLADE INLINE STYLES #############*/
    /*##################################################*/
    .about .d-flex {
        display: initial;
    }
    .layer-overlay::before {
        background: linear-gradient(to right,#063248,#156e9b) !important;
    }
    .text-theme-colored2 {
        color: rgb(81, 172, 55) !important;
    }
    .text-colored2{
        color: rgb(81, 172, 55) !important;
    }
    .about h2,
    .about h4,
    .who-we-are h2,
    .why-choose-us h2,
    .mission h2,
    .inner-header h2
    {
        font-family: 'Poppins',sans-serif;
    }
    .inner-header h2{
        color:#fff !important;
    }
    .about p,
    .who-we-are p,
    .why-choose-us p,
    .mission p{
        line-height:1.8;
        color:#555;
        font-weight:400;
        font-family: 'Poppins',sans-serif;
    }
    .why-choose-us p{
        line-height:1.5 !important;
        padding-left: 30px;
    }

    /*.why-choose-us p::before{*/
    /*    font-family: Font Awesome \ 5 Brands;*/
    /*    font-weight: 900;*/
    /*    color: #51ac37;*/
    /*    content: "\f058";*/
    /*    font-size: 17px;*/
    /*    position: absolute;*/
    /*    left: 0;*/
    /*    padding-left: 20px;*/
    /*}*/
    .why-choose-us i{
        font-weight: 900;
        color: #51ac37;
        font-size: 17px;
        position: absolute;
        left: 0;
        padding-left: 20px;
    }
    .video-box-overlay{background:black;border-radius: 10px;}
    .video-box-overlay .img-fullwidth {border-radius: 10px;}
    .video-box img{opacity: 0.9;z-index:-1;box-shadow: 10px 10px 67px -24px rgba(191,191,191,1);}
    #video-play-btn{
        font-size: 40px;z-index: 2;top: 50%;left: 50%;position: absolute;
        transform: translate(-50%, -50%);color: white;
    }
    #video-play-btn:hover{font-size: 60px;transition:0.2s;}
    @media screen and (max-width: 1000px) and (min-width: 768px){
        .col-sm-push-6 {
            left: 0 !important;
        }
        .col-sm-pull-6 {
            right: 0 !important;
        }

    }

    @media screen and (min-color-index:0) and(-webkit-min-device-pixel-ratio:0) {
        @media {
            /*#about .col-md-6 {
                flex: 0 0 45% !important;
                max-width: 45% !important;
            }*/
        }
    }
    @media not all and (min-resolution:.001dpcm) {
        @media {
            /*.col-md-6 {
                flex: 0 0 45% !important;
                max-width: 45% !important;
            }*/
        }
        @media screen and (min-width: 320px) and (max-width: 767px) {
            .col-md-6 {
                flex: 0 0 100% !important;
                max-width: 100% !important;
            }
        }
    }

    /*##################################################*/
    /*######### LOGIN BLADE INLINE STYLES #############*/
    /*##################################################*/
    .d-flex, .desktop__nav .header__logo, .share-and-gift{
        display: flex;
        display: -webkit-flex;
        /*display: -webkit-box;*/
        display: -moz-flex;
        display: -moz-box;
        display: -ms-flexbox;
    }

    .login-form {
        background-color: #fff;
        padding: 0 !important;
        border-radius: 8px;
        overflow: hidden;
    }

    .login-form .header__logo {
        padding: 15px;
        background-color: #f7f7f7; width:100%; display:inline-block;text-align:center;
    }

    .login-form .nav-tabs > li a {
        font-size: 16px;border-radius:0;
    }

    .login-form .nav-tabs > li.active a {
        color: #000 !important;
        background-color: #2098d124;
    }

    .login-form .nav-tabs.nav-justified > .active > a, .login-form .nav-tabs.nav-justified > .active > a:focus, .login-form .nav-tabs.nav-justified > .active > a:hover {
        border-bottom-color: #fff !important;
        border-top-color: #fff !important;
    }

    .login-form .nav-tabs.nav-justified > .active > a, .login-form .nav-tabs.nav-justified > .active > a:focus, .login-form .nav-tabs.nav-justified > .active > a:hover {
        border: 1px solid #3ec5e8;
    }

    .login-form .tab-content {
        padding: 0;
        border: 0 solid #fff;
        background-color: #fff;
    }

    .social__icons {
        padding: 20px;
    }

    .social__icons a {
        width: 100%;
        display: inline-block;
        padding: 12px 10px;
        color: #fff;
        position: relative;
        text-align: center;
        border-radius: 4px;
        text-transform: uppercase;
    }

    .social__icons a i.fa {
        width: 30px;
        height: 30px;
        text-align: center;
        background-color: #fff;
        line-height: 30px;
        border-radius: 4px;
        position: absolute;
        left: 10px;
        top: 9px;
    }

    .social__icons .facebook__btn {
        background-color: #3c5997;
        margin: 5px 5px 5px 0;
    }

    .social__icons .facebook__btn i {
        color: #3c5997;
    }

    .social__icons .google__btn {
        background-color: #4185f4;
        margin: 5px 0 5px 5px;
    }

    .social__icons .google__btn i {
        color: #4185f4;
    }

    .or_div {
        display: inline-block;
        width: 100%;
        padding: 0 0 20px;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .or_div span {
        background-color: #fff;
        padding: 0 10px;
    }

    .or_div:after {
        content: '';
        position: absolute;
        top: 28%;
        left: 5%;
        background-color: rgba(0, 0, 0, 0.10);
        width: 90%;
        height: 1px;
        z-index: -1;
    }

    .form-div {
        margin-bottom: 0 !important;
    }

    .form-div .form-group {
    }

    .form-div .form-group label, .form-div .form-group .form-control {
        font-size: 13px;
    }

    .row.row-sm-padding {
        margin-left: -5px;
        margin-right: -5px;
    }

    .row-sm-padding > [class*="col-"] {
        padding-left: 5px !important;
        padding-right: 5px !important;
    }

    .btns__form {
        font-size: 18px;
        text-transform: uppercase;
        padding: 15px 20px;
    }

    .paypalDiv {
        margin: 10% 0;
    }

    .course-box{position:relative;}
    .course-box .header__btns{
        position: absolute;top: 5px;right: 5px;z-index: 9; line-height:25px;width: 25px;height: 25px;
        background: rgb(255 255 255 / 72%);border-radius: 2rem;text-align: center;
    }
    .related_courses .blog-item .post-thumb img{
        width:100% !important;max-width:100% !important;
    }


    .top__searchSec{padding:110px 0 100px;background-size:cover;/*background-position:-240px 0 !important;*/}
    .top__searchSec h2{font-size:60px;}

    /*.home_page_Clogo.clients-logo .item {padding:5px;display: inline-block;}
    .home_page_Clogo.clients-logo img {max-height: 80px;opacity:1;}*/

    .mainAbout__section h2.title{font-size: 50px;line-height: 55px;}
    .mainAbout__section p{font-size: 16px;line-height: 36px;padding-top: 14px;}

    .categories_tabs ul.nav-tabs{width:100%;border-bottom: rgba(0, 0, 0, 0.18) solid 1px;}
    .categories_tabs ul.nav-tabs li a {padding: 9px 15px;}
    .categories_tabs ul.nav-tabs li.active a{color: #fff;}
    #market_tabs_contents .course-details .title{height:42px !important;margin-bottom:5px;}
    #market_tabs_contents .course-box .course-details .instructors{margin-bottom: 0px;}
    #market_tabs_contents .course-box .course-details .price del{font-size:15px;color:#7a7a7a;}

    #market_tabs_contents .owl-carousel .owl-nav button.owl-prev, #categories_popular.owl-carousel .owl-nav button.owl-prev {
        left: -16px;background: #fff !important; text-align:center;
        box-shadow: -2px 1px 5px rgba(0, 0, 0, 0.35);
        padding:0 !important;width: 45px;height: 45px;line-height: 35px;font-size:28px;border-radius: 20rem;margin-top: 0;
    }
    #market_tabs_contents .owl-carousel .owl-nav button.owl-next, #categories_popular.owl-carousel .owl-nav button.owl-next {
        right: -16px;background: #fff !important; text-align:center;
        box-shadow: -2px 1px 5px rgba(0, 0, 0, 0.35);
        padding:0 !important;width: 45px;height: 45px;line-height: 35px;font-size:28px;border-radius: 20rem;margin-top: 0;
    }

    #categories_popular.owl-carousel .owl-nav button.owl-prev {
        left: -20px;margin-top:-18px !important;
    }
    #categories_popular.owl-carousel .owl-nav button.owl-next {
        right: -20px;margin-top:-18px;
    }
    #categories_popular .catboxes{
        padding: 12px 10px !important;background-color: #fff;color: #a0ce4e;
    }


    .newCategories__style{
        background-color:#f5f5f9;position:relative;
    }
    .newCategories__style:before{
        content:'';
        width:30%;height:100%;
        background-color:#fff;
        position:absolute;left:0;top:0;
    }
    .newCategories__style .container{
        padding-top:0;padding-bottom:0;
    }
    #filter-accordion-7{margin:40px 0;}
    #filter-accordion-7 a{color:#2F80ED;font-size:14px;}

    .newCategories__style .subcats li{
        display:inline-block;
    }
    .newCategories__style .subcats a{
        font-size:14px;font-weight:600;color:#2F80ED;display:flex;
    }
    .newCategories__style .subcats a span{
        padding-left:5px;
    }
   /* .newCategories__style .subcats li a:after{
        content:'/';
        padding:0 8px;display:inline-block;
    }*/
    .newCategories__style .subcats a:hover {
        transform: scale(1) !important;
    }
    .newCategories__style .subcats li:last-child a:after{
        display:none;
    }

    .newCategories__style .breadcrumb > li + li::before {
        display:none;
    }
    .newCategories__style .breadcrumb {
        list-style: none;
    }
    .newCategories__style .breadcrumb > li {
        display: inline-block;
    }
    .newCategories__style .breadcrumb .is-hidden {
        display: none;
    }
    .newCategories__style .breadcrumb-ellipsis {
        display: inline-block;
        font-size: 30px;line-height: 0;margin-right: 6px;
    }
    .newCategories__style .breadcrumb-dropdown {
        display: inline-block;
    }
    .newCategories__style .breadcrumb > li.breadcrumb-ellipsis.is-hidden + li:before {
        display: none;
    }
    .newCategories__style .breadcrumb .breadcrumb-toggle i.caret {
        border-top: 5px dashed;border-top: 5px solid\9;
        border-right: 5px solid transparent;border-left: 5px solid transparent;
    }

    .filter_div{margin-bottom:20px;display:flex;}
    .filter_div .tab_filtr{flex:0 0 30%;max-width:30%;border:#156e9b solid 1px; color:#156e9b;border-radius: 4px;margin-right:10px;text-align:center;font-size:14px;line-height: 43px;}
    .filter_div .form-control{flex:0 0 65%;max-width:65%;}

    .filter_vewArea{}
    .filter_vewArea #filter-accordion-7.panel-group .panel {box-shadow: none;}
    .filter_vewArea #filter-accordion-7.panel-group .panel-heading {background: transparent;border-color: transparent;padding:8px 10px 8px 0;border-bottom: #fff solid 1px;position:relative;}
    .filter_vewArea #filter-accordion-7.panel-group .panel-heading h2 {font-family: 'Open Sans', sans-serif;padding: 0;font-size:16px;font-weight:600;}
    .filter_vewArea #filter-accordion-7.panel-group .panel-heading h2 i{position: absolute;
        top:5px;right:5px;font-size:14px;
        color: rgb(36, 63, 77);width:30px;height:30px;line-height:30px;text-align: center;cursor: pointer;z-index: 1;transition: all 500ms ease 0s;}
    .filter_vewArea #filter-accordion-7.panel-group .panel-heading small{color:#7c7c7c;}
    .filter_vewArea #filter-accordion-7.panel-group a.active .panel-heading{background-color: rgba(21, 110, 155, 0.00) !important;}
    .filter_vewArea #filter-accordion-7.panel-group a.active .panel-heading h2 i{
        color: rgb(0, 0, 0);background: rgba(21, 110, 155, 0.05);
        transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
        -moz-transform: rotate(-180deg);
        -ms-transform: rotate(-180deg);
        -o-transform: rotate(-180deg);
    }

    .filter_vewArea #filter-accordion-7.panel-group .form-check {position:relative;margin-bottom:10px;}
    .filter_vewArea #filter-accordion-7.panel-group .form-check .form-check-input{position:absolute;left:-15px;top:2px;width:15px;height:15px;}
    .filter_vewArea #filter-accordion-7.panel-group .form-check .form-check-label{cursor: pointer;font-size:14px;color:#000;padding-left:10px;font-weight:500;}
    .filter_vewArea #filter-accordion-7.panel-group .form-check .form-check-label small{
        color: #73726c;
        font-size: 13px;}
    .filter_vewArea #filter-accordion-7.panel-group .form-check .form-check-label .rating{display:inline-block;margin-right:5px;}

    .filter_vewArea #filter-accordion-7.panel-group .form-check:last-child{margin-bottom:0 !important;}
    .filter_vewArea #filter-accordion-7.panel-group .panel .panel-body{padding-bottom:0 !important;}

    #featured_courseSlider{
        margin-top:24px;
        display:block !important;
        width:100%;
        margin-bottom:40px;
    }


    .courseSlider_info .left_col{
        position:relative;
        flex: 0 0 35%;
        max-width: 35%;
        border-top-left-radius:6px;
        border-bottom-left-radius:6px; overflow:hidden;background-color: #eaeaea;vertical-align:middle;
    }
    .courseSlider_info .left_col .tagDiv{
        background-color:#FF4848;font-size:14px;font-weight:600;color:#fff;
        position:absolute;right:0;top:0;padding:5px 12px;
    }
    .courseSlider_info .left_col img{
        object-fit:cover; margin-top:10px;
    }
    .courseSlider_info .right_col {
        background-color:#FCA241; color:#fff;
        padding:20px;
        border-top-right-radius:6px;
        border-bottom-right-radius:6px;
    }
    .courseSlider_info .right_col h4 {
        font-size:20px;margin:0;padding:0;line-height:20px;color:#fff;
    }
    .courseSlider_info .right_col small {
        font-size:12px;color:#FFDDB8;font-weight:600;line-height:14px;
    }
    .courseSlider_info .right_col .col-md-5 {
        text-align:right;
    }
    .courseSlider_info .right_col .rating{line-height:18px;}
    .courseSlider_info .right_col .rating span {
        font-size:16px;font-weight:600;
    }
    .courseSlider_info .right_col .rating i{font-size:15px;color:#FFDDB8;}
    .courseSlider_info .right_col .rating span:first-child, .courseSlider_info .right_col .rating .filled {
        color:#FCE941;
    }
    .courseSlider_info .right_col .rating span:first-child{
        padding-right:6px;padding-top:1px;
    }
    .courseSlider_info .right_col .rating span:last-child{
        padding-left:6px;
    }
    .courseSlider_info .right_col h3{
        font-size: 24px;margin: 0;
        padding: 12px 0 5px;line-height: 28px;color: #fff;
    }
    .courseSlider_info .right_col p{
        font-size:14px;font-weight:400;
    }
    .courseSlider_info .right_col ul li{
        font-size:12px;font-weight:400;
    }
    .courseSlider_info .right_col ul li:after{
        content:'|';
        padding:0 10px;
    }
    .courseSlider_info .right_col ul li:last-child:after{
        display:none;
    }

    #featured_courseSlider .owl-nav button {
        width: 36px;height:36px;
        border-radius:100%;
        margin: 0; background-color:#ECECEC !important;
        font-size: 34px !important;line-height: 0;padding: 0 !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    #featured_courseSlider .owl-nav button span {
        line-height: 15px !important;
        margin-top: -4px;
        display: inline-block;
    }
    #featured_courseSlider .owl-nav button.owl-prev {
        margin-left:10px;
    }
    #featured_courseSlider .owl-nav button.owl-next {
        margin-right:10px;
    }

    .newCategories__style .new_tbs{
        text-align:center;
        margin-top: 30px;
    }
    .newCategories__style .new_tbs li {
        display: inline-block;
        float: none;
        padding: 0 3px;
    }
    .newCategories__style .new_tbs li a {
        background-color: #fff !important;
        border-radius: 5px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 8px 15px;font-size: 12px;font-weight: 600;line-height:16px;
        border:1px solid #fff;
    }
    .newCategories__style .new_tbs > li > a:hover, .newCategories__style .new_tbs > li.active > a {
        color: #fff !important;
        border:1px solid #045F8C !important;
        background-color:#045F8C !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
    }

    .newCourse{
        width:100%;position:relative;background: #FFFFFF;
        box-shadow:0 4px 12px rgba(0, 0, 0, 0.05);
        border-radius:6px;margin-top:20px;margin-bottom:10px;border:none;
    }
    .newCourse .header__btns {
        position: absolute;
        top: 5px;
        right: 5px;
        z-index: 9;
        line-height: 25px;
        width: 25px;
        height: 25px;
        background: rgb(255 255 255 / 72%);
        border-radius: 2rem;
        text-align: center;
    }
    .course-image img{
        height:180px;
        border-top-left-radius:5px;
        border-top-right-radius:5px;
    }
    .newCourse .course-details{padding:10px; border-bottom-left-radius:6px; border-bottom-right-radius:6px;}
    .newCourse .course-details .title{
        font-size:16px;font-weight:700;color:#353535;line-height:24px;
        display: block;
        display: -webkit-box;
        -webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;
        text-overflow: ellipsis;--max-lines: 2;
        height: 46px;
    }
    .newCourse .h__mid{height:28px;padding-top:5px !important; }
    .newCourse .d-flex{
        padding-top:10px;
        -webkit-box-pack: justify;
        -webkit-justify-content: space-between;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }
    .newCourse .user-count{
        font-size:13px;font-weight:400;
        color:#7C7C7C;
    }
    .newCourse .d-flex.h__footer{height:38px;overflow:hidden;}
    .newCourse .price{
        color:#7C7C7C;font-size:18px;font-weight:700;line-height:24px;
    }
    .newCourse .price del{
        color:#949393;font-size:13px;font-weight:600; margin-right: 2px;
    }
    .newCourse .btn {
        background-color: #84BA3F;
        border-color: #84BA3F;
        font-size: 12px;
        font-weight: 600;
        border-radius: 3px;
        text-transform: uppercase;
        padding: 5px 8px;
        line-height: 15px;
        height: 27px;
    }
    .newCategories__style .loadMore_btn{
        width:150px !important;height:30px;font-size:13px;
        background: #045F8C;border-color:#045F8C;
        border-radius:6px !important;line-height:12px;
    }
    .review_content{
        background: #FFFFFF; padding:25px; margin-top:35px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.05);
        border-radius: 5px;
    }
    .review_content .title{
        -webkit-box-pack: justify;
        -webkit-justify-content: space-between;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }
    .review_content .title h3{font-size:20px;color:#000;margin-top:0;display:inline-block;}
    .review_content .reating_area{font-size:14px;color:#7C7C7C;}
    .review_content .reating_area .count{color:#FCA241;font-weight:600;}
    .review_content .reating_area .rating{margin:0 5px;}
    .review_content .reating_area span{padding-right:5px;}
    .review_content .reating_area strong{color:#000;padding-right:5px;}
    .review_content iframe{
        /*height:auto !important;*/
        min-height:180px;
    }

    .company_trustConent{
        width:100%; text-align:center;
        display:inline-block;
        background-color:#000;border-radius:6px !important;
        background-size:cover;background-repeat:no-repeat;
    }
    .company_trustConent .adv-banner-title{color:#fff;font-size: 24px;font-weight: 800;letter-spacing: 1px;}
    .company_trustConent .adv-banner-content{color:#fff;font-weight: 400;font-size: 16px;letter-spacing: 1px;}
    .company_trustConent .adv-top-companies img{height:auto !important;
        -webkit-filter: grayscale(0) !important;filter:initial !important;filter: grayscale(0) !important;
    }
    .adv-top-companies>*:hover {
        -webkit-filter: grayscale(0) !important;filter:initial !important;filter: grayscale(0) !important;
    }
    .company_trustConent .btn-outline-primary{
        background: #84BA3F;border-color:#84BA3F;font-size:12px;
        border-radius:6px !important;
    }

    .company_trustConent .adv-top-companies a{
        position:relative;
        margin:1.1rem 1.8rem 1.5rem 0 !important;display: inline-block;
    }
    .company_trustConent .adv-top-companies a .hover{
        opacity:0;
        position:absolute;left:0;top:2px;
        visibility:hidden;z-index: 1;
    }
    .company_trustConent .adv-top-companies a:hover .hover{
        opacity:1;
        visibility:visible;
    }

    .company_trustConent .adv-top-companies a:nth-child(2) .hover{
        top:0 !important;
    }
    .company_trustConent .adv-top-companies a:nth-child(3) .hover{
        top:3px !important;
    }
    .company_trustConent .adv-top-companies a:nth-child(4) .hover{
        top:0 !important;
    }

    .company_trustConent .adv-top-companies>* {
        margin:0 !important;vertical-align:top !important;
    }


    .main_cateTitle{margin-bottom:30px;}
    .main_cateTitle h3{margin-bottom:0 !important;}
    .main_cateTitle p{
        font-size:14px;
        color:#555555;
    }

    .newCategories__style .pagination.cs-pagination nav {
        padding:0 !important;
    }
    .newCategories__style .pagination.cs-pagination nav ul.pagination {
        margin-top:0 !important; margin-bottom:0;
    }

    .list_viewResult{display:flex; width:100%;margin-bottom:15px;position:relative; border-bottom: rgb(0 0 0 / 16%) solid 1px;}
    .list_viewResult .header__btns{position: absolute;top: 5px;left: 5px;z-index: 9; line-height:25px;width: 25px;height: 25px;background: rgb(255 255 255 / 72%);border-radius: 2rem;text-align: center; }
    .list_viewResult .course-image{flex:0 0 25%;max-width:25%;height:180px;margin-bottom:15px;}
    .list_viewResult .course-image img{height:180px;}
    .list_viewResult .course-details{flex:0 0 75%;max-width:75%; padding-left:20px;margin-bottom:15px;}

    .list_viewResult .course-details .price{width:15%;float: right;font-weight: 800;font-size: 16px;text-align:right;line-height: 20px;}
    .list_viewResult .course-details .price del{color:#7c7c7c;font-size:14px;font-weight:600;display:block;}
    .list_viewResult .course-details a.title{width:85%;padding-right:25px;color:#0a0a0a;font-size:16px;font-weight:700;overflow: hidden;text-overflow: ellipsis;white-space: normal;
        height: 36px;line-height:34px;display: -webkit-box!important;-webkit-line-clamp:1;-moz-line-clamp:1;-ms-line-clamp:1;-o-line-clamp:1;line-clamp:1;
    }
    .list_viewResult .course-details p.instructors{font-size: 12px;color: #686f7a;margin-bottom: 5px;}
    .list_viewResult .course-details .rating{font-size:13px;}
    .list_viewResult .course-details p.info {font-size: 13px;color: #4e545c;margin-bottom: 5px;overflow: hidden;text-overflow: ellipsis;-webkit-line-clamp: 2;display: -webkit-box;-webkit-box-orient: vertical;white-space: normal;width:100%;height:40px;line-height:20px;}
    .list_viewResult .course-details .btn{margin-top:8px;}

    .inner__search{width:60%;margin:0 auto;}
    .inner__search .input-group{}
    .inner__search .input-group input,.inner__search .input-group button{height:60px;line-height:60px;vertical-align: middle;padding: 0 15px}
    .inner__search .input-group input{font-size:16px;}
    .inner__search .input-group button{font-size:18px;}


    .ptnr__logos h2.title {font-size: 50px;line-height: 55px;}
    .ptnr__logos p {font-size: 16px;line-height: 36px;padding-top: 14px;}
    .ptnr__logos .partner .item {display: inline-block;padding: 5px 10px;width:100%;}

    .view__cartSummary{
        border: 1px solid #ededed;padding:20px;margin-bottom: 25px;
        -webkit-box-shadow: 0 0 15px 0 rgba(0, 0, 0, .05);-moz-box-shadow: 0 0 15px 0 rgba(0, 0, 0, .05);box-shadow: 0 0 15px 0 rgba(0, 0, 0, .05);
    }
    .view__cartSummary h4{margin-top:0; text-transform:uppercase;}
    .view__cartSummary .table tr th, .view__cartSummary .table tr td{padding:10px 12px !important;}
    .view__cartSummary .table tr td:last-child{text-align:right;}

    /*.inner_pages .container{padding-top:0 !important;padding-bottom:0 !important;}*/

    .section-title{display:inline-block;width:100%;}

    .corporate_section, .instructor_Banner, .inner__header{padding:80px 0;background-size:cover;background-repeat:no-repeat;width:100%;}
    .corporate_section h3, .instructor_Banner h3, .inner__header h3{font-size:48px;font-weight:800;line-height:55px;color:#000;margin-top:0;}
    .corporate_section p, .instructor_Banner p, .inner__header p{font-size:18px;padding-top:16px;}
    .corporate_section a.btn.btn-primary, .corporate__courses a.btn.btn-primary, .corprt_Inform_form .btn.btn-primary{
        min-width:270px;font-size: 18px;font-weight: 600;color: #fff;background-color: #51ac37;border-color: #51ac37;
        text-transform: uppercase;padding: 13px 30px;border-radius: 6px;margin-top: 13px;
    }

    /*.instructor_Banner h3{color:#fff;margin-top:0;text-shadow: 0 0 6px rgb(0 0 0 / 15%);}
    .instructor_Banner p{color:#fff; text-shadow: 0 0 6px rgb(0 0 0 / 20%);}*/

    .corAbout_section h2.title{margin-top:0;margin-bottom:28px;}
    .corAbout_section p{font-size:16px;line-height:32px;margin-bottom:26px;}
    .corAbout_section p:last-child{margin-bottom:0;}
    .corAbout_section img{float:left; margin:0 20px 25px 0;}

    .corporate__courses{}
    .corporate__courses .header__btns i{line-height:25px !important;}

    .corporate_form{display:inline-block;width:100%;}
    .corporate_form p{width:83%;margin:0 auto;font-size:15px;line-height:28px;}
    .corprt_Inform_form .field, .studentId_form .field {display: flex;flex-flow: column-reverse;}
    .corprt_Inform_form label, .corprt_Inform_form input, .corprt_Inform_form select .corprt_Inform_form textarea,
    .studentId_form .field label, .studentId_form .field input, .studentId_form .field select .studentId_form .field textarea {transition: all 0.2s;touch-action: manipulation;}
    .corprt_Inform_form input, .corprt_Inform_form select, .corprt_Inform_form textarea,
    .studentId_form .field input, .studentId_form .field select, .studentId_form .field textarea {
        border:#e8e8e8 solid 1px;
        width:100%;height:50px;font-size:.85rem;-webkit-appearance: none;border-radius: 0;padding:5px 15px;cursor: text;
    }
    .corprt_Inform_form textarea{height:80px;}
    .corprt_Inform_form input:focus, .corprt_Inform_form .field textarea:focus,
    .studentId_form .field input:focus, .studentId_form .field textarea:focus {outline: 0;border:1px solid #a0ce4e;}
    .corprt_Inform_form label{font-size:11px;color:#404040;margin-bottom:0;}
    .corprt_Inform_form label span, .studentId_form .field label span {font-size:11px;color:#FF0000;}
    .studentId_form .labels span, .studentId_form .labels b{color:#FF0000;}
    .studentId_form .labels {font-weight:600;margin-bottom:0 !important;}
    .studentId_form .form-check{margin:5px 0;}
    .studentId_form .form-check label{font-weight:500;}

    .business__logo{padding-bottom:40px;padding-top:40px;}
    /*.business__logo:before, .business__logo:after{
        content:'';
        background-size: cover;background-repeat: no-repeat;width:100%;float:left;
    }*/
    /*.business__logo:before{
        background-image:url(<?=UPLOADS.'images/wave_top.jpg'?>);height:116px;
    }
    .business__logo:after{
        background-image:url(<?=UPLOADS.'images/wave_bottom.jpg'?>);height:144px;display:none;
    }*/
    .business__logo p{font-size:22px;font-weight:600;color:#000;text-align:center;display:inline-block;width:100%;padding:20px 0;}
    .business__logo .img__box{width:100%;min-height:100px;line-height:100px;text-align:center; }

    .client__testimonials .sdnt-box {margin: 15px;padding:35px 35px 30px;background-color: #f4f8fb;display: inline-block;}
    .client__testimonials .sdnt-box .userN {width: 70px;height: 70px;overflow: hidden;border-radius: 50%;margin: 0 auto 15px;}
    .client__testimonials .sdnt-box .userN img {width: 70px;height: 70px;object-fit: cover;}
    .client__testimonials .sdnt-box .userName {
        font-family: 'Raleway', sans-serif;
        font-size: 18px;
        color: #000;
        width: 100%;
        display: inline-block;
        padding:0 0 10px;margin:0 !important;
        font-weight: 700;
        text-transform: uppercase;
    }
    .client__testimonials .sdnt-box p {
        font-size: 15px;
        color: #000;
        width: 100%;
        line-height: 26px;
        display: block;
        display: -webkit-box;
        max-width: 100%;
        height: 156px;
        margin: 0 auto;
        -webkit-line-clamp: 6;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .studentIdBenf.populr_courses:before{display:none;}

    .studentIdBenf .img_Idbenf{text-align:right;margin-top:30px;}
    .studentIdBenf .img_Idbenf img{width:420px;}
    .studentIdBenf ul{}
    .studentIdBenf ul li{font-size:16px;position:relative;padding-left:25px;margin-bottom:12px;}
    .studentIdBenf ul li:before{
        font-family: "Font Awesome 5 Free"; font-weight:600; font-size:15px;content: "\f00c";color:#51ac37;position:absolute;left:3px;top:0;
    }

    .studentId_form{background-color:#f4f8fb;}/* padding:25px 55px; */
    .studentId_form h4{text-transform:uppercase;padding-left: 3%;cursor:pointer;display:inline-block;width:100%;font-size:22px;color:#000;}

    .form-row {
        display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;
        flex-wrap: wrap;margin-right: -15px;margin-left: -15px;
    }
    .spacer-div {
        width: 100%;
        padding: 2% 0;
        background-color: #fff;
    }

    .studentId_form .form-check-inline {
        display: -ms-inline-flexbox;display: inline-flex;-ms-flex-align: center;align-items: center;padding-left: 0;margin-right: .75rem;
    }
    .studentId_form .form-check-label {margin-bottom: 0;}
    .studentId_form .form-check-inline .form-check-input {
        position: static;
        margin-top: 0;margin-right: .3125rem;margin-left: 0;
    }
    .studentId_form input[type=checkbox], .studentId_form input[type=radio] {box-sizing: border-box;padding: 0;}

    .studentId_form .field textarea {height:80px;}

    .studentId_form .btn.btn-primary, #demo-form2 .btn.btn-primary, .gift__form .btn.btn-primary{
        background-color:#51ac37;border-color:#51ac37;font-size:16px;text-transform:uppercase;padding: 13px 20px;
    }

    .check__out label,.check__out button {
        display: inline-block;
    }
    .check__out label {
        width: 70%;
        padding-top: 2%;
    }

    #myModalinstructor h4{text-transform:uppercase;display:inline-block;width:100%;font-size:22px;color:#000;}
    #myModalinstructor button.close{position:absolute;top:5px;right:5px;}

    .new__formStyle .field input[type=file]{
        padding-top:13px;
    }

    /*Equel Form Style ___ New Style*/
    .new__formStyle label, .new__formStyle input, .new__formStyle select{
        transition: all 0.2s;touch-action: manipulation;
        -webkit-transition: all 0.2s;-moz-transition: all 0.2s;-o-transition: all 0.2s;
    }
    .new__formStyle textarea{
        transition: all 0.2s;touch-action: manipulation;
        -webkit-transition: all 0.2s;-moz-transition: all 0.2s;-o-transition: all 0.2s;
    }
    .new__formStyle .field {display: flex;flex-flow: column-reverse;}
    .new__formStyle .field input, .new__formStyle .field select, .new__formStyle .field textarea{
        border:#e8e8e8 solid 1px;width:100%;height:50px;font-size:.85rem;-webkit-appearance: none;border-radius: 0;padding:5px 15px;cursor: text;
        color:#000;
    }
    .new__formStyle .field select{background-color:transparent;cursor: pointer;font-size:14px;}
    .new__formStyle .field textarea{height:80px;}
    .new__formStyle .field input:focus, .new__formStyle .field textarea:focus{outline: 0;border:1px solid #a0ce4e;}
    .new__formStyle .field label{font-size:11px;color:#404040;margin-bottom:0;}
    .new__formStyle label span{font-size:11px;color:#FF0000;}
    .new__formStyle label b{color:#FF0000;}

    .new__formStyle .form-group{margin-bottom:10px;}

    .field input:placeholder-shown + label{
        cursor: text; padding:0 15px;max-width: 66.66%;white-space:nowrap;overflow: hidden;
        text-overflow: ellipsis;
        transform-origin: left bottom;
        transform: translate(0, 2.425rem) scale(1.4);
        -webkit-transition: translate(0, 2.425rem) scale(1.4);
        -moz-transition: translate(0, 2.425rem) scale(1.4);
        -o-transition: translate(0, 2.425rem) scale(1.4);
    }
    .field select:placeholder-shown + label{
        cursor: text; padding:0 15px;max-width: 66.66%;white-space:nowrap;overflow: hidden;
        text-overflow: ellipsis;
        transform-origin: left bottom;transform: translate(0, 2.425rem) scale(1.4);
    }
    .field input::-webkit-input-placeholder{
        opacity: 0;transition: inherit;
    }

    .field input::-moz-placeholder, .field input[type="text"]::-moz-placeholder, .field input[type="email"]::-moz-placeholder,.field input[type="tel"]::-moz-placeholder,
    .field input[type="number"]::-moz-placeholder{
        opacity: 0;transition: inherit;
    }
    .field input:focus::-moz-placeholder{
        opacity: 1;
    }
    .field input:focus::-webkit-input-placeholder{
        opacity: 1;
    }

    .field textarea:placeholder-shown + label {
        cursor: text; padding:0 15px;max-width: 66.66%;white-space:nowrap;overflow: hidden;
        text-overflow: ellipsis;
        transform-origin: left bottom;
        transform: translate(0, 2.425rem) scale(1.4);
        -webkit-transition: translate(0, 2.425rem) scale(1.4);
        -moz-transition: translate(0, 2.425rem) scale(1.4);
        -o-transition: translate(0, 2.425rem) scale(1.4);
    }
    .field textarea::-webkit-input-placeholder {
        opacity: 0;transition: inherit;
    }
    .field textarea::-moz-placeholder{
        opacity: 0;transition: inherit;
    }
    .field textarea:focus::-moz-placeholder {
        opacity: 1;
    }
    .field textarea:focus::-webkit-input-placeholder {
        opacity: 1;
    }

    .field input:not(:placeholder-shown) + label, .field input:focus + label{
        padding:0;transform: translate(0, 0) scale(1);cursor: pointer;
    }
    .field textarea:not(:placeholder-shown) + label, .field textarea:focus + label {
        padding:0;transform: translate(0, 0) scale(1);cursor: pointer;
    }
    .a-colour {
        color: rgb(81, 172, 55);
    }

    #card_price {
        color: #000 !important;
    }
    .basicInfo, .shipInfo, .billInfo {
        background-color: #fff;
        border-left: 1px solid #f4f8fb;
        border-right: 1px solid #f4f8fb;
        border-bottom: 1px solid #f4f8fb;
        width: 100%;
        margin-left: 0%;
        padding-top: 3%;
    }

    .related_courses .btn.btn-dark.btn-theme-colored2{
        margin:0 auto;
    }

    .angle-position {
        float: right;
        margin-right: 4%;
        margin-top: 1%;
    }

    .new__formStyle .field.select_div{position:relative;z-index:9;}
    .new__formStyle .field.select_div:before{
        font-family: "Font Awesome 5 Free"; font-weight:600; font-size:16px;content:"\f107";color:#333;position:absolute;right:11px;top:13px;z-index:-1;
    }

    .theme-btn {
        position: relative; background-color:#51ac37;
        display: inline-block;cursor: pointer;border-radius: 5px;z-index: 1;transition: all 500ms ease;
    }
    .theme-btn:focus {background-color:#51ac37;}
    .theme-btn:hover:before {
        -webkit-transform: scaleX(1);
        transform: scaleX(1);
        -webkit-transition-timing-function: cubic-bezier(.52,1.64,.37,.66);
        transition-timing-function: cubic-bezier(.52,1.64,.37,.66);
    }
    .theme-btn:before {
        position: absolute;
        content: '';
        background: #045f8c;
        width: 100%;
        height: 100%;
        border-radius: 5px;
        z-index: -1;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        -webkit-transform: scaleX(0);
        transform: scaleX(0);
        -webkit-transform-origin: 50% 100%;
        transform-origin: 50% 100%;
        -webkit-transition-property: transform;
        transition-property: transform;
        -webkit-transition-duration: 0.5s;
        transition-duration: 0.5s;
        -webkit-transition-timing-function: ease-out;
        transition-timing-function: ease-out;
    }

    .new__formStyle .form-check{position: relative;padding-left:26px;cursor: pointer;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;}
    .new__formStyle .form-check input {position: absolute;opacity: 0;cursor: pointer;width:0;height:0;margin:0;}
    .new__formStyle .form-check .checkmark {
        position: absolute;top:5px;left: 0;height:15px;width: 15px;
        background-color: #fff;border-radius: 50%;border:#51ac37 solid 1px;
    }
    .new__formStyle .form-check:hover input ~ .checkmark {background-color: #fff;}
    .new__formStyle .form-check input:checked ~ .checkmark {
        background-color: #51ac37;
    }
    .new__formStyle .form-check .checkmark:after {
        content: "";position: absolute;display: none;
    }
    .new__formStyle .form-check input:checked ~ .checkmark:after {
        display: block;
    }
    .new__formStyle .form-check .checkmark:after {
        top: 3px;left: 3px;width: 7px;height: 7px;
        border-radius: 50%;background: white;
    }
    .new__formStyle .browsSty{border:#51ac37 dashed 1px;font-size:13px;margin-top:10px;}
    .new__formStyle .browsSty input{padding:10px;}

    .checks_div label{position:relative;padding-left:20px;}
    .checks_div label input{position:absolute;left:0;top:2px;}


    /*End Equel Form Style ___ New Style*/

    .terms__condition.populr_courses:after{display:none !important;}

    .scrollbar {height: 305px;width:100%;overflow-y: scroll;}
    .force-overflow {min-height: 305px;}
    .style-4::-webkit-scrollbar-track {-webkit-box-shadow: inset 0 0 0 rgba(0,0,0,0.3);background-color: #f5f5f9; border-radius:20px;}
    .style-4::-webkit-scrollbar {width:15px;border-radius:20px;background-color: #f5f5f9;}
    .style-4::-webkit-scrollbar-thumb {border-radius:20px;background-color: #146793;}

    .terms__condition .term_content{padding-right:25px; height:300px;}
    .terms__condition ul{}
    .terms__condition ul li{font-size:14px;color: #1f1e1e;padding-bottom:10px;line-height:24px;}
    .terms__condition ul li ul{margin-top:10px;padding-left:20px;}

    .categories-section .overlay-shade{background-color: rgb(0 0 0 / 10%);}
    .categories-section .single-course-thumb .course-info{transform: translate(0, -50%);margin: 0;}


    .testimonial__Section{display:inline-block;width:100%;padding:60px 0;}
    /*.testimonial__Section:before {background-image:url(<?=UPLOADS.'images/wave_bottom.jpg'?>);height: 144px;}
    .testimonial__Section:after {background-image:url(<?=UPLOADS.'images/wave_top.jpg'?>);height: 116px;}
    .testimonial__Section:before, .testimonial__Section:after {content: '';background-size: cover;background-repeat: no-repeat;width: 100%;float: left;}*/
    .testimonial__request .rating__mark .lable_r{font-size:24px;color:#404040;font-weight:700;padding-top:10px;}
    .testimonial__request p{font-family: "Raleway", sans-serif; font-size:14px;font-weight:600;font-style:italic; padding-top:10px;}
    .testimonial__request p span, .testimonial__request p a{color:#51ac37;}
    .testimonial__request .theme-btn{font-size:18px;padding:12px 10px; margin-bottom:35px;}

    .testimonial__request .rating {margin:10px auto 28px;}
    .testimonial__request .rating small {display:block;font-weight:600;}
    .testimonial__request .rating i{color:inherit !important;font-size:48px;}
    .testimonial__request .rating {direction: rtl;unicode-bidi: bidi-override;color: #989898; /* Personal choice */}
    .testimonial__request .rating input {display: none;}
    .testimonial__request .rating label{padding:0 5px; cursor:pointer;width:20%;float:right;}
    .testimonial__request .rating label:hover,
    .testimonial__request .rating label:hover ~ label,
    .testimonial__request .rating input:checked + label,
    .testimonial__request .rating input:checked + label ~ label {
        color: #ffc107 !important; /* Personal color choice. Lifted from Bootstrap 4 */
    }
    .testimonial__request .rating label:hover i,
    .testimonial__request .rating label:hover ~ label i,
    .testimonial__request .rating input:checked + label i,
    .testimonial__request .rating input:checked + label ~ label i {
        font-weight:700;
    }

    .input_fileBox{text-align:center;background-color:#f9f9f9; width:100%;height:220px;display:inline-block;border:#51ac37 dashed 1px;}

    footer .paymentInfo img{display:inline-block;width:120px;}
    .main__testi .testi-item {display: inline-block;padding:15px 25px; background-color:#f5f5f5; border-radius:4px;    min-height: 225px;}
    .main__testi .testi-item .user-info {padding-left: 10px;padding-top: 10px;}
    .main__testi .testi-item .desc {padding-left: 10px;font-size: 15px;font-style:normal;}

    .new__pgfrmstyle{background-color:#f5f5f5;}
    .new__pgfrmstyle .btn.theme-btn{padding:12px 10px;}

    .apply-coupon input{height:45px !important;font-size: 15px;}
    .apply-coupon button{margin:0 !important;width:100%;height:45px;font-size: 15px;}

    .blog__header .container, .popular-BlogSection.populr_courses .container,
    .blog_bodySection .container, .blog_detailHeader .container, .artical_blogDetail .container{
        padding-top:0;padding-bottom:0;
    }

    .popular-BlogSection h2.sectiontitle, .blog_detailHeader h2, .widget .widget-title, .lstPost-widget .post.media-post .post-right h5.post-title a,
    .subscribe-widget,.subscribe-widget h2, .blog_postColmn h3.post-title, .artical_blogDetail h3.post-title,
    .artical_blogDetail .entry-content p, .artical_blogDetail .entry-content h3{
        font-family: 'Open Sans', sans-serif;color:#000;
    }

    .artical_blogDetail .blog-posts.single-post figure{text-align:center;}

    .subscribe-widget .btn.theme-btn, .subscribe-widget .btn.theme-btn:before{
        -webkit-border-radius:0;-moz-border-radius:0;-mz-border-radius:0;border-radius:0 !important;
    }

    .blog__header{text-align:center;background-color:#284358;background-size:cover;background-repeat:no-repeat;padding:80px 0;}
    .blog__header h2{font-size:46px;font-weight:700;}
    .blog__header p{font-size:18px;font-weight:500;width:42%;margin:0 auto 15px;}
    .blog__header a{font-size:16px;font-weight:400;text-decoration:underline;color:#fff;}

    .popular-BlogSection.populr_courses:before, .blog_detailHeader.populr_courses:before {display:none;}
    .popular-BlogSection.populr_courses:after{margin-top:-60px;}
    .popular-BlogSection h2.sectiontitle{font-size:36px;text-align:center;width:100%;margin-top:0;}
    .popular-BlogSection{}

    .blog_bodySection{padding-top:170px;}

    .blog_postColmn h3.post-title{font-size:15px;}
    .blog_postColmn p{font-size:13px;font-weight:600;}
    .post-description h3{white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-top:10px;margin-bottom:3px;height:22px;}
    .post-description .post-meta{padding:5px 0;background-color:transparent;border:none;font-size:12px; color:#000;font-weight:600; white-space:nowrap;overflow:hidden;text-overflow: ellipsis;}
    .post-description .post-meta span{padding-right:5px;}
    .post-description .post-meta a{color:#51ac37;text-transform:uppercase;float:right;}
    .post-meta.bottom__meta{padding:0;background-color:transparent;border:none;font-size:13.5px;font-weight:600;}
    .post-meta.bottom__meta a{color:#51ac37;text-decoration:underline;text-transform:uppercase;}

    .infodec{display: block;
        display:-webkit-box;-webkit-line-clamp:3;
        -webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;--max-lines:3;
        height:70px;
        font-size: 13px;
    }
    .infodec p{}

    .related_courses .blog-item .post-description p{font-size:13px;}

    .popular__blogs-slide .blog-item{background-color:transparent !important;}
    .popular__blogs-slide .blog-item .post-thumb{height:300px;overflow:hidden;}
    .popular__blogs-slide .blog-item .post-thumb img{height:300px;object-fit:cover}

    .blogDetail_slidr{position:relative;display:inline-block;width:100%;}
    .blogDetail_slidr:after{
        content:'';
        background-size: cover;background-repeat: no-repeat;width:100%;float:left;
        background-image:url(<?=UPLOADS.'images/wave_top.jpg'?>);height:116px;
    }


    .blog_postColmn{box-shadow:0 0 5px rgba(0, 0, 0, 0.16);}
    .blog_postColmn .post-thumb{height:180px;}
    .blog_postColmn .post-thumb img{height:180px;}

    #main__blogSL .post-description, #main__blogSL .post-meta.bottom__meta,
    .blog_postColmn .post-description, .blog_postColmn .post-meta.bottom__meta{padding:0 10px;}
    #main__blogSL .post-meta.bottom__meta, .blog_postColmn .post-meta.bottom__meta{padding-bottom:10px;}

    .loadMore_btn{border-radius:2rem;width:300px; margin-top:25px;}
    .loadMore_btn:before{border-radius:2rem;}

    .subscribe-widget{
        font-family: 'Open Sans', sans-serif;
        padding:25px;text-align:center;background-color:#fff;
        box-shadow:0 0 10px rgba(0, 0, 0, 0.40); position:relative;
    }
    .subscribe-widget:before{
        content:'';width:100%;height:10px;position:absolute;top:0;left:0;
        background: linear-gradient(to right, #41c4e8 0%,#51ac37 100%) !important;
    }
    .subscribe-widget i{font-size:60px;}
    .subscribe-widget h2{font-size:22px;margin-top:0;}
    .subscribe-widget p{font-size:15px;}
    .subscribe-widget .btn.theme-btn, .loadMore_btn.btn.theme-btn{
        height:50px;line-height:50px;padding:0;
    }


    .subscribe-widget .checkMark{position:relative;padding-left:20px;margin-bottom:0;font-size:14px;}
    .subscribe-widget .checkMark input{position:absolute;left:0;top:2px;}
    .subscribe-widget .checkMark a{color:#000;text-decoration:underline;}

    .blog_detailHeader{ padding-top:70px;}
    .blog_detailHeader.populr_courses:after {margin-top:-65px;}
    .blog_detailHeader h2{font-size:36px;color:#000 !important;margin-top:0;font-weight:600 !important;}
    .blog_detailHeader .breadcrumb li a{color:#000;}
    .blog_detailHeader .breadcrumb li.active{color:#99c529;font-weight:600;}
    .blog_detailHeader .breadcrumb>li+li:before {color: #99c529;font-size: 12px;margin-right: 3px;padding: 0 2px}

    .artical_blogDetail{ padding:130px 0 70px;}

    .entry-header .post-thumb{height:480px; overflow:hidden;}
    .entry-header .post-thumb img{height:480px;object-fit:cover;}
    .entry-header .meta-tag{display:flex;align-items: center;vertical-align:middle;line-height:30px;font-size:14px;padding-top:5px;}
    .entry-header .meta-tag p{flex-grow: 1;color:#000;margin-bottom:0;}
    .entry-header .meta-tag p a{text-decoration:underline;color:#000;font-weight:600;}
    .entry-header .meta-tag p span{padding-left:5px;}

    .entry-header .meta-tag ul{flex:0 0 auto;}
    .entry-header .meta-tag ul li{display:inline-block;color:#000;padding:0 5px;}
    .entry-header .meta-tag ul li a{color:#000;}

    .artical_blogDetail h3.post-title{font-size:30px;font-weight:600;}
    .artical_blogDetail .entry-content h3{font-size:26px;font-weight:600;}
    .artical_blogDetail .entry-content p{font-size:15px;margin-bottom:30px;}

    .multi-banner-top-txt {
        font-family: Open Sans;
        font-size: 18px;
        font-style: normal;
        font-weight: 600;
        line-height: 18px;
        text-align: left;
        color: #ffffff !important;

    }
    .multi-banner-main-txt {
        font-family: Open Sans;
        font-size: 43px;
        font-style: normal;
        font-weight: 700;
        line-height: 62px;
        text-align: left;
        color: #ffffff !important;
        margin: 15% 0;
        padding-left: 10%;
    }
    .multi-banner-bottom-txt {
        font-family: Open Sans;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 30px;
        text-align: left;
        color: #ffffff !important;
    }


    .lstPost-widget .post.media-post{display:flex;align-items: center;vertical-align:middle;padding-bottom: 10px !important;border-bottom: rgba(177, 177, 177, 0.18) solid 1px;}
    .lstPost-widget .post.media-post .post-thumb, .lstPost-widget .post.media-post .post-thumb img, .lstPost-widget .post.media-post img{
        flex:0 0 75px;object-fit:cover;height:65px;margin:0;
    }
    .lstPost-widget .post.media-post .post-right{padding-left:10px;}
    .lstPost-widget .post.media-post .post-right h5.post-title{margin-top:0;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;}
    .lstPost-widget .post.media-post .post-right h5.post-title a{}
    .lstPost-widget .post.media-post .post-right p{font-size:13.5px;color:#000;margin-bottom:0;}
    .lstPost-widget .post.media-post .post-right p a{text-decoration:underline;color:#000;font-weight:600;}
    .lstPost-widget .post.media-post .post-right p span{padding-left:5px;}

    .widget.ads-widget img{width:100%;}

    /*Instructor Sign up*/
    .instructor__signUP h2{font-size:22px;font-weight:600;padding:0 20px;}
    .instructor__signUP .btn.btn-primary{font-size:16px;text-transform:uppercase; margin-bottom:10px;}

    #accordion .card-header{padding:0;position:relative;}
    #accordion .card-header i{top:50%;position: absolute;float:none;right: 20px;transform: translate(0, -50%);margin-top: 0;margin-right:0;}
    #accordion .card-header a {width:100%;padding:18px 25px 18px 15px;position:relative;z-index:1;}


    /*Black Friday*/
    .marketing__header{background-size:cover;padding:110px 0 100px;}
    .marketing__header p{color:#fff;font-size:20px;}
    .marketing__header .btn.btn-primary{
        min-width:270px;font-size: 18px;font-weight:500;color: #fff;background-color: #51ac37;border-color: #51ac37;
        text-transform: uppercase;padding: 13px 30px;border-radius: 6px;margin-top: 13px;
    }

    .marketing__section{padding:30px 0}
    .marketing__section h6{margin:0 auto 20px;width:80%;font-size:20px;color:#000;text-align:center;font-weight:600;}

    .marketing_navTabs a.list-group-item{
        background-color: #fff !important;
        box-shadow: 0 4px 12px rgb(0 0 0 / 5%);padding: 8px 10px;
        font-size:13px;font-weight:400 !important;line-height: 16px;border: 1px solid #fff;
        font-family: 'Open Sans', sans-serif;color: #555555;
        border-radius:5px !important;-webkit-border-radius:5px !important; -moz-border-radius:5px !important;
        margin-right: 0.2rem !important;
    }
    .marketing_navTabs a.list-group-item span{
        line-height:normal !important;
    }
    .marketing_navTabs .list-group-item.active, .marketing_navTabs .list-group-item.active:focus,
    .marketing_navTabs .list-group-item.active:hover, .marketing_navTabs .list-group-item:hover {
        color: #fff !important;
        border: 1px solid #045F8C !important;
        background-color: #045F8C !important;
        box-shadow: 0 4px 12px rgb(0 0 0 / 5%) !important;
    }
    .marketing__section .tab-content h5.title_tabs, .marketing__section .card-marketing h5.title_tabs,
    .marketing__section h6.title_tabs {
        text-transform:uppercase;text-align:center;font-size:24px;color:#000;font-weight:800;
    }
    .marketing__course.course-box .course-image img{
        height:165px;
    }
    .marketing__course .coupon {
        font-size: 15px;
        border: #51ab37 dashed 1px;
        padding: 7px 20px;border-radius: 0;text-align: center;
        font-weight: 700;
        margin: 10px 0;color: #000;
    }
    .marketing__course .price{color:#51ab37;}

    .marketing__course i.fa-check-circle{display:none;}
    .marketing__course.select__course i.fa-check-circle{display:block;
        position: absolute;z-index:10;color: #2098d1;font-size: 68px;top: 0;
        text-align: center;width: 100%;height: 100%;background-color: rgb(0 0 0 / 45%);padding-top:70px;
    }
    .marketing__course.select__course{
        border: 1px solid #2098d1 !important;box-shadow: 0 0 10px rgba(32, 152, 209, 0.20) !important;
    }
    .marketing__course.select__course .btn {
        background-color: #2098d1;border-color: #2098d1;
    }
    .marketing__course.select__course .coupon {
        border: #2098d1 dashed 1px;
    }


    .marketing__trms{background-size:cover;padding:60px 0;}
    .marketing__trms img{margin-bottom:12px;}
    .marketing__trms .section-title{margin-bottom:0;}
    .marketing__trms .title{color:#fff;margin-top:-12px;}

    .marketing__trms .style-4::-webkit-scrollbar-track {-webkit-box-shadow: inset 0 0 0 rgba(0,0,0,0.3);background-color: #151931; border-radius:20px;}
    .marketing__trms .style-4::-webkit-scrollbar {width:10px;border-radius:20px;background-color: #151931;}
    .marketing__trms .style-4::-webkit-scrollbar-thumb {border-radius:20px;background-color: #84ba3f;}

    .marketing__trms .term_content{padding-right:25px; height:250px;}
    .marketing__trms ul{}
    .marketing__trms ul li{font-size:14px;color: #fff;padding-bottom:20px;line-height:24px;}
    .marketing__trms ul li ul{margin-top:10px;padding-left:20px;}

    .desktop__view{display:block;}
    .ipd_mobile_view{display:none;}

    .card-marketing{
        -moz-box-direction: normal;-moz-box-orient: vertical;background-color: #fff;border-radius:0;
        display: flex;flex-direction: column;position: relative;margin-bottom: 1px;border: none;padding-bottom: 20px;
    }
    .card-marketing .card-header{
        width:100%;font-weight: 600;text-align:left;vertical-align: middle; color:#353535;background: #51ac37;
        border-radius:0 !important;-webkit-border-radius:0 !important; -moz-border-radius:0 !important;border: 1px solid #51ac37 !important;display:inline-block !important;
    }
    .card-marketing .card-header a{font-size:16px;font-weight: 600;color:#333;display:inline-block !important;}
    .card-marketing .card-header a i{font-size:20px;}

    .thankyou_section img{margin-bottom:60px;}
    .thankyou_section h4{font-size:26px;font-weight:800;color:#191919; margin:0;}
    .thankyou_section h5{font-size:20px;font-weight:400;padding:10px 0;color:#191919; margin:0;}
    .thankyou_section h6{font-size:13px;color:#191919; margin:0;}
    .thankyou_section p{font-size:16px;line-height:28px;padding:0 0 28px; width:70%; margin:0 auto;color:#191919;}
    .thankyou_section p a, .thankyou_section p u{font-weight:600;}
    .thankyou_section p a{color:#008bca;text-decoration:underline;}
    .thankyou_section p u{color:#008bca;text-decoration:underline;}
    .thankyou_section .btn.btn-primary{
        width:310px; margin-bottom:10px;font-size:16px;
        color: #fff;background-color: #a0ce4e;border-color: #a0ce4e; border-radius: 30px !important;
    }
    .thankyou_section .btn.btn-primary:hover{
        color: #333;background-color: #79c12e;border-color: #79c12e;
    }
    .order_list2{margin:15px auto;width:80%;
        -ms-box-orient: horizontal;
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -moz-flex;
        display: -webkit-flex;
        display: flex;
    }
    .order_list2 li{flex:0 0 20%;background-color:#f5f5f9;text-align:left;margin:1px;padding:10px;}
    .order_list2 li:nth-child(even){flex-grow:1; font-weight:700;}
    .order_list2.wrap{
        -ms-flex-wrap: wrap;-moz-flex-wrap: wrap;-webkit-flex-wrap: wrap;flex-wrap: wrap;
    }

    .links-social{ margin-top:25px;}
    .links-social span{font-size:22px;padding-right:5px;}
    .links-social a{
        width:40px; height:40px;color:#fff;border:transparent solid 1px;text-align:center; line-height:40px;font-size:18px; margin:0 5px; display:inline-block;
        border-radius:50%;margin-top:5px;
    }
    .links-social a:hover{background-color:transparent;}
    .links-social .facebook{background-color:#008bca;}
    .links-social .facebook:hover{border-color:#008bca; color:#008bca;}
    .links-social .twitter{background-color:#65bbf2;}
    .links-social .twitter:hover{border-color:#65bbf2; color:#65bbf2;}
    .links-social .youtube{background-color:#df3a34;}
    .links-social .youtube:hover{border-color:#df3a34; color:#df3a34;}
    .links-social .linkedin{background-color:#008ec6;}
    .links-social .linkedin:hover{border-color:#008ec6; color:#008ec6;}
    .links-social .instagram{background-color:#008bca;}
    .links-social .instagram:hover{border-color:#008bca; color:#008bca;}

    .contact_successMsg .alert {padding: 25px;}
    .contact_successMsg h4.alert-heading{text-align:center;}
    .contact_successMsg .contactok i{
        font-size: 42px;
        display: block;text-align: center;padding: 15px 0;
    }
    .contact_successMsg .alert p {text-align:center;}

    .footer-bottom .footer-social-icons{background-color: rgb(255 255 255 / 99%);
        border-radius:100px;text-align: center;padding: 0;
        width:45px;height:32px; color: #045f8c !important;display: inline-block;line-height:32px;
    }
    .footer-bottom .footer-social-icons i{line-height:32px;}

    .cn-info-detail a.footer-social-icons{
        background-color: rgb(255 255 255 / 99%);border-radius: 3px;text-align: center;padding: 0;
        font-size: 20px;width:40px;height:40px;display: inline-block;
        line-height:40px; margin:0 6px;
    }

    .w-100{width:100%;}
    .ds30_img{width:100px;margin-top:15px;}

    .mobile_icon{
        display: none !important;
    }
    #footer {
        margin-top: 0px;
        padding: 75px 0 0;
    }

    .quickLinkscourse{position:relative;}
    /*.quickLinkscourse .slick-list {margin: 0 -10px;}*/
    .quickLinkscourse .slick-arrow{position:absolute;top:0;color:#fff;font-size:20px;line-height: 26px;cursor:pointer;z-index:1;}
    .quickLinkscourse .slick-arrow.fa-angle-left{left:0;}
    .quickLinkscourse .slick-arrow.fa-angle-right{right:0;}
    .quickLinkscourse .slick-slide a{position:relative;}
    .quickLinkscourse .slick-slide a:after {
        content: '|';font-size: 13.5px;color: #fff;position:absolute; right:-32px;top:0;
    }
    .quickLinkscourse .slick-slide {
        width: auto !important;
    }
    .quickLinkscourse a {display: flex;white-space: nowrap;position:relative;}
    .quickLinkscourse .slick-active {
        opacity: 1 !important;
    }
    .quickLinkscourse .slick-slide {
        opacity: 1;
    }

    .preview-video-box {
        position:relative;
    }
    .preview-video-box a {
        width: 100%;
        height: 100%;color: #fff;text-align: center;position: absolute;top: 0; padding-top:60px;
        /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#000000+1,262626+100&0+0,0.7+100 */
        background: -moz-linear-gradient(top,  rgba(0,0,0,0) 0%, rgba(0,0,0,0.01) 1%, rgba(38,38,38,0.7) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.01) 1%,rgba(38,38,38,0.7) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.01) 1%,rgba(38,38,38,0.7) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#b3262626',GradientType=0 ); /* IE6-9 */
    }
    .preview-video-box i {
        display:inline-block;color: rgb(255, 255, 255) !important;font-size:50px;padding-bottom:20px;
        z-index: 2;/*top: 50%;left: 50%;transform: translate(-50%, -50%);position: absolute;*/
    }
    .preview-video-box span {
        display:inline-block;width:100%;
    }
    #desktopview .preview-video-box img{
        height:200px;
    }

    #videoModal, #mainVideoModal{padding-right:0 !important;}
    #videoModal button.close, #mainVideoModal button.close, #myModalshare button.close, #iframeModal button.close{
        position: absolute !important;
        margin: 0 !important;right:0;top:0;
        z-index: 1;border-radius: 0;opacity: 1;
    }
    #videoModal button.close span, #mainVideoModal button.close span, #myModalshare button.close span, #iframeModal button.close span{
        color: #fff;
    }
    #videoModal .modal-content, #mainVideoModal .modal-content, #iframeModal .modal-content {
        border-radius: 0;background-color: #1e1e1c;color: #fff;border: 0;
    }
    #videoModal .modal-content h5, #iframeModal .modal-content h5 {
        color: #dcdacb;
    }
    #videoModal .modal-content h4, #iframeModal .modal-content h4 {
        font-size:22px;color: #fff;
    }

    #videoModal .modal-body, #iframeModal .modal-body{padding:10px;}
    #videoModal video[poster], #iframeModal iframe{
        height:325px;
        width:100%;
    }


    .modal-dialog-centered {
        top:auto !important;
        transition: -webkit-transform .3s ease-out !important;
        transition: transform .3s ease-out !important;
        transition: transform .3s ease-out,-webkit-transform .3s ease-out !important;
        -webkit-transform: translate(0,-25%);transform: translate(0,-25%) !important;
    }
    #iframeModal.modal.in .modal-dialog,
    #videoModal.modal.in .modal-dialog, #mainVideoModal.modal.in .modal-dialog {
        -webkit-transform: translate(0,40%) !important;
        -ms-transform: translate(0,40%) !important;
        -o-transform: translate(0,40%) !important;
        transform: translate(0,40%) !important;
    }

    .homeVideo{overflow:hidden;border-radius:5px;}
    .homeVideo a{padding-top:26%;}
    .homeVideo a i.fas{color:#fff !important;font-size:4.5rem;}

    #mainVideoModal .modal-body{padding:0 !important;}
    #mainVideoModal .modal-body video{height:100% !important; }

    #fullcertificate button.close {
        position: absolute;
        margin: 0;
        background: transparent;
        padding: 0 10px 0px 10px;
        opacity: 1;top: 5px;right: 3px;
    }
    #fullcertificate button.close span {
        color:#000;
    }

    /*.clients-logo .item {
        margin: auto 2%;
    }*/
    /*.home_page_Clogo.clients-logo img {
        max-height: 150px !important;
        width: 150px !important;
    }*/

    a.ftr_link {
        display: inline-block;
        background-color: #fff;
        color: #000000 !important;
        border-radius: 2rem;
        font-size: 13px;
        padding: 6px 12px;
        font-weight: 600 !important;
        margin-top: 10px;
    }

    .inner_from{}
    .inner_from p{font-size:15px;font-weight:600;}
    .inner_from ul{margin:15px 0 5px;padding:0}
    .inner_from ul li{font-size:15px;padding-bottom:15px; position:relative;padding-left:20px;}
    .inner_from ul li i{position:absolute;left:0;top:7px;font-size:14px;}

    .inner_from img{width: auto; height:460px; margin:15px auto;display:block;}
    .inner_from .new__formStyle .btn span{color:#fff !important;}


    .msg__sucs i{font-size:52px; margin:20px 0}

    .description-content li {
        list-style: disc;
        margin-left: 3%;
    }

    .detail_tabs li {
        list-style: disc;
        margin-left: 3%;
    }


    .buy-team-for-155NLA{
        width:100%; display:inline-block;
        border-top: 1px solid #dcdacb;padding:.5rem 0 0;margin:10px auto 0;
    }
    .buy-team-for-155NLA .buy-team-for-title{
        font-size:18px; color:#000;margin-top: 5px;margin-bottom: 5px;
    }
    .buy-team-for-155NLA .buy-team-for-content{
        font-size:14px; color: #5e5e5e;
    }
    .advertising-banner-2nNLA{
        padding: 2rem;display:inline-block;width:100%;margin-bottom:35px;
        border: 1px solid #dcdacb;border-radius: 4px;
    }
    .adv-banner-title{
        font-size: 20px;
        font-weight: 700;
    }
    .adv-banner-content{
        padding:0 0 10px;font-weight: 600;
    }
    .adv-top-companies{margin:.5rem 0;}
    .adv-top-companies>* {
        margin:1.1rem 1.8rem 1.5rem 0;vertical-align: middle;height:26px;
        -webkit-filter: grayscale(1);filter:gray;filter: grayscale(1);
    }
    .adv-top-companies>*:hover {
        -webkit-filter: grayscale(0);filter:initial;filter: grayscale(0);
    }

    .nla-component-render{
        margin-top:25px;
    }
    .nla-component-render .title, .instructors__section .title, .related_courses .title{
        width:100%;
        font-size: 22px;  font-weight: 600;  margin: 0 0 15px;padding-bottom:10px;
    }
    .nla-component-render .table-responsive{width:100%;display: inline-block;}
    .nla-course-comparison-content{width:100%;}
    .nla-course-comparison-content tbody tr{}
    .nla-course-comparison-content tbody tr td{
        vertical-align:middle;padding:15px 6px !important;
    }
    .nla-course-comparison-content .course-image-wrapper{width:85px;}
    .nla-course-comparison-content .course-image-wrapper img{width:70px;height:50px;object-fit:cover;border-radius:4px;}
    .render_title{vertical-align:top !important;}
    .render_title .course__name{
        color: #3c3b37;
        display: block!important;display: -webkit-box!important;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;white-space: normal;font-weight: 700;
        line-height: 1.3;letter-spacing: -.02rem;
        font-size:.975rem;padding-bottom:8px;
    }
    .nla-component-render .render_rating , .nla-component-render .render_users, .nla-component-render .render_price{
        font-size:14.5px;font-weight:600;
    }
    .nla-component-render .render_rating{
        color:#f7701d;
    }
    .nla-component-render .render_cart{width:3rem;}
    .nla-component-render .cart_btn{
        color: #a0ce4e;
        background-color: transparent;
        border:2px solid #a0ce4e;position: relative;border-radius: 50%;display: inline-block;
        min-width:2.5rem;white-space: nowrap;height:2.5rem;line-height:2.3rem;text-align: center;
    }
    .nla-component-render .cart_btn:hover{
        color: #fff;
        background-color: #f7701d;border:2px solid #f7701d;
    }
    .nla-badge{
        font-size: .75rem;font-weight: 600;
        background-color: #ffe799;color: #593d00;
        border-radius: 4px;display: inline-block;padding: .1rem .3rem;
        margin: 0 .8rem 0 0;white-space: nowrap;float:left;
    }
    .nla-meta-items{}
    .nla-meta-items>* {
        font-size:13px;
        display: flex;align-items: center;
    }
    .nla-meta-items .meta-content-info{
        font-weight:600;color: #000;
    }
    /*   .meta-content-info:after{
           content: '\25CF';
           margin: 0 .4rem;
           font-size:8px;
       }*/

    .instructors__section{margin-bottom:40px;}
    .instructors__section .container{padding-top:0 !important;padding-bottom:0 !important;}
    .instructor__content{border-bottom:1px solid #dcdacb;padding-bottom:15px;}
    .instructor__content .instructor_box ul li{font-size:13px;padding-bottom:5px;}
    .instructor__content .instructor_box ul li i{margin-right:5px;}
    .instructor__content .instructor__about p{font-size:14px;}
    .instructor_box{width:100%;display:inline-block;padding:15px 0}
    .instructor_box img{width:130px;height:130px;margin-right:15px;float:left;}


    .business__associates h2, .related_courses h2 {
        font-size:28px;line-height:36px;font-weight: 700;color: #000;margin-bottom: 0;
    }
    .business__associates .adv-companies img{margin:.7rem 1.4rem; -webkit-filter: grayscale(1);filter:gray;filter: grayscale(1);}
    .business__associates .adv-companies img:hover{-webkit-filter: grayscale(0);filter:gray;filter: grayscale(0);}

    .course-sidebar-text-box .includes ul li span.course-info-title{float:none;}
    .course-sidebar-text-box .includes ul li:first-child{margin-top:0;}
    .course-sidebar-text-box .includes ul li{margin-top:10px !important;}

    .home_page_Clogo img{-webkit-filter: grayscale(1);filter:gray;filter: grayscale(1);}
    .home_page_Clogo img:hover{-webkit-filter: grayscale(0);filter:gray;filter: grayscale(0);}

    .d-inline-block{display:inline-block!important}

    .mob_rating{display:none;}

    .reviews__section{width:100%;display:inline-block;}
    .reviews__section .container{padding-top:0;padding-bottom:0;}

    .certificate_new_bx .d-flex{
        justify-content: center;
        -webkit-justify-content: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        align-items: center;
        -webkit-align-items: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
    }
    .certificate_new_bx img.img_ctrs{
        width:auto;
        border: 2px solid lightblue;
        box-shadow: 0 2px 5px 5px rgb(21 110 155 / 10%); margin:20px 10px 10px;
    }
    .certificate_new_bx img.img_ctrs:first-child{
        border-radius:6px; -webkit-border-radius:6px; -moz-border-radius:6px;
    }
    .certificate_new_bx img.img_ctrs:last-child{
        border-radius:30px; -webkit-border-radius:30px; -moz-border-radius:30px;
    }

    .certificate_new_bx .img_ctrs{height:280px;}
    .certificate_new_bx .ctr_fsc{position:relative;}
    .certificate_new_bx .ctr_fsc:after{
        font-family: "Font Awesome 5 Free";
        content: "\f00e";font-size:14px;
    }

    .mobile_dropdown{padding:0 !important;margin-right: 6px;}
    .mobile_dropdown li {font-size: 13px;}
    .mobile_dropdown .item-name a {color: #29303B;font-weight: 400;}
    .mobile_dropdown img {width:40px !important;}

    .gurnted-logo img:first-child{width:110px; }
    .check__out label{padding-left:20px; }
    .check__out label input{position:absolute;left:20px; }

    .search-form-wrappers {
        display: none;
        position: absolute;
        left: 0;
        right: 0;
        padding: 20px 15px;
        background-color: #156e9a;
    }
    .search-form-wrappers.open {
        display: block;
    }
    .search-form-wrappers .inline-form.top-menu-form {
        margin: 0;padding: 0;
    }
    .search-form-wrappers .input-group{width:100% !important;}
    .search-form-wrappers form input[type="text"] {
        border: 0 solid #c0c0c0;background-color: #fff;height: 45px !important;
    }
    .search-form-wrappers #searchResult_2.searchResult {
        width: 92%;
    }

    .new__formSection{
        background-color: #f3f8f9;padding-top:50px;
    }
    .new__formSection:after{
        content:'';
        background-size: cover;background-repeat: no-repeat;width:100%;float:left;
    }
    .new__formSection:after{
        background-image:url(<?=UPLOADS.'images/wave_bottom.jpg'?>);height:144px;
    }
    .new__formSection blockquote{margin-bottom:0;padding:0 0 0 20px;font-size:15px;border-left: 3px solid #51AC37;}
    .latest_form{margin-top:20px;}
    .latest_form .form-group{margin-bottom:10px;}
    .latest_form .form-control{
        height:55px;border-radius:5px;border-color:#e2e2e2;
    }
    .latest_form textarea.form-control{
        height:75px;
    }
    .latest_form p{
        font-size:13px;color:#8c8c8c;
    }
    .latest_form .btn{
        height:55px;
    }
    .latest_form .switch_btn{display:flex;
        justify-content: flex-end;
        -webkit-justify-content: flex-end;
        -webkit-box-pack: end;
        -ms-flex-pack: end;
        align-items: end;
        -webkit-align-items: flex-end;
        -webkit-box-align: center;
        -ms-flex-align: center;
    }
    .latest_form .switch_btn span:first-child{padding-right:5px;}
    .latest_form .switch_btn span:last-child{padding-left:5px;}
    .latest_form .switch {
        position: relative;display: inline-block;width:56px;height:28px;margin-bottom:0;
    }
    .latest_form .switch input {
        opacity: 0;width: 0;height: 0;
    }
    .latest_form .slider {
        position: absolute;cursor: pointer;
        top: 0;left: 0;right: 0;bottom: 0;background-color: #ccc;-webkit-transition: .4s;transition: .4s;
    }
    .latest_form .slider:before {
        position: absolute;content: "";height: 22px;width: 22px;
        left: 4px;bottom:3px;background-color: white;-webkit-transition: .4s;transition: .4s;
    }
    .latest_form input:checked + .slider {
        background-color: #51AC37;
    }
    .latest_form input:focus + .slider {
        box-shadow: 0 0 1px #51AC37;
    }
    .latest_form input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }
    /* Rounded sliders */
    .latest_form .slider.round {border-radius: 34px;}
    .latest_form .slider.round:before {border-radius: 50%;}

    .populr_courses .btn-sm, .course-box .btn-sm{
        border: #51ac37 solid 2px;
    }

    .footer .footer-bottom{
        background-image: linear-gradient(to right, #063248, #156e9b);
    }
    .footer #subcription .subs-group-content h2{
        color:#fff;
    }

    #myModalshare .social-icon a:hover{color:#000;}
    #myModalshare .modal-body{padding:25px !important;}

    #cookies .cooking_btns{
        display:inline-block;width:auto;text-align:center;padding-left:10px;vertical-align:top;
    }
    #cookies .inner_cookiesDev{
        padding:15px;text-align:center;
    }
    #cookies .inner_cookiesDev p{
        font-weight:bold;color:#fff;display:inline-block;margin:5px 0 !important;
    }


    .detailpg_faqs .title {
        font-size: 22px;
        font-weight: 600;
        margin: 0 0 15px;
    }
    #faq-accordion{width:100%;display:inline-block;}
    #faq-accordion .panel {
        margin-bottom: 15px;box-shadow:none !important;
    }
    #faq-accordion .panel-heading a {
        margin: 0;width: 100%;font-size: .95rem;
        padding: .65rem .95rem .65rem .85rem;font-weight: 600;
        color: #000 !important;
        display: inline-block;
    }
    #faq-accordion .panel-heading a .glyphicon {
        float:right;margin-top:6px;
    }
    #faq-accordion .panel-body{
        border: #e3e3e3 solid 1px;
    }


    .pagination>li {
        float: left;
        padding-left: 0;
    }
    .pagination>li>a, .pagination>li>span{
        font-size:13px;

    }

    .extr_space {
        padding: 35px 0 25px;
        min-height: 70px;
    }

    .gift__CourseSection{padding-bottom:50px;}
    .gift__CourseSection:after{display:none !important;}
    .gift__courseInfo{text-align:center;margin-top:85px;}
    .gift__courseInfo figure img{margin-top:50px;}
    .gift__courseInfo a {
        font-size: 18px;font-weight: 700;margin-top: 15px;color: rgb(81, 172, 55);display: inline-block;width: 100%;
    }
    .gift__courseInfo p {
        font-size: 16px;color:#000;
    }


    /***** all button style in the whole site ****/
    .subscribe-widget .btn.theme-btn, .loadMore_btn.btn.theme-btn, .cart_added_popup .item_button a, .apply-coupon button.btn, .btn.btn-primary,
    .cart_area .cartbtn a.button, .desktop__nav .dropdown-menu a.logout{
        background-color:#51ac37;
        border-color:#51ac37;
    }
    .subscribe-widget .btn.theme-btn:hover, .loadMore_btn.btn.theme-btn:hover, .cart_added_popup .item_button a:hover, .apply-coupon button.btn:hover,
    .btn.btn-primary:hover, .cart_area .cartbtn a.button:hover, .desktop__nav .dropdown-menu a.logout:hover, .student__dashboard .dt-buttons .btn-sm:hover{
        background-color:#045f8c;
        border-color:#045f8c;
    }
    .loadMore_btn.removefocus{
        background-color:#51ac37 !important;
        border-color:#51ac37 !important;
    }
    .loadMore_btn.removefocus:before{background-color:#51ac37 !important;}


    .newlogin__from button.close{
        position: absolute;top: 17px;right:0;font-size: 2rem;background: none !important;z-index: 99;
    }
    .newlogin__from .login__content{padding:30px;}
    .newlogin__from .login__content h3{font-size:24px;text-align:center;margin-top:0;color:#000;}
    .newlogin__from .login__content input.form-control {
        background-color:#F3F8F9;
        border: 1px solid #D0D6D8;
        border-radius: 6px;-webkit-border-radius: 6px;-moz-border-radius: 6px;
        height:50px;
    }
    .newlogin__from .login__content a.forgot {
        color: #000;
        text-decoration: underline;font-weight: 400;
    }
    .newlogin__from .login__content .btn {
        height: 50px;line-height:33px;font-size: 18px;
        border-radius: 6px;
        -webkit-border-radius: 6px;-moz-border-radius: 6px;
    }
    .newlogin__from .login__content .tab-content {
        padding:10px 0 0;
    }
    .newlogin__from .login__content .nav.nav-tabs.nav-justified{
        background-color:#F3F8F9;border: 1px solid #D0D6D8;
        border-radius: 6px;-webkit-border-radius: 6px;-moz-border-radius: 6px;
    }
    .newlogin__from .login__content .nav-tabs.nav-justified>li {
        display: table-cell;width: 1%;
    }
    .newlogin__from .login__content .nav-tabs.nav-justified>li>a {
        border-bottom: 1px solid transparent;border-radius: 0;background-color: transparent;padding: 5px;
        text-transform:uppercase;color:#000;
        margin: 0 !important;border-left: 0 !important;
    }
    .newlogin__from .login__content .nav-tabs.nav-justified>li>a:hover {
        border-bottom: 1px solid transparent !important;background-color: transparent !important;padding:5px;
        margin: 0 !important;border-left: 0 !important;
    }
    .newlogin__from .login__content .nav-tabs.nav-justified>li.active>a {
        border:1px solid transparent !important;
        background-color: #70B564 !important;
        color: #fff !important;margin: 0 !important;
        border-radius:5px;-webkit-border-radius: 5px;-moz-border-radius: 5px;
    }
    .newlogin__from .login__content .form-check a{color:#000;text-decoration:underline;}


    .all__coursesHeader{
        background-repeat:no-repeat;
        background-size:cover;
    }

    .all_course_full_banner_class {
        width: 100%;
    }

    .payment-method .radio > p {
        font-size: 13px;
    }

    .redeem-label-font {
        font-size: 14px;
        padding-left: 1%;
        padding-top: 4px;
    }

    .redeem-label-color {
        color: #044d71;
    }

    .apply-padding-0 {
        padding-top: 0px !important;
        padding-bottom: 0px !important;
    }

    div#AlertModelnew {
        margin-top: 16%;
    }

    /* New media */
    @media screen and (min-width:1921px) and (max-width:5000px) {
        .corporate_section, .instructor_Banner, .inner__header {
            padding: 170px 0;
        }
        .top__searchSec{padding:230px 0 230px;}
        .top__searchSec h2{font-size:70px;}
        .section-title .title {font-size: 2.6rem;}
        .section-title p {font-size: 16.5px;}

        .populr_courses .nav-tabs > li > a {font-size: 14.5px;}
        .registration-area .countdown h2 {font-size: 2.8rem;}
        .registration-area .countdown h5 {font-size: 18px !important;}
        .registration-area .countdown ul > li {font-size: 16px;}
        .content__Info p {font-size:18px;}

        .main__testi .testi-item .user-info .circle {height:90px;width:90px;}
        .main__testi .testi-item .user-info .circle .initials {line-height: 2.5;}
        .main__testi .testi-item .desc {font-size: 16.5px;}

        .become__business img {height: 460px;}

        .ptnr__logos p {font-size: 18px;}
        .related_courses .blog-item .post-description p {font-size: 15px;}

        #footer {
            margin-top: 0px;
            padding: 75px 0 0;
        }
        .footer .footer-bottom {padding-bottom:10px;}

        #videoModal .modal-dialog, #mainVideoModal .modal-dialog {
            width: 860px;
        }
        #mainVideoModal .modal-body {padding: 0;}
        #mainVideoModal .modal-body video {
            height:100%;
        }

        .about p, .who-we-are p, .why-choose-us p, .mission p {
            font-size: 16px;
        }
        .why-choose-us p {
            position: relative;
        }
        .why-choose-us i {
            font-size: 18px;
            left: 0;top: 5px;padding-left: 0;
        }
        .business__associates h2{
            font-size:2rem !important;
        }

        /*.newCategories__style:before {
            width: 35.7%;
        }*/
    }

    @media screen and (min-width:1600px) and (max-width:5000px) {
        /*.newCategories__style .container {width: 1510px !important;}*/
        .newCategories__style:before {width: 26%;}
        .newCategories__style .row {
            display: flex;
            display: -webkit-flex;
            display: -webkit-box;
            display: -moz-flex;
            display: -moz-box;
            display: -ms-flexbox;
            -ms-flex-wrap: wrap;flex-wrap: wrap;
        }
        .newCategories__style .container .row .col-lg-4 {
            -ms-flex: 0 0 25%;flex: 0 0 25%;max-width: 25%;width:25%;
        }

        .all__coursesHeader{
            background-position:center -180px;
        }
    }

    @media screen and (min-width:992px) and (max-width:5000px) {
        .newCategories__style .filter_vewArea .col-lg-3:before {
            content: '';
            width: 96%;
            background-color: #fff;
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
        }
    }
    @media screen and (min-width:1367px) and (max-width:1440px) {
        .newCategories__style:before {
            width: 20%;
        }
    }
    @media screen and (max-width:991px) {
        .newCategories__style:before {
            display:none;
        }
        .filter_vewArea #filter-accordion-7.panel-group .panel {
            box-shadow: none;
            padding: 0 5px 0 10px;
        }
        .filter_vewArea #filter-accordion-7.panel-group .form-check:last-child{margin-bottom:10px !important;}
        .dropdown-cart li, .list_cart div {
            padding: 9px 10px;
        }
    }

    @media screen and (min-width:1600px) and (max-width:2560px) {
        #desktopview{top:210px !important;}
        #desktopview.course-sidebar, #desktopview.course-sidebar.fixed{width:322px;}

        .new__formSection .title{font-size:42px;}
        .new__formSection p{line-height:30px;margin-bottom:20px; }
        .new__formSection blockquote {padding: 0 0 0 25px;line-height:30px;}
    }
    @media screen and (min-width:1140px) and (max-width:2560px) {
        .blog_bodySection {
            padding-top: 110px;
        }
        .cart_item .product-price,.cart_item .product-subtotal{
            min-width:100px;
        }
    }
    @media screen and (min-width:1600px) and (max-width:1920px) {
        #footer{margin-top:0px;padding:25px 0 0;}
        .footer .footer-bottom {padding-bottom:10px;}
        #videoModal .modal-dialog, #mainVideoModal .modal-dialog {width: 760px;}
        .clients-logo .item {
            margin: auto 1%;
        }
        .marketing__header1 {
            min-height: 550px;
        }

        .corporate_section, .instructor_Banner, .inner__header{padding:120px 0;}
    }
    @media screen and (min-width:1445px) and (max-width:1600px) {
        .studentpage_banner{background-position: -315px 0;}
    }
    /* New media */
    @media screen and (min-width:960px) and (max-width:1440px) {
        .top__searchSec h2{font-size: 3.7rem !important;}
        /*.corporate_section {background-position: -255px 0;}*/
        .studentpage_banner{background-position: -255px 0;}

        .inner__search{width:70%;margin:0 auto;}
        .inner__search .input-group input,.inner__search .input-group button{height:55px;line-height:55px;}

        .entry-header .post-thumb{height:380px;}
        .entry-header .post-thumb img{height:380px;}
        .blog__header p {width: 55%;}
        .marketing__header1 {
            min-height: 380px;
        }

        .marketing__header {background-position: 1750px 0;}
        .home_page_Clogo.clients-logo img {max-height:60px;}

        .hid_tlbs{display:none !important;}

        .marketing_navTabs a.list-group-item {width:20%;}
        .why-join-box{padding:15px;}

        .certificate__HeaderSect{
            background-color: #f0f1f5;
            background-position: -200px 0;
        }
        .new__formStyle label, .new__formStyle input, .new__formStyle select, .new__formStyle textarea {
            font-size: 13px;
        }
        .newCourse .btn {
            font-size: 10.5px;padding: 5px 5px;
        }
        .course-sidebar-text-box .price .current-price{font-size:30px;}
        .course-sidebar-text-box .price-stripe {
            font-size: 18px !important;
        }
    }
    @media screen and (min-width:960px) and (max-width:1366px) {
        .top__searchSec {background-position: -545px 0 !important;}
        .desktop__nav .header__logo {width: 190px;}

        .main-nav-wrap {margin: 0 5px 0 0;}
        .desktop__nav .header__btns .dsk_btns {
            padding: 0 .2rem 0 .7rem;
        }
        .signIn_btns{margin-left: .2rem;}
        .signIn_btns, .signUp_btns {font-size: .85rem !important;padding: 0 0.6rem !important;height: 2.2rem;}
        .ds30_img{width:100px;margin-top:15px;}

        .course-box .course-details .title{
            margin-bottom:15px;
        }

        .inner__header.promotionExcel_Banner {
            background-position: center center;
        }

    }
    @media screen and (min-width:1281px) and (max-width:1366px) {
        .newCategories__style:before {width:28.5% !important;}
    }

    @media screen and (min-width:768px) and (max-width:1280px) {
        #cookies{text-align:center;}
        #cookies .inner_cookiesDev p {
            /*padding-left: 10px;width:75%;text-align: left;*/
        }
    }
    @media screen and (min-width:1024px) and (max-width:1280px) {
        .pagination.cs-pagination nav {
            padding: 0;
        }
        .pagination.cs-pagination nav ul.pagination {
            margin:0 !important;
        }
        .newCategories__style:before {
            width: 26%;
        }
    }
    @media screen and (min-width:960px) and (max-width:1024px) {
        .corporate_section h3, .inner__header h3 { font-size: 38px;line-height:48px;}
        .become__business .content__Info {padding: 25px 30px;}
        .become__business .content__Info .section-title h2{font-size: 1.7rem;}
        .corporate_section {background-position: -315px 0;}
        .studentpage_banner {background-position: -430px 0;}
        footer .paymentInfo img {width:95px;}
        .corAbout_section img {width: 36%;}
        .blog__header p {width: 70%;}

        .entry-header .post-thumb {height: 330px;}
        .entry-header .post-thumb img {height: 330px;}

        .marketing__header {background-position: 1550px 0;}
        .marketing_navTabs a.list-group-item {width:25%;}

        .populr_courses .btn-sm {
            padding: 5px 8px;
        }

        .corporate_section p{width:90%;}
        .ftr_rPadding{padding-right:60px;}

        .certificate__HeaderSect {
            background-position: -390px 0;
        }

        /*.newCategories__style:before {
            width: 32.7%;
        }*/
        .newCategories__style .new_tbs li {
            margin-bottom: 8px;
        }
        .courseSlider_info{flex-direction: column;}
        .courseSlider_info .left_col {
            flex: 0 0 100%;
            max-width: 100%;
            border-top-left-radius: 6px; border-top-right-radius:6px;
            border-bottom-left-radius: 0;
            text-align: center; overflow:hidden;
        }
        .courseSlider_info .left_col img {
            width:auto;
        }
        .courseSlider_info .right_col {
            border-top-right-radius:0;
            border-bottom-right-radius: 6px;
            border-bottom-left-radius: 6px;
        }

        .social-btns {
            height:30px;
        }
        .social-btns .btn {
            width: 30px;height: 30px;line-height:26px;
            margin: 0 5px;
        }
        .social-btns .btn .fa {
            font-size:20px;
        }
        .label-3kk12.Arrange-sizeFit.u-textInheritColor.u-inlineBlock{
            display:none !important;
        }

        .newCategories__style:before {
            width: 33%;
        }

    }
    @media screen and (min-width:320px) and (max-width:966px) {

        .instructor_Banner{background-position: -160px 0;}

        .button-space {width: 0;}
        .btn_serch {width: 5.8rem;}
        .header__logo img{width:145px !important;}

        .shopping-cart.mobile_dropdown .list_cart{
            max-height:190px;overflow:scroll;
        }

        .become__business .content__Info {padding: 25px 30px;}
        .become__business .content__Info .section-title h2{font-size: 1.7rem;}

        .inner__search{width:80%;}
        .inner__search .input-group input,.inner__search .input-group button{height:50px;line-height:50px;}

        .blog__header p {width: 80%;}
        {{--.marketing__header1 {--}}
            {{--background-image:url('<?=GetMobileImg(collect(request()->segments())->last())?>') !important;--}}
            {{--min-height: 512px;--}}
            {{--background-position: initial;--}}
        {{--}--}}
        .marketing__header1 {
            display: none;
        }
        .mobile_img {
            display: block;
            width: 100%;
        }
        .blog_bodySection aside, .artical_blogDetail aside{margin-top:40px;}
        .blog_bodySection {
            padding-top: 105px;
        }

        .widget.ads-widget{text-align:center;margin-bottom:0;}

        #footer-top .widget.dark img{width:165px;}
        #footer-top .widget.dark p{padding-top:15px !important;}

        .ds30_img{width:100px;margin-top:15px;}

        .ipad__view{display:block;margin:30px auto;float:none;}
        .ipad__view .course-sidebar{margin-top:0% !important;}

        .marketing_navTabs a.list-group-item {width: 30%;}
        .marketing__header {background-position: 1380px 0;}

        .footer .footer-bottom .text-right {text-align:center;padding-top:8px;}

        .studentIdBenf .img_Idbenf {text-align: center;margin-top:0 !important;}

        .populr_courses .nav-tabs > li > a {white-space: nowrap;overflow: hidden;text-overflow: ellipsis;}

        .course-box .course-details .title{
            margin-bottom:15px;
        }

        .why-join-box{padding:15px;}

        .certificate__HeaderSect {background-color: #f0f1f5;background-position: -310px 0;}
        .certificate__HeaderSect h3 {font-size: 42px;line-height: 49px;}

        .new__formStyle label, .new__formStyle input, .new__formStyle select, .new__formStyle textarea {
            font-size: 13px;
        }


        .newCategories__style .new_tbs li {
            margin-bottom: 8px;
        }
        .courseSlider_info{flex-direction: column;}
        .courseSlider_info .left_col {
            flex: 0 0 100%;
            max-width: 100%;
            border-top-left-radius: 6px; border-top-right-radius:6px;
            border-bottom-left-radius: 0;
            text-align: center; overflow:hidden;
        }
        .courseSlider_info .left_col img {
            width:auto;
        }
        .courseSlider_info .right_col {
            border-top-right-radius:0;
            border-bottom-right-radius: 6px;
            border-bottom-left-radius: 6px;
        }

        .pagination>li>a, .pagination>li>span {
            font-size: 12px;
        }

        #feedback {top:70%;}
        #feedback a {
            width:100px;font-size:13px;
        }

        .toast-success {background-color: #51a351 !important;}
        .toast-error {background-color: #bd362f !important;}
        .toast-info {background-color: #2f96b4 !important;}
        .toast-warning {background-color: #f89406 !important;}
        #toast-container>div{opacity:1 !important;}

        .cart_area .ordertotal {
            padding: 0 10px 10px;
        }

        .social-btns {
            height:30px;
        }
        .social-btns .btn {
            width: 30px;height: 30px;line-height:26px;
            margin: 0 5px;
        }
        .social-btns .btn .fa {
            font-size:20px;
        }

        #pdfviewer .modal-dialog{width:95% !important;}
        #pdfviewer button.close {
            position: absolute !important;
            margin: 0 !important;background: transparent !important;padding: 0 !important;
            right: 10px !important;top: 5px !important;color: #000 !important;font-size: 28px !important;
            opacity: .6 !important;
        }
        #pdfviewer .modal-body {
            padding: 15px 30px !important;
        }
        #pdfviewer .modal-body .text-center {
            text-align: center !important;margin-bottom: 0 !important;
            color: #000 !important;font-weight: 700 !important;font-size: 24px !important;
        }

        .popover.right {
            margin-left: 4px;
            margin-right: 10px;
        }
        .popover-content .quick-view-box {
            padding: 2px;
        }

        .tbl-shopping-cart thead tr th{padding:10px 8px !important;}

        .dropdown-cart.cart_area #emptycart {padding: 15px 0;}
        .dropdown-cart.cart_area #emptycart i {font-size: 20px;}
        #emptycart h4 {font-size: 1rem;margin-top: 3px;}
        .shopping-cart.mobile_dropdown.dropdown-cart.cart_area{
            top:52px;
        }

    }
    @media screen and (min-width:320px) and (max-width:768px) {

        .currency-selector {

            margin-left: 4px;
            width: 52px;
        }
        .apply-coupon input{height:45px;font-size: 15px;}
        .apply-coupon button{margin:0 !important;width:100%;/*background-color:#a0ce4e !important;*/height:45px;font-size: 15px;/*border-color:#a0ce4e;*/}

        .top__searchSec {background-position: -660px 0 !important;}
        .search-container .newsletter-form {margin:0;}
        .counts .counters i{font-size:2.4em}
        .counts .counters span {font-size: 32px;}
        .counts .counters h5 {font-size: 16px;}

        .nav-tabs {text-align: left;}
        .populr_courses .nav-tabs > li {float: left;width: 33.333333%;}

        .registration-area{
            /*background-image: url(https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/information-management.jpg);*/
            /*background-color: #000;background-size: cover;*/
        }
        .registration-area img{margin-bottom:25px;min-height:auto;}
        .registration-area .col-md-6.countdown{padding-left:20px;padding-right:20px;}
        .registration-area:before {display:none;}
        .registration-area:after {display:none;}
        .registration-area .grab-now-button .btn{width:100% !important;}

        .divider.inner-header h2 {margin-top: 0;line-height: 50px;}
        .divider.inner-header .breadcrumb {margin-bottom: 0;}

        .login-form .nav-tabs.nav-justified>li {display: table-cell;width: 1%;float: none;}
        .login-form{width:100%;}

        .main__testi .testi-item {text-align: center;width:100%;}
        .main__testi .testi-item .y-middle {display: block;}
        .main__testi .testi-item .circle {margin: 0 auto 10px;}
        .main__testi .testi-item .user-info, .main__testi .testi-item .name__info__ {text-align: center;width:100%;}

        .corporate_section {
            padding: 40px 0;background-position: -358px 0;
        }
        .corporate_section h3 {font-size: 40px;line-height: 49px;}
        .corporate_section p {font-size: 17px;padding-top: 7px; width:85%;}
        .corporate_section a.btn.btn-primary, .corporate__courses a.btn.btn-primary, .corprt_Inform_form .btn.btn-primary {
            font-size: 16px;margin-top: 4px;
        }

        .retake__feeBanner{background-position: -100px 0;}
        .retake__feeBanner h3 {
            font-size: 34px;line-height: 40px;
        }

        .corAbout_section img {width:40%;}

        .populr_courses:after {height: 70px;margin-top: -15px;}
        .populr_courses.terms__condition img, .corAbout_section img {margin-bottom:25px;}

        #footer-top .widget.dark img {width: 120px;}

        .all__coursesHeader#home h2, .top__searchSec#home h2{font-size:40px !important; }

        .blog__header {padding:30px 0 41px;background-position: center;}
        .blog__header h2 {font-size: 38px;}
        .blog__header p {width:90%;font-size: 16px;}
        .blog_detailHeader.populr_courses:after {
            margin-top: -10px;
        }

        .desktop__view{display:block;}
        .marketing__trms {background-position: 1358px top;}
        .ipd_mobile_view{display:none}

        #mobileview{display: block; margin-top:25px;}
        #desktopview{display: none;}

        .order_list2 {width: 90%;}
        .order_list2 li {flex: 0 0 45%;word-break: break-all;font-size:13px;}
        .thankyou_section p {width: 90%;}

        .mobile__sidrbr #mobileview {display: inline-block;margin:25px auto 15px; width:320px;}

        .blog_bodySection {
            padding-top:60px;
        }

        .become__businessImg{margin-top:25px;}




        #myModalshare .modal-body .social-icon{text-align:center;margin-top:20px;}
        #myModalshare .modal-body .social-icon ul li a {
            padding: 20px 15px;font-size: 20px;
        }

        .newCategories__style .tab-content .row{margin-left:-10px;margin-right:-10px;}
        .newCategories__style .tab-content .row > [class*="col-"] { padding-left:10px !important; padding-right:10px !important; }
        .newCategories__style .newCourse {
            margin-bottom: 0;
        }

        #cookies .inner_cookiesDev p {
            width:100%;text-align:center;
        }

        .w-100.text-sm-center{text-align:center;}
        .become__business .content__Info{
            text-align:center;
        }
        .become__business .content__Info p,.become__business .content__Info .section-title{
            text-align:left;
        }

        .w-sm-200{width:200px;}
        .w-sm-250{width:250px;}

        .cards__Links .row {margin-right: -5px !important;margin-left: -5px !important;}
        .cards__Links .row > [class*="col-"] { padding-left: 5px !important; padding-right: 5px !important; }
        .cards__Links .col-sm-6.col-xs-6:nth-child(3) .gradient-card, .cards__Links .col-sm-6.col-xs-6:nth-child(4) .gradient-card{margin-top:0 !important;}
        .cards__Links .gradient-card {padding: 10px !important;}
        .populr_courses ul.nav-tabs {
            margin-right: -2px !important;margin-left: -2px !important;
        }
        .populr_courses ul.nav-tabs > li {
            padding-left: 2px;padding-right: 2px;
            margin-right: 0;margin-left: 0;
            margin-bottom: 1px;
        }

        .inner__header {
            padding: 50px 0;
            background-position:center;
        }
        .inner__header p {
            width: 80%;
            font-weight: 600;
        }

        .certificate__HeaderSect{position:relative;background-position:73% center !important;}
        .certificate__HeaderSect .col-sm-8.col-12{text-align:center;}
        .certificate__HeaderSect:before{
            content:'';
            width:100%;height:100%;left:0;top:0;position:absolute;background-color: rgba(255, 255, 255, 0.65);
        }
        .certificate__HeaderSect h3, .certificate__HeaderSect p {width: 100% !important;text-align: center;}


    }
    @media screen and (max-width:767px){
        .lable_hidef label.w-100{display:none;}
        .checkOut_login{height: auto !important;}
        .checkOut_login form{margin-bottom:0;}

        #videoModal .modal-content iframe, #iframeModal .modal-content iframe {
            height: auto !important;
            padding:15px 0 !important;
        }
        .certificate_new_bx .img_ctrs {
            height: 220px;
        }

        .render_users{display:none;}

        .new__formStyle .field.select_div {
            margin-top: 20px;
        }

        #myModalLogin{padding-right:0 !important;}

        .gift__courseInfo {
            text-align: center;margin-top: 0;
        }
        .gift__courseInfo p {
            text-align: center;
        }
    }
    @media screen and (max-width:640px){
        .marketing_navTabs a.list-group-item {
            width: 45%;
        }
    }
    @media screen and (min-width:320px) and (max-width:567px) {
        .mobile_icon{
            display: block !important;
        }
        .desktop_text{
            display: none !important;
        }

        #feedback {
            top: auto; width: auto;
            bottom:56px; left:8px;
            z-index: 1000;
            transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
        }
        #feedback a {
            width: 45px; border-radius:100%;
            padding-top:13px;
            text-align: center;
        }
        .countdown .counter-item {width:50%;}
        .countdown .counter-item:first-child{padding-bottom: 25px;}
        .countdown .counter-item:nth-child(2){padding-bottom: 25px;}
        .maincertiback {height: auto;}


        .all__coursesHeader#home h2, .top__searchSec#home h2{font-size:36px !important;line-height: 40px;}
        .inner__search{width:92%;}
        .inner__search .input-group input,.inner__search .input-group button{height:45px !important;line-height:45px !important;}
        .inner__search .input-group input{font-size:14px;}
        .inner__search .input-group button{font-size:15px;}

        .studentId_form {padding: 25px 20px;}

        .counts .counters i {font-size: 2.1em;}
        .counts .counters span {font-size: 22px; padding:5px 0;}
        .counts .counters h5 {font-size: 12px;}

        .registration-area .countdown ul > li {padding-left: 22px;font-size: 14px;}
        .registration-area .countdown ul > li::after {font-size: 14px;color: #51ac37;}

        .corporate_section h3, .instructor_Banner h3, .inner__header h3 {font-size: 28px;line-height: 35px;}
        .corporate_section p, .instructor_Banner p, .inner__header p {font-size: 15px;padding-top: 7px;}

        .corAbout_section img {width:100%;}


        .col-12{width:100% !important;}
        .corAbout_section p {font-size: 15px;line-height:26px;}

        .blog__header {padding: 20px 0 31px;}

        .marketing__header {background-position: 1180px 0;}

        .catboxes {
            padding: 10px 28px 10px 10px !important;
            font-size: 14px !important;
            vertical-align: middle;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;
        }
        .catboxes:after {
            position: absolute;right: 19px;top: 25%;
        }
        .enquiry__from button.close {
            top:10px;right: -2px;background-color: transparent;
        }

        .view__cartSummary {
            padding: 10px;
        }
        .tbl-shopping-cart thead tr th{padding:10px 8px !important;font-size:12px;}

        .certificate_new_bx .img_ctrs {
            height:160px;
        }

        .instructor_Banner {
            padding:65px 0;
            background-position: -200px 0;
        }
        .instructor_Banner h3{
            width:80%;
        }
        .instructor_Banner p {
            /*font-size: 15px;padding-top: 7px;font-weight: 600;*/
            display:none !important;
        }

        .review_content {
            padding: 15px;
        }
        .right_col .d-flex {
            flex-direction: column;
        }
        .title.d-flex{flex-direction: column;padding-bottom: 10px;}

        #featured_courseSlider .owl-nav button {
            width: 28px;height: 28px;
            font-size: 22px !important;
            top: 50%;
            transform: translate(-0%, -50%);
        }

        #featured_courseSlider .owl-nav button.owl-prev {
            margin-left: -8px;
        }
        #featured_courseSlider .owl-nav button.owl-next {
            margin-right: -6px;
        }
        .courseSlider_info .right_col ul li {
            margin-left:10px;
        }
        .courseSlider_info .right_col ul li:after {
            display:none;
        }
        .courseSlider_info .right_col ul li {
            list-style: circle;
        }
        .courseSlider_info .right_col h3 {
            font-size: 20px;
        }
        .courseSlider_info .right_col .col-md-5 {
            text-align: left;
            padding-top: 10px;
        }


        .share-and-gift {
            flex-wrap: wrap;
            margin-left: -5px;margin-right: -5px;
        }
        .share-and-gift .clp-component-render{
            width:50%;
            float: left;margin: 0 !important;padding: 0 3px 6px;
        }
        .share-and-gift .clp-component-render .udlite-btn {
            width: 100%;
        }
    }
    @media screen and (min-width:320px) and (max-width:480px) {

        #videoModal .modal-body{
            padding: 15px 15px;
        }
        #videoModal .modal-body video{
            height: auto !important;
        }

        #iframeModal iframe{
            height:220px !important;
        }

        .btn_serch {
            width: auto;
            padding: 5px 14px 5px 10px;
        }
        .top__searchSec {
            padding: 88px 0 83px;
        }
        /*.top__searchSec {background-position: -752px 10px !important; }*/

        .top__searchSec#home h2{font-size:30px !important;}

        .login-form .social__icons a {padding-left: 30px;}

        .search-container .newsletter-form {max-width:100% !important;margin-left:0;padding:10px;}
        .search-container .newsletter-form .input-group input {height: 45px !important;}
        .search-container .newsletter-form .input-group button.btn {height: 45px !important;}

        .become__business .content__Info {padding:15px 20px;}
        .testi-item {padding:8px 15px !important;}
        .testi-item .user-info{padding-left:10px; padding-top:15px;}
        .testi-item .user-info .name {font-size:14px;}
        .testi-item .user-info .designation {font-size: 13px;}
        .testi-item .desc {padding-left:10px !important;font-size: 15px;}

        .single-course-thumb .course-info {padding-top: 0 !important; margin-bottom:0 !important;}

        .populr_courses:before {height: 50px;}
        .populr_courses:after {height: 34px;}

        .populr_courses .nav-tabs > li {float: left;width:50%;}
        .populr_courses .nav-tabs > li > a {font-size: 11px;font-weight: 600; padding: 5px 3px;letter-spacing:-.3px;}

        .footer .footer-bottom {padding-bottom: 25px;}

        .categories-section .row {margin-right: -5px !important;margin-left: -5px !important;}
        .categories-section .row > [class*="col-"] { padding-left: 5px !important; padding-right: 5px !important; }

        .populr_courses .tab-pane .btn.w-320 {white-space: normal;}

        .testimonial__Section:before {height: 90px;background-position: center;}
        .testimonial__request .rating {width:100% !important;}
        .testimonial__request .rating i {font-size: 40px;}


        .field input:placeholder-shown + label, .field textarea:placeholder-shown + label {
            text-overflow: ellipsis;transform-origin:left bottom;transform: translate(0, 2.425rem) scale(1.2);padding: 0 10px;
        }
        /*.field select:placeholder-shown + label, .field textarea:placeholder-shown + label {
            text-overflow: ellipsis;transform-origin:left bottom;transform: translate(0, 2.425rem) scale(1.2);padding: 0 10px;
        }*/
        .field input:not(:placeholder-shown) + label, .field input:focus + label, .field textarea:not(:placeholder-shown) + label, .field textarea:focus + label {
            padding:0;transform: translate(0, 0) scale(1);cursor: pointer;
        }

        .w3_info #form-section {
            padding-top:0 !important;
        }
        .w3_info .modal-title, #forgetPasswordModal .modal-title {
            margin-bottom: 0;
        }
        .w3_info h6{margin-top:0;margin-bottom:5px;}
        .new__formStyle .field input, .new__formStyle .field select, .new__formStyle .field textarea {
            height: 40px;padding: 5px 10px;
        }
        .new__formStyle .field.select_div:before {top:8px;}
        .new__formStyle .field select {font-size: 13px;}
        .new__formStyle #enquiry-form{margin-bottom:0 !important;}

        #myModalRequest .w3_info{padding-bottom:5px;}
        #enquiry-form{margin-bottom:0 !important;}
        #enquiry-form .field input{height:32px;font-size: 13px !important;}
        #enquiry-form .field select {font-size: 13px !important;height:32px;}
        #enquiry-form .field textarea{font-size:13px !important;}
        #enquiry-form .form-group {margin-bottom: 1px;}
        #enquiry-form .field input:placeholder-shown + label{
            text-overflow: ellipsis;transform-origin:left bottom;transform: translate(0, 2.125rem) scale(1.2);padding: 0 10px;
        }
        #enquiry-form .field input:not(:placeholder-shown) + label, #enquiry-form .field input:focus + label,
        #enquiry-form .field textarea:not(:placeholder-shown) + label, #enquiry-form .field textarea:focus + label {
            padding:0;transform: translate(0, 0) scale(1);cursor: pointer;
        }
        .rechaptcha_div div{margin-top:2px !important;}
        #enquiry-form .btn-dark.btn-theme-colored {font-size: 12px;}

        #enquiry-form #captcha_msg .alert.alert-danger{
            padding:5px;font-weight:13px;margin-bottom:0;
        }


        #giftfrm .field input, #giftfrm .field select{
            height:45px;font-size:13px !important;font-weight:600 !important;
        }
        #giftfrm .field textarea {height: 80px !important;}

        .new__formStyle label b{display:block;}

        .ptnr__logos h2.title {font-size: 40px;line-height: 44px;}
        .mainAbout__section h2.title {font-size: 40px;line-height: 40px;}

        #footer-top li{display:inline-block;width:100%;}

        .blog__header h2 {font-size: 28px;font-weight: 700;}
        .blog__header p {width: 100%;font-size: 14px;text-align: center;}
        .popular-BlogSection.populr_courses:after {margin-top: -16px;}
        .popular__blogs-slide .blog-item .post-thumb {height: 200px;}
        .popular__blogs-slide .blog-item .post-thumb img {height: 200px;}
        .blog_bodySection {padding-top:50px;}

        .post-description .post-meta span {display: block;width: 100%;}
        .post-description .post-meta a {text-align: left;width: 100%;}

        .blog_detailHeader.populr_courses:after {margin-top: -5px;}
        .blog_detailHeader {padding-top: 43px;}
        .blog_detailHeader h2 {font-size: 30px;}
        .blog_detailHeader .breadcrumb li, .blog_detailHeader .breadcrumb li a {font-size: 13px;}
        .entry-header .post-thumb {height: 280px;}
        .entry-header .post-thumb img {height: 280px;}

        .content__Info .btn-dark.btn-theme-colored2 {
            margin-top: 25px;
            font-size:12px !important;white-space: break-spaces; padding:10px 8px; display:block;
        }
        .font-27 {font-size:18px !important;}
        section.faqs p{text-align:left !important;}
        #accordion .card-header h3 {font-size: 16px;font-weight:500;}

        .marketing__header{background-image:url('<?=UPLOADS.'images/header_bg/bg_7mob.jpg'?>') !important; background-position:top center !important;text-align:center;padding: 110px 0 35px;}
        {{--.marketing__header{background-image:url('<?=UPLOADS.'lms/series/offerbanner/'?>') !important; background-position:top center !important;text-align:center;padding: 110px 0 35px;}--}}
        .marketing__header p{text-align:center;}
        .marketing__header img{margin-top:360px;}
        .marketing_navTabs a.list-group-item {width: 94%;height: 55px;line-height: 32px;margin-top:5px;}
        .marketing__trms img{margin-bottom:20px;}

        .contact.new__pgfrmstyle h2.title{font-size:1.8rem !important;}

        .order_list2 {width:100%;}
        .thankyou_section p {width: 100%;text-align: center;}


        .certificate__HeaderSect h3 {font-size: 22px;line-height: 27px;}
        .certificate__HeaderSect p {font-size: 15px;padding-top:0;}
        .certificate__HeaderSect a.btn.btn-primary {
            min-width: 220px;font-size: 14px;padding: 9px 30px;margin-top: 10px;
        }

        #myModalshare .modal-body .btn{width:100%;}

    }

    @media screen and (max-width:480px) {
        .newsletter-form1 .form-control {
            font-size: 14px !important;
            padding: 14px 15px 14px !important;
            height: 50px !important;
        }
        #subscription-form-footer button i {display:none;}
        .newsletter-form1 .input-group button {
            min-height: 41px;
        }
        .w-xxs-100, .offerItem{width:100% !important;}
        .certificate_new_bx .img_ctrs {
            height:140px;
        }
        table.table.table-striped.tbl-shopping-cart tr th:nth-child(3){white-space:nowrap;}
        table.table.table-striped.tbl-shopping-cart tr td:nth-child(3){white-space:inherit;}
        table.table.table-striped.tbl-shopping-cart tr td .amount i{display:inline;margin-right:4px;font-size: 12px;}

        #cookies .cooking_btns{
            padding-bottom: 0px;
        }

        .w-sm-250{width:100%;}

        .newlogin__from .login__content{padding:30px 20px;}
        #ccpaypalform .stripe-form .form-control, .new__formStyle .form-control{margin-top:0 !important;font-size:13px !important;}
        .new__formStyle .box_cart .payment-method .radio > label img{margin:0 auto !important;}
    }
    @media screen and (min-width:381px) and (max-width:480px) {
        .course-header-wrap > div > span.detl_cont{display:inline-flex;}
        .course-header-wrap > div > span:last-child{display:block;}
    }
    @media screen and (min-width:320px) and (max-width:380px) {
        .cards__Links .gradient-card .card-title.card-title-first {font-size: 1.1rem;}
        .cards__Links .gradient-card .icon {height: 30px;width: 30px;line-height: 31px;font-size: 1.3rem;}

        .login-form .social__icons a {font-size: 13px;}
        .login-form .social__icons a i.fa {width: 20px;height: 20px;line-height: 20px;top: 14px;}

        .entry-header .meta-tag {display: inline-block;width: 100%;}
        .entry-header .meta-tag ul {flex: 0 0 100%;}

        .card-marketing .col-xs-6 {width:100%;}

        .certificate_new_bx .img_ctrs {
            height:115px;
        }

        table.table.tbl-shopping-cart thead tr th:nth-child(1),
        table.table.tbl-shopping-cart tr td.product-thumbnail, table.table.cart_shoppingTable thead tr th:nth-child(2){
            /*width:0 !important;overflow:hidden;padding:0 !important;*/
        }
        table.table.tbl-shopping-cart thead tr th:nth-child(1) .hidMob, table.table.cart_shoppingTable thead tr th:nth-child(2) .hidMob,
        table.table.tbl-shopping-cart tr td.product-thumbnail a{/*display:none;*/}

        table.table.cart_shoppingTable thead tr th:nth-child(1),
        table.table.cart_shoppingTable tbody tr td:nth-child(1){
            padding-right:0 !important;
        }

        .social-btns .btn {width:25px;height:25px;line-height:20px;margin: 0 3px;}
        .social-btns .btn .fa {font-size:18px;}

        .course-header-wrap > div > span:first-child, .course-header-wrap > div > span:last-child{display:block;}
    }
    @media screen and (max-width:570px) {
        .certificate_new_bx .row{
            display:table !important;
        }
        .certificate_new_bx .row .col-md-5, .certificate_new_bx .row .col-md-6{
            display:table-cell !important;
            float:none !important;
        }
        .certificate_new_bx .row .col-md-5 img, .certificate_new_bx .row .col-md-6 img{
            height: auto !important;
        }
        .id_img, .main-certi-sec {margin: 10px auto 0;}

        .nla-course-comparison-content tbody tr td {padding:10px !important;}
        .render_title .course__name {
            line-height: 1.5;height:38px;letter-spacing: 0;
        }
        .nla-meta-items.y-middle{display:table;}
        .nla-meta-items.y-middle span{display:table-cell;}
        .nla-badge {margin: 0 .8rem 4px 0;}

        .render_price{text-align:center;padding-left:0 !important;width:105px;max-width:105px;}
        .render_price .render_rating {font-size: 14px;padding-bottom: 4px;vertical-align:middle;}
        .render_price .render_rating i {
            font-size:13px;
        }
        .nla-course-comparison-content tbody tr td.course-image-wrapper,
        .nla-course-comparison-content tbody tr td.render_rating,
        .nla-course-comparison-content tbody tr td.render_users,
        .nla-course-comparison-content tbody tr td.render_cart{display:none !important;}

        .nla-course-comparison-content .render_title img {
            max-width:55px;width:55px !important;margin:0 0 5px;
        }

        .mob_rating{display:block;width:100%;}
        .mob_rating i{font-size:13px;}
        .mob_img2{display:inline-block;width:55px;}

        .nla-component-render .render_cart {
            width:55px;max-width:55px;text-align: center;
            padding: 10px 0 !important;
        }

        .populr_courses .btn-sm {padding: 5px 8px; width:100%;}
        .course-box .btn-sm {min-width: 100% !important;}

        #mainVideoModal .modal-body {
            padding:0 !important;
        }
        #mainVideoModal .modal-body video {
            height:100% !important;
        }

        #forgetPasswordModal .modal-body{padding:15px !important;}
        #forgetPasswordModal .modal-title{
            font-size:22px;line-height:26px;
        }
        .latest_form .switch_btn {
            justify-content: flex-start;
            -webkit-justify-content: flex-start;
            -webkit-box-pack: start;
            -ms-flex-pack: start;
            align-items: start;
            -webkit-align-items: flex-start;
            margin-top: 15px;
        }

        .cart_added_popup .check_arrow{font-size:22px;padding-left:0;}
        .cart_added_popup .item_button a {font-size: 13px;padding: 6px 10px;}
        .cart_added_popup .item-name {font-size: 13px;padding: 6px 10px;width:46%;line-height: 18px !important;}
        .cart_added_popup .cart_image {width:40px;}

        .new__formStyle select option{font-size:13px !important;padding:0 !important;line-height:13px !important;}

        .populr_courses .btn.btn-block.btn-primary.w-320{
            padding: 8px 8px;
        }

    }
    @media screen and (min-width:320px) and (max-width:360px) {
        .cart_area .box_cart .row .col-xs-6{
            width:100%;
        }
        .cart_area .box_cart .row .col-xs-6:last-child{
            margin-top:10px;
        }
        .cart_area .box_cart .row .col-xs-6 .btn{
            width:100%;
        }

        .populr_courses .tab-content .tab-pane .col-xs-6{width:100%;}
        .partner .item img {
            max-width: 100% !important;
            display: inherit;
        }

        .cart_added_popup .check_arrow {
            font-size: 16px;
            padding-left: 0; padding-right:6px;
        }
        .cart_added_popup .item-name {
            padding: 6px 8px;
        }
        .cart_added_popup .item_button a {
            font-size: 11px;padding: 6px 6px;
        }

        .newCategories__style .tab-content .row .col-xs-6.w-xxs-50{
            width:100%;
        }
        .new__formStyle .form-group .field div{margin-bottom:0 !important;}
        .new__formStyle .form-group .field div .g-recaptcha{width:256px !important;}
        .rc-anchor-normal .rc-anchor-checkbox-label {width: 122px;}
        .loadMore_btn {
            width: 100%;
        }
        #contact-details .prc_wrap {
            padding:5px 0;
        }
        .corporate_section {background-position:-60px 0 !important;}
        .corporate_section.certificate__HeaderSect {background-position: 68% center !important;}
        .course-info .font-20 {font-size: 16px !important;}
    }
    @media screen and (max-width: 767px){
        .reviews__section #reviews-widget-summon-carousel-inline .CarouselWidget .reviewsContainer .reviewWrap {
            height: 75%;
        }
      .reviews__section #reviews-widget-summon-carousel-inline .CarouselWidget .CarouselWidget .cw__content{

            height:175px;
        }
    }
    @media screen and (min-width:320px) and (max-width:320px) {
        #reviews-widget-summon-carousel-inline iframe .widgetContainer .CarouselWidget.cfx.fullWidth,
        .CarouselWidget.cfx.fullWidth {
            margin-left: -10px !important;
        }
        .reviews__section .container {
            padding-left: 5px;
        }

    }
    @media screen and (min-width:414px) and (max-width:414px) {
        .home_page_Clogo .item:nth-child(7){padding-left:0 !important;margin-left: -23px;}
        .home_page_Clogo .item:nth-child(8){padding-left:25px !important;}
    }
    @media screen and (min-width:1280px) and (max-width:1440px) {
        .main-nav-wrap>ul>li>ul {
            font-size: 12px;
            padding: 6px 0;
        }
        .main-nav-wrap>ul>li>ul>li a {
            padding: 4px 8px 4px 6px;
            font-size: 11px;
            line-height: 14px;
        }
        .main-nav-wrap>ul>li>ul>li a .icon {
            width:15px;height: 15px;margin-right: 5px;
        }
        .main-nav-wrap>ul>li>ul>li a .icon i {
            font-size: 12px;
        }
        .main-nav-wrap>ul>li>ul>li ul {padding:8px 0;}
        .category.corner-triangle.top-left {max-height: 400px !important;}
        .category.corner-triangle.top-left .sub-category {height: 400px !important;}
        .main-nav-wrap ul li li .has-sub-category {
            line-height: 18px;
        }
    }
    @media screen and (min-width:922px) and (max-width:1279px) {
        .main-nav-wrap>ul>li>ul {font-size: 12px;padding: 6px 0;}
        .main-nav-wrap>ul>li>ul>li a {
            padding: 4px 8px 4px 6px;font-size: 11px;line-height: 14px;
        }
        .main-nav-wrap>ul>li>ul>li a .icon {
            width:15px;height: 15px;margin-right: 5px;
        }
        .main-nav-wrap>ul>li>ul>li a .icon i {
            font-size: 12px;
        }
        .main-nav-wrap>ul>li>ul>li ul {padding:8px 0;}
        .category.corner-triangle.top-left {max-height: 400px !important;}
        .category.corner-triangle.top-left .sub-category {height: 400px !important;}
        .main-nav-wrap ul li li .has-sub-category {
            line-height: 18px;
        }
    }
    /*landscape media query*/
    @media only screen and (min-device-width: 768px) and (max-device-width: 1440px) and (orientation : landscape){
        .category.corner-triangle.top-left{
            /*width: 540px;*/max-height: 360px;/*overflow-y: scroll;*/
        }
        .category.corner-triangle.top-left .sub-category{
            height: 527px;
        }
    }
    @media screen and (min-width: 1024px) and (max-width: 1140px){
        footer .paymentInfo img {
            width: 100px;
        }

        .blog_bodySection {
            padding-top: 115px;
        }

    }
    @media screen and (min-width:1366px) and (max-width:1440px) {
        #desktopview.course-sidebar, #desktopview.course-sidebar.fixed{width:265px;}
    }
    @media screen and (min-width:1199px) and (max-width:1280px) {
        #desktopview.course-sidebar, #desktopview.course-sidebar.fixed{width:245px;}
        #trending__maincourse .btn-sm {
            min-width: 100% !important;
        }
    }
    @media screen and (min-width:1024px) and (max-width:1166px) {
        #desktopview.course-sidebar, #desktopview.course-sidebar.fixed{width:205px;}
    }
    @media screen and (min-width:640px) and (max-width:768px) {
        #trending__maincourse .btn-sm {min-width: 100% !important;}
    }
    @media screen and (min-width:1024px) and (max-width:1199px) {
        .populr_courses .course-box .course-details .btn-sm, .course-box .course-details .btn-sm {
            min-width: 100% !important;
        }
    }
    @media screen and (max-width:425px) {
        .review-details {
            margin-top: 14px;
        }
        .newCourse .d-flex.h__footer {
            height:70px !important;
            display: inline-block !important;width: 100%;
        }
        .newCourse .btn {
            margin-top: 5px;
            width: 100%; line-height:14px;
        }
        .new__formStyle .form-group{position:relative;margin-bottom:3px;}
        .check__out label {padding: 0 10px 0 30px;width: 100%;}
        .check__out label input {left:8px;top:1px;}
        .studentId_form .btn.btn-primary{width: 93.8%;margin: 10px 10px 0 10px;}

        .course-curriculum-box .panel-group .panel-heading .panel-title a {
            width: 100%;display: inline-block;
        }
        .section-time {position: relative;width: 100%;padding-top: 2px;}
        .section-time i {
            position: relative !important;
            top:0 !important;left:0 !important;
        }

        .corporate_section {background-position:0;}
        .corporate_section p, .giftCourse_Banner p{display:none;}
        .corporate_section h3, .inner__header h3{font-size: 24px;}
        .new__formSection {padding-top: 20px;}

        .retake__feeBanner {background-position:-80px 0;}

    }
    @media screen and (max-width:360px) {
        .newCourse .d-flex.h__footer {
            height: 90px !important;
            display: inline-block !important;
            width: 100%;
        }
        .newCourse .btn {
            margin-top: 5px;
            width: 100%;
            font-size: 14px;
            height: 40px;
            line-height: 25px;
        }
        .course-box .course-image {height: 185px;}
        .course-box .course-image img {height: 185px !important;}
        .dropdown-cart.cart_area #emptycart {padding: 10px 0;}
    }
    @media screen and (max-width:576px){
        .text-sm-left{text-align:left!important}.text-sm-right{text-align:right!important}.text-sm-center{text-align:center!important}
    }
    @media screen and (max-height: 575px){
        #rc-imageselect, .g-recaptcha {transform:scale(0.82);-webkit-transform:scale(0.82);transform-origin:0 0;-webkit-transform-origin:0 0;}
        #rc-imageselect {
            transform:scale(0.75);
            -webkit-transform:scale(0.75);
            transform-origin:0 0;
            -webkit-transform-origin:0 0;
        }

        .thankyou_section .btn.btn-primary {
            width: 270px;
        }
        .links-social a {
            width: 30px;height: 30px;line-height: 30px;font-size: 14px;
        }
    }

    /********** pixel by pixel media query **********/
    @media only screen and (orientation : landscape){
        .shopping-cart.mobile_dropdown .list_cart {max-height: 120px !important;}
    }
    /*** Fine css style for landscape ****/
    /* Landscape */
    @media only screen and (min-device-width: 375px) and (max-device-width: 667px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: landscape) {

    }
    /* Landscape iPhone 6+ */
    @media only screen and (min-device-width: 414px) and (max-device-width: 736px) and (-webkit-min-device-pixel-ratio: 3) and (orientation: landscape) {
        .categories-section .single-course-thumb img {height: 215px !important;}
    }
    /* iPhone x */
    @media only screen and (min-width: 375px) and (max-width: 812px) and (orientation: landscape) {
        .blog__header {padding: 40px 0 !important;background-position:-205px 0 !important;}
        .blog__header p {width: 100%;}
        .new__formStyle .form-group {
            margin-bottom: 5px;
        }
        .new__formStyle .field input, .new__formStyle .field select, .new__formStyle .field textarea {
            height: 40px;padding: 5px 10px;
        }
        .new__formStyle .field input:placeholder-shown + label, .new__formStyle .field textarea:placeholder-shown + label {
            padding: 0 10px !important;
            transform: translate(0, 2.125rem) scale(1.4) !important;
        }
        .new__formStyle .field.select_div {
            margin-top: 20px;
        }
        .new__formStyle .field.select_div:before {
            top: 8px;
        }
        .top__searchSec {padding: 90px 0 90px !important;background-position: -600px 0;}
    }
    /* iPad */
    @media only screen and (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
        .blog__header {padding:50px 0;background-position:-75px 0;}
        .blog__header p {width: 100%;}
    }
    /***** Surface Duo deveice *****/
    @media only screen and (min-width: 540px) and (max-width: 720px) {
        .corporate_section {background-position: -407px 0;}
        .corporate_section h3{width:78%;}
        .corporate_section p {width: 60%;}

        .retake__feeBanner {background-position: -200px 0;}
    }
    /**** iphone 5/SE ******/
    @media only screen and (min-width: 320px) and (max-width: 568px) and (orientation: landscape){
        .corporate_section h3 {
            width: 100%;font-size: 30px;line-height: 35px;
        }
        .corporate_section p {
            width: 70%;font-size: 16px;
        }
    }

    /******* paddings ********/
    .ptb-0{padding-top:0 !important;padding-bottom:0 !important;}
    @media (min-width:1200px) {
        .ptb-lg-50{padding-top:50px; padding-bottom:50px;}
        .ptb-lg-60{padding-top:60px; padding-bottom:60px;}
    }
    @media (max-width:1199px) {
        .ptb-md-40{padding-top:40px; padding-bottom:40px;}
        .ptb-md-60{padding-top:60px; padding-bottom:60px;}
    }
    @media (max-width:991px) {
        .ptb-sm-30{padding-top:30px;padding-bottom:30px;}
        .ptb-sm-40{padding-top:40px;padding-bottom:40px;}
    }
    @media (max-width:767px) {
        .ptb-xs-20{padding-top:20px;padding-bottom:20px;}

        .ptb-xs-30{padding-top:30px;padding-bottom:30px;}
        .all__coursesHeader{
            background-repeat: no-repeat;
            background-size:cover;
            background-position: top;
            background-size:cover;
        }
    }

    @media only screen and (min-width:568px) and (max-width:320px) {
        #feedback {top:70%;}
    }


    .popover-content .quick-view-box{padding:10px;}
    .popover-content .quick-view-box--Title{font-size:18px;color:#000;}
    .popover-content .badge-container--1NLa {
        margin-top: .5rem;
        display: flex;
        align-items: baseline;
    }
    .popover-content .badge-bestseller {
        background-color: #ffe799;
        color: #593d00;
    }
    .popover-content .nLAlite-badge {
        border-radius: 4px;
        display: inline-block;
        padding: .2rem .4rem;
        white-space: nowrap;
        margin-right: .5rem;font-size:11px;
    }
    .popover-content .updated--2NLA {color: #2d8643;}
    .popover-content .nLAlite-text-xs {
        font-weight: 400;
        line-height: 1.4;
        font-size:.75rem;
    }
    .popover-content .nLAlite-heading-xs {
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: -.02rem;
        font-size: .7rem;
    }
    .popover-content .box--stats--3pNLA {
        margin-top: .6rem;
        color: #73726c;
    }
    .popover-content .box--stats--3pNLA>span:not(:last-child)::after {
        content: '\25CF';
        margin: 0 .3rem;
        font-size: 6px;
        vertical-align: middle;
    }
    .quick-view-box--cta--3NLA{
        margin-top: .1rem;
        display: flex;
        justify-content: space-between;
    }
    .quick-view-box--cta--3NLA .add-to-cart--2Nla {
        display: flex;flex-direction: column;
        width: 100%;background-color: #84ba3f;
        border-color: #84ba3f;font-size: 11px;text-transform: uppercase;
    }
    .quick-view-box--cta--3NLA .header__btns{margin-left:.5rem;}
    .quick-view-box--cta--3NLA .header__btns .addToWishlist{
        width: 33px;
        height: 33px;
        border: #84ba3f solid 1px;display: inline-flex;justify-content: center;user-select: none;
        vertical-align: bottom;white-space: nowrap;
        border-radius: 10%;position: relative;align-items: center;
        background-color: rgba(132, 186, 63, 0.20);
    }
    .box--headline--GZKCw{margin-top:.6rem;}
    .nLAlite-text-sm{
        font-weight: 400;
        line-height: 1.5;font-size: .75rem;
    }
    .box--objectives--3WNla{
        margin-top: .8rem;
        margin-bottom: 1rem;
    }
    .box--objectives--3WNla ul{
        margin:0;padding:0;
    }
    .box--objectives--3WNla ul li{
        margin-bottom: 8px;width: 100%;
        padding-left: 20px;position: relative;
        font-weight: 400;
        line-height: 1.5;
        font-size: .75rem;
    }
    .box--objectives--3WNla ul li:before {
        font-family: Font Awesome\ 5 Free;
        font-weight: 900;
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        line-height: 1;
        content: "\f00c";
        color: #84ba3f;
        font-size: 13px;
        position: absolute;
        left: 0;
        top: 4px;
    }

    @media screen and (min-width:320px) and (max-width:640px) {
        .popover {max-width: 200px;}
        .popover .popover-content {padding:0;}
    }
    @media screen and (min-width:320px) and (max-width:460px) {
        .popover.left.in{left:auto !important;margin-left:10px !important;}
        .popover.right.in{right:auto !important;margin-right:5px !important;}
    }

    .inner__header.promotionExcel_Banner{position:relative;}
    .inner__header.promotionExcel_Banner:before{
        content:'';
        background: linear-gradient(90deg, #FFFFFF 0%, rgba(255, 255, 255, 0) 92.13%);
        width:54%;height:100%;left:0;top:0;position:absolute;
    }
    .inner__header.promotionExcel_Banner h3{font-size:34px;font-weight:700;}
    .inner__header.promotionExcel_Banner p{font-size:16px;font-weight:400;padding-top:0;}
    .inner__header.promotionExcel_Banner h6{font-size:18px;font-weight:700;color: #000;
        margin-top: 10px;
        display: inline-block;}
    .inner__header.promotionExcel_Banner h6 img{margin-right:10px;}

    .promoExcel_inner, .promoExcel_signUp, .promoExcel_course{padding:50px 0;}
    .promoExcel_inner .container, .promoExcel_signUp .container, .promoExcel_course .container{padding-top:0;padding-bottom:0;}
    .promoExcel_inner h4{text-align:center;color:#000;font-size:30px;margin-top:0;}
    .whyChoose_box{width:100%;display:inline-block;margin-top:25px;overflow:hidden;text-align:center;}
    .whyChoose_box figure{
        width:260px;height:260px;background-color:#CEE4EB;
        border: 1px solid #CEE4EB;
        cursor: default; margin:0 auto;
        overflow:hidden !important;
        -webkit-border-radius:100%;
        -moz-border-radius:100%;
        -ms-border-radius:100%;
        -o-border-radius:100%;
        border-radius:100%;
    }
    .whyChoose_box figure img{
        width:260px;height:260px;object-fit:cover;
        -webkit-transform: scale(1);-moz-transform: scale(1);-ms-transform: scale(1);-o-transform: scale(1);transform: scale(1);
        -webkit-animation-duration:5s !important;-moz-animation-duration:5s !important;-ms-animation-duration:5s !important;-o-animation-duration:5s !important;animation-duration:5s !important;
        -webkit-animation-delay: 3s !important;-moz-animation-delay: 3s !important;-ms-animation-delay: 3s !important;-o-animation-delay: 3s !important;animation-delay: 3s !important;
        cursor: default;
        -webkit-transition: .5s ease-in;
        -moz-transition: .5s ease-in;
        -ms-transition: .5s ease-in;
        -o-transition: .5s ease-in;
        transition: .5s ease-in;
    }
    .whyChoose_box h3{
        font-size:18px;line-height:22px;color:#000;text-align:center;display: block;display: -webkit-box;
        -webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;--max-lines: 2;
        height: 46px;
        cursor: default;
    }
    .whyChoose_box:hover figure img{
        -webkit-transform: scale(1.2);
        -moz-transform: scale(1.2);
        -ms-transform: scale(1.2);
        -o-transform: scale(1.2);
        transform: scale(1.2);
    }
    .whyChoose_box:hover h3{color:#51ac37;}
    .promoExcel_inner .btn.btn-primary, .promoExcel_signUp .signUp_banner .right .btn.btn-primary {
        min-width:300px;
        font-size: 14px;font-weight: 400;
        color: #fff;
        text-transform: uppercase;padding:15px 10px;border-radius: 6px;margin-top: 13px;
    }

    .promoExcel_course .dummyCoure_box {
        height: 390px;
        background-color: #cee4eb00;
        box-shadow: none;
    }
    .promoExcel_signUp .signUp_banner{
        width:100%;height:415px;
        background-size:cover;background-repeat:no-repeat;background-position:top left;position:relative;
        border: 1px solid #CEE4EB;border-radius: 10px;
        justify-content: flex-end;
        -webkit-justify-content: flex-end;
        -webkit-box-pack: end;
        -ms-flex-pack: end;
        align-items: center;
        -webkit-align-items: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        display: flex;
        display: -webkit-flex;
        /*display: -webkit-box;*/
        display: -moz-flex;
        display: -moz-box;
        display: -ms-flexbox;
    }
    .promoExcel_signUp .signUp_banner .right{
        width:37%;margin-right:3%;position:relative;
    }
    .promoExcel_signUp .signUp_banner .right p{
        font-size:24px;line-height:40px;font-weight:700;margin-bottom:0;
    }

    .promoMakeup_signUp{padding:60px 0;}
    .promoMakeup_signUp .signUp_banner{
        width:100%;padding:90px 25px;
        background-size:cover;background-repeat:no-repeat;background-position:top left;position:relative;
        border: 1px solid #CEE4EB;border-radius: 10px;
        justify-content: center;
        -webkit-justify-content: center;-webkit-box-pack: center;-ms-flex-pack: center;
        align-items: center;-webkit-align-items: center;-webkit-box-align: center;-ms-flex-align: center;
        display: flex;display: -webkit-flex;display: -webkit-box;display: -moz-flex;display: -moz-box;display: -ms-flexbox;
    }
    .promoMakeup_signUp .signUp_banner .center{
        width:50%;position:relative;text-align:center;
    }
    .promoMakeup_signUp .signUp_banner .center p{
        font-size:24px;line-height:40px;font-weight:700;margin-bottom:0;text-align:center;
    }
    .promoMakeup_signUp .signUp_banner .center .btn.btn-primary {
        min-width:300px;
        font-size: 14px;font-weight: 400;
        color: #fff;
        text-transform: uppercase;padding:15px 10px;border-radius: 6px;margin-top: 13px;
    }

    .promoExcel_course .row.d-flex{flex-wrap: wrap;}
    .promoExcel_course .row.d-flex .col-auto:first-child{margin-left:auto;}
    .promoExcel_course .row.d-flex .col-auto:last-child{margin-right:auto;}

    @media screen and (min-width:1024px) and (max-width:1199px) {
        .promoExcel_signUp .signUp_banner .right {
            width: 30%;
            margin-right: 5%;
        }
        .promoMakeup_signUp .signUp_banner .center {width: 75%;}
    }
    @media screen and (min-width:320px) and (max-width:768px) {
        .inner__header.promotionExcel_Banner{background-position: 76% top;}
        .inner__header.promotionExcel_Banner .container{padding-top:0;padding-bottom:0;}
        .inner__header.promotionExcel_Banner:before{background: linear-gradient(90deg, #FFFFFF 10%, rgba(255, 255, 255, .3) 99.13%);width: 100%;}
        .inner__header.promotionExcel_Banner p {width:100%;font-size:14px;}

        .promoExcel_signUp .signUp_banner {
            height:auto;padding:50px 0;
            justify-content: center;background-position: -73px 0;
            justify-content:center;-webkit-justify-content: center;-webkit-box-pack: center;-ms-flex-pack: center;
        }
        .promoExcel_signUp .signUp_banner .right {
            width: 90%;
            margin-right: 0;
            padding: 0;
            text-align: center;z-index:1;
        }
        .promoExcel_signUp .signUp_banner .right p {text-align: center;}
        .promoExcel_signUp .signUp_banner{position:relative;}
        .promoExcel_signUp .signUp_banner:before{
            content:'';
            width:100%;height:100%;left:0;top:0;position:absolute;background-color: rgba(255, 255, 255, 0.65);
        }

        .inner__header.promotionExcel_Banner h3 {line-height: 46px;}
        .promoMakeup_signUp .signUp_banner{
            padding:60px 25px;
            position:relative;
        }
        .promoMakeup_signUp .signUp_banner .center{
            width:100%;position:relative;text-align:center;
        }
        .promoMakeup_signUp .signUp_banner:before{
            content:'';
            width:100%;height:100%;left:0;top:0;position:absolute;background-color: rgba(255, 255, 255, 0.65);
        }

    }
    @media screen and (min-width:320px) and (max-width:480px) {
        .promoExcel_signUp .signUp_banner .right p {
            font-size: 20px;line-height: 29px;
        }
        .promoExcel_inner .btn.btn-primary, .promoExcel_signUp .signUp_banner .right .btn.btn-primary, .promoMakeup_signUp .signUp_banner .center .btn.btn-primary {
            min-width: 100%;font-size: 16px;
        }
        .promoMakeup_signUp .signUp_banner{padding:30px 25px;}
        .promoExcel_inner .col-12:first-child .whyChoose_box{margin-top:25px;}
        .promoExcel_inner .whyChoose_box{margin-top:0;}
        .promoExcel_inner .whyChoose_box figure{display:none;}
        .promoExcel_inner .whyChoose_box h3 {text-align: left;height: auto;position:relative;margin-top:0;padding-left:45px }
        .promoExcel_inner .whyChoose_box h3:before{content:"\f00c";font-family: "Font Awesome 5 Free";font-size:16px;position:absolute;top:0;left:15px;
            color:#51ac37;
        }

    }
    @media screen and (min-width:320px) and (max-width:380px) {
        .promoExcel_course .row.d-flex .col-auto{width:100%;}
    }

    .logo_16x img{margin-top:-18px;}
    /*@media (min-width:576px){.d-sm-none{display:none!important}*/

    /******* New user/student page layout **********/
    .topheadBar{
        background-color:#51AC37;
        padding:12px 0;
    }
    .topheadBar h5{
        padding:0;margin:0;color:#fff;
    }

    .student__dashboard{background-color:#F3F8F9;}

    .student__dashboard .row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }
    .student__dashboard .col-lg-3.col-md-4{
        position:relative;
    }
    .student__dashboard .col-lg-3.col-md-4:after{
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 91.5%;
        height: 100%;
        background-color: #fff;
    }

    .student__dashboard .left__Nav{position:relative;z-index:1;margin-bottom:80px;}
    .student__dashboard .left__Nav li a{
        font-size:16px;font-weight:600;
        color:#000;
        width: 100%;
        display: inline-block;position: relative;
        padding:15px;
        border-bottom: rgba(0, 0, 0, 0.08) solid 1px;
    }
    .student__dashboard .left__Nav li a i{
        margin-right:10px;
    }
    .student__dashboard .left__Nav li.active a, .student__dashboard .left__Nav li.active a i{
        color:#000 !important;
    }
    .student__dashboard .left__Nav li.active a:before, .student__dashboard .left__Nav li:hover a:before{
        font-family: "Font Awesome 5 Free";
        font-weight:900;
        content: "\f30b";
        position:absolute;right:10px;
    }
    .student__dashboard .left__Nav li .msg {
        background-color:#51AB37;
        border: 1px solid #51AB37;color: #fff !important;margin-left:8px;
        padding: 1px 5px;
        border-radius: 50px;font-size: 12px
    }
    .student__dashboard .left__Nav li a:hover{
        color:#51AC37;
    }

    .extra-space-40{height:40px;}
    .extra-space-30{height:30px;}

    .student__dashboard .box-ws {
        width:100%;
        border-radius:6px;-webkit-border-radius:6px;-moz-border-radius:6px;
        background-color: #fff;box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 5%);
        padding:20px;margin-bottom:10px;
    }

    .student__dashboard .state-icn {
        height: 60px;width: 60px;text-align: center;
        -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;
    }
    .student__dashboard .state-icn .fa {
        font-size: 28px;
        line-height: 60px;
    }

    .student__dashboard .bg-icon-info {background-color: rgba(52, 211, 235, 0.2);border: 1px solid #34d3eb;color: #34d3eb !important;}
    .student__dashboard .bg-icon-blue {background-color: #0044cc1c;border: 1px solid #0044cc94;color: #0044ccad;}
    .student__dashboard .bg-icon-pink {background-color: rgba(251, 109, 157, 0.2);border: 1px solid #fb6d9d;color: #fb6d9d;}
    .student__dashboard .bg-icon-purple {background-color: rgba(114, 102, 186, 0.2);border: 1px solid #7266ba;color: #7266ba;}

    .student__dashboard .state-media h4 {
        color: #000;font-size: 24px;font-weight:700;margin-top: 6px;margin-bottom: 4px;
    }
    .student__dashboard .state-media a, .student__dashboard .state-media p {
        color: #333;font-size: 16px;font-weight:600;
    }

    .student__dashboard .newCourse {
        margin-top: 5px;
    }
    .student__dashboard .course-box .course-image img {
        width:100%;
    }
    .student__dashboard .newCourse .your-rating-text{
        font-size: 13px;
        font-weight: 600;
        color: #333;
    }
    .student__dashboard .newCourse .your-rating-text:hover{
        color: #51ac37;
    }

    .student__dashboard .progressBar{
        position: absolute;
        top:5px;right:5px;z-index: 2;width: 78px;height: 78px;overflow: hidden;
    }
    .student__dashboard .progressBar .progress{
        width:78px;height:78px;background-color: #BFF2B0;
        border-radius:100%;-webkit-border-radius:100%;-moz-border-radius:100%;
    }
    .student__dashboard .progressBar .progress-bar {
        background-color: #51ac37;
    }
    .student__dashboard .progressBar span{
        text-align:center;font-size:11px;font-weight:600;color:#686F7A;padding-top:14px;
        width: 67px;height: 67px;
        position: absolute;top: 6px;left: 6px;background-color:#fff;
        border-radius:100%;-webkit-border-radius:100%;-moz-border-radius:100%;
    }
    .student__dashboard .progressBar span strong{
        font-size:20px;font-weight:800;color:#000;line-height:18px;
        display:block;
    }

    .student__dashboard .wishlist__btn{
        position: absolute;top:5px;right:5px;z-index: 2;width:38px;height:38px;overflow: hidden;text-align:center;line-height:36px;font-size:20px;
        background-color:#FFF;border-radius:100%;-webkit-border-radius:100%;-moz-border-radius:100%;
    }
    .student__dashboard .wishlist__btn i{
        line-height:40px;
    }
    .student__dashboard .wishlist__btn.active{color:#51ac37;}


    .student__dashboard .panel-heading {
        background-color: #4ca133;
        display:inline-block;width:100%;
    }
    .student__dashboard .panel-heading h3 {
        font-size:20px;
        margin: 0;color: #fff;display: inline-block;
    }
    .student__dashboard .panel-heading .right-buttons{
        float: right;margin-top: 0;
    }
    .student__dashboard .panel-heading .right-buttons .btn {
        margin: 0;
        padding: 6px 10px;font-size: 15px;background-color: #fff;
        color: #4ca133; display:inline-block;
    }

    .student__dashboard .table thead tr th{
        font-size:14px;
        padding:5px 6px !important;
    }

    .student__dashboard .dt-buttons{text-align:right;}
    .student__dashboard .dt-buttons .btn-sm {
        padding:6px 15px;
        background-color: rgba(0, 0, 0, 0.01);color: #333;border:rgba(0, 0, 0, 0.15) solid 1px;
        -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;
    }
    .student__dashboard .dt-buttons .btn-sm span {
        font-weight: normal;font-size: 13px !important;color: #333;
    }
    .student__dashboard .dt-buttons .btn-sm span i {
        font-size: 14px;margin-right: 3px;
    }
    .student__dashboard .dt-buttons .btn-sm:hover span{
        color:#fff;
    }
    .student__dashboard .dataTables_length{float:left; margin:15px 0;}
    .student__dashboard .dataTables_filter{float:right;margin:15px 0;}
    .student__dashboard .dataTables_length label, .student__dashboard .dataTables_filter label{
        font-size: 14px;
    }
    .student__dashboard .dataTables_length label select, .student__dashboard .dataTables_filter input{
        height: 34px;
        line-height: 34px;
        font-size: 13px;font-weight: 600;margin-left:6px;
        background-color: rgba(0, 0, 0, 0.01);color: #333;border:rgba(0, 0, 0, 0.15) solid 1px;
    }
    .student__dashboard .dataTables_processing.panel.panel-default{
        display: inline-block;width: 100%;margin-top: 15px;text-align: center;padding: 10px;
    }

    .student__dashboard .table.table-striped{margin-top:15px;}
    .student__dashboard .table.table-striped thead tr th{padding: 8px 6px !important;}
    .student__dashboard .table.table-striped tbody tr td{font-size:13px;padding: 8px 6px !important; color:#575757;}
    .student__dashboard .table.table-striped tbody tr td a{color:#333;font-weight:600;}
    .student__dashboard .table.table-striped tbody tr td a:hover{color:#51ac37;}
    .student__dashboard .dataTables_info, .student__dashboard .dataTables_paginate.paging_simple_numbers{ text-align:center;}
    .student__dashboard ul.pagination {margin-top: 10px;}

    .student__dashboard .select2-container--default .select2-selection--multiple {
        border: 1px solid #eee;
        border-radius: 4px !important;
        padding: 3px 5px 5px;
        margin-bottom: 10px;
    }
    .student__dashboard .select2-container--default .select2-search--inline .select2-search__field {
        font-weight: normal;font-size: 13px;
    }
    .student__dashboard .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #f1f0f0;
        border: 1px solid #e8e8e8;margin-top: 3px;
        font-weight: normal;color: #000;font-size: 13px;
    }

    .student__dashboard .title__md{font-size:18px !important;}
    .student__dashboard .title__md .result-pf-text{
        background: #fb5a5a;padding: 5px 12px;font-size: 14px;border-radius: 2rem;
    }

    .student__dashboard .questions.questions-withno {
        position: relative;
        padding-left:35px;
    }
    .student__dashboard .questions.questions-withno .question-numbers {
        position: absolute;left: 0;top: 0;font-weight:600;color:#000;font-size:14px !important;
    }
    .student__dashboard .answer-status-container {background: #fafafa;
        margin: 10px 0 0;padding: 10px;display: inline-block;width: 100%;font-size:14px;
    }
    .student__dashboard .explana_bgDiv{background: #f7f7f7 !important; border-bottom:#e6e6e6 solid 1px;}
    .student__dashboard .answer-status-container .label.label-info{
        font-weight: normal;
        color: #fff;
        font-size: 13px !important;
        padding: 1px 8px;
    }
    .student__dashboard .questions.questions-withno .language_l1{
        font-size: 14px;font-weight: 400;color: #9c9c9c;margin-bottom: 0;
    }
    .student__dashboard .panel-body.question-ans-box hr{margin-top:0 !important;}
    .student__dashboard .answer_radio {margin-bottom: 15px;}
    .student__dashboard .correct-answer, .student__dashboard .wrong-answer {
        position: relative;
    }
    .student__dashboard .answer_radio:before {
        width: calc(100% - 45px) !important;
        left: 40px !important;
    }
    .student__dashboard .correct-answer:before {
        background: #cef7c0;
        content: '';
        position: absolute;
        left: 0;
        top: -3px;
        width: 100%;
        height: 100%;
        z-index: 0;
        /* box-shadow: 0 0 30px #cef7c0; */
    }

    .student__dashboard .optional-questions .col-md-6.answer_radio label {
        padding-left:30px;
        position: relative;
    }
    .student__dashboard .optional-questions .col-md-6.answer_radio label span {
        color:#000;font-weight:400;
    }

    .student__dashboard input[type="radio"], .student__dashboard input[type="checkbox"] {
        display: contents;
    }
    .student__dashboard input[type="radio"] + label .radio-button {
        width: 20px;height: 20px;
        border: 2px solid #4a9d32;
    }
    .student__dashboard .optional-questions .col-md-6.answer_radio label .fa-stack.radio-button {
        top: 5px;
    }
    .student__dashboard input[type="radio"] + label .active {
        width: 16px;height: 16px;line-height: 17px;font-size: 12px;
    }
    .student__dashboard input[type="radio"] + label:hover .active {color: #dcdbdb;}
    .student__dashboard input[type="radio"]:checked + label .active {
        background: #4a9d32;
    }

    .footer_msgdiv .btn.button, .footer_msgdiv .btn.button span{
        width:49%;
        color:#fff;display:inline-block;text-align:center;font-weight:normal;
    }

    /**** Inbox ****/
    .student__dashboard .inbox-message-list li.unread-message, .student__dashboard .unread-message.alert-info {
        background-color: #f8fafb;
    }
    .student__dashboard .inbox-message-list li {
        min-height: 80px;position: relative;
        padding-left:80px;padding-right: 115px;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        background-color: #f8fafb;
        border-bottom: rgba(0, 0, 0, 0.10) solid 1px;
    }
    .student__dashboard .inbox-message-list li:last-child {
        border-bottom:none;
    }
    .student__dashboard .inbox-message-list li .message-suject {
        white-space: nowrap;
        width: 100%;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        display: block;
    }
    .student__dashboard .inbox-message-list.inbox-message-nocheckbox li img.sender {
        left:20px;
    }
    .student__dashboard .inbox-message-list li img.sender {
        width: 48px;
        height: 48px;
        border-radius: 100%;
        position: absolute;
        left: 68px;
        top: 50%;
        margin-top: -24px;
    }
    .student__dashboard .inbox-message-list li .message-suject h3 {
        margin: 0 0 5px;
        font-size: 16px;
    }
    .student__dashboard .inbox-message-list li .message-suject p {
        margin: 0; font-weight:400;
        color: #777;
    }
    .student__dashboard .inbox-message-list li .receive-time {
        line-height: 20px;
        height: 20px;
        position: absolute;
        right: 22px;
        top: 50%;
        margin-top: -10px;
        color: #ababab; font-weight:400;
        font-size: 13px !important;
    }

    @media (min-width: 1600px){
        .student__dashboard .left__Nav li a{
            font-size:18px;
            padding:16px 18px;
        }
        .student__dashboard .left__Nav li a i{
            margin-right:15px;
        }
        .student__dashboard .box-ws {
            padding:25px;margin-bottom:30px;
        }
        .student__dashboard .box-ws .media-left {
            padding-right:20px;
        }
        .student__dashboard .state-media h4 {
            font-size: 48px;line-height: 40px;margin-top: 0;
        }

        .student__dashboard .panel-heading h3 {
            font-size:24px;
        }
        .student__dashboard .table thead tr th{
            font-size:15px;
            padding:8px 10px !important;
        }

        .student__dashboard .table.table-striped thead tr th, .student__dashboard .table.table-striped tbody tr td{font-size:14px;padding:10px 12px !important;}


    }

    .student__dashboard .col-sm-1, .student__dashboard .col-sm-2, .student__dashboard .col-sm-3, .student__dashboard .col-sm-4, .student__dashboard .col-sm-5,
    .student__dashboard .col-sm-6, .student__dashboard .col-sm-7, .student__dashboard .col-sm-8, .student__dashboard .col-sm-9, .student__dashboard .col-sm-10,
    .student__dashboard .col-sm-11, .student__dashboard .col-sm-12, .student__dashboard .col-sm, .student__dashboard .col-sm-auto,
    .student__dashboard .col-md-1, .student__dashboard .col-md-2, .student__dashboard .col-md-3, .student__dashboard .col-md-4, .student__dashboard .col-md-5, .student__dashboard .col-md-6,
    .student__dashboard .col-md-7, .student__dashboard .col-md-8, .student__dashboard .col-md-9, .student__dashboard .col-md-10, .student__dashboard .col-md-11, .student__dashboard .col-md-12,
    .student__dashboard .col-md, .student__dashboard .col-md-auto, .student__dashboard .col-lg-1, .student__dashboard .col-lg-2, .student__dashboard .col-lg-3, .student__dashboard .col-lg-4,
    .student__dashboard .col-lg-5, .student__dashboard .col-lg-6, .student__dashboard .col-lg-7, .student__dashboard .col-lg-8, .student__dashboard .col-lg-9, .student__dashboard .col-lg-10,
    .student__dashboard .col-lg-11, .student__dashboard .col-lg-12, .student__dashboard .col-lg, .student__dashboard .col-lg-auto, .student__dashboard .col-xl-1,
    .student__dashboard .col-xl-2, .student__dashboard .col-xl-3, .student__dashboard .col-xl-4, .student__dashboard .col-xl-5, .student__dashboard .col-xl-6, .student__dashboard .col-xl-7,
    .student__dashboard .col-xl-8, .student__dashboard .col-xl-9, .student__dashboard .col-xl-10, .student__dashboard .col-xl-11, .student__dashboard .col-xl-12, .student__dashboard .col-xl,
    .student__dashboard .col-xl-auto {
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
    }
    @media (min-width: 576px) {
        .student__dashboard .col-sm-1 {
            -ms-flex: 0 0 8.333333%;
            flex: 0 0 8.333333%;
            max-width: 8.333333%;
        }
        .student__dashboard .col-sm-2 {
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }
        .student__dashboard .col-sm-3 {
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%;
        }
        .student__dashboard .col-sm-4 {
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
        .student__dashboard .col-sm-5 {
            -ms-flex: 0 0 41.666667%;
            flex: 0 0 41.666667%;
            max-width: 41.666667%;
        }
        .student__dashboard .col-sm-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
        }
        .student__dashboard .col-sm-7 {
            -ms-flex: 0 0 58.333333%;
            flex: 0 0 58.333333%;
            max-width: 58.333333%;
        }
        .student__dashboard .col-sm-8 {
            -ms-flex: 0 0 66.666667%;
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }
        .student__dashboard .col-sm-9 {
            -ms-flex: 0 0 75%;
            flex: 0 0 75%;
            max-width: 75%;
        }
        .student__dashboard .col-sm-10 {
            -ms-flex: 0 0 83.333333%;
            flex: 0 0 83.333333%;
            max-width: 83.333333%;
        }
        .student__dashboard .col-sm-11 {
            -ms-flex: 0 0 91.666667%;
            flex: 0 0 91.666667%;
            max-width: 91.666667%;
        }
        .student__dashboard .col-sm-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
    @media (min-width: 768px) {
        .student__dashboard .col-md {
            -ms-flex-preferred-size: 0;
            flex-basis: 0;
            -ms-flex-positive: 1;
            flex-grow: 1;
            max-width: 100%;
        }
        .student__dashboard .col-md-auto {
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: auto;
            max-width: 100%;
        }
        .student__dashboard .col-md-1 {
            -ms-flex: 0 0 8.333333%;
            flex: 0 0 8.333333%;
            max-width: 8.333333%;
        }
        .student__dashboard .col-md-2 {
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }
        .student__dashboard .col-md-3 {
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%;
        }
        .student__dashboard .col-md-4 {
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
        .student__dashboard .col-md-5 {
            -ms-flex: 0 0 41.666667%;
            flex: 0 0 41.666667%;
            max-width: 41.666667%;
        }
        .student__dashboard .col-md-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
        }
        .student__dashboard .col-md-7 {
            -ms-flex: 0 0 58.333333%;
            flex: 0 0 58.333333%;
            max-width: 58.333333%;
        }
        .student__dashboard .col-md-8 {
            -ms-flex: 0 0 66.666667%;
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }
        .student__dashboard .col-md-9 {
            -ms-flex: 0 0 75%;
            flex: 0 0 75%;
            max-width: 75%;
        }
        .student__dashboard .col-md-10 {
            -ms-flex: 0 0 83.333333%;
            flex: 0 0 83.333333%;
            max-width: 83.333333%;
        }
        .student__dashboard .col-md-11 {
            -ms-flex: 0 0 91.666667%;
            flex: 0 0 91.666667%;
            max-width: 91.666667%;
        }
        .student__dashboard .col-md-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
    @media (min-width: 992px) {
        .col-lg {
            -ms-flex-preferred-size: 0;
            flex-basis: 0;
            -ms-flex-positive: 1;
            flex-grow: 1;
            max-width: 100%;
        }
        .student__dashboard .col-lg-auto {
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: auto;
            max-width: 100%;
        }
        .student__dashboard .col-lg-1 {
            -ms-flex: 0 0 8.333333%;
            flex: 0 0 8.333333%;
            max-width: 8.333333%;
        }
        .student__dashboard .col-lg-2 {
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }
        .student__dashboard .col-lg-3 {
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%;
        }
        .student__dashboard .col-lg-4 {
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
        .student__dashboard .col-lg-5 {
            -ms-flex: 0 0 41.666667%;
            flex: 0 0 41.666667%;
            max-width: 41.666667%;
        }
        .student__dashboard .col-lg-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
        }
        .student__dashboard .col-lg-7 {
            -ms-flex: 0 0 58.333333%;
            flex: 0 0 58.333333%;
            max-width: 58.333333%;
        }
        .student__dashboard .col-lg-8 {
            -ms-flex: 0 0 66.666667%;
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }
        .student__dashboard .col-lg-9 {
            -ms-flex: 0 0 75%;
            flex: 0 0 75%;
            max-width: 75%;
        }
        .student__dashboard .col-lg-10 {
            -ms-flex: 0 0 83.333333%;
            flex: 0 0 83.333333%;
            max-width: 83.333333%;
        }
        .student__dashboard .col-lg-11 {
            -ms-flex: 0 0 91.666667%;
            flex: 0 0 91.666667%;
            max-width: 91.666667%;
        }
        .student__dashboard .col-lg-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
    @media (min-width: 1200px) {
        .student__dashboard .col-xl {
            -ms-flex-preferred-size: 0;
            flex-basis: 0;
            -ms-flex-positive: 1;
            flex-grow: 1;
            max-width: 100%;
        }
        .student__dashboard .col-xl-auto {
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: auto;
            max-width: 100%;
        }
        .student__dashboard .col-xl-1 {
            -ms-flex: 0 0 8.333333%;
            flex: 0 0 8.333333%;
            max-width: 8.333333%;
        }
        .student__dashboard .col-xl-2 {
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }
        .student__dashboard .col-xl-3 {
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%;
        }
        .student__dashboard .col-xl-4 {
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
        .student__dashboard .col-xl-5 {
            -ms-flex: 0 0 41.666667%;
            flex: 0 0 41.666667%;
            max-width: 41.666667%;
        }
        .student__dashboard .col-xl-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
        }
        .student__dashboard .col-xl-7 {
            -ms-flex: 0 0 58.333333%;
            flex: 0 0 58.333333%;
            max-width: 58.333333%;
        }
        .student__dashboard .col-xl-8 {
            -ms-flex: 0 0 66.666667%;
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }
        .student__dashboard .col-xl-9 {
            -ms-flex: 0 0 75%;
            flex: 0 0 75%;
            max-width: 75%;
        }
        .student__dashboard .col-xl-10 {
            -ms-flex: 0 0 83.333333%;
            flex: 0 0 83.333333%;
            max-width: 83.333333%;
        }
        .student__dashboard .col-xl-11 {
            -ms-flex: 0 0 91.666667%;
            flex: 0 0 91.666667%;
            max-width: 91.666667%;
        }
        .student__dashboard .col-xl-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }

    }

    @media (max-width: 768px) {
        .student__dashboard .dt-buttons {margin-right: -1%;margin-left: -1%;}
        .student__dashboard .dt-buttons .btn-sm {width: 48%;float: left;margin: 1%;}
        .footer_msgdiv .btn.button, .footer_msgdiv .btn.button span{
            width:100%;
        }

        .student__dashboard .col-lg-3.col-md-4:after {
            display:none;
        }
        .student__dashboard .left__Nav {
            margin-bottom: 20px;
            background-color: #fff;
        }

    }


/*********** New feedback at 13-06-2022 *****************/
.count-all-course{
    width:100%; padding:15px;
    /*background-color:#f5f5f5;margin:8px 0;*/
    margin-bottom: 30px;
}
.count-all-course .row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -10px;
    margin-left: -10px;
}
.count-all-course .row .col{
    text-align:center;
    -ms-flex: 0 0 33.333333%;flex: 0 0 33.333333%;max-width: 33.333333%;
    padding-right: 10px;
    padding-left: 10px;
    margin:8px 0;
}
.count-all-course .row .col .d-flex{
    align-items: center;justify-content: center;
}
.count-all-course .row .col .d-flex div{
    padding-left:13px;line-height: 20px;
    text-align: left;font-weight: 600;
}
.count-all-course i{font-size:38px;}
.count-all-course .row .col{
    font-size:22px;
}
.count-all-course .row .col span{
    font-size:14px;width:100%;color:#3c3c3c;
    display:inline-block;font-weight:400;
}

.course-curriculum-box #accordion .glyphicon {
    margin-right:10px;
}
.anidi_services .panel-body ul.links li{
    padding: 0.8rem 0;
    display: flex;align-items: flex-start;
    width: 100%;height: auto;text-align: left;
    letter-spacing: normal;white-space: normal;
}
.anidi_services .panel-body ul.links li .icon{
    width: 1.1rem;
}
.anidi_services .panel-body ul.links li .list-item-content{
    display:flex;flex: 1;
    min-width:1px;margin-left:.6rem;
}
.anidi_services .panel-body ul.links li .hidden--on-mobile{flex: 1 1 0%;}
.anidi_services .panel-body ul.links li .preview_link,
.anidi_services .panel-body ul.links li .time_count{
    font-size:13px !important;
}
.anidi_services .panel-body ul.links li .preview_link{margin-left:1.2rem;}
.anidi_services .panel-body ul.links li .time_count{color:#6a6f73;margin-left:1.2rem;}
.anidi_services .panel-body ul.links li span.text-title{
    width:auto !important;padding:0 !important;margin:0 !important;
}
.anidi_services .panel-body ul.links li .preview_link a{font-weight:400!important;color:#51ac37;text-decoration:underline;cursor:pointer;}
.anidi_services .panel-body ul.links li .preview_link a:hover{text-decoration:none;}


@media screen and (min-width:320px) and (max-width:480px) {
    .count-all-course .row .col{
        -ms-flex: 0 0 100%;flex: 0 0 100%;max-width: 100%;
        margin: 10px 0;
    }
    .count-all-course .row .col .d-flex {
        justify-content: start;
    }
    .count-all-course .row .col .d-flex div{
        padding-left: 20px;
    }
}

</style>
<style>
    /************ Phlebotomy - Knowledge Landing Pages Style  **************/

    section .main-title{
        font-family: 'Open Sans', sans-serif;
        font-size:40px;margin:0;color:#000;
    }
    section.main_section .container, .description-box .container, .course_benifits .container, .happy_students .container, .main_section2 .container,
    .course_curricullum .container, .student_testimonial .container, .course_benifits .container, .fellow_creators .container, .form_section .container{
        padding-top:0 !important;
        padding-bottom:0 !important;
        position:relative;z-index:1;
    }
    .fellow_creators .btn.btn-secondary, .course_benifits .btn.btn-secondary{
        display:flex; align-items:center;justify-content:center;
        background: #51AC37;
        border-color:#51AC37;
        box-shadow:0 8px 16px rgba(250, 116, 54, 0.16);border-radius:5px;
    }
    .btn.btn-secondary:hover, .btn.btn-secondary:focus{
        box-shadow:0 0 0 rgba(250, 116, 54, 0.0);
        outline:none;
    }

    .main_section .row, .course_benifits .row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }
    .align-items-lg-center {
        -ms-flex-align: center!important;
        align-items: center!important;
    }
    .justify-content-center {
        -ms-flex-pack: center!important;
        justify-content: center!important;
    }

    .main_section .col-md-6 p,
    .main_section form p, .happy_students .student_content p, .course_benifits p{
        color:#5E5E5E;
    }

    .main_section{padding:40px 0 85px;background-position:top right;background-repeat:no-repeat;position:relative;overflow:hidden;}
    .main_section .main-title {font-size:60px;line-height:70px;}
    .main_section .col-md-6 p{
        font-size:18px;line-height:28px;margin-top:15px;
    }
    .main_section form{
        background: #FFFFFF;
        box-shadow: 0 3px 50px rgba(59, 115, 79, 0.16);
        border-radius: 10px;
        padding:30px;margin-bottom:0;
    }
    .main_section form h4{
        font-size:28px;
        color:#000;padding:0;margin:0;
    }
    .main_section form p{
        font-size:16px;padding:0;margin:0 0 20px;
    }
    .main_section form textarea.form-control{
        width: 100%;height: 140px;
    }
    .main_section form .btn.btn-primary{
        width: 100%;height:45px;
    }
    .main_section .img1, .main_section2 .dots1, .main_section2 .dots2{position:absolute;}
    .main_section .img2,.main_section .img3,.main_section .img4,.course_benifits .img5,.course_benifits .img6,.course_benifits .img7{
        position:absolute;
        animation: animate 25s linear infinite;
        bottom: -150px;
    }

    .main_section .img1{left:8.1%;bottom:2%;}
    .main_section .img2{right:50%;animation-delay: 2s;animation-duration: 12s;}
    .main_section .img3{right:42%;animation-delay: 0s;animation-duration: 18s;}
    .main_section .img4{right:3%;animation-delay: 0s;}

    @keyframes animate {
        0%{
            transform: translateY(0) rotate(0deg);
            opacity: 1;
            border-radius: 0;
        }
        100%{
            transform: translateY(-1000px) rotate(720deg);
            opacity: 0;
            border-radius: 50%;
        }
    }

    .description_box{padding-top:40px;padding-bottom:40px;width:100%;display:inline-block;max-height:100% !important;height:auto !important;}

    .happy_students{
        padding:60px 0;
    }
    .happy_students .student_content .count{
        font-weight:700;font-size:34px;line-height:30px;
    }
    .happy_students .student_content p{
        font-weight: 400;font-size: 18px;line-height: 28px;margin-bottom:0 !important;margin-top:10px;
    }
    .happy_students .student_content h4{
        font-weight:600;
        font-size:26px;line-height:40px;
        letter-spacing:0.52px;color:#000000;margin:0;
    }
    .happy_students .counter{
        animation-duration: 1s;
        animation-delay: 0s;
    }

    .course_benifits{overflow:hidden;}
    .course_benifits .col-md-6{position:relative;}
    .course_benifits .img5{left:0;animation-delay: 3s;}
    .course_benifits .img6{right:20%;animation-delay: 7s;}
    .course_benifits .img7{right:15%;}

    .course_benifits p{
        margin:15px 0;
    }

    .course_curricullum{
        padding:70px 0;
    }
    .course_curricullum #accordion{
        margin-top:45px;
    }
    .course_curricullum .panel-group .panel{
        margin:0 !important;padding:0 !important;
        border: 1px solid #E2E2E2;box-shadow:none !important;
        border-radius:0 !important;
    }
    .course_curricullum .panel-group .panel .panel-heading {
        padding:0 !important;
        background:transparent;
        border:none !important;
    }
    .course_curricullum .panel-group .panel .accordion-toggle{
        font-size: 16px;color:#000;
        background: #F6FBFD;
        padding: 15px 15px 15px 40px;
        display: inline-block;
        width: 100%;position:relative;
    }
    .course_curricullum .panel-group .panel .glyphicon {
        font-size: 14px !important;
        margin-right: 0 !important;
        position: absolute;
        left: 13px !important;
        top: 50% !important;
        transform: translate(0%, -51%) !important;
    }

    .fellow-creators .sub-title{
        margin:0 !important;
        max-width:100% !important;
    }
    .fellow-creators, .student_content{
        background-color:#F6FBFD;padding:50px;
    }
    .fellow-creators p, .fellow-creators h2{
        color:#202047;margin: 0;
    }
    .fellow-creators p{
        max-width:70%;margin: 15px auto 25px;
    }
    .fellow-creators .btn {
        width: 215px;
        border-radius: 20rem;
        height: 50px;line-height:30px; margin:0 auto;
    }

    .student_testimonial{
        padding:100px 0;
    }
    #testimonial-slide .item{
        margin-top:35px;
        margin-bottom:10px;
        padding:15px;
    }
    #testimonial-slide .item .bg-white.w-100{
        position:relative; text-align:left;
        box-shadow: 0px 3px 20px rgba(0, 0, 0, 0.1);
        border-radius: 12px;padding:20px;
    }
    #testimonial-slide .item .bg-white .name__info__{
        display:flex;
        align-items:center;
        justify-content:start;
        margin-bottom:10px;
    }
    #testimonial-slide .item .bg-white .name__info__ img{
        width:50px;height:50px;border-radius:100%;
        object-fit:cover; margin-right:15px;
    }
    #testimonial-slide .item .bg-white .name__info__ .circle{
        width:50px;height:50px;border-radius:100%;margin-right:15px;
    }
    #testimonial-slide .item .bg-white .name__info__ h3{
        font-size:18px;font-weight:600;color:#000;
    }
    #testimonial-slide .item .bg-white svg{
        position:absolute;
    }
    #testimonial-slide .item .bg-white svg#icon_cote{
        left: 21px;
        top: -16px;
    }
    #testimonial-slide .item .bg-white svg#icon_cotes{
        right: 21px;
        bottom: -16px;
        transform: rotate(-180deg);
    }

    .course-list{margin:20px 0;}
    .course-list li {
        font-weight: 500;
        font-size: 15px;
        line-height: 28px;
        letter-spacing: 0;
        color: #000;
        list-style-type: none;
        text-decoration: none;
        position: relative;
        padding-left: 30px;
        margin: 12px 0;
    }
    .course-list li .fa{
        color: #51AC37;
        position: absolute;
        top:8px;left: 0;
    }
    .course_benifits .btn.btn-secondary{
        width:175px;
        height:45px;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }
    @media screen and (min-width:1199px) and (max-width:1366px) {
        .main_section{background-size:690px;}
        .main_section .img2{right:49%;bottom:16%}
        .main_section .img4{bottom:6%;}
    }
    @media screen and (min-width:992px) and (max-width:1024px) {
        .main_section{background-size:510px;padding:30px 0 30px;}
        .main_section .main-title {font-size:48px;line-height:60px;}
        .main_section .col-md-6 p {font-size:15px;}
        .main_section .img1 {left:4%;}
        .main_section .img2 {right: 46%;bottom: 28%;width:75px;height:75px;}
        .main_section .img3 {right: 40%;bottom: 5%;width: 50px;height: 50px;}
        .main_section .img4 {right: 2%;bottom: 20%;}
        .main_section form textarea.form-control {width: 100%;height: 120px;}

        .main_section2 .video_section {
            width:430px !important; height:auto !important;
        }
    }
    @media screen and (min-width:320px) and (max-width:991px) {
        .main_section {background-size:60%;}
        .main_section .main-title {font-size: 45px;line-height: 56px;}
        section .main-title {font-size: 28px;}

        .happy_students .count{margin-bottom:15px;}
        .fellow-creators p {max-width: 100%;}
        .fellow-creators, .student_content {padding:30px;}
        .student_testimonial {padding: 60px 0;}
    }
    @media screen and (max-width:480px) {
        .main_section {background-size:50%;}
        .main_section .main-title {font-size:35px;line-height:46px;}

        .description_box {padding-top: 0;padding-bottom: 0;}
        .student_testimonial {padding: 60px 0;}
        .happy_students, .fellow_creators p{text-align:center;}
        .happy_students .student_content h4 {
            font-size: 20px;line-height: 32px;
        }
        .happy_students .student_content .count {
            font-size: 28px;
        }
        .happy_students .student_content p {
            font-size: 16px;
            text-align:center;
        }
        .course_curricullum{
            padding:60px 0;
        }

        .course_benifits .btn.btn-secondary {
            margin:0 auto;
        }
    }


    @media screen and (max-width:992px) {
        .main_section2 .video_section {margin-top:20px !important;}
        .main_section2 .dots1 {top:5px !important;}
    }

    /************ 2nd Landing Pages Style  **************/
    .main_section2{
        position:relative;
        padding:60px 0 190px;overflow:hidden;
    }
    .main_section2 .main-title{
        font-size:60px;
        line-height:70px;
        font-weight:700;
        color:#fff;
    }
    .main_section2 p{
        font-size:18px;line-height:28px;margin-top:15px;
    }
    .main_section2 svg{
        left:0;bottom:0;
        position:absolute;
        width:100% !important;
        height:auto !important;
    }
    .main_section2 svg.nth-child{
        bottom:25px;
    }
    .main_section2 .dots1{
        left:0;top:-24px;
    }
    .main_section2 .dots2{
        right:0;bottom:-24px;
    }
    .main_section2 .video_section{
        width:470px;height:411px;
        position:relative;margin:0 auto;z-index:1;
    }
    .main_section2 .video_section:before{
        content:'';left:0;top:0;
        width:100%;height:100%;
        border:#fff solid 2px;position:absolute;
        border-radius:30px;z-index:1;
        transform: rotate(-2.75deg);
    }
    .main_section2 .video_section a{
        color:#fff;font-size:85px;
        position:absolute;z-index:2;
        left:50%;top:50%;
        transform: translate(-50%, -50%);
    }
    .main_section2 .video_section a i{
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        border-radius:100%;
    }

    .light_color_lnd{
        background-color:#F6FBFD;
    }
    .form_section{
        margin-top:-140px;
        margin-bottom:60px;
    }
    .form_section form{
        position:relative;z-index:1;
        background: #FFFFFF;
        box-shadow: 0 3px 50px rgba(59, 115, 79, 0.16);
        border-radius: 10px;
        padding:30px;margin-bottom:0;
    }
    .form_section form .btn.btn-primary{
        width: 100%;height:45px;
    }
    .form_section form label{font-weight:600;}

    @media screen and (min-width:1024px) and (max-width:5000px) {
        .form_section form label{padding-top:11px;}
    }
    @media screen and (max-width:1199px) {
        .main_section2 svg{
            width:auto !important;
            height:100% !important;
        }
    }
    @media screen and (max-width:768px) {
        .main_section2 .col-md-6.col-sm-12.position-relative{
            margin-top:25px;
        }
        div.topbartimer {
            display: none;
        }
    }
    @media screen and (max-width:480px) {
        .main_section2 .video_section{
            width:100%;height:auto;
        }
        .main_section2 .main-title {
            font-size: 30px;line-height: 40px;
        }
        .main_section2 .video_section a{
            font-size:45px;
        }

        .student_testimonial.light_color_lnd{
            padding-left:2px !important;padding-right:2px !important;
            overflow:hidden;
        }
        .student_testimonial.light_color_lnd #testimonial-slide .item {
            margin-top: 15px !important;
            margin-bottom:10px !important;
        }
        .course_curricullum #accordion {margin-top:25px;}

        section .main-title {font-size:26px;}

    }

    /************ 3rd Landing Pages Style  **************/
    .student_testimonial.light_color_lnd{
        padding-left:25px;
        padding-right:25px;
    }
    .student_testimonial .owl-dots {
        text-align: left;padding-left:15px;margin-top: 0px;
    }
    .student_testimonial .owl-dots .owl-dot span {
        border-radius: 6px;height: 4px;
        margin: 0 3px;width: 28px;
    }
    .student_testimonial .owl-dots .owl-dot.active span{
        background-color:#000;
    }

    #testimonial-slide .item .bg-white .name__info__ .circle{
        width:50px !important;height:50px !important;border-radius:100%;margin-right:15px !important;
    }
    #testimonial-slide .item .bg-white .name__info__ .circle .initials{
        font-size: 18px !important;line-height: 19px !important;
    }
    #testimonial-slide .item .bg-white .name__info__ h6{
        margin:0 !important;
        text-align:left;
    }
    #testimonial-slide .item .bg-white p {
        display: -webkit-box;
        -webkit-line-clamp:3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;--max-lines: 3;
        margin-bottom: 0;
        height: 70px;
    }
    .course_curricullum .panel-body ul li {
        display: inline-block;width: 100%;padding: 10px 0;
        font-size: 13px !important;line-height: 20px;
    }
    .course_curricullum .panel-body ul li .icon{
        margin-right: 10px;
        display: inline-block;
    }
    .course_curricullum .panel-body ul li .text {
        display: inline-block;
    }

    div.topbartimer {
        position: absolute;
        top: 6%;
        right: 2%;
        color: #060606;
        font-size: 18px;
        background-color: #fff;
        padding: 0% 1%;
        border-radius: 8px;
        opacity: 0.7;
        letter-spacing: 2px;
    }

</style>
