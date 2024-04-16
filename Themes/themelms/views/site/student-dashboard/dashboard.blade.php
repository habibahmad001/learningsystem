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
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="media state-media box-ws">
                                <div class="media-left">
                                    <a href="{{URL::to(PREFIX . 'my-courses')}}"><div class="state-icn bg-icon-info"><i class="fa fa-book-open"></i></div></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="card-title">{{ App\UserCourses::where("user_id", Auth::user()->id)->count() }} </h4>
                                    <a href="{{URL::to(PREFIX . 'my-courses')}}">{{ getPhrase('my_courses')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="media state-media box-ws">
                                <div class="media-left">
                                    <a href="{{URL_NOTIFICATIONS}}"><div class="state-icn bg-icon-blue"><i class="fa fa-envelope"></i></div></a>
                                </div>
                                <div class="media-body">
                                    <?php $date = date('Y-m-d');?>
                                    <h4 class="card-title">{{ \App\Notification::where('valid_from', '<=', $date)
        											->where('valid_to', '>=', $date)->count() }} </h4>
                                    <a href="{{URL_NOTIFICATIONS}}">{{ getPhrase('my Notifications')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="media state-media box-ws">
                                <div class="media-left">
                                    <a href="{{URL::to(PREFIX . 'messages/'.Auth::user()->slug)}}"><div class="state-icn bg-icon-blue"><i class="fa fa-envelope"></i></div></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="card-title">{{ \Cmgmyr\Messenger\Models\Thread::forUser(Auth::user()->id)->count() }} </h4>
                                    <a href="{{URL::to(PREFIX . 'messages/'.Auth::user()->slug)}}">{{ getPhrase('my messages')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="media state-media box-ws">
                                <div class="media-left">
                                    <a href="{{URL_STUDENT_ANALYSIS_BY_EXAM. Auth::user()->slug}}"><div class="state-icn bg-icon-pink"><i class="fa fa-question-circle"></i></div></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="card-title">{{ App\QuizResult::where("user_id", Auth::user()->id)->count() }}</h4>
                                    <a href="{{URL_STUDENT_ANALYSIS_BY_EXAM. Auth::user()->slug}}">{{ getPhrase('my_exams')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="media state-media box-ws">
                                <div class="media-left">
                                    <a href="{{URL::to(PREFIX . 'student/certificates/list')}}"><div class="state-icn bg-icon-purple"><i class="fa fa-award" style="font-size: 35px;"></i></div></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="card-title">{{ App\Certificate::where("user_id", Auth::user()->id)->count() }}</h4>
                                    <a href="{{URL::to(PREFIX . 'student/certificates/list')}}">{{ getPhrase('my_certificates')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="media state-media box-ws">
                                <div class="media-left">
                                    <a href="{{URL::to(PREFIX . 'payments/list/'.Auth::user()->slug)}}"><div class="state-icn bg-icon-purple"><i class="fa fa-dollar"></i></div></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="card-title">{{ \App\Payment::select(['item_name', 'plan_type', 'start_date', 'end_date', 'payment_gateway', 'updated_at','payment_status','id','cost', 'after_discount', 'paid_amount'])
		 ->where('user_id', '=', Auth::user()->id)->count() }} </h4>
                                    <a href="{{URL::to(PREFIX . 'payments/list/'.Auth::user()->slug)}}">{{ getPhrase('my_orders')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="media state-media box-ws">
                                <div class="media-left">
                                    <a href="{{URL::to(PREFIX . 'my-courses/wishlists')}}"><div class="state-icn bg-icon-blue"><i class="fa fa-heart"></i></div></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="card-title">{{ \App\Wishlist::join('lmsseries', 'wishlists.course_id', '=', 'lmsseries.id')
	->select('*')
	->where('wishlists.user_id', '=', Auth::user()->id)
	->orderBy('lmsseries.id', 'desc')->count() }} </h4>
                                    <a href="{{URL::to(PREFIX . 'my-courses/wishlists')}}">{{ getPhrase('my_wishlists')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="media state-media box-ws">
                                <div class="media-left">
                                    <a href="{{URL_FEEDBACK_SEND}}"><div class="state-icn bg-icon-blue"><i class="fa fa-commenting-o"></i></div></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="card-title"><a href="{{URL_FEEDBACK_SEND}}">{{ getPhrase('my feedback')}}</a></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 d-none">
                            <div class="media state-media box-ws">
                                <div class="media-left">
                                    <a href="javascript:void(0);" onclick="sharewithfriend()"><div class="state-icn bg-icon-blue"><i class="fa fa-heart"></i></div></a>
                                </div>
                                <div class="media-body">

                                    <h4 class="card-title"><a href="javascript:void(0);" onclick="sharewithfriend()">{{ getPhrase('share with friends')}}</a></h4>
                                </div>
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
<script></script>
@endsection