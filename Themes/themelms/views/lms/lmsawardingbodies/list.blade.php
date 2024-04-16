@extends(getLayout())
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
	<style>
		.my_class{
			background-color: #cbcbcb;
		}
	</style>
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

							<a href="{{URL_LMS_AWARDINGBODIES_ADD}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>

						</div>
						<h1>{{ $title }}</h1>
					</div>
					<div class="panel-body packages">
						<div>
						<table id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">
							<thead>
								<tr>

									<th>{{ getPhrase('name')}}</th>
									<th>{{ getPhrase('image')}}</th>
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
    array( "data" => "name", "name" => "name" ),
		array( "data" => "image", "name" => "image"),
		array( "data" => "description", "name" => "description" ),
		array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);
?>
@endsection


@section('footer_scripts')

 @include('common.datatables', array('colnames'=>$colnames,'route'=>'awardingbodies.dataTable'))
 @include('common.deletescript', array('route'=>URL_LMS_AWARDINGBODIES_DELETE))

@stop
