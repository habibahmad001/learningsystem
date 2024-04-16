@extends($layout)
@section('content')<div id="page-wrapper">
<div class="container-fluid">
<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<ol class="breadcrumb">
<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
@if(checkRole(getUserGrade(2)))
<li><a href="{{URL_INSTRUCTORS}}">{{ getPhrase('users')}}</a> </li>
<li class="active">{{isset($title) ? $title : ''}}</li>
@else
<li class="active">{{$title}}</li>
@endif
</ol>
</div>
</div>
@include('errors.errors')
<!-- /.row -->

<div class="panel panel-custom col-lg-6  col-lg-offset-3">
<div class="panel-heading">

<h1>{{ $title }}  </h1>
</div>

<div class="panel-body form-auth-style">

<?php $button_name = getPhrase('update'); ?>

{!! Form::open(array('url' => URL_INSTRUCTORS_SETTINGS, 'method' => 'POST', 'novalidate'=>'','name'=>'formUsers ', 'files'=>'true')) !!}

<div class="row">
<input type="hidden" id="setting_id" name="setting_id" value="{{$record->id}}">
    <fieldset class="form-group si setting-checkbox col-md-6 ">
        <label  >Enable Paypal
            <input type="checkbox"    data-onstyle="success" value="{{$record->paypal_enable}}"   name="paypal_enable" class="toggle btn btn-success" {{$record->paypal_enable==1?'checked':''}}  data-toggle="toggle">
                </label>

    </fieldset>
        <fieldset class="form-group si setting-checkbox col-md-6 ">
            <label  >Enable Bank Transfer
                <input type="checkbox"  data-onstyle="success" value="{{$record->bank_enable}}"    name="bank_enable" class="toggle btn btn-success"  {{$record->bank_enable==1?'checked':''}} data-toggle="toggle">
            </label>

        </fieldset>




    <fieldset class="form-group col-md-12">
        <label for="instructor_application_note">Instructor application note</label>
        <div class="form-group">
            <textarea class="form-control" name="instructor_application_note" rows="8" cols="80">{{$record->instructor_application_note}}</textarea>
        </div>
    </fieldset>
    <style>
        .input-group {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -webkit-box-align: stretch;
            -ms-flex-align: stretch;
            align-items: stretch;
            width: 100%;
        }
        .input-group-append {
            margin-left: -1px;
        }
        .input-group-append, .input-group-prepend {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }
        .input-group>.custom-file, .input-group>.custom-select, .input-group>.form-control, .input-group>.form-control-plaintext {
            position: relative;
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            width: 1%;
            margin-bottom: 0;
        }
        .input-group>.custom-select:not(:last-child), .input-group>.form-control:not(:last-child) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .input-group>.input-group-append>.btn, .input-group>.input-group-append>.input-group-text, .input-group>.input-group-prepend:first-child>.btn:not(:first-child), .input-group>.input-group-prepend:first-child>.input-group-text:not(:first-child), .input-group>.input-group-prepend:not(:first-child)>.btn, .input-group>.input-group-prepend:not(:first-child)>.input-group-text {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .input-group-text {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            padding: .45rem .9rem;
            margin-bottom: 0;
            font-size: .875rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef;
            border: 1px solid #dee2e6;
            border-radius: .25rem;
        }
    </style>
    <fieldset class="form-group  col-md-6">
        <label for="instructor_revenue">Instructor revenue percentage</label>
<div class="input-group ">
            <input type="number" name="instructor_revenue" id="instructor_revenue" class="form-control" onkeyup="calculateAdminRevenue(this.value)" min="0" max="100" value="{{$record->instructor_revenue}}">
            <div class="input-group-append">
                <span class="input-group-text"><i class="mdi mdi-percent"></i></span>
            </div>
</div>
    </fieldset>
    <fieldset class="form-group col-md-6">
        <label for="admin_revenue">Admin revenue percentage</label>
        <div class="input-group">
              <input type="number" name="admin_revenue" id="admin_revenue" class="form-control" value="30" disabled="" style="background: none; cursor: default;">
            <div class="input-group-append">
                <span class="input-group-text"><i class="mdi mdi-percent"></i></span>
            </div>
        </div>
    </fieldset>
</div>
    <div class="row">
    <div class="buttons text-center">

        <button class="btn btn-lg btn-success button"

                ng-disabled='!formUsers.$valid'>{{ $button_name }}</button>

    </div>
    </div>
{!! Form::close() !!}
</div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection

@section('footer_scripts')
@include('common.validations')
@include('common.alertify')
 <script>
 	var file = document.getElementById('image_input');

file.onchange = function(e){
    var ext = this.value.match(/\.([^\.]+)$/)[1];
    switch(ext)
    {
        case 'jpg':
        case 'jpeg':
        case 'png':

     
            break;
        default:
               alertify.error("{{getPhrase('file_type_not_allowed')}}");
            this.value='';
    }
};
 </script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    // jQuery(function() {
    //     $('#toggle_one').bootstrapToggle();
    // })

    jQuery(document).ready(function() {
            var instructor_revenue = $('#instructor_revenue').val();
            calculateAdminRevenue(instructor_revenue);
        });
    function calculateAdminRevenue(instructor_revenue) {
        if(instructor_revenue <= 100){
            var admin_revenue = 100 - instructor_revenue;
            $('#admin_revenue').val(admin_revenue);
        }else {
            $('#admin_revenue').val(0);
        }
    }
</script>
</script>
@stop