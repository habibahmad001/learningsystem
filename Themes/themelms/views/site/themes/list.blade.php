@extends(getLayout())
@section('header_scripts')
{{-- <link href="{{CSS}}ajax-datatables.css" rel="stylesheet"> --}}
 <link href="{{themes('css/ajax-datatables.css')}}" rel="stylesheet">
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
						
						
						<h1>{{ $title }}</h1>
					</div>
					<div class="panel-body packages">
						<div> 
						<table id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">
							<thead>
								<tr>
									 
									<th>{{ getPhrase('theme_name')}}</th>
									<th>{{ getPhrase('description')}}</th>
									<th>{{ getPhrase('make_as_default_theme')}}</th>
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
    array( "data" => "title", "name" => "title" ),
    array( "data" => "description", "name" => "description"),
    array( "data" => "is_active", "name" => "is_active" ),

    array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);
?>


@endsection
 

@section('footer_scripts')
  
 @include('common.datatables', array('colnames'=>$colnames,'route'=>URL_THEMES_GET_DATA, 'route_as_url'=>TRUE))

@stop
