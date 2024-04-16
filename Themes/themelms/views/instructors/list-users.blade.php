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

						<div class="pull-right messages-buttons">
 							<a href="{{URL_INSTRUCTORS_ADD}}" class="btn  btn-primary button" >{{ getPhrase('add_new_instructor')}}</a>

						</div>

						<h1>{{ $title }}</h1>
					</div>
					<div class="panel-body packages">
						<div class="table-responsive">
							<table id="table"  class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th> All <input type="checkbox" class='checkall' id='checkall'><input type="button" class="btn btn-sm btn-primary"  data-id="{{ route('instructors.massremove')}}" id='delete_record' value='Delete' ></th>
									<th>{{ getPhrase('name')}}</th>
									<th>{{ getPhrase('email')}}</th>
									<th>{{ getPhrase('image')}}</th>
{{--									<th>{{ getPhrase('role')}}</th>--}}
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
    array( "data" => "check_course", "name" => "check_course" ),
    array( "data" => "name", "name" => "name" ),
		array( "data" => "email", "name" => "email"),
		array( "data" => "image", "name" => "image"),
//		array( "data" => "role", "name" => "role" ),
		array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);
?>


@endsection

@section('footer_scripts')
	<script>
        $(document).ready(function() {
            $("#loginuser").click(function(){
                $("#authform").submit();
            });
        });

	</script>
 @include('common.datatables', array('colnames'=>$colnames,'route'=>'instructors.dataTable'))
 @include('common.deletescript', array('route'=>URL_INSTRUCTORS_DELETE))
@stop
