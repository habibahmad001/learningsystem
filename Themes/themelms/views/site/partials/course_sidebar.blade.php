<div class="course-sidebar-text-box">
    <?php $randid=rand(1,111);
    $currency_symbol=getSetting('currency_code','site_settings');
    ?>
{{--    @if($already_purchased)
            <div>
                <span class="course-info-title"><i class="fa fa-info font-16  mr-5"></i></span>
                @if($lms_series->is_paid)
                <span class="course-info-details  font-weight-600">You purchased this course on {{$purchased_date}}</span>
                @else
                    <span class="course-info-details  font-weight-600">You already enrolled on this free course on {{$purchased_date}}</span>
                @endif
            </div>
            <div class="buy-btns">
                <a class="btn btn-already-buy"  href="{{url('/my-courses/'.$lms_series->slug)}}"   style="background-color: #fff !important;">Go To Course</a>
            </div>
    @else--}}
        @if($lms_series->is_paid)
            @if($discounts)
                <div class="price">
                    <span class="current-price">
                        {!! getCurrencyCode() . currencyPrice($lms_series->discount_price) !!}
                        <span class="original-price">{!! getCurrencyCode() . currencyPrice($lms_series->cost) !!}</span>
                    </span>
                    {{--<input type="hidden" id="total_price_of_checking_out" value="$35">--}}
                </div>

                <div class="buy-btns">
                    @if(\Cart::get($lms_series->id))
                        <a class="btn btn-add-cart"  id="1" href="{{url('/cart')}}"   style="background-color: #fff !important;">Go To Cart</a>
                    @else
                        <a href="javascript:void(0);"
                           data-course-id="{{$lms_series->id}}"
                           data-course-name="{{addslashes($lms_series->title)}}"
                           data-course-price="{{currencyPrice($series->cost)}}"
                           data-course-awarding-body="{{$lms_series->accreditedby->name}}"
                           data-quantity="1"
                           data-image="{{$lms_series->image}}"
                           class="btn btn-add-cart"   id="{{$lms_series->id.'_'.$randid}}"  onclick="addToCart({{$lms_series->id}},'{{$title}}','{{currencyPrice($lms_series->discount_price)}}','1','{{$lms_series->image}}','{{$lms_series->slug}}','{{$lms_series->id.'_'.$randid}}')" style="background-color: #fff !important; ">Add To Cart</a>
                    @endif
                        <a href="javascript:void(0);"
                           data-course-id="{{$lms_series->id}}"
                           data-course-name="{{addslashes($lms_series->title)}}"
                           data-course-price="{{currencyPrice($series->cost)}}"
                           data-course-awarding-body="{{$lms_series->accreditedby->name}}"
                           data-quantity="1"
                           data-image="{{$lms_series->image}}"
                           class="btn btn-buy-now" id="{{'buy_'.$lms_series->id.'_'.$randid}}"  onclick="buyNow({{$lms_series->id}},'{{$title}}',{{currencyPrice($lms_series->discount_price)}},'1','{{$lms_series->image}}','{{$lms_series->slug}}','{{$lms_series->id.'_'.$randid}}')">Buy Now</a>
                </div>
            @else
                <div class="price">
                    @if($lms_series->is_paid == 2 || $lms_series->is_paid == 3)
                        <span class="current-price">
                            {{--<span class="price-stripe">{{getSetting('currency_code','site_settings')}}{{$lms_series->cost}}</span>
                            {{getSetting('currency_code','site_settings')}}{{$lms_series->discount_price}}--}}
                            {!! formatPrice($lms_series->cost, $lms_series->discount_price, true, "course") !!}
                        </span>
                    @else
                        <span class="current-price">
{{--                            {{getSetting('currency_code','site_settings')}}{{$lms_series->cost}}--}}
                            {!! formatPrice($lms_series->cost, $lms_series->discount_price, false, "course") !!}
                        </span>
                    @endif
                    {{--<span class="original-price">{{getSetting('currency_code','site_settings')}}{{$lms_series->cost}}</span>--}}
                    {{--<input type="hidden" id="total_price_of_checking_out" value="$35">--}}
                </div>

                <div class="buy-btns">

                    @if(\Cart::get($lms_series->id))
                        <a class="btn btn-add-cart"  id="1" href="{{url('/cart')}}"   style="background-color: #fff !important;">Go To Cart</a>
                    @else
                        <a href="javascript:void(0);"
                           data-course-id="{{$lms_series->id}}"
                           data-course-name="{{addslashes($lms_series->title)}}"
                           data-course-price="{!! ($lms_series->is_paid == 2 || $lms_series->is_paid == 3) ? currencyPrice($lms_series->discount_price) : currencyPrice($lms_series->cost) !!}"
                           data-course-awarding-body="{{$lms_series->accreditedby->name}}"
                           data-quantity="1"
                           data-image="{{$lms_series->image}}"
                           class="btn btn-add-cart"
                           id="{{$lms_series->id.'_'.$randid}}" onclick="addToCart({{$lms_series->id}},'{{addslashes($title)}}','{!! ($lms_series->is_paid == 2 || $lms_series->is_paid == 3) ? currencyPrice($lms_series->discount_price) : currencyPrice($lms_series->cost) !!}','1','{{$lms_series->image}}','{{$lms_series->slug}}','{{$lms_series->id.'_'.$randid}}')" style="background-color: #fff !important;">Add To Cart</a>
                    @endif
                        <a href="javascript:void(0);"
                           data-course-id="{{$lms_series->id}}"
                           data-course-name="{{addslashes($lms_series->title)}}"
                           data-course-price="{!! ($lms_series->is_paid == 2 || $lms_series->is_paid == 3) ? currencyPrice($lms_series->discount_price) : currencyPrice($lms_series->cost) !!}"
                           data-course-awarding-body="{{$lms_series->accreditedby->name}}"
                           data-quantity="1"
                           data-image="{{$lms_series->image}}"
                           class="btn btn-buy-now"
                           id="{{'buy_'.$lms_series->id.'_'.$randid}}"
                           onclick="buyNow({{$lms_series->id}},'{{addslashes($title)}}','{!! ($lms_series->is_paid == 2 || $lms_series->is_paid == 3) ? currencyPrice($lms_series->discount_price) : currencyPrice($lms_series->cost) !!}','1','{{$lms_series->image}}','{{$lms_series->slug}}','{{$lms_series->id.'_'.$randid}}')" >Buy Now</a>
                </div>
            @endif
        @else
            <div class="price">
                <span class="current-price"><span class="current-price">FREE</span></span>
            </div>
        <?php $user_id='';
            if(Auth::check()) $user_id=Auth::user()->id;    ?>

            <div class="buy-btns">
                <button class="btn btn-buy-now" type="button" id="course_1" ng-click="buyFreeCourseNow({{$lms_series->id}},'{{$title}}','{{$lms_series->slug}}','{{$user_id}}')"  data-course-id="{{$lms_series->id}}" data-course-name="{{addslashes($lms_series->title)}}" data-course-price="{{$lms_series->is_paid ? $lms_series->cost: 0}}" data-course-awarding-body="{{$lms_series->accreditedby->name}}" >Start Now</button>
            </div>
        @endif

        <div class="price">
            <a class="btn btn-add-cart"  id="1" href="{!! URL::to('/gift-course') . "/" . $lms_series->slug !!}"   style="width: 100%;">Gift this course<i class="pe-7s-gift font-16 vertical-align-middle ml-5"></i></a>
        </div>
    {{--@endif--}}
    <div class="includes">
        <div class="title"><b>Course Includes:</b></div>
        <ul class="course-info-list font-14 mt-5">
            <li>
                <span class="course-info-title"><i class="pe-7s-id font-19 vertical-align-middle text-theme-colored2 mr-10"></i>Accredited By:</span>
                <span class="course-info-details">{{$awardingbody->name}} </span>
            </li>
            <li>
                <span class="course-info-title"><i class="pe-7s-graph3 font-19 vertical-align-middle text-theme-colored2 mr-10"></i>Course Level:</span>
                <span class="course-info-details">{{$level->name}} </span>
            </li>
            <li>
                <span class="course-info-title"><i class="pe-7s-timer font-19 vertical-align-middle text-theme-colored2 mr-10"></i>Course Duration:</span>
                <span class="course-info-details">{{$lms_series->validity}} Days</span>
            </li>
            <li>
                <span class="course-info-title"><i class="pe-7s-diamond font-19 vertical-align-middle text-theme-colored2 mr-10"></i>Number of Modules:</span>
                {{--<span class="course-info-details">{{$lms_series->getContents()->count()}}</span>--}}
                <span class="course-info-details">{{$number_of_modules}}</span>
            </li>
            @if(isset($lms_series->learning_hours) && $lms_series->learning_hours != "")
            <li>
                <span class="course-info-title"><img src="<?=UPLOADS?>images/book.svg" style="width:20px;" class="vertical-align-middle mr-5"> Guided Learning Hours:</span>
                {{--<span class="course-info-details">{{$lms_series->getContents()->count()}}</span>--}}
                <span class="course-info-details">{{$lms_series->learning_hours}}</span>
            </li>
            @endif
            {{--<li>
<span class="course-info-title">
<i class="pe-7s-users font-26 vertical-align-middle text-theme-colored2 mr-10"></i>Student Enrolled:</span>
                <span class="course-info-details">{{$lms_series->number_of_students}} Students</span>
            </li>--}}
            <li>
                <span class="course-info-title"><i class="pe-7s-study font-19 vertical-align-middle text-theme-colored2 mr-10"></i>Course Certificate:</span>
                <span class="course-info-details">At completion</span>
            </li>
            @if (isset($lms_series->assesment) && $lms_series->assesment == "yes")
            <li>
                <span class="course-info-title"><i class="pe-7s-like2 font-19 vertical-align-middle text-theme-colored2 mr-10"></i>Assessment Included:</span>
                <span class="course-info-details">{!! (isset($lms_series->assesment) && $lms_series->assesment == "yes") ? '<i class="fa fa-check"></i>' : '' !!}</span>
            </li>
            @endif
            <li>
                      <span class="course-info-title">
                      <i class="pe-7s-box1 font-19 vertical-align-middle text-theme-colored2 mr-10"></i>Course Material:</span>
                <span class="course-info-details">
                    {!! (isset($lms_series->pdf) && $lms_series->pdf == "yes") ? '<i class="fa fa-file-pdf-o"></i>' : '' !!}
                    {!! (isset($lms_series->videoattach) && $lms_series->videoattach == "yes") ? '<i class="fa fa-play-circle-o"></i>' : '' !!}
                </span>
            </li>
        </ul>
    </div>
    <div class="buy-team-for-155NLA">
        <h5 class="buy-team-for-title">Training 5 or more people?</h5>
        <p class="buy-team-for-content">Get your team access to 600+ top NLA courses anytime, anywhere.</p>
        <a href="<?=url('/corporate')?>" class="btn btn-outline-primary btn-block mt-10">Try NLA for Business</a>
    </div>
</div>