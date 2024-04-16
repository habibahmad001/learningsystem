@if(count($frequently_bought)>0)
<div class="nla-component-render">
    <div class="title float-left line-bottom-theme-colored2">Frequently Bought Courses</div>
    <div class="table-responsive table-responsive-md">
        <table class="table nla-course-comparison-content">
            <tbody>

            @foreach($frequently_bought as $series)
            <tr>
                <td class="course-image-wrapper">
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

                    {{--<img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/lms/series/widget/286-image.jpg" alt="" class="img-responsive">--}}
                </td>
                <td class="render_title">
                    <div class="mob_rating mob_img2">
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
                            <img src="{{IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET.$cimage}}" alt="{{ucfirst($series->title).' ACCREDITED BY '.$series->accreditedby->name}}" class="img-responsive">
                        @else
                            <img src="{{IMAGE_PATH_EXAMS_DEFAULT}}" width="72" height="94" alt="{{ucfirst($series->title).' ACCREDITED BY '.$series->accreditedby->name}}" class="">
                        @endif
                    </div>
                    <a href="{{URL_VIEW_LMS_CONTENTS.$series->slug}}" data-course-id="{{$series->id}}" data-course-name="{{$series->title}}" data-course-price="{{$series->cost}}" data-course-awarding-body="{{$series->accreditedby->name}}" class="course__name">{{ucfirst($series->title)}}</a>
                    <div class="nla-badge">Bestseller</div>
                    <div class="nla-meta-items y-middle">
                        <span class="meta-content-info">Accredited by {{$series->accreditedby->name}}</span>
                        {{--<span>{{count($series->contents)}} total units</span>--}}
                    </div>
                </td>
                <td class="render_rating"><span title="Total Reviews {{rating_num($series->reviews)}}">{{rating_stars($series->reviews)}}{{--{{rating_num($series->reviews)}}--}}</span></td>
                <td class="render_users"><i title="Students Enrolled" class="fa fa-users"></i> <span>{{$series->number_of_students}}</span></td>
                <td class="render_price">
                    <div class="mob_rating pb-10">
                        <span title="Total Reviews {{rating_num($series->reviews)}}">{{rating_stars($series->reviews)}}{{--{{rating_num($series->reviews)}}--}}</span>
                    </div>
                    {!! formatPrice($series->cost, $series->discount_price, false) !!}
                    {{--{{getSetting('currency_code','site_settings')}}<?=$series->cost?>--}}
                    <div class="mob_rating pt-10">
                        <?php  $randid=rand(1,111); ?>
                        {{--<a href="javascript:void(0);" class="btn btn-success w-100 btn-sm">Add to Cart</a>--}}
                        <a  id="{{$series->id.'_'.$randid}}"  href="javascript:void(0);"  data-course-id="{{$series->id}}" data-course-name="{{$series->title}}" data-course-price="{{currencyPrice($series->cost)}}" data-course-awarding-body="{{$series->accreditedby->name}}"
                            onclick="addToCart({{$series->id}},'{{$series->title}}',{{currencyPrice($series->cost)}},'1','{{$series->image}}','{{$series->slug}}','{{$series->id."_".$randid}}')"
                            class="btn btn-success btn-sm float-right">Add to Cart
                        </a>
                    </div>
                </td>
                <?php  $randid=rand(1,111); ?>
                <td class="render_cart"><a  id="{{$series->id.'_'.$randid}}"  href="javascript:void(0);"  data-course-id="{{$series->id}}" data-course-name="{{$series->title}}" data-course-price="{{currencyPrice($series->cost)}}" data-course-awarding-body="{{$series->accreditedby->name}}"
                        onclick="addToCart({{$series->id}},'{{$series->title}}',{{currencyPrice($series->cost)}},'1','{{$series->image}}','{{$series->slug}}','{{$series->id."_".$randid}}')"
                                            class="btn btn-success btn-sm float-right">Add to Cart
                </a>
                </td>
                {{--class="cart_btn"><i class="fa fa-shopping-cart"></i>--}}

                {{--<td class="render_cart"><a href="#" class="cart_btn"><i class="fa fa-shopping-cart"></i></a> </td>--}}
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
@endif