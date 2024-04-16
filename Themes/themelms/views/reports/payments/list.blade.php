@extends($layout)

@section('header_scripts')

<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
	<style>
		#filter_frm * {
			width: 24.4% !important;
			display: inline-block !important;
			vertical-align: top;
			height: 45px;
		}
		@media (max-width: 767px) {
			#filter_frm * {
				width: 100% !important;
				display: block !important;
			}
		}
	</style>

@stop

@section('content')





<div id="page-wrapper">

			<div class="container-fluid">

				<!-- Page Heading -->

				<div class="row">

					<div class="col-lg-12">

						<ol class="breadcrumb">

							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>

							<li>REPORTS LIST</li>

						</ol>

					</div>

				</div>



				<!-- /.row -->

				<div class="panel panel-custom">

					<div class="panel-heading">





						<h1>REPORTS LIST</h1>

					</div>

					<div class="panel-body packages">

						<div class="table-responsive">
							<div class="filter-operations">
								<form name="filter_frm" id="filter_frm" enctype="multipart/form-data" method="post" action="{!! URL::to('/customorders') !!}">
									{!! csrf_field() !!}
									<input type="date" name="sdate" id="sdate" onblur="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" class="form-control mt-10">
									<input type="date" name="edate" id="edate" onblur="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" class="form-control mt-10">
									<select name="paymentdateway" id="paymentdateway" onblur="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" class="form-control mt-10">
										<option value="">--- Select Option ---</option>
										<option value="all">All</option>
										<option value="paypal">Paypal</option>
										<option value="offline">OffLine</option>
										<option value="paypalpro">Paypal Pro</option>
									</select>
									{{--onchange="javascript:$('#filter_frm').submit();"--}}
									<select name="plantype" id="plantype" onblur="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" class="form-control mt-10">
										<option value="">--- Select Option ---</option>
										<option value="all">All</option>
										<option value="lms">LMS</option>
										<option value="studentcard-fee">Studentcard Fee</option>
										<option value="reed-certificate">Reed Certificate</option>
									</select>
								</form>
							</div>

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

									{{--<th>{{ getPhrase('price')}}</th>--}}

									{{--<th>{{ getPhrase('discount')}}</th>--}}

									<th>{{ getPhrase('paid amount')}}</th>

									<th>{{ getPhrase('transaction_id')}}</th>
									<th>{{ getPhrase('payment_gateway')}}</th>

									<th>{{ getPhrase('status')}}</th>

									{{-- <th>{{ getPhrase('action')}}</th> --}}



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
    array( "data" => "pid", "name" => "pid" ),
    array( "data" => "item_name", "name" => "item_name"),
    array( "data" => "order_by", "name" => "order_by"),
    array( "data" => "order_created_at", "name" => "created_at"),

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
	@include('common.datatables', array('colnames'=>$colnames,'nosort_colnames'=>$nosrt_colnames,'route'=>PREFIX.'reports/getList', 'route_as_url' => TRUE))
@else
	@include('common.datatables', array('colnames'=>$colnames,'nosort_colnames'=>$nosrt_colnames,'route'=>PREFIX.'reports/getList/'.$user->slug, 'route_as_url' => TRUE))
@endif

 @include('common.deletescript', array('route'=>'/exams/quiz/delete/'))

<script language="JavaScript">
	jQuery(document).ready(function () {
		jQuery(".buttons-excel").addClass("buttons-xlsx").removeClass("buttons-excel");
		jQuery(".buttons-csv").remove();
		jQuery(".buttons-pdf").remove();
		jQuery(".buttons-print").remove();
		jQuery(".buttons-xlsx").click(function () {
			/******** Validation *********/
			var errors = [];
			if(jQuery("#sdate").val() == '') {
				errors.push("#sdate");
			}

			if(jQuery("#edate").val() == '') {
				errors.push("#edate");
			}

			if(jQuery("#paymentdateway").val() == '') {
				errors.push("#paymentdateway");
			}

			if(jQuery("#plantype").val() == '') {
				errors.push("#plantype");
			}

			if(errors.length>0){
				for(i=0; i < errors.length; i++){
					$(errors[i]).addClass('error');
				}
				return false;
			} else {
				$('#filter_frm').submit();
			}
			/******** Validation *********/
		});
	});
</script>

@stop

