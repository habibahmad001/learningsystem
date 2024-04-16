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
							 
							<a href="{{URL_TOPICS_IMPORT}}" class="btn  btn-primary button" >{{ getPhrase('import')}}</a>
							<a href="{{URL_TOPICS_ADD}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>
							 
						</div>
						<h1>{{ $title }}</h1>
					</div>
					<!-- /Subject Topic page Table-->
					<div class="panel-body packages">
						<div class="table-responsive">
						<table id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>{{ getPhrase('subject')}}</th>
									<th>{{ getPhrase('parent')}}</th>
									<th>{{ getPhrase('topic (id)')}}</th>
									<th>{{ getPhrase('description')}}</th>
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
    array( "data" => "subject_title", "name" => "subject_title" ),
    array( "data" => "parent_id", "name" => "parent_id"),
    array( "data" => "topic_name", "name" => "topic_name"),
    array( "data" => "description", "name" => "description"),

    array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);
?>
@endsection
 

@section('footer_scripts')
  
 @include('common.datatables', array('colnames'=>$colnames,'route'=>'topics.dataTable'))
 @include('common.deletescript', array('route'=>URL_TOPICS_DELETE))

@stop
