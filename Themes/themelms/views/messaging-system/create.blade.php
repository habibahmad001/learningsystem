@extends($layout)
<link rel="stylesheet" type="text/css" href="{{CSS}}select2.css">
<style>
    .select2-container{width:100% !important;margin-bottom:10px;}
    .error {
        border: 2px solid red !important;
    }
</style>
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
                            <li><a href="{{URL_MESSAGES}}">{{getPhrase('messages')}}</a> </li>

                            <li class="active"> {{ $title }} </li>
                        </ol>
                    </div>
                </div>
        <!-- <h1>Create a new message</h1> -->
        <div class="panel panel-custom">
            <div class="panel-heading">
                    <div class="pull-right messages-buttons">
                            <a class="btn btn-lg btn-info button" href="{{URL_MESSAGES}}"> {{getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'}} </a>
                            <a class="btn btn-lg btn-info button" href="{{URL_MESSAGES_CREATE}}"> 
                            {{getPhrase('compose')}}</a>

                 
                        </div>
                        <h1>{{$title}}</h1>
                    </div>

            <div class="panel-body packages">
                <div class="row library-items">
                    {!! Form::open(array('url' => url('/messages/store'), 'method' => 'POST',  'files' => true, 'enctype' => 'multipart/form-data', 'name'=>'formLms ', 'onSubmit' => 'javascript: return validation();')) !!}

                    {{--{!! Form::open(['route' => 'messages.store', 'onSubmit' => 'javascript: return validation();']) !!}--}}
                    <div class="col-md-6 col-md-offset-3">
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
{!! Form::close() !!}
  </div>
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