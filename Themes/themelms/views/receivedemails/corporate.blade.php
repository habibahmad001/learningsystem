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
							<a href="{{URL_CORPORATE}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>
						</div>
					 
						<h1>{{ $title }}</h1>
					</div>
					<div class="panel-body packages">
						<div class="table-responsive">
						<table  id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>{{ getPhrase('id_#')}}</th>
									<th>{{ getPhrase('name')}}</th>
									<th>{{ getPhrase('email')}}</th>
									<th>{{ getPhrase('telephone_no')}}</th>
									<th>{{ getPhrase('received_at')}}</th>
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
    array( "data" => "id_#", "name" => "id" ),
    array( "data" => "name", "name" => "f_name" ),
    array( "data" => "email", "name" => "email"),
    array( "data" => "telephone_no", "name" => "contact"),
    array( "data" => "received_at", "name" => "created_at"),
    array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);

//dd($colnames);


?>
@endsection


@section('footer_scripts')

	 @include('common.datatables', array('colnames'=>$colnames,'route'=>URL_CORPORATE_GETLIST, 'route_as_url' => TRUE))
 	 @include('common.deletescript', array('route'=>URL_CORPORATE_EDIT))


@stop
