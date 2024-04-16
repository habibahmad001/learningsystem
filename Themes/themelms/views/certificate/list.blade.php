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
							{{--<a href="{{URL_STUDENTID_ADD}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>--}}
						{{--</div>--}}
					 
						<h1>{{ $title }}</h1>
					</div>
					<br />
					<!--div class="row">
						<div class="col-lg-4">
							&nbsp;
						</div>
						<div class="col-lg-4 text-right">
							2
						</div>
						<div class="col-lg-4 text-right">
							<select name="pagename" id="pagename" class="form-control text-center" onchange="javascript: if($(this).val() == 'paid') { window.location.href='{!! URL_CERTIFICATES_OPT !!}' + $(this).val() } else if($(this).val() == 'paidapplied') { window.location.href='{!! URL_CERTIFICATES_OPT !!}' + $(this).val() } else { window.location.href='{!! URL_CERTIFICATES !!}' }">
								<option value="all">-------- Select one ---------</option>
								<option value="all">All</option>
								<option value="paid">Only Paid</option>
								<option value="paidapplied">Paid and applied for certificate</option>
							</select>
						</div>
					</div-->

					<div class="panel-body packages">
						<div class="table-responsive new__layouttable">
						<table  id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>{{ getPhrase('id_#')}}</th>
									<th>{{ getPhrase('name')}}</th>
									<th>{{ getPhrase('email')}}</th>
									<th>{{ getPhrase('price')}}</th>
									<th>{{ getPhrase('payment_status')}}</th>
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
    array( "data" => "name", "name" => "user_name" ),
    array( "data" => "email", "name" => "user_email"),
    array( "data" => "price", "name" => "delivery_fee"),
    array( "data" => "payment_type", "name" => "payment_type" ),
    array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);

//dd($colnames);


?>
@endsection


@section('footer_scripts')

	@include('common.datatables', array('colnames'=>$colnames,'route'=>URL_CERTIFICATES_GETLIST.'/'.$slug, 'route_as_url' => TRUE))
	@include('common.deletescript', array('route'=>URL_CERTIFICATES_DELETE))

	{{--@if(collect(request()->segments())->last() == 'all' || collect(request()->segments())->last() == 'list')--}}
		{{--@include('common.datatables', array('colnames'=>$colnames,'route'=>URL_CERTIFICATES_GETLIST, 'route_as_url' => TRUE))--}}
		{{--@include('common.deletescript', array('route'=>URL_CERTIFICATES_DELETE))--}}
	{{--@else--}}
		{{--@if(collect(request()->segments())->last() == 'paid')--}}
			{{--@include('common.datatables', array('colnames'=>$colnames,'route'=>URL_CERTIFICATES_GETLISTFIRST, 'route_as_url' => TRUE))--}}
		{{--@else--}}
			{{--@include('common.datatables', array('colnames'=>$colnames,'route'=>URL_CERTIFICATES_GETLISTSECOND, 'route_as_url' => TRUE))--}}
		{{--@endif--}}
	{{--@endif--}}


@stop
