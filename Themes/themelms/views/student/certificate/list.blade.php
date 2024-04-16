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

						{{--<div class="pull-right messages-buttons">--}}
							{{--<a href="{{ URL::to('certificate_fee/630') }}" class="btn  btn-primary button" >{{ getPhrase('order')}}</a>--}}
						{{--</div>--}}

						<h1>{{ $title }}</h1>
					</div>

					<div class="panel-body packages">
						<div class="table-responsive new__layouttable">
						<table  id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">
							<thead>
								<tr>
									{{--<th> All <input type="checkbox" class='checkall' id='checkall'><input class="btn btn-sm btn-primary"  type="button" data-id="{{ route('pages.massremove')}}" id='delete_record' value='Delete' ></th>--}}
									<th>{{ getPhrase('ID')}}</th>
									<th>{{ getPhrase('course_name')}}</th>
									<th>{{ getPhrase('user_name')}}</th>
									<th>{{ getPhrase('course_type')}}</th>
{{--									<th>{{ getPhrase('email')}}</th>--}}
									<th>{{ getPhrase('price')}}</th>
									<th>{{ getPhrase('certificate_code')}}</th>
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
    array( "data" => "check_course", "name" => "check_course" ),
    array( "data" => "course_name", "name" => "course_name" ),
    array( "data" => "user_name", "name" => "user_name" ),
    array( "data" => "course_type", "name" => "course_type" ),
//    array( "data" => "email", "name" => "user_email"),
    array( "data" => "price", "name" => "delivery_fee"),
    array( "data" => "certificate_code", "name" => "certificate_code" ),
    array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);

//dd($colnames);


?>

<div class="modal fade" id="pdfviewer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="modal-body">
				<div  class="text-center"  id="genloader">
					<img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/ajax-loader.gif" width="100"> Regenerating Certificate ...
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('footer_scripts')

	@include('common.datatables', array('colnames'=>$colnames,'route'=>URL_STUDENT_CERTIFICATES_GETLIST.'/'.$slug, 'route_as_url' => TRUE))
	@include('common.deletescript', array('route'=>URL_CERTIFICATES_DELETE))
	@include('student.lms.scripts.common-scripts')

@stop
