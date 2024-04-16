<div class="row">
    @if($user_id)
        <input type="hidden" id="user_id" value="{{$user_id}}" name="user_id">
    @else
    <fieldset class="form-group col-md-12" >
        {{ Form::label('user_id', getphrase('User')) }}
        <span class="text-red">*</span>
        {{Form::select('user_id', $users, $user_id, ['placeholder' => getPhrase('select'),'class'=>'form-control',
        'ng-model'=>'user_id',
            'required'=> 'true',
            'ng-class'=>'{"has-error": formLms.user_id.$touched && formLms.user_id.$invalid}',

        ]) }}
        <div class="validation-error" ng-messages="formLms.user_id.$error" >
            {!! getValidationMessage()!!}
        </div>


    </fieldset>
    @endif

    <fieldset class="form-group col-md-12">

        {{ Form::label('title', getphrase('title')) }}
        <span class="text-red">*</span>
        {{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('title'),
            'ng-model'=>'title',
            'ng-pattern'=>getRegexPattern('name'),
            'required'=> 'true',
            'ng-class'=>'{"has-error": formQuiz.title.$touched && formQuiz.title.$invalid}',
            'ng-minlength' => '4',
            'ng-maxlength' => '45',
            )) }}
        <div class="validation-error" ng-messages="formQuiz.title.$error" >
            {!! getValidationMessage()!!}
            {!! getValidationMessage('pattern')!!}
            {!! getValidationMessage('minlength')!!}
            {!! getValidationMessage('maxlength')!!}
        </div>
    </fieldset>
</div>

<div class="row">
    <fieldset class="form-group col-md-12">

        {{ Form::label('subject', getphrase('subject')) }}
        <span class="text-red">*</span>
        {{ Form::text('subject', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('subject'),
            'ng-model'=>'subject',
            'required'=> 'true',
            'ng-class'=>'{"has-error": formQuiz.subject.$touched && formQuiz.subject.$invalid}',
            'ng-minlength' => '2',
            'ng-maxlength' => '40',
            )) }}
        <div class="validation-error" ng-messages="formQuiz.subject.$error" >
            {!! getValidationMessage()!!}
            {!! getValidationMessage('pattern')!!}
            {!! getValidationMessage('minlength')!!}
            {!! getValidationMessage('maxlength')!!}
        </div>
    </fieldset>
</div>

<div class="row">
    <fieldset class="form-group col-md-12">
        {{ Form::label('description', getphrase('description')) }}
        <span class="text-red">*</span>
        {{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'5', 'placeholder' => 'Fine description')) }}


    </fieldset>
</div>
<div class="buttons text-center">
    <button class="btn btn-lg btn-success button"
            ng-disabled='!formQuiz.$valid'>{{ $button_name }}</button>
</div>