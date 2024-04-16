@extends('layouts.sitelayout')
<style>
    .social-btns .btn .fa {line-height: 40px;}
</style>
@section('content')
    @include('site.partials.student_topBar')
    <div class="student__dashboard">
        <div class="container">
            <div class="row">
                @include('site.partials.student_nav')
                <div class="col-lg-9 col-md-8">
                    <div class="extra-space-30"></div>

                    <div class="panel">
                        <div class="panel-heading">
                            <h3>{{ $title }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        @if($is_parent)
                                            <th>{{ getPhrase('image')}}</th>
                                            <th>{{ getPhrase('user_name')}}</th>
                                        @endif
                                        <th>{{ getPhrase('id')}}</th>
                                        <th>{{ getPhrase('item_name')}}</th>
                                        <th>{{ getPhrase('order by')}}</th>
                                        <th>{{ getPhrase('order_date')}}</th>
                                        <th>{{ getPhrase('price')}}</th>
                                        <th>{{ getPhrase('discount')}}</th>
                                        <th>{{ getPhrase('paid amount')}}</th>
                                        <th>{{ getPhrase('status')}}</th>
                                            {{-- <th>{{ getPhrase('action')}}</th> --}}
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="extra-space-30"></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $arr = array(
        array( "data" => "id", "name" => "id" ),
        array( "data" => "item_name", "name" => "item_name"),
        array( "data" => "order_by", "name" => "order_by"),
        array( "data" => "created_at", "name" => "created_at"),
        array( "data" => "actual_cost", "name" => "actual_cost"),
        array( "data" => "discount_amount", "name" => "discount_amount"),
        array( "data" => "after_discount", "name" => "after_discount"),
//    array( "data" => "updated_at", "name" => "updated_at"),
        array( "data" => "payment_status", "name" => "payment_status")
    );

    $colnames= json_encode($arr);
    ?>
@endsection





@section('footer_scripts')


    @if($slug == "admin")
        @include('common.datatables', array('colnames'=>$colnames,'route'=>URL_PAYPAL_ADMIN_PAYMENTS_AJAXLIST, 'route_as_url' => TRUE))
    @else
        @include('common.datatables', array('colnames'=>$colnames,'route'=>URL_PAYPAL_PAYMENTS_AJAXLIST.$user->slug, 'route_as_url' => TRUE))
    @endif

    @include('common.deletescript', array('route'=>'/exams/quiz/delete/'))



@stop
