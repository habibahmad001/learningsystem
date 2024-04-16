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
                        <div class="panel-heading">{{--<div class="pull-right messages-buttons">--}}
                            {{--<a href="{{ URL::to('certificate_fee/630') }}" class="btn  btn-primary button" >{{ getPhrase('order')}}</a>--}}
                            {{--</div>--}}
                            <h3>{{ $title }}</h3>
                        </div>

                        <div class="panel-body packages">
                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>{{ getPhrase('ID')}}</th>
                                        <th>{{ getPhrase('course_name')}}</th>
                                        <th>{{ getPhrase('user_name')}}</th>
                                        <th>{{ getPhrase('course_type')}}</th>
                                        <th>{{ getPhrase('price')}}</th>
                                        <th>{{ getPhrase('certificate_code')}}</th>
                                        <th>{{ getPhrase('action')}}</th>
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
        array( "data" => "check_course", "name" => "check_course" ),
        array( "data" => "course_name", "name" => "course_name" ),
        array( "data" => "user_name", "name" => "user_name" ),
        array( "data" => "course_type", "name" => "course_type" ),
//    array( "data" => "email", "name" => "user_email"),
        array( "data" => "price", "name" => "delivery_fee"),
        array( "data" => "certificate_code", "name" => "certificate_code" ),
        array( "data" => "action", "name" => "action" )
    );

    $colnames= json_encode($arr);

    //dd($colnames);


    ?>

    <div class="modal fade" id="pdfviewer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div  class="text-center"  id="genloader">
                        <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/ajax-loader.gif" width="100"> Regenerating Certificate ...
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer_scripts')

    @include('common.datatables', array('colnames'=>$colnames,'route'=>URL_STUDENT_CERTIFICATES_GETLIST, 'route_as_url' => TRUE))
    @include('common.deletescript', array('route'=>URL_CERTIFICATES_DELETE))
    @include('student.lms.scripts.common-scripts')

@stop
