@extends(getLayout())
@section('content')

<div id="page-wrapper">
			<div class="container-fluid">
			<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							 
							<li><i class="fa fa-home"></i> {{ $title }}</li>
						</ol>
					</div>
				</div>

				 <div class="row">
				 	<div class="col-md-3 col-sm-6">
				 		<div class="media state-media box-ws">
				 			<div class="media-left">
				 				<a href="{{URL_USERS}}"><div class="state-icn bg-icon-info"><i class="fa fa-users"></i></div></a>
				 			</div>
				 			<div class="media-body">
				 				<h4 class="card-title">{{ App\User::get()->count()}}</h4>
								<a href="{{URL_USERS}}">{{ getPhrase('users')}}</a>
				 			</div>
				 		</div>
				 	</div>
					{{--<div class="col-md-3 col-sm-6">
				 		<div class="media state-media box-ws">
				 			<div class="media-left">
				 				<a href="{{URL_QUIZ_CATEGORIES}}"><div class="state-icn bg-icon-pink"><i class="fa fa-list-alt"></i></div></a>
				 			</div>
				 			<div class="media-body">
				 				<h4 class="card-title">{{ App\QuizCategory::get()->count()}}</h4>
								<a href="{{URL_QUIZ_CATEGORIES}}">{{ getPhrase('quiz_categories')}}</a>
				 			</div>
				 		</div>
				 	</div>--}}
					 <div class="col-md-3 col-sm-6">
						 <div class="media state-media box-ws">
							 <div class="media-left">
								 <a href="{{URL_LMS_SERIES}}"><div class="state-icn bg-icon-pink"><i class="fa fa-list-alt"></i></div></a>
							 </div>
							 <div class="media-body">
								 <h4 class="card-title">{{ App\LmsSeries::get()->count()}}</h4>
								 <a href="{{URL_LMS_SERIES}}">{{ getPhrase('courses')}}</a>
							 </div>
						 </div>
					 </div>
					 <div class="col-md-3 col-sm-6">
						 <div class="media state-media box-ws">
							 <div class="media-left">
								 <a href="{{URL::to(PREFIX . 'payments/list/')}}"><div class="state-icn bg-icon-purple"><i class="fa fa-dollar"></i></div></a>
							 </div>
							 <div class="media-body">
								 <h4 class="card-title">{{ \App\Payment::select(['item_name', 'plan_type', 'start_date', 'end_date', 'payment_gateway', 'updated_at','payment_status','id','cost', 'after_discount', 'paid_amount'])
		 ->count() }} </h4>
								 <a href="{{URL::to(PREFIX . 'payments/list/')}}">{{ getPhrase('orders')}}</a>
							 </div>
						 </div>
					 </div>
{{--					 <div class="col-md-3 col-sm-6">--}}
{{--						 <div class="media state-media box-ws">--}}
{{--							 <div class="media-left">--}}
{{--								 <a href="{{URL::to(PREFIX . 'messages/')}}"><div class="state-icn bg-icon-blue"><i class="fa fa-envelope"></i></div></a>--}}
{{--							 </div>--}}
{{--							 <div class="media-body">--}}
{{--								 <h4 class="card-title">{{ \Cmgmyr\Messenger\Models\Thread::forUser(Auth::user()->id)->count() }} </h4>--}}
{{--								 <a href="{{URL::to(PREFIX . 'messages/')}}">{{ getPhrase('messages')}}</a>--}}
{{--							 </div>--}}
{{--						 </div>--}}
{{--					 </div>--}}
				 	<div class="col-md-3 col-sm-6">
				 		<div class="media state-media box-ws">
				 			<div class="media-left">
				 				<a href="{{URL_QUIZZES}}"><div class="state-icn bg-icon-purple"><i class="fa fa-desktop"></i></div></a>
				 			</div>
				 			<div class="media-body">
				 				<h4 class="card-title">{{ App\Quiz::get()->count()}}</h4>
								<a href="{{URL_QUIZZES}}">{{ getPhrase('exam_quizzes')}}</a>
				 			</div>
				 		</div>
				 	</div>
				 <div class="col-md-3 col-sm-6">
				 		<div class="media state-media box-ws">
				 			<div class="media-left">
				 				<a href="{{URL_LMS_CATEGORIES}}"><div class="state-icn bg-icon-success"><i class="fa fa-book"></i></div></a>
				 			</div>
				 			<div class="media-body">
				 				<h4 class="card-title">{{ App\LmsCategory::get()->count()}}</h4>
								<a href="{{URL_LMS_CATEGORIES}}">{{ getPhrase('course_categories')}}</a>
				 			</div>
				 		</div>
				 	</div>
{{--					 <div class="col-md-3 col-sm-6">--}}
{{--						 <div class="media state-media box-ws">--}}
{{--							 <div class="media-left">--}}
{{--								 <a href="{{URL_COUPONS}}"><div class="state-icn bg-icon-success"><i class="fa fa-book"></i></div></a>--}}
{{--							 </div>--}}
{{--							 <div class="media-body">--}}
{{--								 <h4 class="card-title">{{ App\Couponcode::get()->count()}}</h4>--}}
{{--								 <a href="{{URL_COUPONS}}">{{ getPhrase('coupons')}}</a>--}}
{{--							 </div>--}}
{{--						 </div>--}}
{{--					 </div>--}}
					 <div class="col-md-3 col-sm-6">
						 <div class="media state-media box-ws">
							 <div class="media-left">
								 <a href="{{URL_BLOGS}}"><div class="state-icn bg-icon-success"><i class="fa fa-book"></i></div></a>
							 </div>
							 <div class="media-body">
								 <h4 class="card-title">{{ App\Post::get()->count()}}</h4>
								 <a href="{{URL_BLOGS}}">{{ getPhrase('Blogs')}}</a>
							 </div>
						 </div>
					 </div>

