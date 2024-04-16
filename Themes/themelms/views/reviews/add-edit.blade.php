@extends($layout)
 
@section('content')
	<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
							<li><a href="{{URL_REVIEWS}}">{{ getPhrase('Reviews')}}</a></li>
							{{--<li class="active">{{isset($title) ? $title : ''}}</li>--}}
						</ol>
					</div>
				</div>
					@include('errors.errors')
				<!-- /.row -->
				<?php 
					$settings = ($record) ? $settings : ''; 
				?>

				<div class="panel panel-custom col-lg-6 col-lg-offset-3" ng-init="initAngData('{{ $settings }}');" ng-controller="angLmsController">
					<div class="panel-heading"> 
						<div class="pull-right messages-buttons">
							<a href="{{URL_REVIEWS}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>
						</div>
					<h1>{{$title}}  </h1>
					</div>
					<div class="panel-body" >
					<?php $button_name = getPhrase('create'); ?>
					@if ($record)
					 <?php $button_name = getPhrase('update'); ?>
						{{ Form::model($record, 
						array('url' => URL_REVIEWS_EDIT. $record->id, 'novalidate'=>'','name'=>'formLms ',
						'method'=>'patch', 'files' => true)) }}
					@else
						{!! Form::open(array('url' => URL_REVIEWS_ADD,
							'novalidate'=>'','name'=>'formLms ',
						'method' => 'POST', 'files' => true)) !!}
					@endif
					 @include('reviews.form_elements',
					 array('record'=>$record,'courses'=>$courses,'users'=>$users))
					 	 	
					{!! Form::close() !!}
					</div> 
  
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
@stop
@section('footer_scripts')
	<script src="{{themes('js/bootstrap-datepicker.min.js')}}"></script>
	{{--<script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>--}}
@include('reviews.scripts.js-scripts')
@include('common.validations', array('isLoaded'=>'1'));
@include('common.editor'); 
  @include('common.alertify')

@stop
 