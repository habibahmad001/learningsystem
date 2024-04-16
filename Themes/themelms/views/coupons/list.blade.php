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
							<a href="{{URL_COUPONS_ADD}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>
						</div>

						<h1>{{ $title }}</h1>
					</div>
					<div class="panel-body packages">
						<div class="table-responsive">
						<table id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>{{ getPhrase('title')}}</th>
									<th>{{ getPhrase('code')}}</th>
									<th>{{ getPhrase('type')}}</th>
									<th>{{ getPhrase('discount')}}</th>
									<!--th>{{ getPhrase('minimum_bill')}}</th>
									<th>{{ getPhrase('maximum_discount')}}</th>
									<th>{{ getPhrase('limit')}}</th-->
									<th>{{ getPhrase('status')}}</th>
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
		array( "data" => "coupon_code", "name" => "coupon_code"),
		array( "data" => "discount_type", "name" => "discount_type" ),
		array( "data" => "discount_value", "name" => "discount_value" ),
//		array( "data" => "minimum_bill", "name" => "minimum_bill" ),
//		array( "data" => "discount_maximum_amount", "name" => "discount_maximum_amount" ),
//		array( "data" => "usage_limit", "name" => "usage_limit" ),
		array( "data" => "status", "name" => "status" ),
		array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);
?>
@endsection


@section('footer_scripts')

 @include('common.datatables', array('colnames'=>$colnames,'route'=>URL_COUPONS_GETLIST, 'route_as_url' => TRUE,'colnames'=>$colnames))
 @include('common.deletescript', array('route'=>URL_COUPONS_DELETE))

@stop
