@extends('layouts.sitelayout')
<style>
    .social-btns .btn .fa {line-height: 40px;}
</style>
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
                                                    <div class="wishlist__btn active" id="addToWishlist" data-course="{{$c->id}}" style="cursor: pointer;" onclick="addToWishlist('{!! Auth::user()->id !!}','{{$c->id}}');"><i class="fa fa-heart"></i></div>
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
                                                        <a href="{{URL_VIEW_LMS_CONTENTS.$c->slug}}" class="title" target="_blank"> {{ $c->title }}</a>
                                                        <div class="quiz-short-discription d-none">{!! strip_tags(substr($c->description,0,270)).'...' !!}{{--{!!$c->sub_title!!}--}}</div>

                                                        <div class="d-flex h__footer">
                                                            <a href="{{URL_VIEW_LMS_CONTENTS.$c->slug}}" class="btn btn-block btn-primary">Course Detail</a>
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
    @include('student.lms.scripts.js-scripts')
    @include('common.validations', array('isLoaded'=>'1'));
@stop