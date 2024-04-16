@extends('layouts.sitelayout')
@section('content')
    @if($record->offer_Type == "percentage" && $record->PercentAge == 0)
    <style>
        .course-box .course-details .price {
            color: grey;
            font-size: 16px;
            font-weight: bold;
        }
        .second-line {
            font-weight: normal;
            text-transform: initial;
            font-size: 21px;
            color: #f18101;
        }
    </style>
    @endif
    <style>
        .second-line {
            font-weight: normal;
            text-transform: initial;
            font-size: 21px;
            color: #000;
        }
        .user-count {
            margin-left: {!! ($record->offer_Type == "fixprice") ? 25 : 40 !!}%;
        }

        .price-container > div {
            display: inline-block;
            width: 49%;
        }

        .price-container {
            width: 98%;
            margin: 0 0 4% 0;
        }

        .price-section {
            text-align: right;
        }

        @media (max-width: 768px) {
            .modal-footer button {
                width: 100%;
                margin: 2% 1%;
                float: left;
            }
            .form-group {
                margin-bottom: 15px;
                margin-top: 22%;
            }
        }

    </style>
    <div class="main-content inner_pages">

        <section class="marketing__header1" style="background-image:url('<?=UPLOADS.'lms/series/offerbanner/'.$record->avatar?>');background-position:center center !important; background-size: cover; background-repeat: no-repeat;text-align:center;padding: 110px 0 35px;">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-7 col-xs-9 col-12">
                        <!--img src="<?=UPLOADS.'images/bf_day.png'?>" />
                        <p>Sed ut perspiciatis unde omnis iste natus</p>
                        <a href="#" class="btn btn-primary">View Courses</a-->

                    </div>
                </div>
            </div>
        </section>
        <img src="<?= ($record->mobavatar) ? UPLOADS.'lms/series/offerbanner/'.$record->mobavatar : GetMobileImg(collect(request()->segments())->last())?>" class="mobile_img" />


        @if($record->offer_Activate == "Active")
            @if($record->showall == "no")
                    <section class="marketing__section" style="background-color:#f5f5f9;">
                        <!-- --------------- Alert Ups ------------------- -->
                        <div class="message-popup modal fade" id="message-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <span>You are allowed to select no more than {!! $record->NoOfCourse !!} courses</span>
                            <br><br>
                            <button class="close-me" onclick="javascript: jQuery('.message-popup').hide(600);window.location.href = '{!! URL::to('/offers/' . $record->url . '#heading-div') !!}';">Close</button>
                        </div>
                        <div class="container">
                            <h6 class="title_tabs">{!! $record->introText !!}</h6>

                            {{--desktop view--}}
                            <div class="list-group help-group desktop__view">
                                <div class="marketing_navTabs list-group nav nav-tabs">
                                    {{--<a href="#tab0" class="list-group-item cat-select" data-cat="0" data-title="All" role="tab" data-toggle="tab">All</a>--}}
                                    @if(count(explode(",", json_decode($record->Cat, true))) > 0)
                                        @foreach(explode(",", json_decode($record->Cat, true)) as $cids)
                                            @php
                                                $catData = Select_Category_On_ID($cids);
                                            @endphp
                                                <a href="#tab{!! $catData->id !!}" class="list-group-item cat-select {{ ($loop->iteration == 1 ? 'active': '' ) }}" data-cat="{!! $catData->id !!}" data-title="{!! $catData->category !!}" role="tab" data-toggle="tab">{!! $catData->category !!}</a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="tab-content desktop__view" id="heading-div">

                                {{--Start Tab 0--}}
                                {{--<div class="tab-pane active" id="tab0">--}}
                                    {{--<h5 class="title_tabs" id="all">All</h5>--}}
                                    {{--<div class="row itemcart">--}}
                                        {{--@if(count(explode(",", json_decode($record->offer_keys, true))) > 0)--}}
                                            {{--@foreach(explode(",", json_decode($record->offer_keys, true)) as $ids)--}}
                                                {{--@php--}}
                                                    {{--$offerData = Select_Courses_On_ID($ids);--}}
                                                {{--@endphp--}}
                                                {{--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 offerItem" id="{!! $offerData->lms_category_id !!}">--}}
                                                    {{--<div class="course-box marketing__course mt-20" id="{!! $offerData->id !!}">--}}
                                                        {{--<i class="fa fa-check-circle" data-div="{!! $offerData->id !!}"></i>--}}
                                                        {{--<div class="header__btns">--}}
                                                            {{--<a href="javascript:void(0);" class="addToWishlist" data-course="630" data-user="" data-purpose="toggle-wishlist"><i class="fa fa-heart-o"></i></a>--}}
                                                        {{--</div>--}}
                                                        {{--<a href="{!! URL::to("/course/" . $offerData->slug ) !!}">--}}
                                                            {{--<div class="course-image">--}}
                                                                {{--<img src="{!! IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET . $offerData->image !!}" alt="{!! $offerData->title !!}" class="img-responsive">--}}
                                                            {{--</div>--}}
                                                        {{--</a>--}}
                                                        {{--<div class="course-details">--}}
                                                            {{--<a href="https://demo.nextlearnacademy.com/course/free-microsoft-word-2016-beginner"><h5 class="title">{!! $offerData->title !!}</h5></a>--}}

                                                            {{--<div class="price"><del>{{getSetting('currency_code','site_settings')}}{!! $offerData->discount_price !!}</del> {{getSetting('currency_code','site_settings')}}{!! $offerData->cost !!}</div>--}}
                                                            {{--<div class="rating">--}}

                                                                {{--<i class="fas fa-star filled"></i>--}}
                                                                {{--<i class="fas fa-star filled"></i>--}}
                                                                {{--<i class="fas fa-star filled"></i>--}}
                                                                {{--<i class="fas fa-star filled"></i>--}}
                                                                {{--<i class="fas fa-star filled"></i>--}}

                                                            {{--</div>--}}
                                                            {{--<div class="coupon">Coupon Code: SAVE90</div>--}}
                                                            {{--<button type="button" class="btn btn-success btn-block buy-btn" data-div="{!! $offerData->id !!}" data-itemname="{!! $offerData->title !!}" data-itemprice="{!! (($record->price)/$record->NoOfCourse) !!}" data-itemimg="{!! $offerData->image !!}"  data-itemqty="1">Add to Offer</button>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--@endforeach--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--End Tab 0--}}


                                {{--Start Tab Cat--}}
                                @if(count(explode(",", json_decode($record->Cat, true))) > 0)
                                    @php $count = 0; @endphp
                                    @foreach(explode(",", json_decode($record->Cat, true)) as $cids)
                                        <div class="tab-pane {!! ($count == 0) ? "active" : "" !!}" id="tab{!! $cids !!}">
                                            @php
                                                $catData = Select_Category_On_ID($cids);
                                            @endphp
                                            <h5 class="title_tabs" id="{!! $catData->category !!}">{!! $catData->category !!}</h5>
                                            <div class="row itemcart">
                                                @php $countinner = 0; @endphp
                                                @if(count(json_decode(Select_Course_ID_Parent_Cat_ID($cids), true)) > 0)
                                                    @foreach(json_decode(Select_Course_ID_Parent_Cat_ID($cids), true) as $ids)
                                                        @if(in_array($ids, explode(",", json_decode($record->offer_keys, true))))
                                                            @php $offerData = Select_Courses_On_ID($ids); @endphp
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 offerItem {!! ($countinner > 12) ? "moreItems" : "" !!}" id="{!! $offerData->lms_category_id !!}">
                                                            <div class="course-box marketing__course mt-20" id="csel-{!! $offerData->id !!}">
                                                                <i class="fa fa-check-circle" data-div="{!! $offerData->id !!}"></i>
                                                                <div class="header__btns">
                                                                    <a href="javascript:void(0);" class="addToWishlist" data-course="630" data-user="" data-purpose="toggle-wishlist"><i class="fa fa-heart-o"></i></a>
                                                                </div>
                                                                <a href="{!! URL::to("/course/" . $offerData->slug ) !!}" target="_blank">
                                                                    <div class="course-image">
                                                                        <img src="{!! (file_exists(IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET . $offerData->image)) ? IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET . $offerData->image : IMAGE_PATH_UPLOAD_LMS_SERIES . $offerData->image !!}" alt="{!! $offerData->title !!}" class="img-responsive">
                                                                    </div>
                                                                </a>
                                                                <div class="course-details">
                                                                    <a href="{!! URL::to("/course/" . $offerData->slug ) !!}" target="_blank"><h5 class="title">{!! $offerData->title !!}</h5></a>
                                                                    <div class="row price-container">
                                                                        <div class="sm-col-12 md-col-5 lg-col-5">
                                                                            {{rating_stars($offerData->reviews)}}
                                                                        </div>
                                                                        <div class="sm-col-12 md-col-5 lg-col-5">
                                                                            <div class="price-section">
                                                                                @if($offerData->is_paid == 2 || $offerData->is_paid == 3)
                                                                                    <div class="price" data-oprice="{!! $offerData->cost !!}"><del class="strip-colour">{{getSetting('currency_code','site_settings')}}{!! $offerData->cost !!}</del> {{getSetting('currency_code','site_settings')}}{!! $offerData->discount_price !!}</div>
                                                                                @elseif($record->offer_Type == "fixprice")
                                                                                    <div class="price" data-oprice="{!! $offerData->cost !!}"><del class="strip-colour">{{getSetting('currency_code','site_settings')}}{!! $offerData->cost !!}</del> {{getSetting('currency_code','site_settings')}}{!! $record->price !!}</div>
                                                                                @else
                                                                                    <div class="price" data-oprice="{!! $offerData->cost !!}"> {{getSetting('currency_code','site_settings')}}{!! $offerData->cost !!}</div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {{--<div class="coupon">Coupon Code: SAVE90</div>--}}
                                                                    <button type="button" class="btn btn-success btn-block buy-btn" data-div="{!! $offerData->id !!}" data-itemname="{!! $offerData->title !!}" data-itemprice="{!! ($record->offer_Type == "fixprice") ? $record->price : (($record->price)/$record->NoOfCourse) !!}" data-itemimg="{!! $offerData->image !!}" data-slug="{!! $offerData->slug !!}"  data-itemqty="1">{!! ($record->offer_Type == "fixprice") ? "Buy Now" : "Add to Offer" !!}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php $countinner++; @endphp
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        @php
                                            $count++;
                                        @endphp
                                    @endforeach
                                @endif
                                {{--End Tab Cat--}}

                            </div>

                            {{--ipad and Mobile view--}}
                            <div id="accordion" class="ipd_mobile_view" role="tablist" aria-multiselectable="true">
                                <div class="card-marketing">
                                    <div class="card-header" role="tab" id="heading1">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapse1" class="collapsed">Animal Care</a>
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </div>
                                    <div id="collapse1" class="collapse" role="tabpanel" aria-labelledby="heading1" aria-expanded="false" style="">
                                        <div class="card-block">
                                            <h5 class="title_tabs">Animal Care</h5>

                                        </div>
                                    </div>
                                </div>

                                <div class="card-marketing">
                                    <div class="card-header" role="tab" id="heading2">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2" class="collapsed">Nursing</a>
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </div>
                                    <div id="collapse2" class="collapse" role="tabpanel" aria-labelledby="heading2" aria-expanded="false" style="">
                                        <div class="card-block">
                                            <h5 class="title_tabs">Nursing</h5>

                                        </div>
                                    </div>
                                </div>

                                <div class="card-marketing">
                                    <div class="card-header" role="tab" id="heading3">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3" class="collapsed">Childcare</a>
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </div>
                                    <div id="collapse3" class="collapse" role="tabpanel" aria-labelledby="heading3" aria-expanded="false" style="">
                                        <div class="card-block">
                                            <h5 class="title_tabs">Childcare</h5>

                                        </div>
                                    </div>
                                </div>

                                <div class="card-marketing">
                                    <div class="card-header" role="tab" id="heading4">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4" class="collapsed">Project Management</a>
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </div>
                                    <div id="collapse4" class="collapse" role="tabpanel" aria-labelledby="heading4" aria-expanded="false" style="">
                                        <div class="card-block">
                                            <h5 class="title_tabs">Project Management</h5>
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-6">
                                                    <div class="course-box marketing__course mt-20">
                                                        <div class="header__btns">
                                                            <a href="javascript:void(0);" class="addToWishlist" data-course="630" data-user="" data-purpose="toggle-wishlist"><i class="fa fa-heart-o"></i></a>
                                                        </div>
                                                        <a href="https://demo.nextlearnacademy.com/course/free-microsoft-word-2016-beginner">
                                                            <div class="course-image">
                                                                <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/lms/series/widget/630-image.jpeg" alt="Free Microsoft Word 2016 - Beginner ACCREDITED BY CPD" class="img-responsive">
                                                            </div>
                                                        </a>
                                                        <div class="course-details">
                                                            <a href="https://demo.nextlearnacademy.com/course/free-microsoft-word-2016-beginner"><h5 class="title">Free Microsoft Word 2016 - Beginner</h5></a>

                                                            <div class="price"><del>{{getSetting('currency_code','site_settings')}}899</del> {{getSetting('currency_code','site_settings')}}90.99</div>
                                                            <div class="rating">


                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>



                                                            </div>
                                                            <div class="coupon">Coupon Code: SAVE90</div>
                                                            <button type="button" class="btn btn-success btn-block">Buy Now</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-xs-6">
                                                    <div class="course-box marketing__course mt-20">
                                                        <div class="header__btns">
                                                            <a href="javascript:void(0);" class="addToWishlist" data-course="630" data-user="" data-purpose="toggle-wishlist"><i class="fa fa-heart-o"></i></a>
                                                        </div>
                                                        <a href="https://demo.nextlearnacademy.com/course/free-microsoft-word-2016-beginner">
                                                            <div class="course-image">
                                                                <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/lms/series/widget/630-image.jpeg" alt="Free Microsoft Word 2016 - Beginner ACCREDITED BY CPD" class="img-responsive">
                                                            </div>
                                                        </a>
                                                        <div class="course-details">
                                                            <a href="https://demo.nextlearnacademy.com/course/free-microsoft-word-2016-beginner"><h5 class="title">Free Microsoft Word 2016 - Beginner</h5></a>

                                                            <div class="price"><del>{{getSetting('currency_code','site_settings')}}899</del> {{getSetting('currency_code','site_settings')}}90.99</div>
                                                            <div class="rating">


                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>



                                                            </div>
                                                            <div class="coupon">Coupon Code: SAVE90</div>
                                                            <button type="button" class="btn btn-success btn-block">Buy Now</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-marketing">
                                    <div class="card-header" role="tab" id="heading5">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapse5" class="collapsed">Teaching</a>
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </div>
                                    <div id="collapse5" class="collapse" role="tabpanel" aria-labelledby="heading5" aria-expanded="false" style="">
                                        <div class="card-block">
                                            <h5 class="title_tabs">Teaching</h5>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <br /><br />
                        <center>
                            <button type="button" name="load-btn" id="load-btn" class="btn btn-primary">Load More</button>
                        </center>
                        <br /><br />
                    </section>
            @else
                    <section class="marketing__section" style="background-color:#f5f5f9;">
                        <div class="container">

                            <h6 class="title_tabs">{!! $record->introText !!}</h6>

                                {{--Start Tab Cat--}}
                                @if(count(explode(",", json_decode($record->Cat, true))) > 0)
                                    @php $count = 1; @endphp
                                    @foreach(explode(",", json_decode($record->Cat, true)) as $cids)
                                            @php
                                                $catData = Select_Category_On_ID($cids);
                                            @endphp
                                                @php $countinner = 0; @endphp
                                                @if(count(json_decode(Select_Course_ID_Parent_Cat_ID($cids), true)) > 0)
                                                    @foreach(json_decode(Select_Course_ID_Parent_Cat_ID($cids), true) as $ids)
                                                        @if(in_array($ids, explode(",", json_decode($record->offer_keys, true))))
                                                            @php $offerData = Select_Courses_On_ID($ids); @endphp
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 offerItem {!! ($count > 20) ? "LoadMore" : "" !!} {!! ($countinner > 16) ? "moreItems" : "" !!}" id="{!! $offerData->lms_category_id !!}">
                                                                <div class="course-box marketing__course mt-20" id="csel-{!! $offerData->id !!}">
                                                                    <i class="fa fa-check-circle" data-div="{!! $offerData->id !!}"></i>
                                                                    <div class="header__btns">
                                                                        <a href="javascript:void(0);" class="addToWishlist" data-course="630" data-user="" data-purpose="toggle-wishlist"><i class="fa fa-heart-o"></i></a>
                                                                    </div>
                                                                    <a href="{!! URL::to("/course/" . $offerData->slug ) !!}" target="_blank">
                                                                        <div class="course-image">
                                                                            <img src="{!! (file_exists(IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET . $offerData->image)) ? IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET . $offerData->image : IMAGE_PATH_UPLOAD_LMS_SERIES . $offerData->image !!}" alt="{!! $offerData->title !!}" class="img-responsive">
                                                                        </div>
                                                                    </a>
                                                                    <div class="course-details">
                                                                        <a href="{!! URL::to("/course/" . $offerData->slug ) !!}" target="_blank"><h5 class="title">{!! $offerData->title !!}</h5></a>
                                                                        <div class="row price-container">
                                                                            <div class="sm-col-12 md-col-5 lg-col-5">
                                                                                {{rating_stars($offerData->reviews)}}
                                                                            </div>
                                                                            <div class="sm-col-12 md-col-5 lg-col-5">
                                                                                <div class="price-section">
                                                                                    @if($offerData->is_paid == 2 || $offerData->is_paid == 3)
                                                                                        <div class="price" data-oprice="{!! $offerData->cost !!}"><del class="strip-colour">{{getSetting('currency_code','site_settings')}}{!! $offerData->cost !!}</del> {{getSetting('currency_code','site_settings')}}{!! $offerData->discount_price !!}</div>
                                                                                    @elseif($record->offer_Type == "fixprice")
                                                                                        <div class="price" data-oprice="{!! $offerData->cost !!}"><del class="strip-colour">{{getSetting('currency_code','site_settings')}}{!! $offerData->cost !!}</del> {{getSetting('currency_code','site_settings')}}{!! $record->price !!}</div>
                                                                                    @else
                                                                                        <div class="price" data-oprice="{!! $offerData->cost !!}"> {{getSetting('currency_code','site_settings')}}{!! $offerData->cost !!}</div>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        {{--<div class="coupon">Coupon Code: SAVE90</div>--}}
                                                                        <button type="button" class="btn btn-success btn-block buy-btn" data-div="{!! $offerData->id !!}" data-itemname="{!! $offerData->title !!}" data-itemprice="{!! ($record->offer_Type == "fixprice") ? $record->price : (($record->price)/$record->NoOfCourse) !!}" data-itemimg="{!! $offerData->image !!}" data-slug="{!! $offerData->slug !!}"  data-itemqty="1">{!! ($record->offer_Type == "fixprice") ? "Buy Now" : "Add to Offer" !!}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php $count++; $countinner++; @endphp
                                                        @endif
                                                    @endforeach
                                                @endif
                                    @endforeach
                                @endif

                        </div>
                        <br /><br />
                        <center>
                            <button type="button" name="load-btn" id="loadmore-btn" class="btn btn-primary">Load More</button>
                        </center>
                        <br /><br />
                    </section>
            @endif

                <section class="marketing__trms" style="background-image:url('<?=UPLOADS.'images/bg_7-1.jpg'?>');">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-6 text-center">
                                <img src="<?=UPLOADS.'images/tc-img2.jpg'?>" />
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6">
                                <div class="section-title text-left">
                                    <h2 class="title text-uppercase">TERMS & <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">CONDITIONS</span></h2>
                                </div>
                                <div class="term_content scrollbar style-4">
                                    {!! $record->contentarea !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

        @else
            <section class="marketing__section">
                <div class="container">
                    <h6 class="title_tabs">This Offer is not active right now, Please visit this page later !!!</h6>
                </div>
            </section>
        @endif

    </div>


<!-- --------------- Alert Ups ------------------- -->
<div class="modal fade" id="AlertModelnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">


                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            <div class="modal-body">
                <div class="form-group text-center">
{{--                    <h3>Package Limit </h3>--}}
{{--                    <h5>You are allowed to select only {!! $record->NoOfCourse !!} Courses</h5>--}}
                    <h3>Added to cart </h3>
                    <h5>Item successfully added to cart</h5>
                    @if($record->id == 8)
                        <p>Free Makeup Course is successfully added to your cart!</p>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary stop float-left" data-dismiss="modal">Continue Shopping</button>
                <button type="submit" name="process" id="process" class="btn btn-primary proceed_btn ">Proceed to Checkout</button>
            </div>
        </div>
    </div>
</div>
<!-- --------------- Alert Ups ------------------- -->
@stop
@section('footer_scripts')
    <script>
        $(function () {
            // Since there's no list-group/tab integration in Bootstrap
            $('.list-group-item').on('click', function (e) {
                var previous = $(this).closest(".list-group").children(".active");
                previous.removeClass('active');// previous list-item
                console.log(e.target);
                $(e.target).addClass('active');// activated list-item
            });

            $(".cat-select").click(function(){
                var showCourse  =   $(this).data("cat");
                // $(".itemcart > div").not('#' + showCourse).fadeOut(300);
                $("#catTitle").text($(this).data("title"));
            });

            /*********** Load More *********/
            $(".moreItems").hide();
            $("#load-btn").click(function(){
                ($(this).text() == "Load More") ? $(this).text("Less Items") : $(this).text("Load More");
                $(".moreItems").toggle(300);
            });

            $(".LoadMore").hide();
            $("#loadmore-btn").click(function(){
                ($(this).text() == "Load More") ? $(this).text("Less Items") : $(this).text("Load More");
                $(".LoadMore").toggle();
            });
            /*********** Load More *********/

            $(".buy-btn").click(function(){

                var goin = ('<?php echo $record->offer_Type;?>' == "percentage" && "<?php echo $record->PercentAge;?>" == "0") ? 1 : 2;

                if($("div.itemcart div.select__course").length < <?php echo $record->NoOfCourse;?> || goin == 1) {
                    $("#csel-" + $(this).data("div")).addClass("select__course");

                    /*------- buy 1 get 1 half ----------*/
                    if('<?php echo $record->offer_Type;?>' == "percentage") {
                        $(this).attr("data-itemprice", $("div.itemcart div#csel-" + $(this).data("div") + " div.price").data("oprice"));
                    }
                    /*------- buy 1 get 1 half ----------*/

                    /*------- Add to cart ----------*/
                    var data = {
                        id: $(this).data("div"),
                        name: $(this).data("itemname"),
                        price: $(this).data("itemprice"),
                        slug: $(this).data("slug"),
                        image: $(this).data("itemimg"),
                        'qty': 1,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };
                    $.ajax({
                        type: 'POST',
                        url: '{{ URL_LMS_SERIES_ADD_TO_CART }}/buynow',
                        data: data,
                        success: function(result) {
                        },
                        async:false
                    });
                    /*------- Add to cart ----------*/


                    /*------- Update cart on second Item ----------*/
                    if('<?php echo $record->offer_Type;?>' == "percentage") {
                        if ($("div.itemcart div.select__course").length == 2) {
                            if ('<?php echo $record->PercentageType;?>' == "highe") {
                                if ($("div.itemcart div.select__course").eq(0).find("button").data("itemprice") >= $("div.itemcart div.select__course").eq(1).find("button").data("itemprice")) {
                                    /*------- Add course with - price ----------*/
                                    $.post('{{ URL_LMS_SERIES_ADD_TO_CART }}/updatecart', {
                                        id: $("div.itemcart div.select__course").eq(1).find("button").data("div"),
                                        percentagee: <?php echo $record->PercentAge;?>,
                                        _token: $('meta[name="csrf-token"]').attr('content')
                                    }, function (data, status) {
                                        if (status == "success") {
                                            // console.log(data);
                                        }
                                    });
                                    /*------- Add course with - price ----------*/
                                } else {
                                    $.post('{{ URL_LMS_SERIES_ADD_TO_CART }}/updatecart', {
                                        id: $("div.itemcart div.select__course").eq(1).find("button").data("div"),
                                        percentagee: <?php echo $record->PercentAge;?>,
                                        _token: $('meta[name="csrf-token"]').attr('content')
                                    }, function (data, status) {
                                        if (status == "success") {
                                            // console.log(data);
                                        }
                                    });
                                    /*------- Add course with - price ----------*/
                                }
                            }

                            if ('<?php echo $record->PercentageType;?>' == "cheap") {
                                if ($("div.itemcart div.select__course").eq(0).find("button").data("itemprice") >= $("div.itemcart div.select__course").eq(1).find("button").data("itemprice")) {
                                    /*------- Add course with - price ----------*/
                                    $.post('{{ URL_LMS_SERIES_ADD_TO_CART }}/updatecart', {
                                        id: $("div.itemcart div.select__course").eq(1).find("button").data("div"),
                                        percentagee: <?php echo $record->PercentAge;?>,
                                        _token: $('meta[name="csrf-token"]').attr('content')
                                    }, function (data, status) {
                                        if (status == "success") {
                                            // console.log(data);
                                        }
                                    });
                                    /*------- Add course with - price ----------*/
                                } else {
                                    $.post('{{ URL_LMS_SERIES_ADD_TO_CART }}/updatecart', {
                                        id: $("div.itemcart div.select__course").eq(0).find("button").data("div"),
                                        percentagee: <?php echo $record->PercentAge;?>,
                                        _token: $('meta[name="csrf-token"]').attr('content')
                                    }, function (data, status) {
                                        if (status == "success") {
                                            // console.log(data);
                                        }
                                    });
                                    /*------- Add course with - price ----------*/
                                }
                            }

                            if ('<?php echo $record->PercentageType;?>' == "normal") {
                                if ($("div.itemcart div.select__course").eq(0).find("button").data("itemprice") >= $("div.itemcart div.select__course").eq(1).find("button").data("itemprice")) {
                                    /*------- Add course with - price ----------*/
                                    $.post('{{ URL_LMS_SERIES_ADD_TO_CART }}/updatecart', {
                                        id: $(this).data("div"),
                                        percentagee: <?php echo $record->PercentAge;?>,
                                        _token: $('meta[name="csrf-token"]').attr('content')
                                    }, function (data, status) {
                                        if (status == "success") {
                                            // alert(data.NewPrice);
                                        }
                                    });
                                    /*------- Add course with - price ----------*/
                                }
                            }
                        }
                    }
                    /*------- Update cart on second Item ----------*/
                }

                 if($("div.itemcart div.select__course").length == <?php echo $record->NoOfCourse;?> || goin == 1) {
                   $('#AlertModelnew').modal('show');
                }

                if("{!! $record->offer_Type !!}" == "fixprice") {
                    $('#AlertModelnew').modal('show');
                }

            });

            $(".fa-check-circle").click(function(){
                $("#" + $(this).data("div")).removeClass("select__course");
                $.post('{{ URL_LMS_SERIES_ADD_TO_CART }}/removeToCart', {id: $(this).data("div"), _token: $('meta[name="csrf-token"]').attr('content')}, function (data, status) {
                    if(status == "success") {
                        // console.log(data);
                    }
                });
            });

            $(".proceed_btn").click(function(){
                {{--$("div.itemcart div.select__course").each(function(){--}}
                    {{--$.post('{{ URL_LMS_SERIES_ADD_TO_CART }}/buynow', {id: $(this).find("button").data("div"), name: $(this).find("button").data("itemname"), price: $(this).find("button").data("itemprice"), image: $(this).find("button").data("itemimg"), 'qty': 1, _token: $('meta[name="csrf-token"]').attr('content')}, function (data, status) {--}}
                        {{--if(status == "success") {--}}
                            {{--// console.log(data);--}}
                        {{--}--}}
                    {{--});--}}
                {{--});--}}
                window.location = '{{ url('/promocheckout') }}'
            });

        });
        $(".topbar-img").hide();
        $(".mobile-topbar-img").hide();
        if("<?php echo $record->PercentAge;?>" == "0") {
            $(".marketing__trms").hide();
        }

    </script>
@stop