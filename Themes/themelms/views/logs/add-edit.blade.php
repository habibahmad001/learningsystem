@extends(getLayout())

@section('content')
	<style>
		.permi-check {
			display: inline-block !important;
		}
		.permissions-div {
			display: none;
		}
	</style>
<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="/"><i class="mdi mdi-home"></i></a> </li>
							<li><a href="{{URL_LOGS}}">{{ getPhrase('logs')}}</a></li>
							<li class="active">{{isset($title) ? $title : ''}}</li>
						</ol>
					</div>
				</div>
					@include('errors.errors')
				<!-- /.row -->

				<div class="panel panel-custom col-lg-8 col-lg-offset-2">
					<div class="panel-heading">
						<div class="pull-right messages-buttons">
							{{--<a href="{{URL_PAGES}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>--}}
						</div>
						
					<h1>{{ $title }} </h1>
					</div>
					<div class="panel-body" >
					<?php $button_name = getPhrase('create'); ?>
					@if ($records)
					 <?php $button_name = getPhrase('update'); ?>
						 {!! Form::open(array('url' => URL_LOGS, 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id'=>'frmmark', 'name'=>'frmmark', 'novalidate'=>'')) !!}
					@else
						{!! Form::open(array('url' => URL_LOGS, 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id'=>'frmmark', 'name'=>'frmmark', 'novalidate'=>'')) !!}
					@endif
					

					 @include('logs.form_elements',
					 array('button_name'=> $button_name),
					 array('records'=> $records))
					 		
					{!! Form::close() !!}
					</div>

				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
@stop

@section('footer_scripts')
@include('common.validations')
@include('common.editor')
@include('common.alertify')
	<script language="javascript">
	</script>
@stop
 
 