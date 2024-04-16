@extends('layouts.sitelayout')
<style>
    .social-btns .btn .fa {line-height:inherit;}
    a.btn.btn-success.wishlist-btn-dark.col-xs-6.col-sm-6.col-md-6.col-lg-6 {
        border-radius: 0px;
        background-color: #50ab37;
        border: none;
        width: 50%;
    }
    a.btn.btn-success.wishlist-btn-light.col-xs-6.col-sm-6.col-md-6.col-lg-6 {
        border-radius: 0px;
        background-color: #84BA3F;
        border: none;
        width: 50%;
    }
    .course-price-setting {
        padding: 0px !important;
    }
    .spacer-price {
        margin-top: 10%;
    }
</style>
@section('content')
    @include('site.partials.student_topBar')
    <div class="student__dashboard">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12">
                    <div class="extra-space-30"></div>

                    <div ng-init="initAngData"  ng-controller="studentLmsController">
                        <div class="row row-sm-padding">
                            <?php $settings = getSettings('lms');
                                        // dd($series);
                            ?>
                                @if(count($series))
                                    <?php $entry_count = 0;?>
                                        @foreach($series as $c)
                                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                                <div class="course-box newCourse">
                                                    <div class="wishlist__btn active" id="addToWishlist" data-course="{{$c->id}}" style="cursor: pointer;" onclick="addToWishlist('','{{$c->id}}');"><i class="fa fa-heart"></i></div>
                                                    <a href="{{URL_VIEW_LMS_CONTENTS.$c->slug}}">
                                                        <div class="course-image">
                                                            <?php $image = $settings->defaultCategoryImage;
                                                            if(isset($c->image) && $c->image!='')
                                                                $image = $c->image;
                                                            ?>
                                                                <img src="{{ IMAGE_PATH_UPLOAD_LMS_SERIES.$image}}" alt="{{$c->item_name}}">
                                                        </div>
                                                    </a>
                                                    <div class="course-details">

                                                            <a class="title" rel="canonical" href="{{URL_VIEW_LMS_CONTENTS.$c->slug}}" data-course-id="398" data-course-name="Work Area Organization Hacks" data-course-price="64.00" data-course-awarding-body="CPD">
                                                                {{ $c->title }}
                                                            </a>

                                                            <div class="quiz-short-discription d-none">{!! strip_tags(substr($c->description,0,270)).'...' !!}{{--{!!$c->sub_title!!}--}}</div>

                                                            <p class="instructors"><i class="fa fa-graduation-cap"></i> ACCREDITED BY {{$c->accreditedby->name}} </p>

                                                            <div class="d-flex h__mid">
                                                                <div class="rating">{{rating_stars($c->reviews)}}</div>
                                                                @if($c->number_of_students>0)
                                                                    <div class="user-count"><i class="fa fa-users"></i> {{$c->number_of_students}}</div>
                                                                @endif
                                                            </div>
                                                            <div class="d-flex h__footer {!! (!$c->is_paid) ? "spacer-price" : "" !!}">
                                                                @if($c->is_paid)
                                                                    <div class="col-md-3"></div>
                                                                    <div class="price col-md-9 text-right course-price-setting">
                                                                        @if($c->is_paid == 2 || $c->is_paid == 3)
                                                                            {!! formatPrice($c->cost, $c->discount_price, true) !!}
                                                                        @else
                                                                            {!! formatPrice($c->cost, $c->discount_price, false) !!}
                                                                        @endif
                                                                    </div>
                                                                @else
                                                                    <div class="price text-left col-md-6 course-price-setting">FREE</div>
                                                                    <button type="button" onclick="javascript:window.location.href='{!! URL::to('/login') !!}';" data-course-id="{{$c->id}}" data-course-name="{{addslashes($c->title)}}" data-course-price="{{currencyPrice($c->cost)}}" data-course-awarding-body="{{$c->accreditedby->name}}"
                                                                            ng-click="buyFreeCourseNow('{{$c->id}}','{{addslashes($c->title)}}','{{$c->slug}}','3')"
                                                                            class="btn add-to-cart--2Nla col-md-6">Start Now
                                                                    </button>
                                                                @endif
                                                                {{--<a href="javascript:void(0);"--}}
                                                                   {{--data-course-id="{{$c->id}}"--}}
                                                                   {{--data-course-name="{{addslashes($c->title)}}"--}}
                                                                   {{--data-course-price="{!! ($c->is_paid == 2 || $c->is_paid == 3) ? currencyPrice($c->discount_price) : currencyPrice($c->cost) !!}"--}}
                                                                   {{--data-course-awarding-body="{{$c->accreditedby->name}}"--}}
                                                                   {{--data-quantity="1"--}}
                                                                   {{--data-image="{{$c->image}}"--}}
                                                                   {{--class="btn btn-success gotocart col-md-5"--}}
                                                                   {{--id="{{'buy_'.$c->id.'_'.rand(1,111)}}"--}}
                                                                   {{--onclick="buyNow({{$c->id}},'{{addslashes($title)}}','{!! ($c->is_paid == 2 || $c->is_paid == 3) ? currencyPrice($c->discount_price) : currencyPrice($c->cost) !!}','1','{{$c->image}}','{{$c->slug}}','{{$c->id.'_'.rand(1,111)}}')" >Buy Now</a>--}}
                                                            </div>

                                                        @if($c->is_paid)
                                                            <div>
                                                                @if(\Cart::get($c->id))
                                                                    <a class="btn btn-success wishlist-btn-light gotocart col-xs-6 col-sm-6 col-md-6 col-lg-6" rel="canonical" href="{!! URL::to('/cart') !!}" data-course-name="{{$c->title}}" data-course-awarding-body="CPD">
                                                                        GO TO CART
                                                                    </a>
                                                                @else
                                                                    @php $randid = rand(1,111); @endphp
                                                                    <a class="btn btn-success wishlist-btn-light col-xs-6 col-sm-6 col-md-6 col-lg-6" id="{{$c->id."_".$randid}}" rel="canonical" href="javascript:void(0);" onclick="javascript: addToCart('{{$c->id}}','{{addslashes($c->title)}}','{{($c->is_paid == 2 || $c->is_paid == 3) ? $c->discount_price : $c->cost }}','1','{{$c->image}}','{{$c->slug}}','{{$c->id."_".$randid}}')" data-course-name="{{$c->title}}" data-course-awarding-body="CPD">
                                                                        Add to Cart
                                                                    </a>
                                                                @endif

                                                                {{--<a class="btn btn-success gotocart col-md-5" rel="canonical" href="{{URL_VIEW_LMS_CONTENTS.$c->slug}}" data-course-id="{{$c->id}}" data-course-name="{{$c->title}}" data-course-price="{{$c->discount_price}}" data-course-awarding-body="CPD">--}}
                                                                    {{--View Detail--}}
                                                                {{--</a>--}}
                                                                <a href="javascript:void(0);"
                                                                   data-course-id="{{$c->id}}"
                                                                   data-course-name="{{addslashes($c->title)}}"
                                                                   data-course-price="{!! ($c->is_paid == 2 || $c->is_paid == 3) ? currencyPrice($c->discount_price) : currencyPrice($c->cost) !!}"
                                                                   data-course-awarding-body="{{$c->accreditedby->name}}"
                                                                   data-quantity="1"
                                                                   data-image="{{$c->image}}"
                                                                   class="btn btn-success wishlist-btn-dark col-xs-6 col-sm-6 col-md-6 col-lg-6"
                                                                   id="{{'buy_'.$c->id.'_'.rand(1,111)}}"
                                                                   onclick="buyNow({{$c->id}},'{{addslashes($c->title)}}','{!! ($c->is_paid == 2 || $c->is_paid == 3) ? currencyPrice($c->discount_price) : currencyPrice($c->cost) !!}','1','{{$c->image}}','{{$c->slug}}','{{$c->id.'_'.rand(1,111)}}')" >Buy Now</a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                @else
                                    <div class="col-md-12 text-center">Ooops...! {{getPhrase('No_courses_available')}}</div>
                                @endif
                        </div>
                    </div>

                    <div class="extra-space-30"></div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_scripts')
    @include('student.lms.scripts.js-scripts')
    @include('common.validations', array('isLoaded'=>'1'))
@stop