<?php
$user_id='';
if(Auth::check()){
    $user_id=Auth::user()->id;
}
//            else{
//                $request->session()->put('url.intended', url('/free-courses'));
//            }
        $widgt_id=$series->id.'_'.rand(0,20);
?>
<div class="course-box newCourse" data-toggle="popover" data-id="{{$widgt_id}}" data-container="body" data-html="true">
    <div class="header__btns">

        <a href="javascript:void(0);" class="addToWishlist dsk_btns wish__btn" data-course="{{ (isset($series->id)) ? $series->id : '' }}" data-user="{{ (isset(Auth::user()->id)) ? Auth::user()->id : '' }}" data-purpose="toggle-wishlist"
           onclick="addToWishlist('{{$user_id}}', '{{$series->id }}');" >
            @if(App\Http\Controllers\SiteController::CourseIsWishlisted($series->id))
                <i class="fa fa-heart"></i><!--span class="badge wish_count">0</span-->
            @else
                <i class="fa fa-heart-o"></i>
                <!--span class="badge wish_count">0</span-->
            @endif
        </a>

    </div>
    <a rel="canonical" href="{{URL_VIEW_LMS_CONTENTS.$series->slug}}"  data-course-id="{{$series->id}}" data-course-name="{{$series->title}}" data-course-price="{{currencyPrice($series->cost)}}" data-course-awarding-body="{{$series->accreditedby->name}}">
        <div class="course-image">
