@extends('layouts.sitelayout')
<link rel="stylesheet" type="text/css" href="{{CSS}}select2.css">
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
                        <div class="panel-heading"><h3>{{$title}} </h3></div>
                    <div id="historybox" class="panel-body inbox-messages-replay">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>{{ ucfirst($thread->subject) }}</h1>
                                <?php $current_user = Auth::user()->id; ?>
                                @foreach($thread->messages as $message)
                                <?php $class='message-sender';
                                if($message->user_id == $current_user)
                                {
                                    $class = 'message-receiver';
                                }


                                ?>
                                    <div class="{{$class}}">
                                        <div class="media">
                                            <a class="pull-left" href="#"><img src="{{getProfilePath($message->user->image)}}" alt="{!! $message->user->name !!}" class="img-circle"></a>
                                            <div class="media-body">
                                                <h5 class="media-heading">{!! $message->user->name !!}</h5>
                                                <p>{!! $message->body !!}</p>
                                                <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!}</small></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                        <div class="reply-block">
                        {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
                            <div class="row">
                                <div class="col-lg-9 col-md-8">
                                    {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-lg-3 col-md-4">{!! Form::submit('Reply', ['class' => 'btn btn-primary btn-lg btn-width']) !!}</div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div class="extra-space-30"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer_scripts')
<script>
 $('#historybox').scrollTop($('#historybox')[0].scrollHeight);
</script>
@stop