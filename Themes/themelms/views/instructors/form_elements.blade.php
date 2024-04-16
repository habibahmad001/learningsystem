<div class="row">
<fieldset class="form-group col-md-6">


    {{ Form::label('first_name', getphrase('first_name')) }}

    <span class="text-red">*</span>

    {{ Form::text('fname', $value = (isset($records->fname)) ? $records->fname : "" , $attributes = array('class'=>'form-control', 'placeholder' => 'jack',

        'ng-model'=>'fname',

        'required'=> 'fname',

        'ng-minlength' => '3',

        'ng-maxlength' => '100',

        'ng-class'=>'{"has-error": formUsers.fname.$touched && formUsers.fname.$invalid}',



    )) }}

    <div class="validation-error" ng-messages="formUsers.fname.$error">

        {!! getValidationMessage()!!}

        {!! getValidationMessage('minlength')!!}

        {!! getValidationMessage('maxlength')!!}

        {!! getValidationMessage('pattern')!!}

    </div>

</fieldset>

<fieldset class="form-group  col-md-6">


    {{ Form::label('lname', getphrase('last_name')) }}

    <span class="text-red">*</span>

    {{ Form::text('lname', $value = (isset($records->lname)) ? $records->lname : "" , $attributes = array('class'=>'form-control', 'placeholder' => 'grealish',

        'ng-model'=>'lname',

        'required'=> 'true',

        'ng-minlength' => '3',

        'ng-maxlength' => '100',

        'ng-class'=>'{"has-error": formUsers.lname.$touched && formUsers.lname.$invalid}',



    )) }}

    <div class="validation-error" ng-messages="formUsers.lname.$error">

        {!! getValidationMessage()!!}

        {!! getValidationMessage('minlength')!!}

        {!! getValidationMessage('maxlength')!!}

        {!! getValidationMessage('pattern')!!}

    </div>

</fieldset>
</div>

<div class="row">

    <fieldset class="form-group  col-md-6">
        {{ Form::label('uname', getphrase('user_name')) }}
        <input type="text" name="uname" value="{!! (isset($records->uname)) ? $records->uname : "" !!}" class="form-control" placeholder="jack" id="uname" required>
    </fieldset>


    <fieldset class="form-group  col-md-6">

        <?php

        $readonly = '';

        if (!checkRole(getUserGrade(4)))
            $readonly = 'readonly="true"';

        if ($records) {

            $readonly = 'readonly="true"';

        }



        ?>

        {{ Form::label('email', getphrase('email')) }}

        <span class="text-red">*</span>

        {{ Form::email('email', $value = (isset($records->email)) ? $records->email : "", $attributes = array('class'=>'form-control', 'placeholder' => 'jack@jarvis.com',

            'ng-model'=>'email',

            'required'=> 'true',

            'ng-class'=>'{"has-error": formUsers.email.$touched && formUsers.email.$invalid}',

         $readonly)) }}

        <div class="validation-error" ng-messages="formUsers.email.$error">

            {!! getValidationMessage()!!}

            {!! getValidationMessage('email')!!}

        </div>

    </fieldset>
</div>

<div class="row">

    <fieldset class="form-group  col-md-6">
        {{ Form::label('designation', getphrase('designation')) }}
        <input type="text" name="designation" id="designation" value="{!! (isset($records->designation)) ? $records->designation : "" !!}" class="form-control" placeholder="Manager" required>
    </fieldset>

    <fieldset class="form-group  col-md-6">
        {{ Form::label('rating', getphrase('instructor_rating')) }}
        <input type="text" name="rating" id="rating" value="{!! (isset($records->rating)) ? $records->rating : "" !!}" class="form-control" placeholder="4.5" required>
    </fieldset>

</div>


<div class="row">

    <fieldset class="form-group  col-md-6">
        {{ Form::label('reviews', getphrase('number_of_reviews')) }}
        <input type="text" name="reviews" id="reviews" value="{!! (isset($records->reviews)) ? $records->reviews : "" !!}" class="form-control" placeholder="237,879" required>
    </fieldset>

    <fieldset class="form-group  col-md-6">
        {{ Form::label('students', getphrase('number_of_students')) }}
        <input type="text" name="students" id="students" value="{!! (isset($records->students)) ? $records->students : "" !!}" class="form-control" placeholder="1,296,815" required>
    </fieldset>

</div>


