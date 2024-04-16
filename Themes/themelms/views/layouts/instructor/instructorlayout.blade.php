<!DOCTYPE html>

<html lang="en" dir="{{ (App\Language::isDefaultLanuageRtl()) ? 'rtl' : 'ltr' }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="{{getSetting('meta_description', 'seo_settings')}}">
	<meta name="keywords" content="{{getSetting('meta_keywords', 'seo_settings')}}">
	<meta name="csrf_token" content="{{ csrf_token() }}">
	 
	<link rel="icon" href="{{IMAGE_PATH_SETTINGS.getSetting('site_favicon', 'site_settings')}}" type="image/x-icon" />
	<title>@yield('title') {{ isset($title) ? $title : getSetting('site_title','site_settings') }}</title>
	<!-- Bootstrap Core CSS -->
	 @yield('header_scripts')

	   <link href="{{themes('css/bootstrap.min.css')}}" rel="stylesheet">
	   {{--<link href="{{themes('css/sweetalert.css')}}" rel="stylesheet">--}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.min.css" integrity="sha512-A374yR9LJTApGsMhH1Mn4e9yh0ngysmlMwt/uKPpudcFwLNDgN3E9S/ZeHcWTbyhb5bVHCtvqWey9DLXB4MmZg==" crossorigin="anonymous" />

	<link href="{{themes('css/metisMenu.min.css')}}" rel="stylesheet">
	   <link href="{{themes('css/custom-fonts.css')}}" rel="stylesheet">
	   <link href="{{themes('css/materialdesignicons.css')}}" rel="stylesheet">
	   {{--<link href="{{themes('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">--}}
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/v4-shims.css">

	<link href="{{themes('css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
	
	<!-- Morris Charts CSS -->
	{{-- <link href="{{CSS}}plugins/morris.css" rel="stylesheet"> --}}
	   <link href="{{themes('css/plugins/morris.css')}}" rel="stylesheet">
	 <link href="{{themes('css/sb-admin.css')}}" rel="stylesheet">
	 {{-- <link href="{{themes('css/themeone-blue.css')}}" rel="stylesheet"> --}}

    <?php
    $theme_color  = getThemeColor();
    // dd($theme_color);
    ?>
    @if($theme_color == 'blueheader')      
	 <link href="{{themes('css/theme-colors/header-blue.css')}}" rel="stylesheet">
    @elseif($theme_color == 'bluenavbar')	 
	 <link href="{{themes('css/theme-colors/blue-sidebar.css')}}" rel="stylesheet">
    @elseif($theme_color == 'darkheader')	 
	 <link href="{{themes('css/theme-colors/dark-header.css')}}" rel="stylesheet">
    @elseif($theme_color == 'darktheme')	 
	 <link href="{{themes('css/theme-colors/dark-theme.css')}}" rel="stylesheet">
    @elseif($theme_color == 'whitecolor')	 
	 <link href="{{themes('css/theme-colors/white-theme.css')}}" rel="stylesheet">]
	@endif

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
	<style>
		.toast-top-right {
			top: 65px !important;
			right: 12px;
		}
		.error {
			color: red;
		}

	</style>
</head>

