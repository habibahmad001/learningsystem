@extends($layout)
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')


<div id="page-wrapper" ng-controller="payments_report">
            <div class="container-fluid">
                <!-- Page Heading -->
                 <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
                            @if($payment_mode=='online')
                            <li><a href="{{URL_ONLINE_PAYMENT_REPORTS}}">{{$payments_mode}}</a> </li>
                            @else
                            <li><a href="{{URL_OFFLINE_PAYMENT_REPORTS}}">{{$payments_mode}}</a> </li>
                            @endif
                           
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
                        <table id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>{{ getPhrase('image')}}</th>
                                    <th>{{ getPhrase('user_name')}}</th>
                                    <th>{{ getPhrase('item')}}</th>
                                    <th>{{ getPhrase('plan')}}</th>
                                    <th>{{ getPhrase('start_date')}}</th>
                                    <th>{{ getPhrase('end_date')}}</th>
                                    <th>{{ getPhrase('payment_gateway')}}</th>
                                    <th>{{ getPhrase('updated_at')}}</th>
                                    <th>{{ getPhrase('payment_status')}}</th>
                                    
                                </tr>
                            </thead>
                             
                        </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
{!! Form::open(array('url' => URL_PAYMENT_APPROVE_OFFLINE_PAYMENT, 'method' => 'POST', 'name'=>'formQuiz ',  )) !!}
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{getPhrase('offline_payment_details')}}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
           <div class="col-md-8 col-md-offset-2">
               <p><strong>{{getPhrase('name')}}</strong> : @{{payment_record.item_name}}</p>
               <p><strong>{{getPhrase('cost')}}</strong> : {{getCurrencyCode().' '}} @{{payment_record.cost}}</p>
               <p><strong>{{getPhrase('coupon_applied')}}</strong> : @{{coupon_applied}}</p>
               <p><strong> @{{payment_record.other_details.coupon_applied}}</strong></p>
               <div ng-if="other_details.is_coupon_applied==1">
               <p><strong>{{getPhrase('discount')}}</strong> : {{getCurrencyCode().' '}}@{{other_details.discount_availed}}</p>
               <p><strong>{{getPhrase('after_discount')}}</strong> : {{getCurrencyCode().' '}}@{{other_details.after_discount}}</p>
               </div>
               <p><strong>{{getPhrase('plan_type')}}</strong> : @{{payment_record.plan_type}}</p>
               <p><strong>{{getPhrase('notes')}}</strong> :  @{{payment_record.notes}}</p>
               <p><strong>{{getPhrase('created_at')}}</strong> : @{{payment_record.created_at}}</p>
               <p><strong>{{getPhrase('updated_at')}}</strong> : @{{payment_record.updated_at}}</p>
               <p><strong>{{getPhrase('comments')}}</strong> : <textarea class="form-control" name="admin_comment"></textarea></p>
               <input type="hidden" name="record_id" value="@{{payment_record.id}}">
           </div>
        </div>
      </div>
      <div class="modal-footer">
      <button class="btn btn-lg btn-success button" name="submit" value="approve" >{{ getPhrase('approve') }}</button>
      <button class="btn btn-lg btn-danger button" name="submit" value="reject" >{{ getPhrase('reject') }}</button>
        <button type="button" class="btn btn-lg btn-default button" data-dismiss="modal">{{ getPhrase('close')}}</button>
      </div>
    </div>
{!! Form::close() !!}
  </div>
</div>
        </div>




<?php
$arr = array(
    array( "data" => "image", "name" => "image" ),
    array( "data" => "name", "name" => "name"),
    array( "data" => "item_name", "name" => "item_name"),
    array( "data" => "plan_type", "name" => "plan_type"),
    array( "data" => "start_date", "name" => "start_date"),
    array( "data" => "end_date", "name" => "end_date"),
    array( "data" => "payment_gateway", "name" => "payment_gateway"),
    array( "data" => "updated_at", "name" => "updated_at"),
    array( "data" => "payment_status", "name" => "payment_status")
);

$colnames= json_encode($arr);
?>
@endsection
 

@section('footer_scripts')
  
 @include('common.datatables', array('colnames'=>$colnames,'route'=>$ajax_url, 'route_as_url' => TRUE))
 @include('payments.scripts.js-scripts');
 {{-- @include('common.deletescript', array('route'=>URL_QUIZ_DELETE)) --}}
<script>
function viewDetails(record_id)
{
    angular.element('#page-wrapper').scope().setDetails(record_id);
    angular.element('#page-wrapper').scope().$apply() 
 $('#myModal').modal('show');
}
</script>
@stop
