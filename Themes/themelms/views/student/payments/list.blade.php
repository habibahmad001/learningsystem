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

						<div class="table-responsive">

						<table id="table" class="table table-striped table-bordered datatable r_s_h " cellspacing="0" width="100%">

							<thead>

								<tr>
								@if($is_parent)
								 <th>{{ getPhrase('image')}}</th>
                                    <th>{{ getPhrase('user_name')}}</th>
                                @endif

									<th class="no-sort">{{ getPhrase('id')}}</th>

									<th>{{ getPhrase('item_name')}}</th>
									<th class="no-sort">{{ getPhrase('order by')}}</th>
									<th  >{{ getPhrase('order_date')}}</th>

									<th>{{ getPhrase('paid amount')}}</th>

									<th>{{ getPhrase('transaction_id')}}</th>
									<th>{{ getPhrase('payment_gateway')}}</th>

									<th>{{ getPhrase('status')}}</th>

									{{-- <th>{{ getPhrase('action')}}</th> --}}



								</tr>

							</thead>


							{{--<tfoot>
							<tr>
								@if($is_parent)
									<th>{{ getPhrase('image')}}</th>
									<th>{{ getPhrase('user_name')}}</th>
								@endif

								<th class="no-sort">{{ getPhrase('id')}}</th>

								<th>{{ getPhrase('item_name')}}</th>
								<th class="no-sort">{{ getPhrase('order by')}}</th>
								<th  >{{ getPhrase('order_date')}}</th>


								<th>{{ getPhrase('paid amount')}}</th>

								<th>{{ getPhrase('transaction_id')}}</th>
								<th>{{ getPhrase('payment_gateway')}}</th>

								<th>{{ getPhrase('status')}}</th>

							</tr>
							</tfoot>--}}
						</table>

						</div>



					</div>

				</div>

			</div>

			<!-- /.container-fluid -->

		</div>
<?php
$arr = array(
    array( "data" => "id", "name" => "id" ),
    array( "data" => "item_name", "name" => "item_name","orderable"=> true ),
    array( "data" => "user_id", "name" => "user_id"),
    array( "data" => "created_at", "name" => "created_at"),

//    array( "data" => "actual_cost", "name" => "actual_cost"),
//    array( "data" => "discount_amount", "name" => "discount_amount"),
    array( "data" => "paid_amount", "name" => "paid_amount"),

    array( "data" => "transaction_id", "name" => "transaction_id"),
    array( "data" => "payment_gateway", "name" => "payment_gateway"),
    array( "data" => "payment_status", "name" => "payment_status")
);

$nosort_arr = array(
    array( "targets" => "no-sort", "searchable" => "false" )
);

$colnames= json_encode($arr);
$nosrt_colnames= json_encode($nosort_arr);
?>
@endsection





@section('footer_scripts')


@if($slug == "admin")
	@include('common.datatables', array('colnames'=>$colnames,'nosort_colnames'=>$nosrt_colnames,'route'=>URL_PAYPAL_ADMIN_PAYMENTS_AJAXLIST, 'route_as_url' => TRUE))
@else
	@include('common.datatables', array('colnames'=>$colnames,'nosort_colnames'=>$nosrt_colnames,'route'=>URL_PAYPAL_PAYMENTS_AJAXLIST.$user->slug, 'route_as_url' => TRUE))
@endif

 @include('common.deletescript', array('route'=>'/exams/quiz/delete/'))



@stop

