<?php

Route::get('clear',function(){

    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    // Artisan::call('translator:flush');
    // Waavi\Translation\Facades\TranslationCache::flushAll();
    Session::forget('key');
    Session::flush();
    Cache::flush();
    die('Cleared');
});

Route::get('symlink',function(){
    Artisan::call('storage:link');
    die('Generated');
});

Route::get('dump',function(){
    system('composer dump-autoload');
    die('Dumped');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//if(env('DB_DATABASE')=='')
//{
//
//   Route::get('/', 'InstallatationController@index');
//   Route::get('/install', 'InstallatationController@index');
//   Route::post('/update-details', 'InstallatationController@updateDetails');
//   Route::post('/install', 'InstallatationController@installProject');
//}

//Route::get('/', function () {
//
//    if(Auth::check())
//    {
//        return redirect('dashboard');
//    }
//    // dd('here');
//    return redirect(URL_USERS_LOGIN);
//});


//
//
//if(env('DEMO_MODE')) {
//
//    Event::listen('eloquent.saving: *', function ($model) {
//        if(urlHasString('finish-exam') || urlHasString('start-exam'))
//          return true;
//      return false;
//
//
//    });
//
//}

 // Route::get('install/reg', 'InstallatationController@reg');
 //Route::post('install/register', 'InstallatationController@registerUser');

//Route::get('/', function(){
//
//    $menu_categories=Cache::get( 'menu_categories' );
//
//    $lms_allcats = $menu_categories;
//
//    return $menu_categories;
//
//});


if(env('DB_DATABASE')==''){
  Route::get('/', 'SiteController@index');
}
  Route::get('/', 'SiteController@index');
//  Route::get('all-courses', 'SiteController@allCourses');
  Route::get('all-courses', 'SiteController@frontSearchCourses');

// Route::get('/', function () {
     
//     if(Auth::check())
//     {
//         return redirect('dashboard');
//     }
// 	return redirect(URL_USERS_LOGIN);
// });

Route::get('dashboard','DashboardController@index');
Route::get('dashboard/testlang','DashboardController@testLanguage');


Route::get('auth/{slug}','Auth\LoginController@redirectToProvider');
Route::get('auth/{slug}/callback','Auth\LoginController@handleProviderCallback');
Route::post('authadmin','SiteController@handleSuperAdminUserLogin')->name('authadmin');
Route::post('backtoadmin','SiteController@handleSuperAdminBackLogin')->name('backtoadmin');



// Authentication Routes...
Route::get('login/{layout_type?}', 'Auth\LoginController@getLogin')->name('login');
Route::post('login', 'Auth\LoginController@postLogin');
Route::post('loginco', 'Auth\LoginController@postLoginCO');
Route::post('checklogin', 'Auth\LoginController@CheckUser');

Route::get('logout', function(Illuminate\Http\Request $request){

	if(Auth::check()) {
        //  toastr()->success('You are logged out successfully');
        //flash(getPhrase('success'),getPhrase('logged_out_successfully'),'success');
        //showMessage("Success", "Title", getPhrase('logged_out_successfully'));
    }
	/********* Reset coupon ********/
    $request->session()->forget('Coupon_code');
    $request->session()->forget('Coupon_value');
    /********* Reset coupon ********/

    /********* Reset Currency Converter sessions********/
//    $request->session()->forget('currency_id');
    $request->session()->forget('currency_rate');
    $request->session()->forget('currency_symbol');
    $request->session()->forget('currency_short');

    /********* Reset Currency Converter sessions ********/
    \Cookie::queue(\Cookie::forget('preurl'));
    \Cookie::queue(\Cookie::forget('adminid'));
    \Cart::clear();
	Auth::logout();

    session(['currency_rate' => 1,'currency_short' => 'GBP','currency_symbol' => 'fas fa-pound-sign']);


    return redirect(URL_USERS_LOGIN);
});

Route::get('parent-logout', function(){
    if(Auth::check())
        flash('Oops..!',getPhrase('parents_module_is_not_available'),'error');
    Auth::logout();
    return redirect(URL_USERS_LOGIN);
});


// Route::get('auth/logout', 'Auth\LoginController@getLogout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@getRegister');
Route::middleware('throttle:20,1')->group(function () {
    Route::post('register', 'Auth\RegisterController@postRegister');
});



// Forgot Password Routes...
// Route::get('forgot-password', 'PasswordController@postEmail');
Route::get('password/reset/{slug?}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::post('users/forgot-password', 'Auth\AuthController@resetUsersPassword');


Route::get('languages/list', 'NativeController@index');
Route::get('languages/getList', [ 'as'   => 'languages.dataTable',
     'uses' => 'NativeController@getDatatable']);
 
Route::get('languages/add', 'NativeController@create');
Route::post('languages/add', 'NativeController@store');
Route::get('languages/edit/{slug}', 'NativeController@edit');
Route::patch('languages/edit/{slug}', 'NativeController@update');
Route::delete('languages/delete/{slug}', 'NativeController@delete');
 
Route::get('languages/make-default/{slug}', 'NativeController@changeDefaultLanguage');
Route::get('languages/update-strings/{slug}', 'NativeController@updateLanguageStrings');
Route::patch('languages/update-strings/{slug}', 'NativeController@saveLanguageStrings');



//Users
Route::get('users/staff/{role?}', 'UsersController@index');
Route::get('users/create', 'UsersController@create');
Route::delete('users/delete/{slug}', 'UsersController@delete');
Route::post('users/create/{role?}', 'UsersController@store');
Route::get('users/edit/{slug}', 'UsersController@edit');
Route::patch('users/edit/{slug}', 'UsersController@update');
Route::get('users/profile/{slug}', 'UsersController@show');
Route::get('users', 'UsersController@index');
Route::get('users/profile/{slug}', 'UsersController@show');
Route::get('users/details/{slug}', 'UsersController@details');
Route::post('users/massremove', 'UsersController@deleteMultiple')->name('users.massremove');

Route::get('users/settings/{slug}', 'UsersController@settings');
Route::patch('users/settings/{slug}', 'UsersController@updateSettings');

Route::get('users/change-password/{slug}', 'UsersController@changePassword');
Route::patch('users/change-password/{slug}', 'UsersController@updatePassword');

Route::get('users/import','UsersController@importUsers');
Route::post('users/import','UsersController@readExcel');

Route::get('users/import-report','UsersController@importResult');

Route::get('users/list/getList/{role_name?}', [ 'as'   => 'users.dataTable',
    'uses' => 'UsersController@getDatatable']);
Route::get('users/parent-details/{slug}', 'UsersController@viewParentDetails');

Route::patch('users/parent-details/{slug}', 'UsersController@updateParentDetails');
Route::post('users/search/parent', 'UsersController@getParentsOnSearch');
Route::get('users/assign-course/{slug}', 'UsersController@assignCourse')->name('assign-course');
Route::post('get-sub-category', 'UsersController@getsubCategory')->name('get-sub-category');
Route::post('users/get-course', 'UsersController@getCourses')->name('get-course');
Route::post('users/user-assign-course', 'UsersController@userassignCourses')->name('user-assign-course');
Route::post('users/user-remove-course', 'UsersController@userremoveCourses')->name('user-remove-course');
// Route::get('users/list/getList/{role_name?}', 'UsersController@getDatatable');

Route::get('users_enrolled', 'UsersController@getUsersEnrolled');
Route::get('users_enrolled/data', 'UsersController@getUsersEnrolledData');
            //////////////////////
            //Parent Controller //
            //////////////////////
Route::get('parent/children', 'ParentsController@index');
Route::get('parent/children/list', 'ParentsController@index');
Route::get('parent/children/getList/{slug}', 'ParentsController@getDatatable');
Route::get('children/analysis', 'ParentsController@childrenAnalysis');


//////////////////////
//Instructor Controller //
//////////////////////
Route::get('instructors/staff/{role?}', 'InstructorController@index');
Route::get('instructors/create', 'InstructorController@create');
Route::delete('instructors/delete/{slug}', 'InstructorController@delete');
Route::post('instructors/create/{role?}', 'InstructorController@store');
Route::get('instructors/edit/{slug}', 'InstructorController@edit');
Route::patch('instructors/edit/{slug}', 'InstructorController@update');
Route::get('instructors/profile/{slug}', 'InstructorController@show');
Route::get('instructors', 'InstructorController@index');
Route::get('instructors/profile/{slug}', 'InstructorController@show');
Route::get('instructors/settings', 'InstructorController@settings');
Route::post('instructors/settings', 'InstructorController@saveSettings');
Route::get('instructors/details/{slug}', 'InstructorController@details');
Route::post('instructors/massremove', 'InstructorController@deleteMultiple')->name('instructors.massremove');
Route::get('instructors/list/getList/{role_name?}', [ 'as'   => 'instructors.dataTable',
    'uses' => 'InstructorController@getDatatable']);


// Roles Module
Route::get('roles', 'RolesController@index');
Route::get('roles/create', 'RolesController@addRole');
Route::get('roles/edit/{id}', 'RolesController@edit');
Route::post('roles/create', 'RolesController@store');
Route::post('roles/edit', 'RolesController@update');
Route::get('roles/getlist', 'RolesController@getDatatable');
Route::get('roles/delete/{id}', 'RolesController@delete');


// Logs Module
Route::get('logs', 'LogsController@index');
Route::get('logs/view/{id}', 'LogsController@view');
Route::get('logs/getlist', 'LogsController@getDatatable');
Route::get('logs/delete/{id}', 'LogsController@delete');


Route::post('apply/instructor', 'InstructorRequestController@instructor')->name('apply.instructor');
Route::get('instructorsrequests/getList/{role_name?}', [ 'as'   => 'instructorsrequests.dataTable',
    'uses' => 'InstructorRequestController@getDatatable']);
Route::resource('requestinstructor', 'InstructorRequestController');

Route::get('instructorsrequests/review/{slug}', 'InstructorRequestController@review');
Route::delete('instructorsrequests/delete/{slug}', 'InstructorRequestController@delete');
Route::post('instructorsrequests/massremove', 'InstructorRequestController@deleteMultiple')->name('instructorsrequests.massremove');
Route::get('all/instructor', 'InstructorRequestController@allinstructor')->name('all.instructor');

Route::get('instructor-signup','InstructorRequestController@getInstructorRegister');
Route::post('register-instructor', 'InstructorRequestController@postInstructorRegister');


Route::get('instructor', 'InstructorController@index')->name('instructor.index');
Route::resource('userenroll', 'InstructorEnrollController');
Route::resource('instructorquestion', 'InstructorQuestionController');
Route::resource('instructoranswer', 'InstructorAnswerController');
Route::get('coursereview', 'CourseReviewController@index');

Route::resource('instructor/announcement', 'InstructorAnnouncementController');

Route::post('/quickupdate/ansr/{id}','QuickUpdateController@ansrQuick')->name('ansr.quick');
Route::post('/quickupdate/order/{id}','QuickUpdateController@orderQuick')->name('order.quick');


Route::get('pending/payout', 'PayoutController@pending')->name('pending.payout');
Route::get('admin/completed/payout', 'CompletedPayoutController@show')->name('admin.completed');

Route::get('instructor/details', 'InstructorSettingController@instructor')->name('instructor.pay');

Route::post('instructor/payout/{id}', 'InstructorSettingController@settings')->name('instructor.payout');


                    /////////////////////
                    // Master Settings //
                    /////////////////////




//subjects
Route::get('mastersettings/subjects', 'SubjectsController@index');
Route::get('mastersettings/subjects/add', 'SubjectsController@create');
Route::post('mastersettings/subjects/add', 'SubjectsController@store');
Route::get('mastersettings/subjects/edit/{slug}', 'SubjectsController@edit');
Route::patch('mastersettings/subjects/edit/{slug}', 'SubjectsController@update');
Route::delete('mastersettings/subjects/delete/{id}', 'SubjectsController@delete');
Route::get('mastersettings/subjects/getList', [ 'as'   => 'subjects.dataTable',
    'uses' => 'SubjectsController@getDatatable']);
Route::post('mastersettings/subjects/massremove', 'SubjectsController@deleteMultipleMastSubjects')->name('mastsubjects.massremove');

Route::get('mastersettings/subjects/import', 'SubjectsController@import');
Route::post('mastersettings/subjects/import', 'SubjectsController@readExcel');
 
//Topics 
Route::get('mastersettings/topics', 'TopicsController@index');
Route::get('mastersettings/topics/add', 'TopicsController@create');
Route::post('mastersettings/topics/add', 'TopicsController@store');
Route::get('mastersettings/topics/edit/{slug}', 'TopicsController@edit');
Route::patch('mastersettings/topics/edit/{slug}', 'TopicsController@update');
Route::delete('mastersettings/topics/delete/{id}', 'TopicsController@delete');
Route::get('mastersettings/topics/getList', [ 'as'   => 'topics.dataTable',
    'uses' => 'TopicsController@getDatatable']);

Route::get('mastersettings/topics/get-parents-topics/{subject_id}', 'TopicsController@getParentTopics');

Route::get('mastersettings/topics/import', 'TopicsController@import');
Route::post('mastersettings/topics/import', 'TopicsController@readExcel');

                    ////////////////////////
                    // EXAMINATION SYSTEM //
                    ////////////////////////

//Question bank
Route::get('exams/questionbank', 'QuestionBankController@index');
Route::get('exams/questionbank/add-question/{slug}', 'QuestionBankController@create');
Route::get('exams/questionbank/view/{slug}', 'QuestionBankController@show');

Route::post('exams/questionbank/add', 'QuestionBankController@store');
Route::get('exams/questionbank/edit-question/{slug}', 'QuestionBankController@edit');
Route::patch('exams/questionbank/edit/{slug}', 'QuestionBankController@update');
Route::delete('exams/questionbank/delete/{id}', 'QuestionBankController@delete');
Route::get('exams/questionbank/getList',  'QuestionBankController@getDatatable');
Route::post('exams/questionbank/massremove', 'QuestionBankController@deleteMultiple')->name('questionbank.massremove');
Route::post('exams/subjects/massremove', 'QuestionBankController@deleteMultipleSubjects')->name('subjects.massremove');

Route::get('exams/questionbank/getquestionslist/{slug}', 
     'QuestionBankController@getQuestions');
Route::get('exams/questionbank/import',  'QuestionBankController@import');
Route::post('exams/questionbank/import',  'QuestionBankController@readExcel');


//Quiz Categories
Route::get('exams/categories', 'QuizCategoryController@index');
Route::get('exams/categories/add', 'QuizCategoryController@create');
Route::post('exams/categories/add', 'QuizCategoryController@store');
Route::get('exams/categories/edit/{slug}', 'QuizCategoryController@edit');
Route::patch('exams/categories/edit/{slug}', 'QuizCategoryController@update');
Route::delete('exams/categories/delete/{slug}', 'QuizCategoryController@delete');
Route::get('exams/categories/getList', [ 'as'   => 'quizcategories.dataTable',
    'uses' => 'QuizCategoryController@getDatatable']);

// Quiz Student Categories 
Route::get('exams/student/categories', 'StudentQuizController@index');
Route::get('exams/student/exams/{slug?}', 'StudentQuizController@exams');
Route::get('exams/student/quiz/getList/{slug?}', 'StudentQuizController@getDatatable');
Route::get('exams/student/quiz/take-exam/{slug?}', 'StudentQuizController@instructions');
Route::post('exams/student/start-exam/{slug}', 'StudentQuizController@startExam');
Route::get('exams/student/start-exam/{slug}', 'StudentQuizController@index');

Route::post('exams/student/finish-exam/{slug}', 'StudentQuizController@finishExam');
Route::get('exams/student/reports/{slug}', 'StudentQuizController@reports');


Route::get('exams/student/exam-attempts/{user_slug}/{exam_slug?}', 'StudentQuizController@examAttempts');
Route::get('exams/student/get-exam-attempts/{user_slug}/{exam_slug?}', 'StudentQuizController@getExamAttemptsData');

Route::get('student/analysis/by-exam/{user_slug}', 'StudentQuizController@examAnalysis');
Route::get('student/analysis/get-by-exam/{user_slug}', 'StudentQuizController@getExamAnalysisData');

Route::get('student/analysis/by-subject/{user_slug}/{exam_slug?}/{results_slug?}', 'StudentQuizController@subjectAnalysisInExam');
Route::get('student/analysis/subject/{user_slug}', 'StudentQuizController@overallSubjectAnalysis');

//Student Reports
Route::get('student/exam/answers/{quiz_slug}/{result_slug}', 'ReportsController@viewExamAnswers');
Route::get('student/exam/answers/download/{quiz_slug}/{result_slug}', 'ReportsController@downexamanswers')->name('download.exam.res');

//Quiz 
Route::get('exams/quizzes', 'QuizController@index');
Route::get('exams/quiz/add', 'QuizController@create');
Route::post('exams/quiz/add', 'QuizController@store');
Route::get('exams/quiz/edit/{slug}', 'QuizController@edit');
Route::patch('exams/quiz/edit/{slug}', 'QuizController@update');
Route::delete('exams/quiz/delete/{slug}', 'QuizController@delete');

Route::post('exams/quiz/massremove', 'QuizController@deleteMultiple')->name('quiz.massremove');
Route::get('exams/quiz/getList/{slug?}', 'QuizController@getDatatable');

Route::get('exams/quiz/update-questions/{slug}', 'QuizController@updateQuestions');
Route::post('exams/quiz/update-questions/{slug}', 'QuizController@storeQuestions');


Route::post('exams/quiz/get-questions', 'QuizController@getSubjectData');

//Certificates controller
Route::get('result/generate-certificate/{slug}', 'CertificatesController@getCertificate');
Route::post('result/generate-free-certificate', 'CertificatesController@generateViewCertificate')->name('generate-free-certificate');
Route::post('result/regenerate-certificate', 'CertificatesController@regenerateCertificate')->name('regenerate-certificate');


//Exam Series 
Route::get('exams/exam-series', 'ExamSeriesController@index');
Route::get('exams/exam-series/add', 'ExamSeriesController@create');
Route::post('exams/exam-series/add', 'ExamSeriesController@store');
Route::get('exams/exam-series/edit/{slug}', 'ExamSeriesController@edit');
Route::patch('exams/exam-series/edit/{slug}', 'ExamSeriesController@update');
Route::delete('exams/exam-series/delete/{slug}', 'ExamSeriesController@delete');
Route::get('exams/exam-series/getList', 'ExamSeriesController@getDatatable');

//EXAM SERIES STUDENT LINKS
Route::get('exams/student-exam-series/list', 'ExamSeriesController@listSeries');
Route::get('exams/student-exam-series/{slug}', 'ExamSeriesController@viewItem');

//COURSE ASSIGNMENTS
Route::post('course/assignment/{id}', 'AssignmentController@submit')->name('assignment.submit');
Route::post('assignment/delete/{id}', 'AssignmentController@delete');
Route::resource('user/question/report','QuestionReportController');
Route::post('question/reports/{id}','QuestionReportController@store')->name('question.report');
Route::post('addquestion/{id}','QuestionanswerController@question');
Route::post('addanswer/{id}','AnswerController@answer');

Route::resource('assignment', 'AssignmentController');
Route::get('lms/assignments', 'AssignmentController@view')->name('assignment.view');
Route::get('view/assignment/{id}', 'AssignmentController@assignment')->name('list.assignment');

Route::get('exams/exam-series/assign-contents/{slug}/{secid}', 'ExamSeriesController@assignContents');
Route::get('exams/exam-series/update-series/{slug}', 'ExamSeriesController@updateSeries');
Route::post('exams/exam-series/update-series/{slug}', 'ExamSeriesController@storeSeries');
Route::post('exams/exam-series/get-exams', 'ExamSeriesController@getExams');
Route::get('payment/cancel', 'ExamSeriesController@cancel');
Route::post('payment/success', 'ExamSeriesController@success');

            /////////////////////
            // PAYMENT REPORTS //
            /////////////////////
Route::get('payments-report/', 'PaymentsController@overallPayments');

 Route::get('payments-report/online/', 'PaymentsController@onlinePaymentsReport');
 Route::get('payments-report/online/{slug}', 'PaymentsController@listOnlinePaymentsReport');
Route::get('payments-report/online/getList/{slug}', 'PaymentsController@getOnlinePaymentReportsDatatable');

Route::get('payments-report/offline/', 'PaymentsController@offlinePaymentsReport');
Route::get('payments-report/offline/{slug}', 'PaymentsController@listOfflinePaymentsReport');
Route::get('payments-report/offline/getList/{slug}', 'PaymentsController@getOfflinePaymentReportsDatatable');
Route::get('payments-report/export', 'PaymentsController@exportPayments');
Route::post('payments-report/export', 'PaymentsController@doExportPayments');

Route::post('payments-report/getRecord', 'PaymentsController@getPaymentRecord');
Route::post('payments/approve-reject-offline-request', 'PaymentsController@approveOfflinePayment');

//Route::get('view/order/admin/{id}', 'PaymentsController@vieworder')->name('view.order');

            //////////////////
            // INSTRUCTIONS  //
            //////////////////
            
Route::get('exam/instructions/list', 'InstructionsController@index');
Route::get('exam/instructions', 'InstructionsController@index');
Route::get('exams/instructions/add', 'InstructionsController@create');
Route::post('exams/instructions/add', 'InstructionsController@store');
Route::get('exams/instructions/edit/{slug}', 'InstructionsController@edit');
Route::patch('exams/instructions/edit/{slug}', 'InstructionsController@update');
Route::delete('exams/instructions/delete/{slug}', 'InstructionsController@delete');
Route::get('exams/instructions/getList', 'InstructionsController@getDatatable');

 
//BOOKMARKS MODULE
Route::get('student/bookmarks/{slug}', 'BookmarksController@index');
Route::post('student/bookmarks/add', 'BookmarksController@create');
Route::delete('student/bookmarks/delete/{id}', 'BookmarksController@delete');
Route::delete('student/bookmarks/delete_id/{id}', 'BookmarksController@deleteById');
Route::get('student/bookmarks/getList/{slug}',  'BookmarksController@getDatatable');
Route::post('student/bookmarks/getSavedList',  'BookmarksController@getSavedBookmarks');


                //////////////////////////
                // Notifications Module //
                /////////////////////////
Route::get('admin/notifications/list', 'NotificationsController@index');
Route::get('admin/notifications', 'NotificationsController@index');
Route::get('admin/notifications/add', 'NotificationsController@create');
Route::post('admin/notifications/add', 'NotificationsController@store');
Route::get('admin/notifications/edit/{slug}', 'NotificationsController@edit');
Route::patch('admin/notifications/edit/{slug}', 'NotificationsController@update');
Route::delete('admin/notifications/delete/{slug}', 'NotificationsController@delete');
Route::get('admin/notifications/getList', 'NotificationsController@getDatatable');

// NOTIFICATIONS FOR STUDENT
Route::get('notifications/list', 'NotificationsController@usersList');
Route::get('notifications/show/{slug}', 'NotificationsController@display');

 
//BOOKMARKS MODULE
Route::get('toppers/compare-with-topper/{user_result_slug}/{compare_slug?}', 'ExamToppersController@compare');

               
                        ////////////////
                        // LMS MODULE //
                        ////////////////

//LMS Categories
Route::get('lms/categories', 'LmsCategoryController@index');
Route::get('lms/categories/add', 'LmsCategoryController@create');
Route::post('lms/categories/add', 'LmsCategoryController@store');
Route::get('lms/categories/edit/{slug}', 'LmsCategoryController@edit');
Route::patch('lms/categories/edit/{slug}', 'LmsCategoryController@update');
Route::delete('lms/categories/delete/{slug}', 'LmsCategoryController@delete');
Route::get('lms/categories/getList', [ 'as'   => 'lmscategories.dataTable',
    'uses' => 'LmsCategoryController@getDatatable']);


//Awarding Bodies
Route::get('lms/awardingbodies', 'AwardingBodiesController@index');
Route::get('lms/awardingbodies/add', 'AwardingBodiesController@create');
Route::post('lms/awardingbodies/add', 'AwardingBodiesController@store');
Route::get('lms/awardingbodies/edit/{slug}', 'AwardingBodiesController@edit');
Route::patch('lms/awardingbodies/edit/{slug}', 'AwardingBodiesController@update');
Route::delete('lms/awardingbodies/delete/{slug}', 'AwardingBodiesController@delete');
Route::get('lms/awardingbodies/getList', [ 'as'   => 'awardingbodies.dataTable',
    'uses' => 'AwardingBodiesController@getDatatable']);



//LMS Levels
//Route::resources([
//    'levels' => 'LmsLevelsController',
//    'categories' => 'LmsCategoryController'
//]);

Route::get('lms/levels', 'LmsLevelsController@index');
Route::get('lms/levels/add', 'LmsLevelsController@create');
Route::post('lms/levels/add', 'LmsLevelsController@store');
Route::get('lms/levels/edit/{slug}', 'LmsLevelsController@edit');
Route::patch('lms/levels/edit/{slug}', 'LmsLevelsController@update');
Route::delete('lms/levels/delete/{slug}', 'LmsLevelsController@delete');
Route::get('lms/levels/getList', [ 'as'   => 'lmslevels.dataTable',
    'uses' => 'LmsLevelsController@getDatatable']);



//LMS Contents
Route::get('lms/content', 'LmsContentController@index');
Route::get('lms/content/add', 'LmsContentController@create');
Route::post('lms/content/add', 'LmsContentController@store');
Route::get('lms/content/edit/{slug}', 'LmsContentController@edit');
Route::patch('lms/content/edit/{slug}', 'LmsContentController@update');
Route::delete('lms/content/delete/{slug}', 'LmsContentController@delete');
Route::post('lms/content/massremove', 'LmsContentController@deleteMultiple')->name('content.massremove');
Route::get('lms/content/getList', [ 'as'   => 'lmscontent.dataTable',
    'uses' => 'LmsContentController@getDatatable']);



//LMS Series 
Route::get('lms/series/{slug?}', 'LmsSeriesController@index');
Route::get('lms/series/add/new', 'LmsSeriesController@create');
Route::post('get-admin-sub-category', 'LmsSeriesController@getsubcategory')->name('get-admin-sub-category');
Route::get('get-course-tags', 'LmsSeriesController@getCourseTags')->name('get-course-tags');
Route::post('lms/series/add/new', 'LmsSeriesController@store');

Route::post('lms/series/video/new', 'LmsSeriesController@uploadnewVideo')->name('new-upload-video');
Route::post('lms/series/video/new/delete/{name}', 'LmsSeriesController@deletenewVideo')->name('delete-upload-video');
Route::post('lms/series/video/{id}', 'LmsSeriesController@uploadVideo')->name('upload-video');
Route::post('lms/series/video/delete/{id}', 'LmsSeriesController@deleteVideo')->name('delete-video');

Route::get('lms/series/edit/{slug}', 'LmsSeriesController@edit');
Route::patch('lms/series/edit/{slug}', 'LmsSeriesController@update');
Route::get('lms/series/editsections/{slug}', 'LmsSeriesController@editSections');
Route::post('lms/series/storesections/{slug}', 'LmsSeriesController@storeSections');
Route::post('lms/series/updatesections/{slug}', 'LmsSeriesController@updateSections');
Route::delete('lms/series/deletesections/{slug}', 'LmsSeriesController@deleteSections');
Route::delete('lms/series/delete/{slug}', 'LmsSeriesController@delete');
Route::post('lms/series/massremove', 'LmsSeriesController@deleteMultiple')->name('series.massremove');
Route::post('lms/series/massunpublish', 'LmsSeriesController@unpublishMultiple')->name('series.massunpublish');
Route::post('lms/series/masspublish', 'LmsSeriesController@publishMultiple')->name('series.masspublish');

Route::get('lms/series/getList/{slug?}', 'LmsSeriesController@getDatatable');

//LMS SERIES STUDENT LINKS
Route::get('lms/exam-series/list', 'LmsSeriesController@listSeries');
Route::get('lms/exam-series/{slug}', 'LmsSeriesController@viewItem');

/********* contact Login **********/
Route::post('contactpost','SiteController@ContactPost');
Route::post('enquirypost','SiteController@EnquiryPost');
/********* contact Login **********/


Route::post('getpreviewiframe','SiteController@GetPreviewIframe');


/********** Gernal Functions *********/
Route::get('/courseiswishlisted/{cid}', 'SiteController@CourseIsWishlisted');
Route::get('/countwishlisteditem', 'SiteController@CountWishlistedItem');
/********** Gernal Functions *********/


Route::get('lms/series/update-series/{slug}', 'LmsSeriesController@updateSeries');
Route::get('lms/series/update-series/{slug}/{secid}', 'LmsSeriesController@updateSectionContents');
Route::post('lms/series/update-series/{slug}', 'LmsSeriesController@storeSeries');
Route::post('lms/series/get-series', 'LmsSeriesController@getSeries');
Route::get('payment/cancel', 'LmsSeriesController@cancel');
Route::post('payment/success', 'LmsSeriesController@success');


Route::get('lms/series/update-exams/{slug}', 'LmsSeriesController@updateExams');
Route::get('lms/series/update-exams/{slug}/{secid}', 'LmsSeriesController@updateExams');
Route::post('lms/series/update-exams/{slug}', 'LmsSeriesController@storeExams');
Route::post('lms/series/get-exams', 'LmsSeriesController@getExams');


//LMS Student view
Route::get('my-courses/categories', 'StudentLmsController@index');
Route::get('my-courses/view/{slug}', 'StudentLmsController@viewCategoryItems');
Route::get('my-courses', 'StudentLmsController@courses');
Route::get('my-courses/wishlists', 'StudentLmsController@wishlists');
Route::post('my-courses/storeReview', 'StudentLmsController@storeReview');
Route::post('my-courses/storeComment', 'StudentLmsController@storeComment');
Route::get('my-courses/{slug}/{content_slug?}', 'StudentLmsController@viewItem');
Route::get('user/paid/{slug}/{content_slug}', 'StudentLmsController@verifyPaidItem');
Route::get('my-courses/content/{req_content_type}', 'StudentLmsController@content');
Route::get('my-courses/content/show/{slug}', 'StudentLmsController@showContent');

 

//Payments Controller
Route::get('payments/list/{slug}', 'PaymentsController@index');
Route::get('payments/getList/{slug}', 'PaymentsController@getDatatable');


//Enquiries Controller
Route::get('enquires/list/{slug}', 'EnquiryController@index');
Route::get('enquires/getList/{slug}', 'EnquiryController@getDatatable');
Route::get('enquires/view/{id}', 'EnquiryController@view');

Route::get('payments/list', 'PaymentsController@index');
Route::get('payments/getList', 'PaymentsController@getDatatable');

Route::get('reports/list', 'PaymentsController@GetReports');
Route::get('reports/getList', 'PaymentsController@getDatatableList');

Route::get('payments/checkout/{type}/{slug}', 'PaymentsController@checkout');
Route::get('payments/paynow/{slug}', 'DashboardController@index');
Route::post('payments/paynow/{slug}', 'PaymentsController@paynow');
Route::post('payments/paypalanonymous', 'SiteController@PaypalExpressAnonymous');

Route::get('paypal_express_process','PaymentsController@paypalExpressProcess');

Route::get('payments/paypal/status-success','SiteController@get_paypal_success');

Route::get('payments/paypal/status-cancel', 'PaymentsController@paypal_cancel');

Route::post('payments/payu/status-success','PaymentsController@payu_success');
Route::post('payments/payu/status-cancel', 'PaymentsController@payu_cancel');
Route::post('payments/offline-payment/update', 'PaymentsController@updateOfflinePayment');



Route::get('payment_rest', 'PaymentControllerRest@index');
Route::post('charge_rest', 'PaymentControllerRest@charge');
Route::get('paymentsuccess_rest', 'PaymentControllerRest@payment_success');
Route::get('paymenterror_rest', 'PaymentControllerRest@payment_error');

Route::post('test/paypal/order', 'PaymentControllerRest@testorder');
Route::post('test/order/{order}/capture', 'PaymentControllerRest@testordercapture');
Route::post('test/success', 'PaymentControllerRest@testsuccess');


/********* paypal Send ********/

Route::get('paypal_student','PaymentsController@PayPalStudent');
Route::get('paypal', 'Front\CartController@Paypal');
Route::get('paypalsuccess', 'Front\CartController@PayPalSuccess');
/********* paypal Send ********/


/********* Coupon Code **********/
Route::post('checkout','SiteController@ApplyCouponCode');
/********* Coupon Code **********/


/********* Social Login **********/
Route::get('sociallogin','Auth\LoginController@registerWithSocialLogin');
Route::get('facebook', 'SiteController@redirectToProvider');
Route::get('login/facebook/callback', 'SiteController@handleProviderCallback');
/********* Social Login **********/

/********* Gernal Methods **********/
Route::get('/pullcountrys','SiteController@AllCountries');
/********* Gernal Methods **********/



////////////////////////////
                        // SETTINGS MODULE //
                        ///////////////////////////


//LMS Categories
Route::get('mastersettings/settings/', 'SettingsController@index');
Route::get('mastersettings/settings/index', 'SettingsController@index');
Route::get('mastersettings/settings/add', 'SettingsController@create');
Route::post('mastersettings/settings/add', 'SettingsController@store');
Route::get('mastersettings/settings/edit/{slug}', 'SettingsController@edit');
Route::patch('mastersettings/settings/edit/{slug}', 'SettingsController@update');
Route::get('mastersettings/settings/view/{slug}', 'SettingsController@viewSettings');
Route::get('mastersettings/settings/add-sub-settings/{slug}', 'SettingsController@addSubSettings');
Route::post('mastersettings/settings/add-sub-settings/{slug}', 'SettingsController@storeSubSettings');
Route::patch('mastersettings/settings/add-sub-settings/{slug}', 'SettingsController@updateSubSettings');
 
Route::get('mastersettings/settings/getList', [ 'as'   => 'mastersettings.dataTable',
     'uses' => 'SettingsController@getDatatable']);

                        ////////////////////////////
                        // EMAIL TEMPLATES MODULE //
                        ///////////////////////////
//config('recaptcha.default_validation_route', 'biscolab-recaptcha/validate');
//LMS Categories
Route::get('email/templates', 'EmailTemplatesController@index');
Route::get('email/templates/add', 'EmailTemplatesController@create');
Route::get('email/templates/duplicate/{id}', 'EmailTemplatesController@duplicate');
Route::get('email/templates/view/{id}', 'EmailTemplatesController@view');
Route::post('email/templates/add', 'EmailTemplatesController@store');
Route::get('email/templates/edit/{slug}', 'EmailTemplatesController@edit');
Route::patch('email/templates/edit/{slug}', 'EmailTemplatesController@update');
Route::delete('email/templates/delete/{slug}', 'EmailTemplatesController@delete');
Route::get('email/templates/getList', [ 'as'   => 'emailtemplates.dataTable',
    'uses' => 'EmailTemplatesController@getDatatable']);

//Route::get('email/templates/massremove', 'EmailTemplatesController@deleteMultiple')->name('templates.massremove');


//CouponsCoupons Module
Route::get('coupons/list', 'CouponcodesController@index');
Route::get('coupons/add', 'CouponcodesController@create');
Route::post('coupons/add', 'CouponcodesController@store');
Route::get('coupons/edit/{slug}', 'CouponcodesController@edit');
Route::patch('coupons/edit/{slug}', 'CouponcodesController@update');
Route::delete('coupons/delete/{slug}', 'CouponcodesController@delete');
Route::get('coupons/getList/{slug?}', 'CouponcodesController@getDatatable');

Route::get('coupons/get-usage', 'CouponcodesController@getCouponUsage');
Route::get('coupons/get-usage-data', 'CouponcodesController@getCouponUsageData');
Route::post('coupons/update-questions/{slug}', 'CouponcodesController@storeQuestions');


Route::post('coupons/validate-coupon', 'CouponcodesController@validateCoupon');

//Pages Module
Route::get('pages/list', 'PagesController@index');
//Route::get('pages/getList/{slug?}', 'PagesController@getDatatable');
Route::get('pages/add', 'PagesController@create');
Route::post('pages/add', 'PagesController@store');
Route::get('pages/edit/{slug}', 'PagesController@edit');
Route::patch('pages/edit/{slug}', 'PagesController@update');
Route::delete('pages/delete/{slug}', 'PagesController@delete');

Route::get('pages/getList', [ 'as'   => 'pages.dataTable', 'uses' => 'PagesController@getDatatable']);

Route::post('pages/delete/massremove', 'PagesController@deleteMultiple')->name('pages.massremove');
//FRONT page
Route::get('page/{slug}', 'SiteController@page');

//Promo Banner
Route::get('promobanner', 'PromoBannerController@PromoBanner');
Route::post('promobanner', 'PromoBannerController@UpdatePromo');

//Marketing Banner
Route::get('marketingbanner', 'PromoBannerController@MarketingBanner');
Route::post('marketingbanner', 'PromoBannerController@UpdateMarketingPromo');
Route::get('getMBanner', 'PromoBannerController@getBanner');

//All Course Banner
Route::get('allcourse', 'PromoBannerController@AllCourseBanner');
Route::post('allcourseadd', 'PromoBannerController@UpdateAllCourse');

//Spacial Offers Module
Route::get('offer/list', 'OfferController@index');
Route::get('offer/getList', 'OfferController@getDatatable');
Route::get('offer/add', 'OfferController@create');
Route::post('offer/add', 'OfferController@store');
Route::get('offer/edit/{slug}', 'OfferController@edit');
Route::post('offer/edit/{slug}', 'OfferController@update');
Route::delete('offer/delete/{slug}', 'OfferController@delete');


//Promo Popup
Route::get('popup/list', 'PopupController@index');
Route::get('popup/getList', 'PopupController@getDatatable');
Route::get('popup/add', 'PopupController@create');
Route::post('popup/add', 'PopupController@store');
Route::get('popup/edit/{slug}', 'PopupController@edit');
Route::post('popup/edit/{slug}', 'PopupController@update');
Route::delete('popup/delete/{slug}', 'PopupController@delete');


//Student Id Card
Route::get('studentid/list', 'StudentIDController@index');
Route::get('studentid/view/{slug}', 'StudentIDController@view');
Route::get('studentid/getList', 'StudentIDController@getDatatable');
Route::get('studentid/add', 'StudentIDController@create');
Route::post('studentid/add', 'StudentIDController@store');
Route::get('studentid/edit/{slug}', 'StudentIDController@edit');
Route::post('studentid/edit/{slug}', 'StudentIDController@update');
Route::delete('studentid/delete/{slug}', 'StudentIDController@delete');


//Certificates
Route::get('certificates/list/{slug?}', 'CertificateController@index');
Route::get('certificates/getList/{slug?}', 'CertificateController@getDatatable');
Route::get('certificates/add', 'CertificateController@create');
Route::post('certificates/add', 'CertificateController@store');
Route::get('certificates/view/{slug}', 'CertificateController@view');
Route::get('certificates/list/{type}', 'CertificateController@index');
Route::get('certificates/getListfirst', 'CertificateController@FiltersFirst');
Route::get('certificates/getListsecond', 'CertificateController@FiltersSecond');
Route::post('certificates/edit/{slug}', 'CertificateController@update');
Route::delete('certificates/delete/{slug}', 'CertificateController@delete');


//Certificates student
Route::get('student/certificates/list/{slug?}', 'ParentsController@certificates');
Route::get('student/certificates/view/{slug}', 'ParentsController@view');
Route::get('student/certificates/getList/{slug?}', 'ParentsController@getcertDatatable');


//Emails
Route::get('emails/list', 'ReceivedEmailsController@index');
Route::get('emails/getList', 'ReceivedEmailsController@getDatatable');
Route::get('emails/edit/{id}', 'ReceivedEmailsController@Edit');
Route::get('emails/corporate', 'ReceivedEmailsController@Corporate');
Route::get('emails/corporategetList', 'ReceivedEmailsController@CorporategetDatatable');
Route::get('emails/corporate/edit/{id}', 'ReceivedEmailsController@CorporateEdit');


//FAQS CATEGORIES Module
Route::get('faq-categories', 'FaqCategoriesController@index');
//Route::get('faq-categories/getList/{slug?}', 'FaqCategoriesController@getDatatable');
Route::get('faq-categories/getList', [ 'as'   => 'faq-categories.dataTable', 'uses' => 'FaqCategoriesController@getDatatable']);

Route::post('faq-categories/delete/massremove', 'FaqCategoriesController@deleteMultiple')->name('faq-categories.massremove');

Route::get('faq-categories/add', 'FaqCategoriesController@create');
Route::post('faq-categories/add', 'FaqCategoriesController@store');
Route::get('faq-categories/edit/{slug}', 'FaqCategoriesController@edit');
Route::patch('faq-categories/edit/{slug}', 'FaqCategoriesController@update');
Route::delete('faq-categories/delete/{slug}', 'FaqCategoriesController@delete');


//FAQS QUESTIONS Module
Route::get('faq-questions', 'FaqQuestionsController@index');
//Route::get('faq-questions/getList/{slug?}', 'FaqQuestionsController@getDatatable');
Route::get('faq-questions/getList', [ 'as'   => 'faq-questions.dataTable', 'uses' => 'FaqQuestionsController@getDatatable']);
Route::post('faq-questions/delete/massremove', 'FaqQuestionsController@deleteMultiple')->name('faq-questions.massremove');
Route::get('faq-questions/add', 'FaqQuestionsController@create');
Route::post('faq-questions/add', 'FaqQuestionsController@store');
Route::get('faq-questions/edit/{slug}', 'FaqQuestionsController@edit');
Route::patch('faq-questions/edit/{slug}', 'FaqQuestionsController@update');
Route::delete('faq-questions/delete/{slug}', 'FaqQuestionsController@delete');


//FRONT FAQs
Route::get('faqs', 'SiteController@faqs');



//FAQS CATEGORIES Module
Route::get('currencies', 'CurrenciesController@index');
//Route::get('faq-categories/getList/{slug?}', 'FaqCategoriesController@getDatatable');
Route::get('currencies/getList', [ 'as'   => 'currencies.dataTable', 'uses' => 'CurrenciesController@getDatatable']);


Route::get('currencies/add', 'CurrenciesController@create');
Route::post('currencies/add', 'CurrenciesController@store');
Route::get('currencies/edit/{slug}', 'CurrenciesController@edit');
Route::patch('currencies/edit/{slug}', 'CurrenciesController@update');
Route::delete('currencies/delete/{slug}', 'CurrenciesController@delete');



//Reviews Module
Route::get('reviews/list', 'ReviewsController@index');
Route::get('reviews/add', 'ReviewsController@create');
Route::post('reviews/add', 'ReviewsController@store');
Route::get('reviews/edit/{slug}', 'ReviewsController@edit');
Route::patch('reviews/edit/{slug}', 'ReviewsController@update');
Route::delete('reviews/delete/{slug}', 'ReviewsController@delete');
//Route::get('posts/getList/{slug?}', 'ReviewsController@getDatatable');
Route::get('reviews/getList', [ 'as'   => 'reviews.dataTable',
    'uses' => 'ReviewsController@getDatatable']);
Route::post('reviews/delete/massremove', 'ReviewsController@deleteMultiple')->name('reviews.massremove');


//Posts Module
Route::get('posts/list', 'PostController@index');
Route::get('posts/add', 'PostController@create');
Route::post('posts/add', 'PostController@store');
Route::get('posts/edit/{slug}', 'PostController@edit');
Route::patch('posts/edit/{slug}', 'PostController@update');
Route::delete('posts/delete/{slug}', 'PostController@delete');
//Route::get('posts/getList/{slug?}', 'PostController@getDatatable');
Route::get('posts/getList', [ 'as'   => 'posts.dataTable',
    'uses' => 'PostController@getDatatable']);
Route::post('posts/delete/massremove', 'PostController@deleteMultiple')->name('posts.massremove');

//Post Categories
Route::get('posts/categories', 'PostCategoryController@index');
Route::get('posts/categories/add', 'PostCategoryController@create');
Route::post('posts/categories/add', 'PostCategoryController@store');
Route::get('posts/categories/edit/{slug}', 'PostCategoryController@edit');
Route::patch('posts/categories/edit/{slug}', 'PostCategoryController@update');
Route::delete('posts/categories/delete/{slug}', 'PostCategoryController@delete');
Route::get('posts/categories/getList', [ 'as'   => 'postcategories.dataTable',
    'uses' => 'PostCategoryController@getDatatable']);



//Tags Module
Route::get('tags/list', 'TagController@index');
Route::get('tags/add', 'TagController@create');
Route::post('tags/add', 'TagController@store');
Route::get('tags/edit/{slug}', 'TagController@edit');
Route::patch('tags/edit/{slug}', 'TagController@update');
Route::delete('tags/delete/{slug}', 'TagController@delete');
//Route::get('posts/getList/{slug?}', 'TagController@getDatatable');
Route::get('tags/getList', [ 'as'   => 'tags.dataTable',
    'uses' => 'TagController@getDatatable']);
Route::post('tags/delete/massremove', 'TagController@deleteMultiple')->name('tags.massremove');

//Tag Categories
Route::get('tags/categories', 'TagCategoryController@index');
Route::get('tags/categories/add', 'TagCategoryController@create');
Route::post('tags/categories/add', 'TagCategoryController@store');
Route::get('tags/categories/edit/{slug}', 'TagCategoryController@edit');
Route::patch('tags/categories/edit/{slug}', 'TagCategoryController@update');
Route::delete('tags/categories/delete/{slug}', 'TagCategoryController@delete');
Route::get('tags/categories/getList', [ 'as'   => 'tagcategories.dataTable',
    'uses' => 'TagCategoryController@getDatatable']);



//Feedback Module
Route::get('feedback/list', 'FeedbackController@index');
Route::get('feedback/view-details/{slug}', 'FeedbackController@details');
Route::get('feedback/send', 'FeedbackController@create');
Route::get('feedback/edit/{slug}', 'FeedbackController@edit');
Route::patch('feedback/edit/{slug}', 'FeedbackController@update');
Route::post('feedback/send', 'FeedbackController@store');
Route::delete('feedback/delete/{slug}', 'FeedbackController@delete');
Route::get('feedback/getlist', 'FeedbackController@getDatatable');

//SMS Module

Route::get('sms/index', 'SMSAgentController@index');
Route::post('sms/send', 'SMSAgentController@sendSMS');

                        /////////////////////
                        // MESSAGES MODULE //
                        /////////////////////


Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/store', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('update/{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});

                        /////////////////////
                        // PRIVACY POLICY  //
                        /////////////////////



Route::get('site/{slug?}', 'SiteController@sitePages');
// privacy-policy


                         ////////////////////
                         // UPDATE PATCHES //
                         ////////////////////
 Route::get('updates/patch1', 'UpdatesController@patch1');
 Route::get('updates/patch2', 'UpdatesController@patch2');
 Route::get('updates/patch3', 'UpdatesController@patch3');
 Route::get('updates/patch4', 'UpdatesController@patch4');
 Route::get('update/application','UpdatesController@updateDatabase');

Route::get('refresh-csrf', function(){
    return csrf_token();
});


//Fornt End Part
 Route::get('exams/list', 'FrontendExamsController@examsList');
Route::get('exams/start-exam/{slug}', 'FrontendExamsController@startExam');
Route::post('exams/finish-exam/{slug}', 'FrontendExamsController@finishExam');

//Resume Exam
Route::post('resume/examdata/save','StudentQuizController@saveResumeExamData');
Route::get('exam-types','QuizController@examTypes');
Route::get('edit/exam-type/{code}','QuizController@editExamType');
Route::post('update/exam-type/{code}','QuizController@updateExamType');
Route::post('razoapay/success','PaymentsController@razorpaySuccess');


//sitemap update
Route::get('generate/sitemap','SitemapController@index');

//facebook feed XML update
Route::get('generate/facebook_feed','SiteController@xml_facebook_feed');


//Theme Updates
Route::post('subscription/email','SiteController@saveSubscription');


//------------ Multiple course Redeem ----------------
Route::get('/multiple_course_redeem','SiteController@GetMultipleCourse');
Route::post('/multiple_course_redeem', 'SiteController@PostMultipleCourse');
//------------ Multiple course Redeem ----------------

//------------ Redeem a Voucher ----------------
Route::get('/redeem_a_voucher','SiteController@GetRedeemVoucher');
Route::post('/redeem_a_voucher', 'SiteController@PostRedeemVoucher');
//------------ Redeem a Voucher ----------------


//------------ Affiliate Marketing ----------------
Route::get('affiliate_marketing','SiteController@GetaffiliateMarketing');
Route::post('affiliate_marketing','SiteController@PostaffiliateMarketing');
//------------ Affiliate Marketing ----------------


//------------ New Landing page ----------------
Route::get('knowledgebased','SiteController@KnowledgeBased');
Route::post('knowledgebased','SiteController@PostaffiliateMarketing');

Route::get('landingpage/{slug?}','SiteController@KnowledgePhlebotomy');
//Route::get('landingpage/publicspeaking','SiteController@PublicSpeaking');
//------------ New Landing page ----------------


//------------ Affiliate Subscribe ----------------
Route::post('affiliatesubscribe','SiteController@PostAffiliateSubscribe');
//------------ Affiliate Subscribe ----------------

//Subscribed Users
Route::get('subscribed/users','UsersController@SubscribedUsers');
Route::get('subscribed/users/data','UsersController@SubscribersData');

//All Exam categories
Route::get('exam/categories/{slug?}','SiteController@frontAllExamCats');
Route::get('practice-exams/{slug?}','SiteController@frontAllExamCats');
Route::get('courses/search','SiteController@frontSearchCourses');
Route::get('courses/{slug?}','SiteController@browseData');
//Route::get('courses/search', [ 'as'   => 'courses.search',
//    'uses' => 'SiteController@frontSearchCourses']);
Route::get('course/{slug}','SiteController@frontLMSContents');
Route::get('cart','SiteController@viewCart');
Route::get('checkout','SiteController@viewCheckout');
Route::post('course/addtocart','SiteController@addToCart');
Route::post('course/updatecart','SiteController@UpdateCart');
Route::post('course/updatequantity','SiteController@UpdateQuantity');
Route::post('course/buynow','SiteController@buyNow');
Route::post('course/removeToCart','SiteController@removeToCart');
Route::post('course/clearCart','SiteController@clearCart');
Route::post('progress/save_course_progress','SiteController@saveCourseProgress');

Route::post('autocomplete', 'SiteController@autocomplete')->name('autocomplete');
Route::post('fetchCourses', 'SiteController@fetchCourses')->name('fetchCourses');
Route::middleware('throttle:20,1')->group(function () {
    Route::post('send/enquiry', 'SiteController@sendEnquiry');
});

Route::post('add/wishlist','WishlistController@wishlist');
Route::post('remove/wishlist/{id}','WishlistController@removewishlist');


Route::post('switchcurrency','SiteController@switchCurrency');



//STRIP ROUTES
//Route::post('addmoney/stripe', array('as' => 'addmoney.stripe','uses' => 'PaymentsController@postPaymentWithStripe'));
Route::post('addmoney/stripe_student', array('as' => 'addmoney.stripe','uses' => 'PaymentsController@postPaymentWithStripeStudent'));
Route::get('payments/stripe/status-success', array('as' => 'addmoney.paywithstripe','uses' => 'PaymentsController@stripe_success'));


//PAYPAL PRO ROUTES

Route::post('addmoney/paypalpro', array('as' => 'addmoney.paypalpro','uses' => 'PaymentsController@postPaymentWithPayPalPro'));
Route::post('addmoney/paypalproanonymous', array('as' => 'addmoney.paypalproanonymous','uses' => 'SiteController@postPaymentWithPayPalProAnonymous'));


// PAYPAL PRO FOR STUDENT
//Route::post('addmoney/paypalprostudent', array('as' => 'addmoney.paypalpro.student','uses' => 'SiteController@postPaymentStudentPayPalPro'));
Route::get('order-thankyou', array('as' => 'studentidcard.thankyou','uses' => 'SiteController@StudentThankYou'));
Route::post('order-thankyou', array('as' => 'studentidcard.thankyou','uses' => 'SiteController@StudentThankYou'));


// PAYPAL PRO FOR CERTIFICATE FEE
Route::post('addmoney/paypalprocertificate', array('as' => 'addmoney.paypalpro.certificate','uses' => 'PaymentsController@postPaymentCertificatePayPalPro'));
Route::post('addmoney/paypalproexamfee', array('as' => 'addmoney.paypalpro.examfee','uses' => 'PaymentsController@postPaymentExamFeePayPalPro'));
Route::get('certificate-thankyou', array('as' => 'certificate.thankyou','uses' => 'SiteController@StudentThankYou'));

//BLOG LINKS

Route::get('blogs','SiteController@getBlogList');
Route::get('blogs/{slug}','SiteController@getBlogCategoryList');
Route::post('blogs/search','SiteController@searchBlogs');
Route::get('blog/{slug}','SiteController@viewBlogArticle');
Route::get('blogajaxcall/{limit}','SiteController@getBlogAJAX');


//URL_LMS_SERIES_ADD_TO_CART
Route::get('download/lms/contents/{slug}','SiteController@downloadLMSContent');
Route::get('lms/video/{slug}/{cat_id?}','SiteController@viewVideo');


Route::get('free-courses','SiteController@getFreeCourses');
Route::get('popular-courses','SiteController@getPopularCourses');
Route::get('new-courses','SiteController@getNewCourses');
Route::get('discounted-courses','SiteController@getDiscountedCourses');
Route::get('about-us','SiteController@getAboutUs');
Route::get('contact_us','SiteController@getContactUs');
Route::middleware('throttle:20,1')->group(function () {
    Route::post('send/contact_us/details','SiteController@ContactUs');
});
Route::post('get/series/contents','SiteController@getSeriesContents');
Route::get('terms-and-conditions','SiteController@getTerms');
Route::get('privacy-policy','SiteController@getPrivacy');

Route::get('validate-certificate','SiteController@getValidate');
Route::get('postValidationCertificate','SiteController@postValidate');
Route::post('postValidationCertificate','SiteController@postValidate');
Route::post('result/view-pdf-certificate', 'SiteController@viewCertificate')->name('view-pdf-certificate');

/*********** Apply coupon cart **********/
//Route::get('checkoutcart','SiteController@ApplyCouponCodeCart');
Route::post('cart','SiteController@ApplyCouponCodeCart');
Route::get('testpage',function() {
    $data = [];
    $view_name = getTheme().'::site.testpage';
    return view($view_name, $data);
});
//Route::group(['middleware' => ['web']], function () {
//    Route::post('abc','SiteController@ContactUs');
//});
Route::get('ssess','SiteController@setsess');
Route::get('gsess','SiteController@getsess');

/*********** Apply coupon cart **********/

// NewPages
Route::get('student-id-card','SiteController@studentIdCard');
Route::post('student-id-card','PaymentsController@payStudentCardFee');

Route::get('retake_exam_fee/{cid}/{qid}','PaymentsController@retakeExamFee');


Route::get('certificate_fee/{cid}','PaymentsController@certificateFee');
Route::post('pay_certificate_fee','PaymentsController@payCertificateFee');


/************** freelance certificate  ************/
Route::get('freelance_certificate_fee','SiteController@FreelanceCertificateFee');
Route::get('freelance_certificate_fee/{cid}','SiteController@FreelanceCertificateFee');
Route::post('freelance_pay_certificate_fee','SiteController@FreelancePayCertificateFee');
/************** freelance certificate  ************/

//REED CERTIFICATE ANONYMOUS
Route::get('certificate_request','SiteController@certificateRequest');
Route::post('post_certificate_request','SiteController@payCertificateFee');
Route::post('/customorders','SiteController@PaymentExport');

//E CERTIFICATE ANONYMOUS
Route::get('ecertificate_request','SiteController@eCertificateRequest');
Route::post('post_ecertificate_request','SiteController@storeECertificateFee');

// cooke
Route::get('setcook','SiteController@SetUserdaysplus3');
Route::get('getcook','SiteController@getUserdaysplus3');

Route::get('corporate','SiteController@corporateTraining');
Route::post('corporate','SiteController@corporateTrainingSave');
Route::get('testimonial','SiteController@testimonialRequest');
Route::get('thankyou','SiteController@thankYou');
Route::get('unsubscribe','SiteController@UnSubscribe');

Route::get('instructor','SiteController@instructorForm');


Route::get('offers/{slug}','SiteController@marketingLanding');
Route::get('/offer/courseonid/{cid}','SiteController@GetCourseOnID');
Route::get('/offer/removecourse/{cid}','SiteController@GetCourseIDonCat');

// Subscribed
Route::get('subscribed/list', 'PromoBannerController@SubscribedListing');
Route::get('subscribed/getList', 'PromoBannerController@getDatatableSubscribed');

//Themes

Route::get('themes/list','SiteThemesController@index');
Route::get('themes/data','SiteThemesController@getDatatable');
Route::get('make/default/theme/{id}','SiteThemesController@makeDefault');
Route::get('theme/settings/{slug}','SiteThemesController@viewSettings');
Route::post('theme/update/settings/{slug}','SiteThemesController@updateSubSettings');


Route::get('gift-course','SiteController@giftCourse');
Route::get('gift-course/{slug}','SiteController@giftCourseID');
Route::post('/savegift','SiteController@SavegiftCourse');
Route::get('/promocheckout','SiteController@PackageCheckout');
Route::post('/ajaxcheckuseremail','SiteController@AJAXCheckUserEmail');
//Download student id card photo
Route::get('/savephoto/{slug}','SiteController@downloadPhoto');

Route::get('new-login','SiteController@newLogin');

Route::get('student-dashboard/dashboard','SiteController@studentDashboard');
Route::get('student-dashboard/my-courses','SiteController@studentCourses');
Route::get('student-dashboard/notifications_user','SiteController@studentNotification');
Route::get('student-dashboard/my-message','SiteController@studentMessages');
Route::get('student-dashboard/my-exam/{slug}','SiteController@studentExams');
Route::get('student-dashboard/my-certificates','SiteController@studentCertificates');
Route::get('student-dashboard/my-orders/{slug}','SiteController@studentOrders');
Route::get('student-dashboard/wishlist','SiteController@studentWishlist');
Route::get('/wishlist','SiteController@OfflineWishlist');
Route::post('/saveofflinewishlist','SiteController@SaveOfflineWishlist');
Route::get('student-dashboard/certificates/view/{slug}', 'SiteController@previewCertificate');
//Student Reports
Route::get('student-dashboard/exam/answers/{quiz_slug}/{result_slug}', 'SiteController@viewExamAnswers');
Route::get('student-dashboard/exam/answers/download/{quiz_slug}/{result_slug}', 'SiteController@downexamanswers')->name('download.exam.res');

Route::group(['prefix' => 'student-messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'SiteController@messageindex']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'SiteController@messagecreate']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'SiteController@messagestore']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'SiteController@messageshow']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'SiteController@messageupdate']);
});

/********** Landing pages 19-07-2021 *********/
Route::get('promotion-excel','SiteController@promotionExcel');
Route::get('promotion-makeup','SiteController@promotionMakeup');
