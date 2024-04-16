@extends(getLayout())
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')


<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
							<li>{{ $title }}</li>
						</ol>
					</div>
				</div>
								
				<!-- /.row -->
				<div class="panel panel-custom">
					<div class="panel-heading">
						
						<div class="pull-right messages-buttons">
							 
							<a href="{{URL_LANGUAGES_ADD}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>
							 
						</div>
						<h1>{{ $title }}</h1>
					</div>
					<div class="panel-body packages">
						<div> 
						<table id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">
							<thead>
								<tr>
									 
									<th>{{ getPhrase('language')}}</th>
									<th>{{ getPhrase('code')}}</th>
									<th>{{ getPhrase('is_rtl')}}</th>
									<th>{{ getPhrase('default_language')}}</th>
							 		<th>{{ getPhrase('action')}}</th>
								  
								</tr>
							</thead>
							 
						</table>
						</div>

					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
<?php
$arr = array(
    array( "data" => "language", "name" => "language" ),
    array( "data" => "code", "name" => "code"),
    array( "data" => "is_rtl", "name" => "is_rtl" ),
    array( "data" => "is_default", "name" => "is_default" ),

    array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);
?>


@endsection
 

@section('footer_scripts')
  
 @include('common.datatables', array('colnames'=>$colnames,'route'=>'languages.dataTable'))
 @include('common.deletescript', array('route'=>URL_LANGUAGES_DELETE))

@stop