<body ng-app="academia">
 @yield('custom_div')
 <?php 
 $class = '';
 if(!isset($right_bar))
 	$class = 'no-right-sidebar';

 ?>
	<div id="wrapper" class="{{$class}}">
		<!-- Navigation -->
		<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="{{ url('/') }}" target="_blank"><img src="{{IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')}}" alt="{{getSetting('site_title','site_settings')}}"></a>
			</div>

			<!-- Top Menu Items -->
			<?php $newUsers = (new App\User())->getLatestUsers(); ?>
			<ul class="nav navbar-right top-nav">
				<li><span> <a href="{{url('/dashboard?view=student')}}"   class="btn button btn-warning  d-none">Switch to Student View</a> </span></li>
				<li><span> <a href="{{url('/')}}" target="_blank" class="btn button btn-success">Visit Website</a> </span></li>
				<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class="icon-topbar-event"></i> {{ getPhrase('latest_users') }}  </a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-notif" aria-labelledby="dd-notification">
					<div class="dropdown-menu-notif-list" id="latestUsers">
					@foreach($newUsers as $user)
							<div class="dropdown-menu-notif-item">
								<div class="photo">
									<img src="{{ getProfilePath($user->image)}}" alt="">
								</div>
								 <a href="{{URL_USER_DETAILS.$user->slug}}">{{ucfirst($user->name)}}</a>  {{ getPhrase('was_joined_as').' '. getRoleData($user->role_id)}}
								<div class="color-blue-grey-lighter">{{$user->updated_at->diffForHumans()}}</div>
							</div>
					@endforeach
						</div>

						<div class="dropdown-menu-notif-more">
							<a href="{{URL_USERS}}">{{ getPhrase('see_more') }}</a>
						</div>
					</div>
				</li>
				
				 
				<li class="dropdown profile-menu">
					<div class="dropdown-toggle top-profile-menu" data-toggle="dropdown">
						@if(Auth::check())
						<div class="username">
							<h2>{{Auth::user()->name}}</h2>
							 
						</div>
						@endif
						
						<div class="profile-img"> <img src="{{ getProfilePath(Auth::user()->image, 'thumb') }}" alt=""> </div>
						<div class="mdi mdi-menu-down"></div>
					</div>
					<ul class="dropdown-menu">
						<li>
							<a href="{{URL_USERS_EDIT}}{{Auth::user()->slug}}">
								<sapn>{{ getPhrase('my_profile') }}</sapn>
							</a>
						</li>
					{{--	<li>
							<a href="{{URL_THEMES_LIST}}">
								<sapn>{{ getPhrase('themes') }}</sapn>
								</a>
						</li>
						<li>
							<a href="{{URL_LANGUAGES_LIST}}">
								<sapn>{{ getPhrase('languages') }}</sapn>
								</a>
						</li>--}}
						<li>
							<a href="{{URL_USERS_CHANGE_PASSWORD}}{{Auth::user()->slug}}">
								<sapn>{{ getPhrase('change_password') }}</sapn>
								</a>
						</li>
					 
						<li>
							<a href="{{URL_USERS_LOGOUT}}">
								<sapn>{{ getPhrase('logout') }}</sapn>
							</a>
						</li>
					</ul>
				</li>
			</ul>
			<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
			<!-- /.navbar-collapse -->
		</nav>
		 @if(env('DEMO_MODE')) 
		<div class="alert alert-info demo-alert">
		&nbsp;&nbsp;&nbsp;<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			<strong>{{getPhrase('info')}}!</strong> CRUD {{getPhrase('operations_are_disabled_in_demo_version')}}
		</div>
		@endif
		<!--Instructor Menu layout-->
		<aside class="left-sidebar">
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav side-nav">
					<li {{ isActive($active_class, 'dashboard') }}>
						<a href="{{URL_DASHBOARD}}">
							<i class="fa fa-fw fa-window-maximize"></i> {{ getPhrase('dashboard') }} 
						</a> 
					</li>
					<li {{ isActive($active_class, 'my-courses') }} >
						<a href="{{URL_STUDENT_LMS_SERIES}}" data-toggle="collapse" data-target="#my-courses"><i class="fa fa-book-reader"></i>{{ getPhrase('My Courses') }} </a>
					</li>
					@if(getSetting('messaging', 'module'))

						<li {{ isActive($active_class, 'messages') }} >

							<a href="{{URL_MESSAGES}}"> <i class="fa fa-fw fa-comments" aria-hidden="true"> </i>
								{{ getPhrase('messages')}}
								<small class="msg">{{$count = Auth::user()->newThreadsCount()}} </small>
							</a>

						<!--   <a  href="{{URL_MESSAGES}}"><span><i class="fa fa-comments-o fa-2x" aria-hidden="true"><h5 class="badge badge-success">{{$count = Auth::user()->newThreadsCount()}}</h5></i></span>
					{{ getPhrase('messages')}} </a> -->


						</li>

					@endif

					<li {{ isActive($active_class, 'exams') }} >
						<a href="javascript:void(0)" data-toggle="collapse" data-target="#exams"><i class="fas fa-book-reader"></i>{{ getPhrase('exams') }} <i class="fa fa-fw fa-angle-down"></i></a>
						<ul id="exams" class="collapse">
							<li><a href="{{URL_QUIZ_CATEGORIES}}"> <i class="fa fa-fw fa-fw fa-bars"></i>{{ getPhrase('categories') }}</a></li>
							<li><a href="{{URL_QUIZ_QUESTIONBANK}}"> <i class="fa fa-fw fa-fw fa-question"></i>{{ getPhrase('question_bank') }}</a></li>
							<li><a href="{{URL_QUIZZES}}"> <i class="icon-total-time"></i> {{ getPhrase('quizzes')}}</a></li>
							<li><a href="{{URL_EXAM_SERIES}}"> <i class="fa fa-fw fa-list-ol"></i> {{ getPhrase('exam_series')}}</a></li>
							<li><a href="{{URL_INSTRUCTIONS}}"> <i class="fa fa-fw fa-hand-o-right"></i> {{ getPhrase('instructions')}}</a></li>
							{{--<li><a href="{{URL_MASTERSETTINGS_SUBJECTS}}"> <i class="icon-books"></i> {{ getPhrase('subjects_master')}}</a></li>--}}
							<li><a href="{{URL_MASTERSETTINGS_TOPICS}}"> <i class="fa fa-fw fa-database"></i> {{ getPhrase('subject_topics')}}</a></li>
						</ul>
					</li>
					<li {{ isActive($active_class, 'lms') }} >
						<a href="javascript:void(0)" data-toggle="collapse" data-target="#lms"><i class="fas fa-school"></i>Manage Courses <i class="fa fa-fw fa-angle-down"></i></a>
						<ul id="lms" class="collapse">
							<li><a href="{{ URL_LMS_SERIES }}"> <i class="fa fa-book" aria-hidden="true"></i>{{ getPhrase('courses') }}</a></li>
							<li><a href="{{ URL_LMS_CONTENT }}"> <i class="icon-books"></i>{{ getPhrase('contents / Units') }}</a></li>
							<li><a href="{{ URL_LMS_ASSIGNMENTS }}"> <i class="icon-books"></i>{{ getPhrase('Assignments') }}</a></li>
						</ul>
					</li>
					<li {{ isActive($active_class, 'userenroll') }} >
						<a href="{{url('/users_enrolled')}}" ><i class="fas fa-user-tag"></i>{{ getPhrase('users enrolled') }} </a>
					</li>
					<li {{ isActive($active_class, 'wishlists') }} >
						<a href="{{url('/my-courses/wishlists')}}" ><i class="fa fa-heart"></i>{{ getPhrase('my wishlist') }} </a>
					</li>
					<li {{ isActive($active_class, 'announcement') }} >
						<a href="{{url('/instructor/announcement')}}" ><i class="fas fa-bullhorn"></i> {{ getPhrase('announcements') }} </a>
					</li>
					<li {{ isActive($active_class, 'blog') }} >
						<a href="javascript:void(0)" data-toggle="collapse" data-target="#coupons"><i class="fa fa-newspaper-o"></i>{{ getPhrase('Blogs') }} <i class="fa fa-fw fa-angle-down"></i></a>
						<ul id="coupons" class="collapse">
							<li><a href="{{URL_POSTS}}"> <i class="fa fa-newspaper-o"></i>{{ getPhrase('All Posts') }}</a></li>
							<li><a href="{{URL_POSTS_ADD}}"> <i class="fa fa-fw fa-plus"></i>{{ getPhrase('add new post') }}</a></li>
							<li><a href="{{URL_POST_CATEGORIES}}"> <i class="fa fa-fw fa-plus"></i>{{ getPhrase('categories') }}</a></li>
							{{--<li><a href="{{URL_COUPONS_ADD}}"> <i class="fa fa-fw fa-plus"></i>{{ getPhrase('add new post') }}</a></li>--}}
						</ul>
					</li>
					<li {{ isActive($active_class, 'discussions') }} >
						<a href="javascript:void(0)" data-toggle="collapse" data-target="#discussions"><i class="fas fa-question-circle"></i>{{ getPhrase('Discussions') }} <i class="fa fa-fw fa-angle-down"></i></a>
						<ul id="discussions" class="collapse">
							<li><a href="{{url('/instructorquestion')}}"> <i class="fa fa-fw fa-fw fa-bars"></i>{{ getPhrase('Questions') }}</a></li>
							<li><a href="{{url('/instructoranswer')}}"> <i class="fa fa-fw fa-fw fa-question"></i>{{ getPhrase('Answers') }}</a></li>
						</ul>
					</li>
					<li {{ isActive($active_class, 'revenue') }} >
						<a href="javascript:void(0)" data-toggle="collapse" data-target="#revenueMenu"><i class="fas fa-money-check"></i>{{ getPhrase('My Revenue') }} <i class="fa fa-fw fa-angle-down"></i></a>
						<ul id="revenueMenu" class="collapse">
							<li><a href="{{url('/pending/payout')}}"> <i class="fa fa-fw fa-fw fa-bars"></i>{{ getPhrase('Pending Payout') }}</a></li>
							<li><a href="{{url('/admin/completed/payout')}}"> <i class="fa fa-fw fa-fw fa-question"></i>{{ getPhrase('Completed Payout') }}</a></li>
						</ul>
					</li>
					<li {{ isActive($active_class, 'payoutsettings') }} >
						<a href="{{url('/instructor/details')}}" ><i class="fas fa-cash-register"></i>{{ getPhrase('Payout Settings') }} </a>
					</li>
				</ul>
			</div>
		</aside>
		@if(isset($right_bar))
			
		<aside class="right-sidebar" id="rightSidebar">
			<button class="sidebat-toggle" id="sidebarToggle" href='javascript:'><i class="mdi mdi-menu"></i></button>
			<div class="panel panel-right-sidebar">
				<?php $data = '';
			if(isset($right_bar_data))
				$data = $right_bar_data;
			?>
				@include($right_bar_path, array('data' => $data))
			</div>
		</aside>
	 
	@endif
		@include('admin.message')
		@yield('content')
	</div>
	<!-- /#wrapper -->
	<!-- jQuery -->

	{{-- <script>
            var csrfToken = $('[name="csrf_token"]').attr('content');

            setInterval(refreshToken, 600000); // 1 hour 

            function refreshToken(){
                $.get('refresh-csrf').done(function(data){
                    csrfToken = data; // the new token
                });
            }

            setInterval(refreshToken, 600000); // 1 hour 

        </script> --}}

	<!-- Bootstrap Core JavaScript -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	{{--<script src="{{themes('js/jquery-1.12.1.min.js')}}"></script>--}}
	<script src="{{themes('js/bootstrap.min.js')}}"></script>
	<script src="{{themes('js/main.js')}}"></script>
	<script src="{{themes('js/metisMenu.min.js')}}"></script>
	{{--<script src="{{themes('js/sweetalert-dev.js')}}"></script>--}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.min.js" integrity="sha512-tiZ8585M9G8gIdInZMGGXgEyFdu8JJnQbIcZYHaQxq+MP4+T8bkvA+TfF9BjPmiePjhBhev3bQ6nloOB1zF9EA==" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
 @toastr_render

	<script >
		 /*Sidebar Menu*/
    $("#ag-menu").metisMenu();



	</script>


	 @yield('footer_scripts')

	@include('errors.formMessages')
	
	 
 	
 	@yield('custom_div_end')
	{!!getSetting('google_analytics', 'seo_settings')!!}
	<div class="ajax-loader" style="display:none;" id="ajax_loader"><img src="{{AJAXLOADER}}"> {{getPhrase('please_wait')}}...</div>
</body>

</html>