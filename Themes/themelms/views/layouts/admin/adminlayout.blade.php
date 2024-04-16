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
	@include('student.lms.scripts.exam-style')

	<link href="{{themes('css/bootstrap.min.css')}}" rel="stylesheet">

	<link href="{{themes('site/css/custom.min.css')}}" rel="stylesheet">
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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css" rel="stylesheet" />

	<style>
		.toast-top-right {
			top: 65px !important;
			right: 12px;
		}
		.error {
			color: red;
		}
		.dz-preview .dz-image img{
			width: 100% !important;
			height: 100% !important;
			object-fit: cover;
		}


	</style>
</head>

<body ng-app="academia">
@if(CheckPermission(Auth::user()->role_id, collect(request()->segments())->first()))
	<script language="JavaScript">window.location.href='{!! URL::to('/404') !!}';</script>
@endif
@yield('custom_div')
<?php
$class = '';
if(!isset($right_bar))
    $class = 'no-right-sidebar';

?>
<div id="wrapper" class="{{$class}}">

	<!-- Navigation-->
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			<a class="navbar-brand" href="{{ url('/') }}" target="_blank"><img src="{{IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')}}" alt="{{getSetting('site_title','site_settings')}}"></a>
		</div>

		<!-- Top Menu Items -->
        <?php $newUsers = (new App\User())->getLatestUsers(); ?>
		<ul class="nav navbar-right top-nav">
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
					{{--<li>
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

	<aside class="left-sidebar">
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav side-nav">
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'dashboard'))
				<li {{ isActive($active_class, 'dashboard') }}>
					<a href="{{URL_DASHBOARD}}"><i class="fa fa-fw fa-window-maximize"></i> {{ getPhrase('dashboard') }}</a>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'users'))
				<li {{ isActive($active_class, 'users') }}>
					<a href="{{URL_USERS}}"><i class="fa fa-fw fa-user-circle"></i> {{ getPhrase('users') }}</a>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'roles'))
				<li {{ isActive($active_class, 'roles') }}>
					<a href="javascript:void(0)" data-toggle="collapse" data-target="#roles"><i class="fa fa-tasks"></i> {{ getPhrase('roles') }} <i class="fa fa-fw fa-angle-down"></i></a>
					<ul id="roles" class="collapse">
						<li><a href="{{URL_ROLES}}"><i class="fa fa-fw fa-fw fa-bars"></i>{{ getPhrase('view all role') }}</a></li>
						<li><a href="{{URL_ROLES_ADD}}"><i class="fas fa-plus-square"></i>{{ getPhrase('add new role') }}</a></li>
					</ul>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'instructors'))
				<li {{ isActive($active_class, 'instructors') }}>
					<a href="javascript:void(0)" data-toggle="collapse" data-target="#instructors"><i class="fas fa-chalkboard-teacher"></i> {{ getPhrase('instructors') }} <i class="fa fa-fw fa-angle-down"></i></a>
					<ul id="instructors" class="collapse">
						<li><a href="{{URL_INSTRUCTORS}}"><i class="fa fa-fw fa-fw fa-bars"></i>{{ getPhrase('view all') }}</a></li>
						<li><a href="{{URL_INSTRUCTORS_ADD}}"><i class="fas fa-plus-square"></i>{{ getPhrase('Add new instructor') }}</a></li>
						<li><a href="{{URL_INSTRUCTORS_SETTINGS}}"><i class="fas fa-users-cog"></i> {{ getPhrase('settings')}}</a></li>
						<li><a href="{{URL_INSTRUCTORS_APPLICATIONS}}"><i class="fas fa-clipboard-list"></i> {{ getPhrase('applications')}}</a></li>
						<li><a href="{{URL_INSTRUCTORS_PAYOUTS}}"> <i class="far fa-credit-card"></i> {{ getPhrase('instructor payouts')}}</a></li>
					</ul>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'my-courses'))
				<li {{ isActive($active_class, 'my-courses') }} >
					<a href="{{URL_STUDENT_LMS_SERIES}}" data-toggle="collapse" data-target="#exams"><i class="fas fa-book-reader"></i>{{ getPhrase('My Courses') }} </a>
					{{--<ul id="exams" class="collapse sidemenu-dropdown">
                        <li><a href="{{URL_STUDENT_LMS_SERIES}}"> <i class="fa fa-random"></i>{{ getPhrase('My Courses') }}</a></li>
                        <li><a href="{{URL_STUDENT_EXAM_SERIES_LIST}}"> <i class="fa fa-list-ol"></i>{{ getPhrase('exam_series') }}</a></li>
                    </ul>--}}
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'exams'))
				<li {{ isActive($active_class, 'exams') }} >
					<a href="javascript:void(0)" data-toggle="collapse" data-target="#exams"><i class="fas fa-book-reader"></i>{{ getPhrase('exams') }} <i class="fa fa-fw fa-angle-down"></i></a>
					<ul id="exams" class="collapse">
						<li><a href="{{URL_QUIZ_CATEGORIES}}"> <i class="fa fa-fw fa-fw fa-bars"></i>{{ getPhrase('categories') }}</a></li>
						<li><a href="{{URL_QUIZ_QUESTIONBANK}}"> <i class="fa fa-fw fa-fw fa-question"></i>{{ getPhrase('question_bank') }}</a></li>
						<li><a href="{{URL_QUIZZES}}"> <i class="icon-total-time"></i> {{ getPhrase('quizzes')}}</a></li>
						<li><a href="{{URL_EXAM_TYPES}}"> <i class="fa fa-fw fa-list"></i> {{ getPhrase('exam_types')}}</a></li>
						<li><a href="{{URL_EXAM_SERIES}}"> <i class="fa fa-fw fa-list-ol"></i> {{ getPhrase('exam_series')}}</a></li>
						<li><a href="{{URL_INSTRUCTIONS}}"> <i class="fa fa-fw fa-hand-o-right"></i> {{ getPhrase('instructions')}}</a></li>
						<li><a href="{{URL_MASTERSETTINGS_SUBJECTS}}"> <i class="icon-books"></i> {{ getPhrase('subjects_master')}}</a></li>
						<li><a href="{{URL_MASTERSETTINGS_TOPICS}}"> <i class="fa fa-fw fa-database"></i> {{ getPhrase('subject_topics')}}</a></li>
					</ul>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'lms'))
				<li {{ isActive($active_class, 'lms') }} >
					<a href="javascript:void(0)" data-toggle="collapse" data-target="#lms"><i class="fas fa-school"></i>{!! getPhrase('lms') !!} <i class="fa fa-fw fa-angle-down"></i></a>
					<ul id="lms" class="collapse">
						<li><a href="{{ URL_LMS_SERIES }}"> <i class="fa fa-book" aria-hidden="true"></i>{{ getPhrase('courses') }}</a></li>
						<li><a href="{{ URL_LMS_CATEGORIES }}"> <i class="fa fa-fw fa-random"></i>{{ getPhrase('categories') }}</a></li>
						<li><a href="{{ URL_LMS_CONTENT }}"> <i class="icon-books"></i>{{ getPhrase('contents / Units') }}</a></li>
						<li><a href="{{ URL_LMS_LEVELS }}"> <i class="fa fa-level-up"></i>{{ getPhrase('levels') }}</a></li>
						<li><a href="{{ URL_LMS_AWARDINGBODIES }}"> <i class="fa fa-certificate"></i>{{ getPhrase('awarding bodies') }}</a></li>
					</ul>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'certificates'))
				<li {{ isActive($active_class, 'certificates') }} >
					<a href="{{URL_STUDENT_CERTIFICATES}}"><i class="fa fa-stamp" aria-hidden="true"></i>{{ getPhrase(' certificates') }} </a>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'coupons'))
				<li {{ isActive($active_class, 'coupons') }} >
					<a href="javascript:void(0)" data-toggle="collapse" data-target="#coupons"><i class="fa fa-gift" aria-hidden="true"></i>{{ getPhrase('coupons') }} <i class="fa fa-fw fa-angle-down"></i></a>
					<ul id="coupons" class="collapse">
						<li><a href="{{URL_COUPONS}}"> <i class="fa fa-fw fa-list"></i>{{ getPhrase('list') }}</a></li>
						<li><a href="{{URL_COUPONS_ADD}}"> <i class="fa fa-fw fa-plus"></i>{{ getPhrase('add') }}</a></li>
					</ul>
				</li>
				@endif
				{{--@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'classroom'))--}}
					{{--<li {{ isActive($active_class, 'classroom') }} >--}}
						{{--<a href="javascript:void(0);" data-toggle="collapse" data-target="#blogNav"><i class="fas fa-blog"></i>{{ getPhrase('my_classroom') }} <i class="fa fa-fw fa-angle-down"></i></a>--}}
						{{--<ul id="blogNav" class="collapse">--}}
							{{--<li><a href="javascript:void(0);"> <i class="fas fa-blog"></i>{{ getPhrase('live') }}</a></li>--}}
							{{--<li><a href="{{ URL_LMS_SERIES }}"> <i class="fa fa-fw fa-plus"></i>{{ getPhrase('classroom') }}</a></li>--}}
						{{--</ul>--}}
					{{--</li>--}}
				{{--@endif--}}
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'blogs'))
				<li {{ isActive($active_class, 'blog') }} >
					<a href="javascript:void(0)" data-toggle="collapse" data-target="#blogNav"><i class="fas fa-blog"></i>{{ getPhrase('blogs') }} <i class="fa fa-fw fa-angle-down"></i></a>
					<ul id="blogNav" class="collapse">
						<li><a href="{{URL_POSTS}}"> <i class="fas fa-blog"></i>{{ getPhrase('All Posts') }}</a></li>
						<li><a href="{{URL_POSTS_ADD}}"> <i class="fa fa-fw fa-plus"></i>{{ getPhrase('add new post') }}</a></li>
						<li><a href="{{URL_POST_CATEGORIES}}"> <i class="fa fa-list-alt" aria-hidden="true"></i>{{ getPhrase('categories') }}</a></li>
						{{--<li><a href="{{URL_COUPONS_ADD}}"> <i class="fa fa-fw fa-plus"></i>{{ getPhrase('add new post') }}</a></li>--}}
					</ul>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'tags'))
				<li {{ isActive($active_class, 'tag') }} >
					<a href="javascript:void(0)" data-toggle="collapse" data-target="#tagNav"><i class="fa fa-fw fa-tags"></i>{{ getPhrase('tags') }} <i class="fa fa-fw fa-angle-down"></i></a>
					<ul id="tagNav" class="collapse">
						<li><a href="{{URL_TAGS}}"><i class="fa fa-fw fa-tags"></i>{{ getPhrase('All Tags') }}</a></li>
						<li><a href="{{URL_TAGS_ADD}}"> <i class="fa fa-fw fa-plus"></i>{{ getPhrase('add new tag') }}</a></li>
						<li><a href="{{URL_TAG_CATEGORIES}}"> <i class="fa fa-list-alt" aria-hidden="true"></i>{{ getPhrase('tag categories') }}</a></li>
						{{--<li><a href="{{URL_COUPONS_ADD}}"> <i class="fa fa-fw fa-plus"></i>{{ getPhrase('add new post') }}</a></li>--}}
					</ul>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'pages'))
				<li {{ isActive($active_class, 'pages') }} >
					<a href="{{URL_PAGES}}" ><i class="fa fa-book" ></i> {{ getPhrase('pages') }} </a>
				</li>
				@endif
					<li {{ isActive($active_class, 'announcement') }} >
						<a href="{{url('/instructor/announcement')}}" ><i class="fas fa-bullhorn"></i> {{ getPhrase('announcements') }} </a>
					</li>
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'orders'))
				<li {{ isActive($active_class, 'orders') }}>
					<a href="javascript:void(0)" data-toggle="collapse" data-target="#ods"><i class="fa fa-fw fa-ticket"></i>{{ getPhrase('orders') }} <i class="fa fa-fw fa-angle-down"></i></a>
					<ul id="ods" class="collapse sidemenu-dropdown">
						<li><a href="{{URL_PAYMENTS_ADMIN_LIST}}" data-toggle="collapse" data-target="#ods"><i class="fa fa-fw fa-ticket"></i>{{ getPhrase('all_orders') }}</a></li>
						{{--<li><a href="{{URL_PAYMENTS_ADMIN_LIST.'/isadmin'.'/courses'}}" data-toggle="collapse" data-target="#ods"><i class="fa fa-fw fa-ticket"></i>{{ getPhrase('course_orders') }}</a></li>--}}
						<li><a href="{{URL_STUDENTID}}"> <i class="fa fa-user-graduate"></i>{{ getPhrase('student_card_orders') }}</a></li>
						<li><a href="{{URL_CERTIFICATES}}"> <i class="fa fa-id-card"></i>{{ getPhrase('certificates_orders') }}</a></li>
						<li><a href="{{URL_REED_CERTIFICATES}}"> <i class="fa fa-id-card"></i>{{ getPhrase('reed_certificates_orders') }}</a></li>
						<li><a href="{!! PREFIX.'reports/list' !!}"> <i class="fa fa-linode"></i>{{ getPhrase('reports') }}</a></li>
					</ul>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'enquires'))
				<li {{ isActive($active_class, 'enquires') }}>
					<a href="{{URL_ENQUIRIES_LIST}}all"><i class="fa fa-building"></i>{{ getPhrase('enquires') }}</a>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'corporate_emails'))
				<li {{ isActive($active_class, 'corporate_emails') }}>
					<a href="{{URL_CORPORATE}}">
						<i class="fa fa-fw fa-chain-broken"></i>{{ getPhrase('corporate_emails') }}
					</a>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'marketing'))
				<li {{ isActive($active_class, 'marketingbanner') }} >
					<a href="javascript:void(0)" data-toggle="collapse" data-target="#merktNav"><i class="fa fa-bullhorn"></i>{{ getPhrase('marketing') }} <i class="fa fa-fw fa-angle-down"></i></a>
					<ul id="merktNav" class="collapse">
						<li><a href="{{URL_OFFER}}"> <i class="fa fa-american-sign-language-interpreting"></i>{{ getPhrase('package offers') }}</a></li>
						<li><a href="{{URL_PROMOBANNER}}" ><i class="fa fa-snowflake-o" ></i> {{ getPhrase('top_bar_strip') }} </a></li>
						<li><a href="{{URL_MARKETTINGBANNER}}" ><i class="fa fa-slideshare" ></i> {{ getPhrase('promotional_section') }} </a></li>
						{{--<li><a href="{{URL_ALLCOURSE}}" ><i class="fab fa-airbnb"></i> {{ getPhrase('all_course_banner') }} </a></li>--}}
						<li><a href="{{URL_PROMOPOPUP}}"> <i class="fa fa-external-link"></i>{{ getPhrase('promotional_popup') }}</a></li>
						<li><a href="{{URL_SUBSCRIBED}}"> <i class="fa fa-circle"></i>{{ getPhrase('subscribed_users') }}</a></li>
					</ul>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'faqs'))
				<li {{ isActive($active_class, 'faqs') }} >
					<a href="javascript:void(0)" data-toggle="collapse" data-target="#faqs"><i class="fa fa-fw fa-question"></i>{{ getPhrase('faqs') }} <i class="fa fa-fw fa-angle-down"></i></a>
					<ul id="faqs" class="collapse">
						<li><a href="{{URL_FAQ_CATEGORIES}}"> <i class="fa fa-fw fa-list"></i>{{ getPhrase('categories') }}</a></li>
						<li><a href="{{URL_FAQ_QUESTIONS}}"> <i class="fa fa-fw fa-question"></i>{{ getPhrase('faqs') }}</a></li>
					</ul>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'Reviews'))
				<li {{ isActive($active_class, 'reviews') }} >
					<a href="javascript:void(0)" data-toggle="collapse" data-target="#reviewNav"><i class="fa fa-star"></i> {{ getPhrase('Reviews') }} <i class="fa fa-fw fa-angle-down"></i></a>
					<ul id="reviewNav" class="collapse">
						<li><a href="{{URL_REVIEWS}}"> <i class="fa fa-fw fa-list"></i>{{ getPhrase('All Reviews') }}</a></li>
						<li><a href="{{URL_REVIEWS_ADD}}"> <i class="fa fa-fw fa-plus"></i>{{ getPhrase('add new Review') }}</a></li>
					</ul>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'payment_reports'))

				<li {{ isActive($active_class, 'reports') }} >
					<a href="javascript:void(0)" data-toggle="collapse" data-target="#reports"><i class="fa fa-fw fa-credit-card"></i>{{ getPhrase('payment_reports') }} <i class="fa fa-fw fa-angle-down"></i></a>
					<ul id="reports" class="collapse">
						<li><a href="{{URL_ONLINE_PAYMENT_REPORTS}}"> <i class="fa fa-fw fa-link"></i>{{ getPhrase('online_payments') }}</a></li>
						<li><a href="{{URL_OFFLINE_PAYMENT_REPORTS}}"> <i class="fa fa-fw fa-chain-broken"></i>{{ getPhrase('offline_payments') }}</a></li>
						<li><a href="{{URL_PAYMENT_REPORT_EXPORT}}"> <i class="fa fa-fw fa-file-excel-o"></i>{{ getPhrase('export') }}</a></li>
					</ul>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'notifications'))
				<li {{ isActive($active_class, 'notifications') }} >
					<a href="javascript:void(0)" data-toggle="collapse" data-target="#notifiNav"><i class="fa fa-fw fa-bell" aria-hidden="true"></i>{{ getPhrase('notifications') }} <i class="fa fa-fw fa-angle-down"></i></a>
					<ul id="notifiNav" class="collapse">
						<li><a href="{{URL_STUDENT_ID}}"> <i class="fa fa-fw fa-link"></i>{{ getPhrase('student_id_card') }}</a></li>
						<li><a href="{{URL_ADMIN_NOTIFICATIONS}}"> <i class="fa fa-fw fa-bell"></i>{{ getPhrase('notifications') }}</a></li>
					</ul>
				</li>

				{{--<li {{ isActive($active_class, 'sms') }} > --}}
				{{--<a href="{{URL_SEND_SMS}}" ><i class="fa fa-fw fa-envelope" ></i> --}}
				{{--SMS </a> --}}
				{{----}}
				{{--</li>--}}
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'messages'))
				<li {{ isActive($active_class, 'messages') }} >
					<a  href="{{URL_MESSAGES}}"> <i class="fa fa-fw fa-comments" aria-hidden="true"> </i>{{ getPhrase('messages')}} <small class="msg">{{$count = Auth::user()->newThreadsCount()}} </small></a>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'feedback'))
				<li {{ isActive($active_class, 'feedback') }} >
					<a href="{{URL_FEEDBACKS}}" ><i class="fa fa-fw fa-commenting" ></i>{{ getPhrase('feedback') }} </a>
				</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'logs'))
					<li {{ isActive($active_class, 'logs') }} >
						<a href="{{URL_LOGS}}" ><i class="fa fa-low-vision" ></i>{{ getPhrase('logs') }} </a>
					</li>
				@endif
				@if(App\Role::getPermissionOnID(Auth::user()->role_id, 'master_settings'))
					@if(checkRole(getUserGrade(1)))
						<li {{ isActive($active_class, 'master_settings') }} >
							<a href="javascript:void(0)" data-toggle="collapse" data-target="#master_settings" href="{{URL_MASTERSETTINGS_SETTINGS}}"><i class="fa fa-fw fa-cog"></i>{{ getPhrase('master_settings') }} <i class="fa fa-fw fa-angle-down"></i></a>
							<ul id="master_settings" class="collapse">
								<li><a href="{{URL_MASTERSETTINGS_EMAIL_TEMPLATES}}"> <i class="icon-history"></i> {{ getPhrase('email_templates') }}</a></li>
								<li><a href="{{URL_LANGUAGES_LIST}}"><i class="fa fa-fw fa-language" aria-hidden="true"></i> {{ getPhrase('languages') }} </a> </li>
								<li><a href="{{URL_CURRENCIES}}"><i class="fa fa-fw fa-dollar" aria-hidden="true"></i> {{ getPhrase('currencies') }} </a> </li>
								<li><a href="{{URL_MASTERSETTINGS_SETTINGS}}"> <i class="icon-settings"></i> {{ getPhrase('settings') }}</a></li>
							</ul>
						</li>
						<li {{ isActive($active_class, 'themes') }} >
							<a href="{{URL_THEMES_LIST}}" ><i class="fa fa-fw fa-th-large" ></i>{{ getPhrase('themes') }} </a>
						</li>
					@endif
				@endif
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
    $(document).ready(function () {

    });


</script>


@yield('footer_scripts')

@include('errors.formMessages')



@yield('custom_div_end')
{!!getSetting('google_analytics', 'seo_settings')!!}
<div class="ajax-loader" style="display:none;" id="ajax_loader"><img src="{{AJAXLOADER}}"> {{getPhrase('please_wait')}}...</div>
</body>

</html>