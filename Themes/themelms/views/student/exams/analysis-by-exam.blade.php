@extends($layout)

@section('header_scripts')

<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">

@stop

@section('content')
	<!-- Admin User/Student My Exams -->


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



									<th>{{ getPhrase('Exam title')}}</th>
{{--									<th>{{ getPhrase('Exam Title')}}</th>--}}

									<th>{{ getPhrase('Achieved Marks')}}</th>

									<th>{{ getPhrase('Result')}}</th>

									{{--<th>{{ getPhrase('Attempts')}}</th>--}}

									<th>{{ getPhrase('View Answers')}}</th>







								</tr>

							</thead>



						</table>

						</div>

						<div class="row">

							<div class="col-md-4 col-md-offset-4">

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
//    array( "data" => "title", "name" => "title" ),
    array( "data" => "title", "name" => "title" ),
    array( "data" => "total_marks", "name" => "total_marks"),
    array( "data" => "exam_status", "name" => "exam_status" ),
//    array( "data" => "attempts", "name" => "attempts" ),
    array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);
?>
@endsection

 



@section('footer_scripts')


 @include('common.datatables', array('colnames'=>$colnames,'route'=>URL_STUDENT_EXAM_ANALYSIS_BYEXAM.$user->slug, 'route_as_url' => 'TRUE'))

 

{{--@include('common.chart', array($chart_data,'ids' => array('myChart1' )));--}}



<style>
	td.my_class.sorting_1 {
		width: 400px;
		height: 40px;
	}
</style>

@stop