<?php
            //$series->reviews=Cache::get('reviews_'.$series->id);
            ?>
            @if($series->image)
                <?php
                $cimage=$series->image;
                    if(strpos($cimage,'.jpeg')){
                        if (@getimagesize(IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET.$cimage)){
                            $cimage=$series->image;

                        }else{
                            $cimage=str_replace('jpeg','jpg',$cimage);
                        }
                    } ?>
                <img src="{{IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET.$cimage}}" alt="{{ucfirst($series->title).' ACCREDITED BY '.$series->accreditedby->name}}"
                     class="img-responsive">
            @else
                <img src="{{IMAGE_PATH_EXAMS_DEFAULT}}" width="272" height="194" alt="{{ucfirst($series->title).' ACCREDITED BY '.$series->accreditedby->name}}"
                     class="">
            @endif



        </div>   </a>
    <div class="course-details">
        <a class="title" rel="canonical" href="{{URL_VIEW_LMS_CONTENTS.$series->slug}}"  data-course-id="{{$series->id}}" data-course-name="{{$series->title}}" data-course-price="{{$series->cost}}" data-course-awarding-body="{{$series->accreditedby->name}}">
            {{ucfirst($series->title)}}
        </a>
        {{--<h5 class="title">Sales Fire: B2B Sales &amp; Business Development for Startups</h5>--}}
        <p class="instructors"><i class="fa fa-graduation-cap"></i> ACCREDITED BY {{$series->accreditedby->name}} </p>
        {{--{{ $series->reviews}}--}}
        <div class="d-flex h__mid">
            <div class="rating">{{rating_stars($series->reviews)}}</div>
            @if($series->number_of_students>0)
            <div class="user-count"><i class="fa fa-users"></i> {{$series->number_of_students}}</div>
                @endif
        </div>
        <?php  $randid=rand(1,111); ?>
        @if($series->is_paid)
        @if($discounts)
                <div class="d-flex h__footer">
                    <div class="price">{!! formatPrice($series->cost, $series->discount_price, true) !!}
                    {{--@if(\Cart::get($series->id))
                        <a href="{{url('/cart')}}"  class="btn btn-success gotocart">Go to Cart</a>
                    @else
                            <a  id="{{$series->id.'_'.$randid}}"   href="javascript:void(0);" data-course-id="{{$series->id}}"
                                data-course-name="{{addslashes($series->title)}}"
                                data-course-price="{{currencyPrice($series->cost)}}"
                                data-course-awarding-body="{{$series->accreditedby->name}}"
                                data-quantity="1"
                                data-image="{{$series->image}}"
                                onclick="addToCart('{{$series->id}}','{{addslashes($series->title)}}','{{currencyPrice($series->discount_price)}}','1','{{$series->image}}','{{$series->slug}}','{{$series->id."_".$randid}}')"
                                class="btn btn-success">Add to Cart
                            </a>
                        @endif--}}
                        {{--<a class="title" rel="canonical" href="{{URL_VIEW_LMS_CONTENTS.$series->slug}}"  data-course-id="{{$series->id}}" data-course-name="{{$series->title}}" data-course-price="{{$series->cost}}" data-course-awarding-body="{{$series->accreditedby->name}}">
                            View Detail
                        </a>--}}
                        <a href="javascript:void(0);"
                           data-course-id="{{$series->id}}"
                           data-course-name="{{addslashes($series->title)}}"
                           data-course-price="{{currencyPrice($series->discount_price)}}"
                           data-course-awarding-body="{{$series->accreditedby->name}}"
                           data-quantity="1"
                           data-image="{{$series->image}}"
                           class="btn btn-buy-now" id="{{'buy_'.$series->id.'_'.$randid}}"  onclick="buyNow({{$series->id}},'{{addslashes($series->title)}}',{{currencyPrice($series->discount_price)}},'1','{{$series->image}}','{{$series->slug}}','{{$series->id.'_'.$randid}}')">Buy Now</a>
                    </div>
                </div>
            @else
                <div class="d-flex h__footer">
                    <div class="price">
                        {{--@if($series->is_paid == 2 || $series->is_paid == 3)--}}
                            {{--<span class="current-price price-stripe" style="font-size: 16px !important;">£{{floatval($series->discount_price)}}</span>--}}
                        {{--@endif--}}
                        @if($series->is_paid == 2 || $series->is_paid == 3)
{{--                            <del>£{{floatval($series->cost)}}</del> £<?=$series->discount_price?>--}}
                            {!! formatPrice($series->cost, $series->discount_price, true) !!}
                        @else
                            {{--£<?=$series->cost?>--}}
                            {!! formatPrice($series->cost, $series->discount_price, false) !!}
                        @endif
                    </div>
                    {{--@if(\Cart::get($series->id))
                        <a href="{{url('/cart')}}"  class="btn btn-success gotocart">Go to Cart</a>
                    @else
                    <a  id="{{$series->id.'_'.$randid}}"    href="javascript:void(0);"
                        data-course-id="{{$series->id}}"
                        data-course-name="{{addslashes($series->title)}}"
--}}{{--                        data-course-price="{!! ($series->is_paid == 2 || $series->is_paid == 3) ? $series->discount_price : $series->cost !!}"--}}{{--
                        data-course-price="{!! ($series->is_paid == 2 || $series->is_paid == 3) ? currencyPrice($series->discount_price) : currencyPrice($series->cost) !!}"
                        data-course-awarding-body="{{$series->accreditedby->name}}"
                        data-quantity="1"
                        data-image="{{$series->image}}"

                            onclick="addToCart('{{$series->id}}','{{addslashes($series->title)}}','{!! ($series->is_paid == 2 || $series->is_paid == 3) ? currencyPrice($series->discount_price) : currencyPrice($series->cost) !!}','1','{{$series->image}}','{{$series->slug}}','{{$series->id."_".$randid}}')"
                            class="btn btn-success">Add to Cart
                    </a>
                    @endif--}}
                   {{-- <a class="btn btn-success gotocart" rel="canonical" href="{{URL_VIEW_LMS_CONTENTS.$series->slug}}"  data-course-id="{{$series->id}}" data-course-name="{{$series->title}}" data-course-price="{{$series->cost}}" data-course-awarding-body="{{$series->accreditedby->name}}">
                        View Detail
                    </a>--}}
                    <a href="javascript:void(0);"
                       data-course-id="{{$series->id}}"
                       data-course-name="{{addslashes($series->title)}}"
                       data-course-price="{!! ($series->is_paid == 2 || $series->is_paid == 3) ? currencyPrice($series->discount_price) : currencyPrice($series->cost) !!}"
                       data-course-awarding-body="{{$series->accreditedby->name}}"
                       data-quantity="1"
                       data-image="{{$series->image}}"
                       class="btn btn-buy-now" id="{{'buy_'.$series->id.'_'.$randid}}"  onclick="buyNow({{$series->id}},'{{addslashes($series->title)}}',{!! ($series->is_paid == 2 || $series->is_paid == 3) ? currencyPrice($series->discount_price) : currencyPrice($series->cost) !!},'1','{{$series->image}}','{{$series->slug}}','{{$series->id.'_'.$randid}}')">Buy Now</a>

                </div>
        @endif
        @else
            <div class="d-flex h__footer">
                <div class="price text-left">FREE</div>

                <button type="button"  data-course-id="{{$series->id}}" data-course-name="{{addslashes($series->title)}}" data-course-price="{{currencyPrice($series->cost)}}" data-course-awarding-body="{{$series->accreditedby->name}}"

                        ng-click="buyFreeCourseNow('{{$series->id}}','{{addslashes($series->title)}}','{{$series->slug}}','{{$user_id}}')"
                        class="btn btn-success">Start Now
                </button>
            </div>
        @endif
    </div>

    <div id="{{$widgt_id}}" class="hide" style="z-index: 10 !important;">
        <div class="quick-view-box">
            <a rel="canonical" href="{{URL_VIEW_LMS_CONTENTS.$series->slug}}" class="quick-view-box--Title">{{$series->title}}</a>
            <div class="nLAlite-text-xs box--stats--3pNLA">
                {{--<span>24.5 total hours</span>--}}
                <span>{{sprintf("%02d", count($series->sections))}} Sections</span>
                {{--<span>{!! Course_Time($series->sections)["lec"] !!} Lectures</span>--}}
                <span>{{$series->level->name}}</span><span>{{$series->accreditedby->name}}</span>
            </div>
            <div class="nLAlite-text-sm box--objectives--3WNla">
                {!! $series->what_will_i_learn !!}
            </div>

            <div class="quick-view-box--cta--3NLA haider">
                @if($series->is_paid)
                @if(\Cart::get($series->id))
                    <a href="{{url('/cart')}}"  class="btn add-to-cart--2Nla gotocart">Go to Cart</a>
                @else
                    <a  id="{{$series->id.'_'.$randid}}"   href="javascript:void(0);"
                        data-widget-id="{{$widgt_id}}"
                        data-course-id="{{$series->id}}"
                        data-course-name="{{addslashes($series->title)}}"
                        data-course-price="{!! ($series->is_paid == 2 || $series->is_paid == 3) ? currencyPrice($series->discount_price) : currencyPrice($series->cost) !!}"
                        data-course-awarding-body="{{$series->accreditedby->name}}"
                        data-quantity="1"
                        data-image="{{$series->image}}"
                        onclick="addToCart('{{$series->id}}','{{addslashes($series->title)}}','{!! ($series->is_paid == 2 || $series->is_paid == 3) ? currencyPrice($series->discount_price) : currencyPrice($series->cost) !!}','1','{{$series->image}}','{{$series->slug}}','{{$series->id."_".$randid}}')"
                        class="btn add-to-cart--2Nla">Add to Cart
                    </a>
                @endif
                @else
                    <div class="d-flex h__footer">
                        <div class="price text-left hide">FREE</div>
                        <button type="button"  href="" data-course-id="{{$series->id}}" data-course-name="{{addslashes($series->title)}}" data-course-price="{{currencyPrice($series->cost)}}" data-course-awarding-body="{{$series->accreditedby->name}}"
                                ng-click="buyFreeCourseNow('{{$series->id}}','{{addslashes($series->title)}}','{{$series->slug}}','{{$user_id}}')"
                                class="btn add-to-cart--2Nla hide">Start Now
                        </button>
                    </div>
                    @endif
                <div class="header__btns">
                    @if(Auth::user())
                        <a href="javascript:void(0);" class="addToWishlist" data-course="{{ (isset($series->id)) ? $series->id : '' }}" data-user="{{ (isset(Auth::user()->id)) ? Auth::user()->id : '' }}" data-purpose="toggle-wishlist" class="dsk_btns wish__btn"
                           onclick="addToWishlist('{{$user_id}}', '{{$series->id }}');" >
                            @if(App\Http\Controllers\SiteController::CourseIsWishlisted($series->id))
                                <i class="fa fa-heart"></i><!--span class="badge wish_count">0</span-->
                            @else
                                <i class="fa fa-heart-o"></i>
                                <!--span class="badge wish_count">0</span-->
                            @endif
                        </a>
                    @else
                        <a href="javascript:void(0);" class="addToWishlist" data-course="{{ (isset($series->id)) ? $series->id : '' }}" data-user="{{ (isset(Auth::user()->id)) ? Auth::user()->id : '' }}" data-purpose="toggle-wishlist" class="dsk_btns wish__btn"
                           onclick="addToWishlist('{{$user_id}}', '{{$series->id }}');" >

                            @if(App\Http\Controllers\SiteController::CourseIsWishlisted($series->id))
                                <i class="fa fa-heart"></i><!--span class="badge wish_count">0</span-->
                            @else
                                <i class="fa fa-heart-o"></i>
                                <!--span class="badge wish_count">0</span-->
                            @endif
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

