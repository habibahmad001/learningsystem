@extends(getLayout())
@section('header_scripts')

@stop
@section('content')


<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
							<li><a href="{{URL_SETTINGS_LIST}}">{{ getPhrase('settings')}}</a>  </li>
							<li>{{ $title }}</li>
						</ol>
					</div>
				</div>
								
				<!-- /.row -->
				<div class="panel panel-custom col-lg-8 col-lg-offset-2">
					<div class="panel-heading">
						
					<div class="pull-right messages-buttons">
							@if($slug == "recaptcha-settings")
							
							<img src="{{IMAGES}}rechaptcha.png" height="25px"><a href="https://www.google.com/recaptcha/admin#list" target="_blank" class="btn  btn-primary button" >
								 Manage your reCAPTCHA API keys</a>
						@endif		 
							 
						</div>
						<h1>{{ $title }}

						</h1>

					</div>
					<div class="panel-body packages">
					<div class="row hide">
						@if($record->image)
						<img src="{{IMAGE_PATH_SETTINGS.$record->image}}"  height="100">
						@endif
					</div>
					{!! Form::open(array('url' => URL_SETTINGS_ADD_SUBSETTINGS.$record->slug, 'method' => 'PATCH', 
						'novalidate'=>'','name'=>'formSettings ', 'files'=>'true')) !!}
						<div class="row"> 
						<ul class="list-group">
						@if(count($settings_data))

						@foreach($settings_data as $key=>$value)
						<?php 
							$type_name = 'text';

							if($value->type == 'number' || $value->type == 'email' || $value->type=='password')
								$type_name = 'text';
							else
								$type_name = $value->type;
						?>
						 {{-- {{dd($value)}} --}}
						@include(
									'mastersettings.settings.sub-list-views.'.$type_name.'-type', 
									array('key'=>$key, 'value'=>$value)
								)
						  @endforeach

						  @else
							  <li class="list-group-item">{{ getPhrase('no_settings_available')}}</li>
						  @endif
						</ul>

						</div>

						@if(count($settings_data))
						<div class="buttons text-center clearfix">
							<button class="btn btn-lg btn-success button" ng-disabled='!formTopics.$valid'
							>{{ getPhrase('update') }}</button>
						</div>
						@endif
							{!! Form::close() !!}
					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
@endsection
 

@section('footer_scripts')
	@include('common.editor');
 
  <script src="{{JS}}bootstrap-toggle.min.js"></script>

@stop
