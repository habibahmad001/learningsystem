@extends($layout)

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

						<h1>{{ $title }}</h1>

					</div>


					<div class="panel-body packages">

						<div class="row enquiriesList-filter">
							<div class="col-lg-4">&nbsp;</div>
							<div class="col-lg-4">
								<h4>Apply Filter:</h4>
							</div>
							<div class="col-lg-4 text-right">
								<select name="pagename" id="settype" class="form-control text-center" onchange="javascript: window.location.href='{!! URL_ENQUIRIES_LIST !!}' + $(this).val();">
									<option value="all">-------- Select one ---------</option>
									<option value="all" {!! ($slug == "all") ? "selected" : "" !!}>All</option>
									<option value="contact" {!! ($slug == "contact") ? "selected" : "" !!}>Contact Us</option>
									<option value="course_enquiry" {!! ($slug == "course_enquiry") ? "selected" : "" !!}>Course Enquiry</option>
									<option value="general" {!! ($slug == "general") ? "selected" : "" !!}>General Query</option>
									<option value="presale" {!! ($slug == "presale") ? "selected" : "" !!}>Presale</option>
									<option value="technical" {!! ($slug == "technical") ? "selected" : "" !!}>Technical</option>
									<option value="other" {!! ($slug == "other") ? "selected" : "" !!}>Other</option>
								</select>
							</div>
						</div>


						<div class="table-responsive"> 

						<table id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">

							<thead>

								<tr>

									<th>{{ getPhrase('id_#')}}</th>

									<th>{{ getPhrase('name')}}</th>

									<th>{{ getPhrase('email')}}</th>

									<th>{{ getPhrase('enquiry_type')}}</th>

									<th>{{ getPhrase('enquiry_date')}}</th>

									<th>{{ getPhrase('view_enquiry')}}</th>



								  

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
		array( "data" => "id_#", "name" => "id"),
    	array( "data" => "name", "name" => "name"),
    	array( "data" => "email", "name" => "email"),
    	array( "data" => "enquiry_type", "name" => "enquiry_type"),
    	array( "data" => "enquiry_date", "name" => "created_at"),
    	array( "data" => "view_enquiry", "name" => "view_enquiry")
);

$colnames= json_encode($arr);
?>
@endsection

 



@section('footer_scripts')


	@include('common.datatables', array('colnames'=>$colnames,'route'=>URL_ENQUIRIES_AJAXLIST.$slug, 'route_as_url' => TRUE))
 	@include('common.deletescript', array('route'=>'/exams/quiz/delete/'))



@stop

