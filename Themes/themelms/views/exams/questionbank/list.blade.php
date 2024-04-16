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

							<a href="{{URL_QUESTIONBAMK_IMPORT}}" class="btn  btn-primary button" >{{ getPhrase('import_subject')}}</a>
							<a href="{{URL_SUBJECTS_ADD}}" class="btn  btn-primary button" >{{ getPhrase('add_subject')}}</a>

						</div>
						<h1>{{ $title }}</h1>
					</div>
					<div class="panel-body packages">
						<div>
						<table id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">
							<thead>
								<tr>

									<th> All <input type="checkbox" class='checkall' id='checkall'><input class="btn btn-sm btn-primary"  type="button" data-id="{{ route('subjects.massremove')}}" id='delete_record' value='Delete' ></th>
									<th>{{ getPhrase('subject')}}</th>
									<th>{{ getPhrase('code')}}</th>
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
    array( "data" => "subject_title", "name" => "subject_title" ),
    array( "data" => "subject_code", "name" => "subject_code"),
    array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);
?>

@endsection


@section('footer_scripts')

 @include('common.datatables', array('colnames'=>$colnames,'route'=> URL_QUESTIONBANK_GETLIST, 'route_as_url' => 'TRUE'))
 @include('common.deletescript', array('route'=> URL_QUESTIONBANK_DELETE))

@stop
