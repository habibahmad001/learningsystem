@extends($layout)
<style>
    .d-none{display:none !important;}

    .library-item .item-details {
        width: 100%;
        display: inline-block;
        padding: 5px 10px 0 10px;
        position: relative;
    }
    .library-item .item-details .progress{height: 6px;margin-bottom: 10px;background-color: #dedddd;}
    .library-item .item-details .progress-bar {background-color: #81ab38;}
    .library-item .item-details .rating.your-rating-box{float:right;text-align:right;}
    .library-item .item-details .rating i {color: #dedfe0;}
    .library-item .item-details .rating i.filled {color: #f4c150;}
    .library-item .btn-group-justified {padding: 6px;}
    .library-item .btn-group-justified .btn-group:first-child{padding-right:2px}
    .library-item .btn-group-justified .btn-group:last-child{padding-left:2px}
    .library-item .btn-group-justified .btn-primary{background-color: #8ab53d;border-color: #a0ce4e;}
    .library-item .btn-group-justified .btn-primary:hover {background-color: #286090;border-color: #204d74;}
    .hover-content .buttons a.btn{font-size:100px; color:#fff;}
    .hover-content .buttons a.btn:hover{color:#B6D433;}
</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/v4-shims.css">

@section('content')
    <!-- Admin User/Student progress course -->
    <?php
    $settings = ($record) ? $settings : '';
    ?>

    <div id="page-wrapper"  ng-init="initAngData('{{ $settings }}');"  ng-controller="studentLmsController">

			<div class="container-fluid">

				<!-- Page Heading -->

				<div class="row">

					<div class="col-lg-12">

						<ol class="breadcrumb">

							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>

							<li class="active"> {{ $title }} </li>

						</ol>

					</div>

				</div>

				<!-- /.row -->

                <div class="panel-heading d-none"><h1>{{$title}}</h1></div>

                <div class="packages">
                    <div class="row library-items">
                        <?php $settings = getSettings('lms');
                        // dd($series);
                        ?>
                        @if(count($series))
                                <?php $entry_count = 0;?>
                                @foreach($series as $c)
                                        {{--@if($c->total_items)--}}
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="library-item mouseover-box-shadow">
                                                <div class="item-image">
                                                    {{--	@if($c->is_paid)
                                                    <div class="label-primary label-band">{{getPhrase('premium')}}</div>
                                                    @else
									<div class="label-danger  label-band">{{getPhrase('free')}}</div>
									@endif
--}}

									<?php $image = $settings->defaultCategoryImage;
									if(isset($c->image) && $c->image!='')
									    $image = $c->image;
									?>
                                                    <img src="{{ IMAGE_PATH_UPLOAD_LMS_SERIES.$image}}" alt="{{$c->item_name}}">
                                                    <div class="hover-content">
                                                        <div class="buttons">
                                                            <a href="{{URL_STUDENT_LMS_SERIES_VIEW.$c->slug}}" class="btn"><i class="fa fa-play-circle"></i> {{--{{getPhrase('view_more')}}--}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-details">
                                                    <h3><a href="{{URL_STUDENT_LMS_SERIES_VIEW.$c->slug}}"  > {{ $c->title }}</a></h3>
                                                    <div class="quiz-short-discription d-none">{!! substr($c->sub_title,0,70).'...' !!}{{--{!!$c->sub_title!!}--}}</div>
                                                    <div class="progress" style="height: 5px;">
                                                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?php echo course_progress($c->id); ?>%" aria-valuenow="<?php echo course_progress($c->id); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>

                                                    <?php //print(course_progress($c->id)); ?>


                                                    <small><?php echo ceil(course_progress($c->id)); ?>% {{getPhrase('completed')}}</small>
                                                    {{--<div class="progress">
                                                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width:20%" aria-valuenow="20%" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small>20% Completed</small>--}}
                                                    <div class="rating your-rating-box" onclick="event.preventDefault();" data-toggle="modal" data-target="#EditRatingModal">
                                                        <div class="rating">
                                                            <?php $series=$c;?>
                                                            @if(count($series->reviews)>=1)
                                                                <?php $totalratings=$series->reviews->sum('rating');
                                                                $avgstars=round($totalratings/count($series->reviews),1);
                                                                $totstars = array_fill(0, $avgstars, NULL);
                                                                $nilstars= 5-count($totstars);
                                                                $empstars = array_fill(0, $nilstars, NULL);
                                                                //$totstars=array(1,2,3,4,5);
                                                                ?>


                                                                @foreach($totstars as $key=>$value )
                                                                    <i class="fas fa-star filled"></i>
                                                                @endforeach
                                                                @foreach($empstars as $key=>$value )
                                                                    <i class="fas fa-star"></i>
                                                                @endforeach

                                                                {{--<span class="d-inline-block average-rating">{{ count($series->reviews)}}</span>--}}

                                                            @else

                                                                <i class="fas fa-star "></i>
                                                                <i class="fas fa-star "></i>
                                                                <i class="fas fa-star "></i>
                                                                <i class="fas fa-star "></i>
                                                                <i class="fas fa-star "></i>
                                                                {{--<span class="d-inline-block average-rating">0</span>--}}

                                                            @endif
                                                        </div>

                                                       {{-- <i class="fa fa-star filled" aria-hidden="true"></i>
                                                        <i class="fa fa-star filled" aria-hidden="true"></i>
                                                        <i class="fa fa-star filled" aria-hidden="true"></i>
                                                        <i class="fa fa-star filled" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>--}}
                                                          <a class="your-rating-text" id = "1" href="javascript:void(0);" >
                                                            {{--<span class="your">Your</span>--}}
                                                            <span class="edit">Edit</span> Rating
                                                        </a>
                                                    </div>
                                                    {{--<a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>--}}
                                                    {{--<ul><li><i class="icon-bookmark"></i> {{ $c->total_items.' '.getPhrase('units')}}</li></ul>--}}
                                                </div>

                                                <div class="btn-group btn-group-justified" role="group">
                                                    <div class="btn-group d-none" role="group"><a href="{{URL_VIEW_LMS_CONTENTS.$c->slug}}" class="btn btn-primary">Course Detail</a></div>
                                                    <div class="btn-group" role="group"><a href="{{URL_STUDENT_LMS_SERIES_VIEW.$c->slug}}" class="btn btn-primary">Start Lesson</a></div>
                                                </div>
                                            </div>
                                        </div>

                                <div class="modal fade" id="EditRatingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" reset-on-close="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content edit-rating-modal">
                                            <div class="modal-header">
                                                <h2 class="modal-title step-1" data-step="1">Rate & Review</h2>

                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="m-progress-bar-wrapper">
                                                <div class="m-progress-bar">
                                                </div>
                                            </div>
                                            <div class="modal-body step step-1">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="modal-course-preview-box">
                                                                <div class="panel">
                                                                    <img class="card-img-top img-fluid" id = "course_thumbnail_1" alt="">
                                                                    <div class="panel-body">
                                                                        <h5 class="panel-content" class = "course_title_for_rating" id = "course_title_1">{{ $c->title }}</h5>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="modal-rating-box">
                                                                <h4 class="rating-title">Write A Public Review</h4>
                                                                {!! Form::open(array('url' => URL_LMS_REVIEWS_ADD,
                                                                                            'novalidate'=>'','name'=>'formReview ',
                                                                                        'method' => 'POST')) !!}

                                                                    {{--<input id="ratings-hidden" name="rating" type="hidden">--}}
                                                                    <input type="hidden" name="course_id" id="course_id" value="{{$c->id}}">
                                                                <fieldset class="form-group  col-md-12">
                                                                {{ Form::text('review_title', $value = null , $attributes = array('class'=>'form-control','required', 'placeholder' => getPhrase('enter review title'),
                                                                'ng-model'=>'review_title',
                                 'ng-class'=>'{"has-error": formLms.review_title.$touched && formLms.review_title.$invalid}')) }}
                                                                <div class="validation-error" ng-messages="formLms.review_title.$error" >

                                                                    {!! getValidationMessage()!!}

                                                                </div>
                                                                </fieldset>
                                                                <fieldset class="form-group  col-md-12">
                                                                    {{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control animated mb-20', 'required', 'rows'=>'5', 'cols'=>'50', 'placeholder' => 'Enter your review here...',
                                                                    )) }}
                                                                </fieldset>
                                                                <fieldset class="form-group  col-md-12">
                                                                    {{--<textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>--}}
                                                                    <h4 class="rating-title">How Would You Rate This Course Overall?</h4>

                                                                    <div class="text-left">
                                                                        <input id="stars_rating" name="stars_rating" required="required" class="rating rating-loading" value="0" data-show-clear="false" data-show-caption="true" data-min="0" data-max="5" data-step="1" data-size="sm"><hr/>
                                                                        {{--<div class="stars starrr" data-rating="0"></div>--}}
                                                                        {{--<a class="btn btn-danger  " href="#" id="close-review-box" style=" margin-right: 10px;">--}}
                                                                            {{--<span class="glyphicon glyphicon-remove"></span>Cancel</a>--}}
                                                                    </div>
                                                                </fieldset>
                                                                <fieldset class="form-group  col-md-12">
                                                                    <button class="btn btn-lg btn-success button"
                                                                            ng-disabled='!formReview.$valid'>Publish</button>
                                                                        {{--<button class="btn btn-success  " type="submit">Publish</button>--}}

                                                                </fieldset>
                                                                {!! Form::close() !!}

                                                                <style>
                                                                    .animated {
                                                                        -webkit-transition: height 0.2s;
                                                                        -moz-transition: height 0.2s;
                                                                        transition: height 0.2s;
                                                                    }

                                                                    .stars
                                                                    {
                                                                        margin: 20px 0;
                                                                        font-size: 24px;
                                                                        color: #d17581;
                                                                    }
                                                                </style>


                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                </div>

							{{--@endif--}}



							 @endforeach

							@else

							Ooops...! {{getPhrase('No_courses_available')}}



						{{--<a href="{{URL_USERS_SETTINGS.$user->slug}}" >{{getPhrase('click_here_to_change_your_preferences')}}</a>--}}

							@endif

                        {{--<script
                                src="https://code.jquery.com/jquery-1.12.4.min.js"
                                integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
                                crossorigin="anonymous"></script>
                        <script>
                            function getCourseDetailsForRatingModal(course_id, imgsrc) {
                                $.ajax({
                                    type : 'POST',
                                    url : 'http://localhost/udemy/home/get_course_details',
                                    data : {course_id : course_id},
                                    success : function(response){
                                        $('#course_title_1').append(response);
                                         $('#course_thumbnail_1').attr('src', imgsrc);
                                         $('#course_thumbnail_1').attr('width', 200);
                                         $('#course_id_for_rating').val(course_id);
                                        // $('#instructor_details').text(course_id);
                                        console.log(response);
                                    }
                                });
                            }
                            $( document ).ready(function(e) {
                                var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this};
                                var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()});
                            });

                            $(function() {


                                var ratingsField = $('#ratings-hidden');

                                $('.starrr').on('starrr:change', function (e, value) {
                                    ratingsField.val(value);
                                });
                            });

                        </script>--}}


						</div>

{{--						@if(count($user->courses))--}}

{{--						{!! $series->links() !!}--}}

						{{--@endif--}}

					</div>



			</div>



</div>

		<!-- /#page-wrapper -->



@stop
@section('footer_scripts')
    @include('student.lms.scripts.js-scripts')
    @include('common.validations', array('isLoaded'=>'1'));


@stop
