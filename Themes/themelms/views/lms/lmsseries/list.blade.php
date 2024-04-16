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
							<li>{{ $title.$slug }}</li>
						</ol>
					</div>
				</div>
								
				<!-- /.row -->
				<div class="panel panel-custom">
					<div class="panel-heading">
						
						<div class="pull-right messages-buttons">
							<a href="{{URL_LMS_SERIES_ADD}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>
						</div>
						<h1>{{ $title }}</h1>
					</div>
					<div class="panel-body packages">
						<div>
							<div class="mb-10 pb-10" style="margin-bottom: 10px;">
							<input type="button" class="btn btn-sm btn-primary"  data-id="{{ route('series.massremove')}}" id='delete_record' value='Delete' >
							<input type="button" class="btn btn-sm btn-warning"  data-id="{{ route('series.massunpublish')}}" id='unpublish_record' value='UnPublish' >
							<input type="button" class="btn btn-sm btn-success"  data-id="{{ route('series.masspublish')}}" id='publish_record' value='Publish' >
						</div>
							<div class="table-responsive">
								<table id="table" class="table table-striped table-bordered datatable r_s_h mt-10" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th> All <input type="checkbox" class='checkall' id='checkall'></th>
										<th>{{ getPhrase('title')}}</th>
										<th>{{ getPhrase('image')}}</th>
										<th>{{ getPhrase('publish')}}</th>
										<th>{{ getPhrase('cost')}}</th>
										<th>{{ getPhrase('discount_price')}}</th>
										<th>{{ getPhrase('validity')}}</th>
										<th>{{ getPhrase('total_items')}}</th>
										<th>{{ getPhrase('action')}}</th>
									</tr>
								</thead>
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>

<?php
$arr = array(
    array( "data" => "check_course", "name" => "check_course" ),
    array( "data" => "title", "name" => "title" ),
    array( "data" => "image", "name" => "image"),
    array( "data" => "status", "name" => "status" ),
    array( "data" => "cost", "name" => "cost" ),
    array( "data" => "discount_price", "name" => "discount_price" ),
    array( "data" => "validity", "name" => "validity" ),
    array( "data" => "total_items", "name" => "total_items" ),
    array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);
?>


@endsection
 

@section('footer_scripts')
  
 @include('common.datatables', array('colnames'=>$colnames,'route'=>URL_LMS_SERIES_AJAXLIST.'/'.$slug, 'route_as_url' => TRUE))
 @include('common.deletescript', array('route'=>URL_LMS_SERIES_DELETE))

@stop
