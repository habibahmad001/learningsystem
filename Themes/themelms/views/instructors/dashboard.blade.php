@extends(getLayout())
@section('content')

<div id="page-wrapper">
			<div class="container-fluid">
			<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							 
							<li><i class="fa fa-home"></i> {{ $title}}</li>
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
				 				<h4 class="card-title">{{ App\UserCourses::get()->where('record_updated_by','=',$user->id)->count()}}</h4>
								<a href="{{URL_USERS}}">{{ getPhrase('users enrolled')}}</a>
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
								 <h4 class="card-title">{{ App\LmsSeries::get()->where('record_updated_by','=',$user->id)->count()}}</h4>
								 <a href="{{URL_LMS_SERIES}}">{{ getPhrase('courses')}}</a>
							 </div>
						 </div>
					 </div>
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
				 				<a href="{{URL_SUBJECTS}}"><div class="state-icn bg-icon-success"><i class="fa fa-book"></i></div></a>
				 			</div>
				 			<div class="media-body">
				 				<h4 class="card-title">{{ App\Subject::get()->count()}}</h4>
								<a href="{{URL_SUBJECTS}}">{{ getPhrase('subjects_category')}}</a>
				 			</div>
				 		</div>
				 	</div>


				 	 <div class="col-md-3 col-sm-6">
				 		<div class="media state-media box-ws">
				 			<div class="media-left">
				 				<a href="{{URL_TOPICS}}"><div class="state-icn bg-icon-purple"><i class="fa fa-list"></i></div></a>
				 			</div>
				 			<div class="media-body">
				 				<h4 class="card-title">{{ App\Topic::get()->count() }}</h4>
								<a href="{{URL_TOPICS}}">{{ getPhrase('topics')}}</a>
				 			</div>
				 		</div>
				 	</div>


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
				 	</div>--}}

				 		{{-- <div class="col-md-3 col-sm-6">
				 		<div class="media state-media box-ws">
				 			<div class="media-left">
				 				<a href="{{URL_THEMES_LIST}}"><div class="state-icn bg-icon-pink"><i class="fa fa-fw fa-th-large" ></i> </div></a>
				 			</div>
				 			<div class="media-body">
				 				<h4 class="card-title">{{ App\SiteTheme::get()->count() }}</h4>
								<a href="{{URL_THEMES_LIST}}">{{ getPhrase('themes')}}</a>
				 			</div>
				 		</div>
				 	</div>--}}

				</div>

</div>
		<!-- /#page-wrapper -->
</div>

@stop
@section('footer_scripts')
 
{{-- @include('common.chart', array($chart_data,'ids' =>$ids))
 @include('common.chart', array('chart_data'=>$payments_chart_data,'ids' =>array('payments_chart'), 'scale'=>TRUE))
 @include('common.chart', array('chart_data'=>$payments_monthly_data,'ids' =>array('payments_monthly_chart'), 'scale'=>true))
 @include('common.chart', array('chart_data'=>$demanding_quizzes,'ids' =>array('demanding_quizzes')))
 @include('common.chart', array('chart_data'=>$demanding_paid_quizzes,'ids' =>array('demanding_paid_quizzes')))
 --}}

@stop
