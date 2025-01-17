@extends($layout)

@section('content')
<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
						 
							<li class="active">{{getPhrase('feedback_form')}}</li>
						</ol>
					</div>
				</div>
					@include('errors.errors')
				<!-- /.row -->
				
<div class="panel panel-custom col-lg-6 col-lg-offset-3" >
	<div class="panel-heading">
		<div class="pull-right messages-buttons">
			@if($user_id==null)
				<a href="{{URL_FEEDBACKS}}" class="btn  btn-primary button" >{{  getPhrase('list') }}</a>
			@endif
		</div>
		<h1>{{ $title }}  </h1>
	</div>

					<div class="panel-body" >
					<?php $button_name = getPhrase('send'); ?>
						<div class="panel-body" >
                            <?php $button_name = getPhrase('create'); ?>
							@if ($record)
                                <?php $button_name = getPhrase('update'); ?>
								{{ Form::model($record,
                                array('url' => URL_FEEDBACK_EDIT.$record->slug,
                                'method'=>'patch', 'name'=>'formQuiz', 'novalidate'=>'')) }}
							@else
								{!! Form::open(array('url' => URL_FEEDBACK_SEND, 'method' => 'POST', 'name'=>'formQuiz', 'novalidate'=>'')) !!}
							@endif


							@include('feedbacks.form_elements',
                            array('button_name'=> $button_name),
                            array('record'=> $record, 'user_id'=>$user_id, 'users'=>$users))

							{!! Form::close() !!}
						</div>





					{{--{!! Form::open(array('url' => URL_FEEDBACK_SEND, 'method' => 'POST', 'name'=>'formQuiz ', 'novalidate'=>'')) !!}--}}

					{{--{!! Form::close() !!}--}}
					</div>

				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
@stop

@section('footer_scripts')
 @include('common.validations');
 
    
@stop
 
 