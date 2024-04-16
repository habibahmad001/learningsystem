@extends(getLayout())
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')


<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
							<li>{{ $title }}</li>
						</ol>
					</div>
				</div>
								
				<!-- /.row -->
				<div class="panel panel-custom">
					<div class="panel-heading">
						
						<div class="pull-right messages-buttons">
							<a href="{{URL_EXAM_SERIES_ADD}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>
						</div>
						<h1>{{ $title }}</h1>
					</div>
					<!-- /Exam Series page Table-->
					<div class="panel-body packages">
						<div class="table-responsive">
						<table id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>{{ getPhrase('title')}}</th>
									<th>{{ getPhrase('category')}}</th>
									<th>{{ getPhrase('image')}}</th>
									<th>{{ getPhrase('is_paid')}}</th>
									<th>{{ getPhrase('cost')}}</th>
									<th>{{ getPhrase('validity')}}</th>
									<th>{{ getPhrase('total_exams')}}</th>
									<th>{{ getPhrase('total_questions')}}</th>
									
									<th>{{ getPhrase('action')}}</th>
								  
								</tr>
							</thead>
							 
						</table>
						</div>

					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
<?php
$arr = array(
    array( "data" => "title", "name" => "title" ),
    array( "data" => "category", "name" => "category_id" ),
    array( "data" => "image", "name" => "image"),
    array( "data" => "is_paid", "name" => "is_paid"),
    array( "data" => "cost", "name" => "cost"),
    array( "data" => "validity", "name" => "validity"),
    array( "data" => "total_exams", "name" => "total_exams"),
    array( "data" => "total_questions", "name" => "total_questions"),
    array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);
?>
@endsection
 

@section('footer_scripts')
  
 @include('common.datatables', array('colnames'=>$colnames,'route'=>URL_EXAM_SERIES_AJAXLIST, 'route_as_url' => TRUE))
 @include('common.deletescript', array('route'=>URL_EXAM_SERIES_DELETE))

@stop
