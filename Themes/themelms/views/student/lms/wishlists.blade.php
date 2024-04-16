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
    .new_wishListItem .quiz-short-discription {
        padding:0;height: 65px;overflow: hidden;
    }
    .new_wishListItem .item-details h3 {
        padding: 5px 0;
    }
</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/v4-shims.css">


@section('content')
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
                    <div class="row library-items new_wishListItem">
                        <?php $settings = getSettings('lms');
                        // dd($series);
                        ?>
                        @if(count($series))
                                <?php $entry_count = 0;?>
                                @foreach($series as $c)
                                        {{--@if($c->total_items)--}}
                                        <div class="col-md-3">
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
                                                            <a href="{{URL_VIEW_LMS_CONTENTS.$c->slug}}" class="btn"><i class="fa fa-search"></i> {{--{{getPhrase('view_more')}}--}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-details">
                                                    <h3><a href="{{URL_VIEW_LMS_CONTENTS.$c->slug}}" target="_blank"> {{ $c->title }}</a></h3>
                                                    <div class="quiz-short-discription">{!! strip_tags(substr($c->description,0,270)).'...' !!}{{--{!!$c->sub_title!!}--}}</div>
                                                </div>
                                                <div class="btn-group btn-group-justified" role="group">
                                                    <div class="btn-group" role="group"><a href="{{URL_VIEW_LMS_CONTENTS.$c->slug}}" class="btn btn-primary">Course Detail</a></div>
                                                    {{--<div class="btn-group" role="group"><a href="{{URL_STUDENT_LMS_SERIES_VIEW.$c->slug}}" class="btn btn-primary">Start Lesson</a></div>--}}
                                                </div>
                                            </div>
                                        </div>



							 @endforeach

							@else

							Ooops...! {{getPhrase('No_courses_available')}}


							@endif


						</div>


					</div>



			</div>



</div>

		<!-- /#page-wrapper -->



@stop
@section('footer_scripts')
    @include('student.lms.scripts.js-scripts')
    @include('common.validations', array('isLoaded'=>'1'));


@stop
