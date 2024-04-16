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

							<a href="{{URL_QUIZ_ADD}}" class="btn  btn-primary button" >{{ getPhrase('create_new_quiz')}}</a>

						</div>

						{{--<div class="pull-right messages-buttons">--}}

							{{--<a href="{{URL_EXAM_SERIES}}" class="btn  btn-primary button" >{{ getPhrase('create_series')}}</a>--}}

						{{--</div>--}}

						<h1>{{ $title }}</h1>

					</div>
					<!-- /Quiz page Table-->
					<div class="panel-body packages">
						<div class="table-responsive">
							@include('errors.errors')
						<table id="table" class="table table-striped table-bordered datatable r_s_h" cellspacing="0" width="100%">

							<thead>

								<tr>

									<th> All <input type="checkbox" class='checkall' id='checkall'><input class="btn btn-sm btn-primary"  type="button" data-id="{{ route('quiz.massremove')}}" id='delete_record' value='Delete' ></th>
									<th>{{ getPhrase('title')}}</th>

									<th>{{ getPhrase('duration')}}</th>

									<th>{{ getPhrase('category')}}</th>

									<th>{{ getPhrase('is_paid')}}</th>

									<th>{{ getPhrase('total_marks')}}</th>

									<th>{{ getPhrase('exam_type')}}</th>

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
            array( "data" => "dueration", "name" => "dueration"),
            array( "data" => "category", "name" => "category_id"),
            array( "data" => "is_paid", "name" => "is_paid"),
            array( "data" => "total_marks", "name" => "total_marks"),
            array( "data" => "exam_type", "name" => "exam_type"),
            array( "data" => "action", "name" => "action" )
		);

		$colnames= json_encode($arr);
		?>
@endsection





@section('footer_scripts')



 @include('common.datatables', array('colnames'=>$colnames,'route'=>URL_QUIZ_GETLIST, 'route_as_url' => TRUE,'colnames'=>$colnames))

 @include('common.deletescript', array('route'=>URL_QUIZ_DELETE))



@stop
