@extends('layouts.sitelayout')
<style>
    .social-btns .btn .fa {line-height: 40px;}
    @media screen and (min-width:320px) and (max-width:966px) {
        .social-btns .btn .fa {line-height:28px; }
    }
</style>
@section('content')
    @include('site.partials.student_topBar')
    <div class="student__dashboard">
        <div class="container">
            <div class="row">
                @include('site.partials.student_nav')
                <div class="col-lg-9 col-md-8">
                    <div class="extra-space-30"></div>

                    <div class="panel panel-custom">
                        <div class="panel-heading">
                            <div class="right-buttons"><a href="{{URL_ADMIN_NOTIFICATIONS_ADD}}" class="btn button">{{ getPhrase('create')}}</a></div>
                            <h3>{{ $title }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>{{ getPhrase('title')}}</th>
                                        <th>{{ getPhrase('start_date')}}</th>
                                        <th>{{ getPhrase('end_date')}}</th>
                                        <th>{{ getPhrase('url')}}</th>
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
@stop
@section('footer_scripts')
@endsection