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
						
						
						<h1>{{ $title }}</h1>
					</div>
					<div class="panel-body packages">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>#</th>
									<th>{{ getPhrase('User') }}</th>
									<th>{{ getPhrase('Course') }}</th>
									<th>{{ getPhrase('TransactionId') }}</th>
									<th>{{ getPhrase('PaymentMethod') }}</th>
									<th>{{ getPhrase('TotalAmount') }}</th>
{{--									<th>{{ getPhrase('Status') }}</th>--}}
									{{--<th>{{ getPhrase('View') }}</th>--}}
									{{--<th>{{ getPhrase('Delete') }}</th>--}}
								</tr>
								</thead>
								<tbody>
                                <?php $i=0;?>
								@if(count($orders) > 0)
									@foreach($orders as $order)
										<?php $i++;
										// dd($order->user->name);

										?>
										<tr>
											<td><?php echo $i;?></td>
											<td>{{$order->user->name}}</td>
											<td>{{ $order->item_name}}</td>
											<td>{{$order->payment['transaction_id']}}</td>
											<td>{{$order->payment['payment_gateway']}}</td>

											@if($order->coupon_applied)
												<td><i class="{{ $order->payment['currency_icon'] }}"></i>{{ $order->payment['actual_cost'] - $order->payment['discount_amount'] }}</td>
											@else
												<td><i class="fa {{ $order->payment['currency_icon'] }}"></i>{{ $order->payment['actual_cost'] }}</td>
											@endif

											<td class="d-none">
												<form action="{{ route('order.quick',$order->id) }}" method="POST">
													{{ csrf_field() }}
													<button  type="Submit" class="btn btn-xs {{ $order->payment_status =='success' ? 'btn-success' : 'btn-danger' }}">
														@if($order->payment_status =='success')
															{{ getPhrase('Active') }}
														@else
															{{ getPhrase('Deactive') }}
														@endif
													</button>
												</form>
											</td>

											{{--<td><a class="btn btn-primary btn-sm" href="{{route('view.order',$order->id)}}">{{ getPhrase('View') }}</a>--}}
											{{--</td>--}}

											{{--<td>
												<form  method="post" action="{{url('order/'.$order->id)}}"
													   data-parsley-validate class="form-horizontal form-label-left">
													{{ csrf_field() }}
													{{ method_field('DELETE') }}
													<button type="submit" class="btn btn-danger btn-sm">
														<i class="fa fa-fw fa-trash-o"></i>
													</button>
												</form>
											</td>--}}
										</tr>
									@endforeach
								@else
									<tr>
										<th colspan="7"><br /><center><span style="color: #9e0505; font-weight: bold; font-size: 14px">No record found!!</span></center></th>
									</tr>
								@endif
							</table>	</div>

					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>

@endsection
 

@section('footer_scripts')
  
 
@stop
