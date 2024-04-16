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
							<li><a href="{{url('/')}}"><i class="mdi mdi-home"></i></a> </li>
							<li>{{ $title }}</li>
						</ol>
					</div>
				</div>
								
				<!-- /.row -->
				<div class="panel panel-custom">
					<div class="panel-heading">
						
						<div class="pull-right messages-buttons">
							<a href="{{URL_LMS_CONTENT_ADD}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>
						</div>
						<h1>{{ $title }}</h1>
					</div>
					<!-- /LMS content/Unit page Table-->
					<div class="panel-body packages">
						<div class="table-responsive">
						<table id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th> All <input type="checkbox" class='checkall' id='checkall'><input class="btn btn-sm btn-primary"  type="button" data-id="{{ route('content.massremove')}}" id='delete_record' value='Delete' ></th>
									<th>{{ getPhrase('title')}}</th>
									<th>{{ getPhrase('image')}}</th>
									<th>{{ getPhrase('type')}}</th>
									<th>{{ getPhrase('subject')}}</th>
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
    array( "data" => "title", "name" => "title" ),
    array( "data" => "image", "name" => "image"),
    array( "data" => "content_type", "name" => "content_type" ),
    array( "data" => "subject_title", "name" => "subject_id" ),
    array( "data" => "action", "name" => "action" )
);

$colnames= json_encode($arr);
?>
@endsection
 

@section('footer_scripts')
  
 @include('common.datatables', array('colnames'=>$colnames,'route'=>'lmscontent.dataTable'))
 @include('common.deletescript', array('route'=>URL_LMS_CONTENT_DELETE))
<script>
    $(document).ready(function() {
        $('#table_length select option[value="-1"]').css("display","none");
        //$('#table_length select option[value="-1"]').attr("disabled", true);

		
        // $.extend(true, $.fn.dataTable.defaults, {
        //     "lengthMenu": [[5, 10, 15, 20, 25], [5, 10, 15, 20, 25]],
        //     "pageLength": 5
		//
        // });
       // tableObj.settings().context[0]._iDisplayLength = 10;
       //  tableObj.settings().lengthMenu= [[25, 50,100, 250,500], [25, 50, 100, 250, 500]];
       //  tableObj.draw();
    });

</script>
@stop
