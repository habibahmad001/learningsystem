@extends(getLayout())

@section('content')
<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="/"><i class="mdi mdi-home"></i></a> </li>
							<li><a href="{{url('/studentid/list')}}">{{ getPhrase('Student id card list')}}</a></li>
							<li class="active">{{isset($title) ? $title : ''}}</li>
						</ol>
					</div>
				</div>


				<div class="panel panel-custom col-lg-8 col-lg-offset-2">
					<div class="panel-heading">
						<div class="pull-right messages-buttons">
							{{--<a href="{{URL_PAGES}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>--}}
						</div>
						
					<h1>{{ $title }}  </h1>
					</div>
					<div class="panel-body" >

					 @include('studentidcard.form_elements',
					 array('record'=> $record))
					 		
					{!! Form::close() !!}
					</div>

				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
@stop

@section('footer_scripts')
@stop
 
 