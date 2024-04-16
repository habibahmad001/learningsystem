<div class="row">
    {!! (isset($_REQUEST["message"])) ? '<div class="alert alert-danger" role="alert"><b>' . $_REQUEST["message"] . '</b></div>' : "" !!}
</div>
<div class="row">
    <fieldset class="form-group col-md-6">


        {{ Form::label('first_name', getphrase('first_name')) }}

        <span class="text-red">*</span>

        {{ Form::text('first_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Jack',

            'ng-model'=>'first_name',

            'required'=> 'first_name',

            'ng-minlength' => '3',

            'ng-maxlength' => '100',

            'ng-class'=>'{"has-error": formUsers.first_name.$touched && formUsers.first_name.$invalid}',



        )) }}

        <div class="validation-error" ng-messages="formUsers.first_name.$error">

            {!! getValidationMessage()!!}

            {!! getValidationMessage('minlength')!!}

            {!! getValidationMessage('maxlength')!!}

            {!! getValidationMessage('pattern')!!}

        </div>

    </fieldset>

    <fieldset class="form-group col-md-6">


        {{ Form::label('last_name', getphrase('last_name')) }}

        <span class="text-red">*</span>

        {{ Form::text('last_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Jack',

            'ng-model'=>'last_name',

            'required'=> 'true',

            'ng-minlength' => '3',

            'ng-maxlength' => '100',

            'ng-class'=>'{"has-error": formUsers.last_name.$touched && formUsers.last_name.$invalid}',



        )) }}

        <div class="validation-error" ng-messages="formUsers.last_name.$error">

            {!! getValidationMessage()!!}

            {!! getValidationMessage('minlength')!!}

            {!! getValidationMessage('maxlength')!!}

            {!! getValidationMessage('pattern')!!}

        </div>

    </fieldset>
</div>
<div class="row">
    <?php

    $readonly = '';

    $username_value = null;

    if ($record) {

        $readonly = 'readonly="true"';

        // $username_value = $record->username;
    }



    ?>

    <fieldset class="form-group col-md-12">


        {{ Form::label('username', getphrase('username')) }}

        <span class="text-red">*</span>

        {{ Form::text('username', $value = $username_value , $attributes = array('class'=>'form-control', 'placeholder' => 'Jack',

            'ng-model'=>'username',

            'required'=> 'true',

             $readonly,



            'ng-minlength' => '2',

            'ng-maxlength' => '200',

            'ng-class'=>'{"has-error": formUsers.username.$touched && formUsers.username.$invalid}',



        )) }}

        <div class="validation-error" ng-messages="formUsers.username.$error">

            {!! getValidationMessage()!!}

            {!! getValidationMessage('minlength')!!}

            {!! getValidationMessage('maxlength')!!}

            {!! getValidationMessage('pattern')!!}

        </div>

    </fieldset>

</div>

<fieldset class="form-group">

    <?php

    $readonly = '';

    if (!checkRole(getUserGrade(4)))
        $readonly = 'readonly="true"';

    if ($record) {

        $readonly = 'readonly="true"';

    }



    ?>

    {{ Form::label('email', getphrase('email')) }}

    <span class="text-red">*</span>

    {{ Form::email('email', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'jack@jarvis.com',

        'ng-model'=>'email',

        'required'=> 'true',

        'ng-class'=>'{"has-error": formUsers.email.$touched && formUsers.email.$invalid}',

     $readonly)) }}

    <div class="validation-error" ng-messages="formUsers.email.$error">

        {!! getValidationMessage()!!}

        {!! getValidationMessage('email')!!}

    </div>

</fieldset>


@if($record)
    <fieldset class="form-group">
        {{ Form::label('password', getphrase('password')) }}

        {{--<span class="text-red">*</span>--}}

        {{ Form::password('password', $attributes = array('class'=>'form-control instruction-call',

                'placeholder' => getPhrase("password"),

                'ng-model'=>'password',


                'ng-class'=>'{"has-error": formUsers.password.$touched && formUsers.password.$invalid}'

            )) }}

        <div class="validation-error" ng-messages="formUsers.password.$error">

            {!! getValidationMessage()!!}

            {!! getValidationMessage('password')!!}

        </div>


    </fieldset>

    <fieldset class="form-group">
        {{ Form::label('confirm_password', getphrase('confirm_password')) }}

        {{--<span class="text-red">*</span>--}}

        {{ Form::password('password_confirmation', $attributes = array('class'=>'form-control instruction-call',

                'placeholder' => getPhrase("confirm_password"),

                'ng-model'=>'password_confirmation',


                'ng-class'=>'{"has-error": formUsers.password_confirmation.$touched && formUsers.password.$invalid}'



            )) }}

        <div class="validation-error" ng-messages="formUsers.password_confirmation.$error">

            {!! getValidationMessage()!!}

            {!! getValidationMessage('password')!!}

        </div>


    </fieldset>

@endif





@if(!checkRole(['parent']))

    <fieldset class="form-group">


        {{ Form::label('role', getphrase('role')) }}

        <span class="text-red">*</span>

        <?php $disabled = (checkRole(getUserGrade(2))) ? '' : 'disabled';



        $selected = getRoleData('student');

        if ($record)
            $selected = $record->role_id;

        ?>

        {{Form::select('role_id', $roles, $selected, ['placeholder' => getPhrase('select_role'),'class'=>'form-control', $disabled,

            'ng-model'=>'role_id',

            'required'=> 'true',

            'ng-class'=>'{"has-error": formUsers.role_id.$touched && formUsers.role_id.$invalid}'

         ])}}

        <div class="validation-error" ng-messages="formUsers.role_id.$error">

            {!! getValidationMessage()!!}


        </div>


    </fieldset>

@endif



<fieldset class="form-group">


    {{ Form::label('phone', getphrase('phone')) }}

    {{--<span class="text-red">*</span>--}}

    {{ Form::text('phone', $value = null , $attributes = array('class'=>'form-control', 'placeholder' =>
    getPhrase('please_enter_10-15_digit_mobile_number'),

        'ng-model'=>'phone',


        'ng-class'=>'{"has-error": formUsers.phone.$touched && formUsers.phone.$invalid}',


    )) }}


</fieldset>

<div class="row">

    <fieldset class="form-group col-sm-6 col-md-12">


        {{ Form::label('address', getphrase('billing_address')) }}



        {{ Form::textarea('address', $value = null , $attributes = array('class'=>'form-control','rows'=>3, 'cols'=>'15', 'placeholder' => getPhrase('please_enter_your_address'),

            'ng-model'=>'address',

            )) }}

    </fieldset>

</div>
<div class="row">
    <fieldset class='col-sm-6 col-md-12'>

        {{ Form::label('image', getphrase('image')) }}

        <div class="form-group row">

            <div class="col-md-6">


                {!! Form::file('image', array('id'=>'image_input', 'accept'=>'.png,.jpg,.jpeg')) !!}

            </div>

            <?php if(isset($record) && $record) {

            if($record->image != '') {

            ?>

            {{-- <div class="col-md-6">

                 <img src="{{ getProfilePath($record->image) }}"/>


             </div>--}}

            <?php } } ?>
            @if($record)

                @if($record->image)

                    <?php //$examSettings = getExamSettings(); ?>

                    <img src="{{ IMAGE_PATH_PROFILE.$record->image }}" height="100"   >



                @endif

            @endif

        </div>

    </fieldset>

</div>


<div class="buttons text-center">

    <button class="btn btn-lg btn-success button"

            ng-disabled='!formUsers.$valid'>{{ $button_name }}</button>

</div>