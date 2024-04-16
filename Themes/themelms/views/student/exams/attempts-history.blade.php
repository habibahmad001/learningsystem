@extends($layout)

@section('header_scripts')

<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">

@stop

@section('content')


	<style>
		.modal-body {
			display: grid;
		}

		.form-group label {
			position: relative;
			cursor: pointer;
		}

		.list-item .form-group {
			margin-bottom: 0px;
			display: inline;
		}
		#pdfviewer .modal-body {
			padding: 0;
		}
		#pdfviewer button.close{
			position: absolute;
			right: 0;
			z-index: 999;
			background: #000;
			width: 100px;
			font-size: 40px;
			bottom: 0;
		}

		.modal-body .form-group {

			margin-right: 5px;
		}

		.lesson-list .form-group input {
			padding: 0;
			height: initial;
			width: initial;
			margin-bottom: 0;
			display: none !important;
			cursor: pointer;
		}

		.lesson-list .form-group label:before {
			content: '';
			-webkit-appearance: none;
			background-color: transparent;
			border: 2px solid #097e97;
			box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
			padding: 6px;
			display: inline-block;
			position: relative;
			vertical-align: middle;
			cursor: pointer;
			margin-right: 5px;
		}

		.lesson-list .form-group input:checked + label:after {
			content: '';
			display: block;
			position: absolute;
			top: 1px;
			left: 6px;
			width: 5px;
			height: 11px;
			border: solid #097e97;
			border-width: 0 2px 2px 0;
			transform: rotate(45deg);
		}
		.modal-body form .form-group {
			margin-right: 10px;
		}
		.lesson-list .list-item .form-group label {
			color: #353f4d;
			font-weight: normal;
			margin-bottom: 0px;
			margin-left: 5px;
		}
	</style>



<div id="page-wrapper">

			<div class="container-fluid">

				<!-- Page Heading -->

				<div class="row">

					<div class="col-lg-12">

						<ol class="breadcrumb">

							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>

							 

							<li>{{ $title}}</li>

						</ol>

					</div>

				</div>

								

				<!-- /.row -->

				<div class="panel panel-custom">

					<div class="panel-heading">

						 

						<h1>{{ $title.' '.getPhrase('of').' '.$user->name }}</h1>

					</div>

					<div class="panel-body packages">

						<div class="table-responsive"> 

						<table id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">

							<thead>

								<tr>

								 

									<th>{{ getPhrase('title')}}</th>

									<th>{{ getPhrase('type')}}</th>

								 

									<th>{{ getPhrase('marks')}}</th>

								 	 

									<th>{{ getPhrase('result')}}</th>
									<th>{{ getPhrase('attempts')}}</th>

									 

									<th>{{ getPhrase('action')}}</th>

								  

								</tr>

							</thead>

							 

						</table>

						</div>

						<div class="row">

							<div class="col-md-6 col-md-offset-3">

								<canvas id="myChart1" width="100" height="110"></canvas>

							</div>

						</div>

					</div>

				</div>

			</div>

			<!-- /.container-fluid -->

		</div>
<?php
$arr = array(
    array( "data" => "title", "name" => "title" ),
    array( "data" => "is_paid", "name" => "is_paid"),
    array( "data" => "marks_obtained", "name" => "marks_obtained" ),
    array( "data" => "exam_status", "name" => "exam_status" ),
    array( "data" => "attempts", "name" => "attempts" ),
    array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);
?>
@endsection



<div class="modal fade" id="pdfviewer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="modal-body">
				<div  class="text-center"  id="genloader">
					<img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/ajax-loader.gif" width="100"> Generating Certificate ...
				</div>
			</div>
		</div>
	</div>
</div>

@section('footer_scripts')
	@include('student.lms.scripts.common-scripts')
 @if(!$exam_record)

 @include('common.datatables', array('colnames'=>$colnames,'route'=>URL_STUDENT_EXAM_GETATTEMPTS.$user->slug, 'route_as_url' => 'TRUE'))

 @else

 @include('common.datatables', array('colnames'=>$colnames,'route'=>URL_STUDENT_EXAM_GETATTEMPTS.$user->slug.'/'.$exam_record, 'route_as_url' => 'TRUE'))

 @endif

 @include('common.chart', array($chart_data,'ids' => array('myChart1')));
 <style>
	 td.my_class.sorting_1 {
		 width: 400px;
		 height: 40px;
	 }
 </style>
@stop

