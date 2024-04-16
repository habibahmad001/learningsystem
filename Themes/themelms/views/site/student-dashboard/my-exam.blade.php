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
                            <h3>{{ $title.' '.getPhrase('of').' '.$user->name }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>{{ getPhrase('Exam title')}}</th>
                                        <th>{{ getPhrase('Achieved Marks')}}</th>
                                        <th>{{ getPhrase('Result')}}</th>
                                        <th>{{ getPhrase('View Answers')}}</th>
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
//    array( "data" => "title", "name" => "title" ),
        array( "data" => "title", "name" => "title" ),
        array( "data" => "total_marks", "name" => "total_marks"),
        array( "data" => "exam_status", "name" => "exam_status" ),
//    array( "data" => "attempts", "name" => "attempts" ),
        array( "data" => "action", "name" => "action" )
    );

    $colnames= json_encode($arr);
    ?>
@endsection
@section('footer_scripts')
    @include('common.datatables', array('colnames'=>$colnames,'route'=>URL_STUDENT_EXAM_ANALYSIS_BYEXAM.$user->slug, 'route_as_url' => 'TRUE'))
@stop