@extends(getLayout())

@section('content')
<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="/"><i class="mdi mdi-home"></i></a> </li>
							<li><a href="{{URL_PROMOPOPUP}}">{{ getPhrase('promotion popup')}}</a></li>
							<li class="active">{{isset($title) ? $title : ''}}</li>
						</ol>
					</div>
				</div>
					@include('errors.errors')
				<!-- /.row -->

				<div class="panel panel-custom col-lg-8 col-lg-offset-2">
					<div class="panel-heading">
						<div class="pull-right messages-buttons">
							<a href="{{URL_PROMOPOPUP}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>
						</div>
						
					<h1>{{ $title }}  </h1>
					</div>
					<div class="panel-body" >
					<?php $button_name = getPhrase('create'); ?>
					@if ($record)
					 <?php $button_name = getPhrase('update'); ?>
						 {!! Form::open(array('url' => URL_PROMOPOPUP_EDIT . collect(request()->segments())->last(), 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id'=>'frmmark', 'name'=>'frmmark', 'novalidate'=>'')) !!}
					@else
						{!! Form::open(array('url' => URL_PROMOPOPUP_ADD, 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id'=>'frmmark', 'name'=>'frmmark', 'novalidate'=>'')) !!}
					@endif
					

					 @include('popup.form_elements',
					 array('button_name'=> $button_name),
					 array('record'=> $record))
					 		
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
<script src="{{JS}}datepicker.min.js"></script>
<script>
	$('#psd').datepicker({
		autoclose: true,
		startDate: "0d",
		format: 'yyyy-mm-dd',
	});

	$('#ped').datepicker({
		autoclose: true,
		startDate: "0d",
		format: 'yyyy-mm-dd',
	});

	$(".fa-angle-double-right").click(function () {
		$("#course option:selected").each(function() {
			$(this).remove().appendTo('#coursename');
		});
	});

	$(".fa-angle-double-left").click(function () {
		$("#coursename option:selected").each(function() {
			$(this).remove().appendTo('#course');
		});
	});

	$("#allcourse").keyup(function (e) {
		var searchtxt	=	$(this).val().toLowerCase();
		$("#course option").removeClass("hideit");
		$("#course option").each(function() {
			if(!($(this).text()).toLowerCase().includes(searchtxt)) {
				$(this).addClass("hideit");
			}
		});
	});

	$("#selectedcourse").keyup(function (e) {
		var searchtxt	=	$(this).val().toLowerCase();
		$("#coursename option").removeClass("hideit");
		$("#coursename option").each(function() {
			if(!($(this).text()).toLowerCase().includes(searchtxt)) {
				$(this).addClass("hideit");
			}
		});
	});

	$("#saveBTN").hover(function () {
		$("#coursename option").each(function() {
			$(this).prop('selected', true);
		});
	});
</script>
@stop
 
 