@extends($layout)
 
@section('content')
	<link href="{{themes('css/tagsinput.css')}}" rel="stylesheet">
<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
							<li><a href="{{URL_POSTS}}">{{ getPhrase('Posts')}}</a></li>
							<li class="active">{{isset($title) ? $title : ''}}</li>
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
							<a href="{{URL_POSTS}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>
						</div>
					<h1>{{ $title }}  </h1>
					</div>
					<div class="panel-body" >
					<?php $button_name = getPhrase('create'); ?>
					@if ($record)
					 <?php $button_name = getPhrase('update'); ?>
						{{ Form::model($record, 
						array('url' => URL_POSTS_EDIT. $record->slug, 'novalidate'=>'','name'=>'formLms ',
						'method'=>'patch', 'files' => true)) }}
					@else
						{!! Form::open(array('url' => URL_POSTS_ADD,
							'novalidate'=>'','name'=>'formLms ',
						'method' => 'POST', 'files' => true)) !!}
					@endif
					 @include('posts.form_elements',
					 array('record'=>$record,'categories'=>$categories))
					 	 	
					{!! Form::close() !!}
					</div> 
  
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
@stop
@section('footer_scripts')   
@include('posts.scripts.js-scripts')
@include('common.validations', array('isLoaded'=>'1'));
@include('common.editor'); 
  @include('common.alertify')
<script src="{{themes('js/tagsinput.js')}}"></script>
   <script>
 	var file = document.getElementById('image_input');

file.onchange = function(e){
    var ext = this.value.match(/\.([^\.]+)$/)[1];
    switch(ext)
    {
        case 'jpg':
        case 'jpeg':
        case 'png':

     
            break;
        default:
               alertify.error("{{getPhrase('file_type_not_allowed')}}");
            this.value='';
    }
};
 </script>
@stop
 