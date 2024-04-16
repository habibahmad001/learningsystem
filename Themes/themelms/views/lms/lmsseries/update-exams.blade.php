@extends(getLayout())

 @section('custom_div')

 <div ng-controller="prepareQuestions">

 @stop

@section('content')

<div id="page-wrapper">

			<div class="container-fluid">

				<!-- Page Heading -->

				<div class="row">

					<div class="col-lg-12">

						<ol class="breadcrumb">

							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>

							<li><a href="{{URL_LMS_SERIES}}">{{ getPhrase('lms_series')}}</a></li>

							<li class="active">{{isset($title) ? $title : ''}}</li>

						</ol>

					</div>

				</div>

					@include('errors.errors')

				<?php 	$settings = ($record) ? $settings : '';

                ?>

				<div class="panel panel-custom" ng-init="initAngData({{$settings}});" >

					<div class="panel-heading">

						<div class="pull-right messages-buttons">

							<a href="{{URL_LMS_SERIES}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>

						</div>

					<h1>{{ $title }}  </h1>

					</div>

					<div class="panel-body" >

					<?php $button_name = getPhrase('create'); ?>

					 		<div class="row">

							<fieldset class="form-group col-md-5">
								{{ Form::label('lms_categories', getphrase('select_category')) }}

								{{Form::select('lms_categories', $exam_categories, null, ['class'=>'form-control', 'ng-model' => 'exam_category_id',

								'placeholder' => 'Select', 'ng-change'=>'examCategoryChanged(exam_category_id)' ])}}

							</fieldset>

								<fieldset class="form-group col-md-5">

									{{ Form::label('select_exam_series', getphrase('select_exam_series')) }}
									<select name="exam_series" class="form-control" ng-model="exam_series_id" ng-change="examSeriesChanged(exam_series_id)">
										<option value="" selected="selected">Please Select..</option>
										<option ng-repeat="series in seriesItems"  data-total_exams="series.total_exams"  ng-value="series.id" >
											@{{series.title}}
										</option>
									</select>
									{{--<h1>You selected: @{{exam_series_id}}</h1>--}}

									{{--{{Form::select('exam_type', $exam_types, null, ['class'=>'form-control', 'ng-model' => 'exam_type',--}}

									{{--'placeholder' => getPhrase('Select')  ])}}--}}

								</fieldset>
								<fieldset class="form-group col-md-2">

{{--									{{ Form::label('exam_series_type', getphrase('final_exam')) }}--}}

									{{Form::input('exam_series_type',$value = null ,false,  ['class'=>'hide', 'ng-model' => 'exam_series_type' ])}}

								</fieldset>
								<h1>You selected: @{{exam_series_type}}</h1>

                                <?php
								//$exam_types = array('0'=>'Select Exam Series ...');
								//$exam_types = array('0'=>'Mock', '1'=>'Final');
                                ?>

							</div>

						<div class="row">
								<fieldset class="form-group col-md-6">
									{{ Form::label('lms_sections', getphrase('select_section')) }}

									{{Form::select('lms_sections', $course_sections, null , ['class'=>'form-control', 'ng-model' => 'exam_section_id',

                                    'placeholder' => 'Select'
            ])}}

								</fieldset>

								<fieldset class="form-group col-md-6">
									{{ Form::label('add_new_sections', getphrase('add_update_sections')) }}<br />

									<a href="{{URL_LMS_SERIES_ADDSECTIONS.$record->slug}}" class="btn btn-primary">{{getphrase('manage_sections')}}</a><br />

								</fieldset>


</div>



								<div class="col-md-12">

							<div ng-if="examSeries!=''" class="vertical-scroll" >

								<h4 ng-if="categoryItems.length>0" class="text-success">{{getPhrase('total_items')}}: @{{ categoryItems.length}} </h4>

								<table class="table table-hover">

									<th>{{getPhrase('title')}}</th>
									<th>{{getPhrase('duration')}}</th>
									<th>{{getPhrase('total_marks')}}</th>
									<th>{{getPhrase('action')}}</th>
									<tr ng-repeat="item in categoryItems | filter : {is_paid: exam_type} | filter:search_term  track by $index">

										 

										<td 

										title="@{{item.title}}" >

										@{{item.title}}

										</td>

										<td>@{{item.dueration}}</td>

										<td>@{{item.total_marks}}</td>

										{{-- <td><img src="{{IMAGE_PATH_UPLOAD_LMS_CONTENTS}}@{{item.image}}" height="50" width="50" /> --}}</td>

										<td><a 

										 

										ng-click="addToCourse(item,exam_series_type,exam_section_id);" class="btn btn-primary" >{{getPhrase('add')}}</a>

									  		

										  </td>

										

									</tr>

								</table>

								</div>	

							



					 			</div>

					 			 



					 		</div>

					 





				</div>

			</div>

			<!-- /.container-fluid -->

		</div>

		<!-- /#page-wrapper -->

@stop

@section('footer_scripts')

@include('lms.lmsseries.scripts.js-scripts')

@stop

 

@section('custom_div_end')

 </div>

@stop