<div class="row">

    <fieldset class="form-group  col-md-6">
        {{ Form::label('ncourses', getphrase('number_of_courses')) }}
        <input type="text" name="ncourses" id="ncourses" value="{!! (isset($records->ncourses)) ? $records->ncourses : "" !!}" class="form-control" placeholder="50" required>
    </fieldset>

    <fieldset class="form-group  col-md-6">
        {{ Form::label('introduction', getphrase('instructor_introduction')) }}
        <input type="text" name="introduction" id="introduction" value="{!! (isset($records->introduction)) ? $records->introduction : "" !!}" class="form-control" placeholder="Instructor Introduction" required>
    </fieldset>

</div>

<div class="row">

    <fieldset class="form-group  col-md-6">
        <div class="field">
            <label for="image">Photo:<sup class="redstar"></sup></label>
            <input type="file" class="form-control" name="image"  id="image">
        </div>
    </fieldset>


    <fieldset class="form-group  col-md-6">

        <?php

        $readonly = '';

        if (!checkRole(getUserGrade(4)))
            $readonly = 'readonly="true"';

//        if ($records) {
//
//            $readonly = 'readonly="true"';
//
//        }



        ?>

        {{ Form::label('mobile', getphrase('phone')) }}



        {{ Form::text('mobile', $value = (isset($records->mobile)) ? $records->mobile : "", $attributes = array('class'=>'form-control', 'placeholder' => '123-456-7890',

            'ng-model'=>'mobile',


            'ng-class'=>'{"has-error": formUsers.mobile.$touched && formUsers.mobile.$invalid}',

         $readonly)) }}

        <div class="validation-error" ng-messages="formUsers.mobile.$error">

            {!! getValidationMessage()!!}

            {!! getValidationMessage('mobile')!!}

        </div>

    </fieldset>

</div>




<div class="row">

    <fieldset class="form-group  col-md-6">

        <?php

        $readonly = '';

        if (!checkRole(getUserGrade(4)))
            $readonly = 'readonly="true"';

//        if ($records) {
//
//            $readonly = 'readonly="true"';
//
//        }



        ?>

        {{ Form::label('subject', getphrase('subject')) }}

        <span class="text-red">*</span>

        {{ Form::text('subject', $value = (isset($records->subject)) ? $records->subject : "", $attributes = array('class'=>'form-control', 'placeholder' => 'Accounting',

            'ng-model'=>'subject',
    'required'=> 'true',

            'ng-class'=>'{"has-error": formUsers.subject.$touched && formUsers.subject.$invalid}',

         $readonly)) }}

        <div class="validation-error" ng-messages="formUsers.subject.$error">

            {!! getValidationMessage()!!}

            {!! getValidationMessage('subject')!!}

        </div>

    </fieldset>

    <fieldset class="form-group  col-md-6">

        <?php

        $readonly = '';

        if (!checkRole(getUserGrade(4)))
            $readonly = 'readonly="true"';

        if ($records) {

            $readonly = 'readonly="true"';

        }



        ?>

        {{ Form::label('detail', getphrase('detail')) }}

        <span class="text-red">*</span>

        {{ Form::text('detail', $value = (isset($records->detail)) ? $records->detail : "", $attributes = array('class'=>'form-control', 'placeholder' => 'Accounting ',

            'ng-model'=>'detail',
    'required'=> 'true',

            'ng-class'=>'{"has-error": formUsers.detail.$touched && formUsers.detail.$invalid}',

         $readonly)) }}

        <div class="validation-error" ng-messages="formUsers.subject.$error">

            {!! getValidationMessage()!!}

            {!! getValidationMessage('detail')!!}

        </div>

    </fieldset>
</div>



<div class="row">

    <fieldset class="form-group  col-md-6">

        <div class="field">
            <label for="file">Upload Resume:<span>*</span></label>
            <input type="file" class="form-control" name="file" id="file" value="" required>
        </div>
    </fieldset>

    <fieldset class="form-group  col-md-6">
        {{ Form::label('baddress', getphrase('billing_address')) }}
        <input type="text" name="baddress" id="baddress" value="{!! (isset($records->baddress)) ? $records->baddress : "" !!}" class="form-control" placeholder="Billing Address" required>
    </fieldset>
    <input type="hidden" name="uid" id="uid" value="{!! $uid !!}">
    <input type="hidden" name="iid" id="iid" value="{!! $iid !!}">

</div>



<div class="buttons text-center">

    <button class="btn btn-lg btn-success button"

            ng-disabled='!formUsers.$valid'>{{ $button_name }}</button>

</div>