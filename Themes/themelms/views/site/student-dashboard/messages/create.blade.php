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
                        <div class="panel-heading">
                            <div class="right-buttons">
                                <a class="btn button" href="{{URL_MESSAGES}}"> {{getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'}} </a>
                                <a class="btn button" href="{{URL_MESSAGES_CREATE}}">{{getPhrase('compose')}}</a>
                            </div>
                            <h3>{{$title}}</h3>
                        </div>
                        <div class="panel-body">
                            {!! Form::open(['route' => 'messages.store', 'onSubmit' => 'javascript: return validation();']) !!}
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                <?php $tosentUsers = array(); ?>
                                @if($users->count() > 0)
                                    <?php foreach($users as $user) {
                                        $tosentUsers[$user->id] = $user->name;
                                    }
                                    ?>
                                    {!! Form::label('Select User', 'Select User', ['class' => 'control-label']) !!}
                                    {{Form::select('recipients[]', $tosentUsers, null, ['class'=>'form-control select2', 'name'=>'recipients[]', 'id'=>'recipients', 'multiple'=>'true'])}}
                                @endif
                                <!-- Subject Form Input -->
                                <div class="form-group">
                                    {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
                                    {!! Form::text('subject', null, ['class' => 'form-control', 'id' => 'subject']) !!}
                                </div>

                                <!-- Message Form Input -->
                                <div class="form-group">
                                    {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
                                    {!! Form::textarea('message', null, ['class' => 'form-control', 'id' => 'message']) !!}
                                </div>

                                <!-- Submit Form Input -->
                                <div class="text-right">
                                    {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-lg']) !!}
                                </div>
                            </div>
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
    
    <script src="{{JS}}select2.js"></script>
    
    <script>
      $('.select2').select2({
       placeholder: "Add User",
    });

      function validation() {
          $(".error").each(function(){
              $(this).removeClass('error');
          });

          var errors = [];

          var recipients            = $("#recipients").val();
          var subject               = $("#subject").val();
          var message               = $("#message").val();



          if(recipients == '') {
              errors.push("#recipients");
          }

          if(subject == '') {
              errors.push("#subject");
          }

          if(message == '') {
              errors.push("#message");
          }

          if(errors.length>0){
              for(i=0; i < errors.length; i++){
                  $(errors[i]).addClass('error');
              }
              return false;
          }

          return true;
      }
    </script>
@stop