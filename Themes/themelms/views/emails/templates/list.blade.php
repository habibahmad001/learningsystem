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

							<a href="{{URL_EMAIL_TEMPLATES_ADD}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>

							 

						</div>

						<h1>{{ $title }}</h1>

					</div>

					<div class="panel-body packages">
						<div class="table-responsive">
							<table id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">
								<thead>
								<tr>
									{{--<th> All <input type="checkbox" class='checkall' id='checkall'><input class="btn btn-sm btn-primary"  type="button" data-id="{{ route('templates.massremove')}}" id='delete_record' value='Delete' ></th>--}}
									<th>{{ getPhrase('Key')}}</th>

									{{--<th>{{ getPhrase('slug')}}</th>--}}
									<th>{{ getPhrase('subject')}}</th>

									<th>{{ getPhrase('type')}}</th>

							 

									<th>{{ getPhrase('from_email')}}</th>

									<th>{{ getPhrase('from_name')}}</th>

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
//    array( "data" => "check_course", "name" => "check_course" ),
    array( "data" => "title", "name" => "title" ),
//    array( "data" => "slug", "name" => "slug" ),
    array( "data" => "subject", "name" => "subject"),
    array( "data" => "type", "name" => "type"),
    array( "data" => "from_email", "name" => "from_email"),
    array( "data" => "from_name", "name" => "from_name"),
    array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);
?>
@endsection
@section('footer_scripts')
 @include('common.datatables', array('colnames'=>$colnames,'route'=>'emailtemplates.dataTable'))
 @include('common.deletescript', array('route'=>'/email/templates/delete/'))
@stop