{{--				 	 <div class="col-md-3 col-sm-6">--}}
{{--				 		<div class="media state-media box-ws">--}}
{{--				 			<div class="media-left">--}}
{{--				 				<a href="{{URL_TOPICS}}"><div class="state-icn bg-icon-purple"><i class="fa fa-list"></i></div></a>--}}
{{--				 			</div>--}}
{{--				 			<div class="media-body">--}}
{{--				 				<h4 class="card-title">{{ App\Topic::get()->count() }}</h4>--}}
{{--								<a href="{{URL_TOPICS}}">{{ getPhrase('topics')}}</a>--}}
{{--				 			</div>--}}
{{--				 		</div>--}}
{{--				 	</div>--}}


				 	 <div class="col-md-3 col-sm-6">
				 		<div class="media state-media box-ws">
				 			<div class="media-left">
				 				<a href="{{URL_QUIZ_QUESTIONBANK}}"><div class="state-icn bg-icon-orange"><i class="fa fa-question-circle"></i></div></a>
				 			</div>
				 			<div class="media-body">
				 				<h4 class="card-title">{{ App\QuestionBank::get()->count() }}</h4>
								<a href="{{URL_QUIZ_QUESTIONBANK}}">{{ getPhrase('questions')}}</a>
				 			</div>
				 		</div>
				 	</div>

					 <div class="col-md-3 col-sm-6">
						 <div class="media state-media box-ws">
							 <div class="media-left">
								 <a href="{{URL_QUIZ_CATEGORIES}}"><div class="state-icn bg-icon-pink"><i class="fa fa-list-alt"></i></div></a>
							 </div>
							 <div class="media-body">
								 <h4 class="card-title">{{ App\QuizCategory::get()->count()}}</h4>
								 <a href="{{URL_QUIZ_CATEGORIES}}">{{ getPhrase('quiz_categories')}}</a>
							 </div>
						 </div>
					 </div>
				 	 {{--<div class="col-md-3 col-sm-6">
				 		<div class="media state-media box-ws">
				 			<div class="media-left">
				 				<a href="{{URL_SUBSCRIBED_USERS}}"><div class="state-icn bg-icon-blue"><i class="fa fa-users"></i></div></a>
				 			</div>
				 			<div class="media-body">
				 				<h4 class="card-title">{{  App\UserSubscription::get()->count() }}</h4>
								<a href="{{URL_SUBSCRIBED_USERS}}">{{ getPhrase('subscribed_users')}}</a>
				 			</div>
				 		</div>
				 	</div>
--}}
{{--				 	 <div class="col-md-3 col-sm-6">--}}
{{--						 <div class="media state-media box-ws">--}}
{{--				 			<div class="media-left">--}}
{{--				 				<a href="{{URL_ENQUIRIES_LIST.'all'}}"><div class="state-icn bg-icon-pink"><i class="fa fa-fw fa-th-large" ></i> </div></a>--}}
{{--				 			</div>--}}
{{--				 			<div class="media-body">--}}
{{--				 				<h4 class="card-title">{{ App\Enquiry::get()->count() }}</h4>--}}
{{--								<a href="{{URL_ENQUIRIES_LIST.'all'}}">{{ getPhrase('enquiries')}}</a>--}}
{{--				 			</div>--}}
{{--				 		</div>--}}
{{--				 	</div>--}}

				</div>
		 
			<!-- /.container-fluid -->
 <div class="row">

 	<div class="col-md-6">
  				  <div class="panel panel-primary dsPanel">
				    <div class="panel-heading"><i class="fa fa-pie-chart"></i> {{getPhrase('quizzes_usage')}}</div>
				    <div class="panel-body" >
				    	<canvas id="demanding_quizzes" width="100" height="60"></canvas>
				    </div>
				  </div>
				</div>
				
				
				<div class="col-md-6">
  				  <div class="panel panel-primary dsPanel">
				    <div class="panel-heading"><i class="fa fa-pie-chart"></i> {{getPhrase('paid_quizzes_usage')}}</div>
				    <div class="panel-body" >
				    	<canvas id="demanding_paid_quizzes" width="100" height="60"></canvas>
				    </div>
				  </div>
				</div>
			</div>
			<div class="row">

				<div class="col-md-6 col-lg-5">
  				  <div class="panel panel-primary dsPanel panel_height_min">
				    <div class="panel-heading"><i class="fa fa-bar-chart-o"></i> {{getPhrase('payment_statistics')}}</div>
				    <div class="panel-body" >
				    	<canvas id="payments_chart" width="100" height="60"></canvas>
				    </div>
				  </div>
				</div>
				<div class="col-md-6 col-lg-3">
  				  <div class="panel panel-primary dsPanel panel_height_min user__statistics">
				    <div class="panel-heading"><i class="fa fa-bar-chart-o"></i>{{@$chart_heading}}</div>
				    <div class="panel-body" >
						
						<?php $ids=[];?>
						@for($i=0; $i<count($chart_data); $i++)
						<?php 
						$newid = 'myChart'.$i;
						$ids[] = $newid; ?>

							<canvas id="{{$newid}}" width="100" height="110"></canvas>

						@endfor
				    </div>
				  </div>
				</div>
				<div class="col-md-6 col-lg-4">
  				  <div class="panel panel-primary dsPanel panel_height_min">
				    <div class="panel-heading"><i class="fa  fa-line-chart"></i> {{getPhrase('payment_monthly_statistics')}}</div>
				    <div class="panel-body" >
				    	<canvas id="payments_monthly_chart" width="100" height="60"></canvas>
				    </div>
				  </div>
				</div>

			</div>
	</div>
		<!-- /#page-wrapper -->

@stop

@section('footer_scripts')
 
 @include('common.chart', array($chart_data,'ids' =>$ids))
 @include('common.chart', array('chart_data'=>$payments_chart_data,'ids' =>array('payments_chart'), 'scale'=>TRUE))
 @include('common.chart', array('chart_data'=>$payments_monthly_data,'ids' =>array('payments_monthly_chart'), 'scale'=>true))
 @include('common.chart', array('chart_data'=>$demanding_quizzes,'ids' =>array('demanding_quizzes')))
 @include('common.chart', array('chart_data'=>$demanding_paid_quizzes,'ids' =>array('demanding_paid_quizzes')))


@stop
