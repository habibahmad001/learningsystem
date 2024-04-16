@extends('layouts.sitelayout')
<link href="{{CSS}}materialdesignicons.css" rel="stylesheet" type="text/css">
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

                    <div class="panel panel-custom">
                        <div class="panel-heading">
                            <div class="right-buttons">
                                <a class="btn button" href="{{URL_MESSAGES}}"> {{getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'}} </a>
                                <a class="btn button" href="{{URL_MY_MESSAGES_CREATE}}">{{getPhrase('compose')}}</a>
                            </div>
                            <h3>{{getPhrase('inbox')}}</h3>
                        </div>
                        <?php $currentUserId = Auth::user()->id;?>
                        <div class="panel-body">
                            <ul class="inbox-message-list inbox-message-nocheckbox">
                                @if(count($threads)>0)
                                    @foreach($threads as $thread)
                                        {{-- {{dd($currentUserId)}} --}}
                                        <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                                        <?php $sender = getUserRecord($thread->latestMessage->user_id); ?>
                                        <li class="unread-message {!!$class!!}">
                                            <?php
                                            $image_path ='';
                                                    if(isset($sender->image))
                                                        $image_path = getProfilePath($sender->image);
                                                    else
                                                        $image_path = IMAGE_PATH_PROFILE_THUMBNAIL_DEFAULT;
                                                    ?>
                                                    <img class="sender" src="{{$image_path}}" alt="">
                                                    <a href="{{URL_MESSAGES_SHOW.$thread->id}}" class="message-suject">
                                                        <h3>{{ucfirst($thread->subject)}}</h3>
                                                        <p>{!! $thread->latestMessage->body !!}</p>
                                                    </a>
                                                        <span class="receive-time"><i class="mdi mdi-clock"></i> {{$thread->latestMessage->updated_at->diffForHumans()}}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <p class="w-100 text-center">Sorry, no messages.</p>
                                @endif
                            </ul>
                            <div class="custom-pagination pull-right">{!! $threads->links() !!}</div>
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