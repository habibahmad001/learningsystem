@extends($layout)

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

						

					 

						<h1>{{ $title }}</h1>

					</div>

					<div class="panel-body packages">

						<div > 

						<table id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">

							<thead>

								<tr>

									<th>{{ getPhrase('question_type')}}</th>

									<th>{{ getPhrase('question')}}</th>

									<th>{{ getPhrase('marks')}}</th>

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
    array( "data" => "question_type", "name" => "question_type" ),
    array( "data" => "question", "name" => "question" ),
    array( "data" => "marks", "name" => "marks"),
    array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);
?>
@endsection

 



@section('footer_scripts')

  

 @include('common.datatables', array('colnames'=>$colnames,'route'=>URL_BOOKMARK_AJAXLIST.$user->slug, 'route_as_url'=>TRUE))

 @include('common.deletescript', array('route'=>URL_BOOKMARK_DELETE_BY_ID))



@stop

