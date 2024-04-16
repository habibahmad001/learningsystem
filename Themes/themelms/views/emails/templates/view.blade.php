@extends(getLayout())
 

@section('content')
<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->


				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
							<li><a href="{{URL_EMAIL_TEMPLATES}}">{{ getPhrase('email_templates') }}</a> </li>
							<li class="active">{{isset($title) ? $title : ''}}</li>
						</ol>
					</div>
				</div>
				@include('errors.errors')	
			 <div class="panel panel-custom col-lg-6 col-lg-offset-3">				<div class="panel-heading">						<div class="pull-right messages-buttons">
							<a href="{{URL_EMAIL_TEMPLATES}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>
							<a href="{{URL_EMAIL_TEMPLATES_EDIT.'/'.$record->slug}}" class="btn  btn-success button" >{{ getPhrase('Edit')}}</a>
						</div>
					<h1>{{ $title }}  </h1>
					</div>
					<div class="panel-body  form-auth-style" >
						{!! $record->content !!}

					</div>

				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
@stop
@section('footer_scripts')

	@include('common.validations')
	@include('common.editor')
@stop
 