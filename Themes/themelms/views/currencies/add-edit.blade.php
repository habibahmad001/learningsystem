@extends(getLayout())
<link href="{{CSS}}bootstrap-datepicker.css" rel="stylesheet">
@section('content')
<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="/"><i class="mdi mdi-home"></i></a> </li>
							<li><a href="{{URL_CURRENCIES}}">{{ getPhrase('edit_currencies')}}</a></li>
							<li class="active">{{isset($title) ? $title : ''}}</li>
						</ol>
					</div>
				</div>
					@include('errors.errors')
				<!-- /.row -->
				
				<div class="panel panel-custom col-lg-6 col-lg-offset-3">
					<div class="panel-heading">
						<div class="pull-right messages-buttons">
							<a href="{{URL_CURRENCIES}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>
						</div>
						
					<h1>{{ $title }}  </h1>
					</div>
					<div class="panel-body form-auth-style" >
					<?php $button_name = getPhrase('create');

					?>
					@if ($record)
					 <?php $button_name = getPhrase('update'); ?>
						{{ Form::model($record, 
						array('url' => URL_CURRENCIES_EDIT.$record->id,
						'method'=>'patch', 'name'=>'formQuiz', 'novalidate'=>'')) }}
					@else
						{!! Form::open(array('url' => URL_CURRENCIES_ADD, 'method' => 'POST', 'name'=>'formQuiz', 'novalidate'=>'')) !!}
					@endif
					

					 @include('currencies.form_elements',
					 array('button_name'=> $button_name),
					 array('record'=> $record,'countries'=> $countries))
					 		
					{!! Form::close() !!}
					</div>

				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
@stop

@section('footer_scripts')
@include('common.validations')

<script src="{{JS}}datepicker.min.js"></script>
<script src="{{JS}}bootstrap-toggle.min.js"></script>
<script>
    $('.input-daterange').datepicker({
        autoclose: true,
        startDate: "0d",
        format: '{{getDateFormat()}}',
    });
    </script>
@include('common.editor')
@include('common.alertify')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.bundle.min.js" ></script>


<script>

    jQuery( document ).ready(function() {
        jQuery('#target').iconpicker({
            iconset: 'fontawesome',
            icon: '{!! (isset($record->icon)) ? $record->icon : '' !!}',
        });

        $('#target').on('change', function(e) {
            console.log(e.icon);
            $('#currency_symbol').val(e.icon);
        });

    });

</script>
@stop
 
 