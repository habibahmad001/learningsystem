@extends('layouts.sitelayout')
@section('content')
    @include('site.partials.student_topBar')

    <div class="student__dashboard">
        <div class="container">
            <div class="row">
                @include('site.partials.student_nav')
                <div class="col-lg-9 col-md-8">
                    <div class="extra-space-30"></div>


                    <?php
                    $settings = ($record) ? $settings : '';
                    ?>

                    <div ng-init="initAngData('{{ $settings }}');"  ng-controller="studentLmsController">
                        <div class="row row-sm-padding">
                            <?php $settings = getSettings('lms');
                            // dd($series);
                            ?>
                                @if(count($series))
                                    <?php $entry_count = 0;?>
                                        @foreach($series as $c)
                                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                                <div class="course-box newCourse">
                                                    <div class="progressBar">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?php echo course_progress($c->id); ?>%" aria-valuenow="<?php echo course_progress($c->id); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <span><strong><?php echo ceil(course_progress($c->id)); ?>%</strong>{{getPhrase('completed')}}</span>
                                                    </div>
                                                    <a href="{{URL_STUDENT_LMS_SERIES_VIEW.$c->slug}}">
                                                        <div class="course-image">
                                                            <?php $image = $settings->defaultCategoryImage;
                                                            if(isset($c->image) && $c->image!='')
                                                                $image = $c->image;
                                                            ?>
                                                            <img src="{{ IMAGE_PATH_UPLOAD_LMS_SERIES.$image}}" alt="{{$c->item_name}}">
                                                            <div class="hover-content d-none"><i class="fa fa-play-circle"></i></div>
                                                        </div>
                                                    </a>
                                                    <div class="course-details">
                                                        <a href="{{URL_STUDENT_LMS_SERIES_VIEW.$c->slug}}" class="title">{{ $c->title }}</a>

                                                        <div class="quiz-short-discription d-none">{!! substr($c->sub_title,0,70).'...' !!}{{--{!!$c->sub_title!!}--}}</div>

                                                        <div class="rating d-flex h__mid" onclick="event.preventDefault();" data-toggle="modal" data-target="#EditRatingModal">
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

                                                                    @else
                                                                        <i class="fas fa-star "></i>
                                                                        <i class="fas fa-star "></i>
                                                                        <i class="fas fa-star "></i>
                                                                        <i class="fas fa-star "></i>
                                                                        <i class="fas fa-star "></i>
                                                                    @endif
                                                                </div>
                                                            <a class="your-rating-text" id = "1" href="javascript:void(0);"><span class="edit">Edit</span> Rating</a>
                                                        </div>

                                                        <div class="d-flex h__footer">
                                                            <a href="{{URL_VIEW_LMS_CONTENTS.$c->slug}}" class="btn btn-primary d-none">Course Detail</a>
                                                            <a href="{{URL_STUDENT_LMS_SERIES_VIEW.$c->slug}}" class="btn btn-block btn-primary">Start Lesson</a>
                                                        </div>
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
    <script></script>
@endsection