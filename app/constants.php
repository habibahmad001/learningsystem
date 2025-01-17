<?php
$base="";
$base = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
$host = '';
if (!empty($_SERVER['HTTP_HOST'])) {
  $host = $_SERVER['HTTP_HOST'];
}
$base .= '://'.$host . str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

define('PREFIX1', $base.'public/');
define('BASE_PATH', $base.'/');
define('PREFIX', $base);
define('URL_HOME', PREFIX.'home');
define('URL_DASHBOARD', PREFIX.'dashboard');
define('URL_MY_DASHBOARD', PREFIX.'student-dashboard/dashboard');


// dd($_SERVER);
//Design Source File Paths
define('CSS', PREFIX1.'css/');
define('JS', PREFIX1.'js/');
define('FONTAWSOME', PREFIX1.'font-awesome/css/');
define('IMAGES', PREFIX1.'images/');
//define('AJAXLOADER', IMAGES.'ajax-loader.svg');
define('AJAXLOADER_FADEIN_TIME', 100);
define('AJAXLOADER_FADEOUT_TIME', 100);
define('FRONT_ASSETS', PREFIX1.'front/');


//define('UPLOADS', PREFIX1.'uploads/');
define('UPLOADS_LOCAL', 'public/uploads/');
//define('UPLOADS', 'https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/');
define('UPLOADS', 'https://infinity-bucket-2024.s3.eu-west-2.amazonaws.com/');
//define('UPLOADS', 'https://dgzyo31xc1vmh.cloudfront.net/');
define('AJAXLOADER', UPLOADS.'images/ajax-loader.svg');
define('EXAM_UPLOADS', UPLOADS.'exams/');
define('IMAGE_PATH_UPLOAD_SERIES', UPLOADS.'exams/series/');
define('IMAGE_PATH_UPLOAD_SERIES_THUMB', UPLOADS.'exams/series/thumb/');

define('IMAGE_PATH_UPLOAD_EXAMSERIES_DEFAULT', UPLOADS.'exams/series/default.png');

define('IMAGE_PATH_UPLOAD_QUIZ_CATEGORIES', UPLOADS.'exams/categories/');
define('IMAGE_PATH_UPLOAD_QUIZ_DEFAULT', UPLOADS.'exams/categories/default.png');

define('IMAGE_PATH_UPLOAD_LMS_CATEGORIES', UPLOADS.'lms/categories/');
define('IMAGE_PATH_UPLOAD_LMS_DEFAULT', UPLOADS.'lms/categories/default.png');
define('IMAGE_PATH_UPLOAD_LMS_CONTENTS', UPLOADS.'lms/content/');
define('IMAGE_PATH_UPLOAD_POST_CONTENTS', UPLOADS.'blog/article/');
define('IMAGE_PATH_UPLOAD_BLOG', UPLOADS.'blog/');

define('CERTIFICATE_PATH', UPLOADS.'lms/certificate/');
define('IMAGE_PATH_UPLOAD_LMS_SERIES', UPLOADS.'lms/series/');
define('VIDEO_PATH_UPLOAD_LMS_SERIES', UPLOADS.'lms/series/videos/');
define('IMAGE_PATH_UPLOAD_LMS_SERIES_THUMB', UPLOADS.'lms/series/thumb/');
define('IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET', UPLOADS.'lms/series/widget/');

define('IMAGE_PATH_PROFILE', UPLOADS.'users/');
define('IMAGE_PATH_PROFILE_THUMBNAIL', UPLOADS.'users/thumbnail/');
define('IMAGE_PATH_PROFILE_THUMBNAIL_DEFAULT', UPLOADS.'users/thumbnail/default.png');

define('CARD_PHOTO_PATH', UPLOADS.'users/cards/');
define('CARD_PHOTO_PATH_THUMBNAIL', UPLOADS.'users/cards/thumbnail/');


define('IMAGE_PATH_INSTRUCTOR', UPLOADS.'instructors/images/');
define('RESUME_PATH_INSTRUCTOR', UPLOADS.'instructors/files/');

define('IMAGE_PATH_SETTINGS', UPLOADS.'settings/');



define('DOWNLOAD_LINK_USERS_IMPORT_EXCEL', PREFIX1.'downloads/excel-templates/users_template.xlsx');
define('DOWNLOAD_LINK_SUBJECTS_IMPORT_EXCEL', PREFIX1.'downloads/excel-templates/subjects_template.xlsx');
define('DOWNLOAD_LINK_TOPICS_IMPORT_EXCEL', PREFIX1.'downloads/excel-templates/topics_template.xlsx');
define('DOWNLOAD_LINK_QUESTION_IMPORT_EXCEL', PREFIX1.'downloads/excel-templates/');


define('DOWNLOAD_EMPTY_DATA_DATABASE', PREFIX1.'downloads/database/install.sql');
define('DOWNLOAD_SAMPLE_DATA_DATABASE', PREFIX1.'downloads/database/install_dummy_data.sql');



define('CURRENCY_CODE', '$ ');
define('RECORDS_PER_PAGE', '8');


define('OWNER_ROLE_ID', '1');
define('ADMIN_ROLE_ID', '2');
define('USER_ROLE_ID', '5');
define('STUDENT_ROLE_ID', '5');
define('PARENT_ROLE_ID', '6');
define('INSTRUCTOR_ROLE_ID', '7');



define('GOOGLE_TRANSLATE_LANGUAGES_LINK', 'https://cloud.google.com/translate/docs/languages');

define('PAYMENT_STATUS_CANCELLED', 'cancelled');
define('PAYMENT_STATUS_SUCCESS', 'success');
define('PAYMENT_STATUS_PENDING', 'pending');
define('PAYMENT_STATUS_ABORTED', 'aborted');
define('PAYMENT_RECORD_MAXTIME', '30'); //TIME IN MINUTES
//define('SUPPORTED_GATEWAYS', ['paypal','payu']);

define('URL_INSTALL_SYSTEM', PREFIX.'install');
define('URL_UPDATE_INSTALLATATION_DETAILS', PREFIX.'update-details');
define('URL_FIRST_USER_REGISTER', PREFIX.'install/register');

//MASTER SETTINGS MODULE
define('URL_MASTERSETTINGS_SETTINGS', PREFIX.'mastersettings/settings');
define('URL_MASTERSETTINGS_EMAIL_TEMPLATES', PREFIX.'email/templates');
define('URL_MASTERSETTINGS_TOPICS', PREFIX.'mastersettings/topics');
define('URL_MASTERSETTINGS_SUBJECTS', PREFIX.'mastersettings/subjects');

//QUIZ MODULE
define('URL_QUIZZES', PREFIX.'exams/quizzes');
define('URL_QUIZ_QUESTIONBANK', PREFIX.'exams/questionbank');
define('URL_QUIZ_ADD', PREFIX.'exams/quiz/add');
define('URL_QUIZ_EDIT', PREFIX.'exams/quiz/edit');
define('URL_QUIZ_DELETE', PREFIX.'exams/quiz/delete/');
define('URL_QUIZ_GETLIST', PREFIX.'exams/quiz/getList');
define('URL_QUIZ_UPDATE_QUESTIONS', PREFIX.'exams/quiz/update-questions/');
define('URL_QUIZ_GET_QUESTIONS', PREFIX.'exams/quiz/get-questions');

//QUIZ CATEGORIES
define('URL_QUIZ_CATEGORIES', PREFIX.'exams/categories');
define('URL_QUIZ_CATEGORY_EDIT', PREFIX.'exams/categories/edit');
define('URL_QUIZ_CATEGORY_ADD', PREFIX.'exams/categories/add');
define('URL_QUIZ_CATEGORY_DELETE', PREFIX.'exams/categories/delete/');

//QUESTIONSBANK MODULE
define('URL_QUESTIONBANK_VIEW', PREFIX.'exams/questionbank/view/');
define('URL_QUESTIONBANK_ADD_QUESTION', PREFIX.'exams/questionbank/add-question/');
define('URL_QUESTIONBANK_EDIT_QUESTION', PREFIX.'exams/questionbank/edit-question/');
define('URL_QUESTIONBANK_EDIT', PREFIX.'exams/questionbank/edit');
define('URL_QUESTIONBANK_ADD', PREFIX.'exams/questionbank/add');
define('URL_QUESTIONBANK_GETLIST', PREFIX.'exams/questionbank/getList');
define('URL_QUESTIONBANK_DELETE', PREFIX.'exams/questionbank/delete/');
define('URL_QUESTIONBANK_GETQUESTION_LIST', PREFIX.'exams/questionbank/getquestionslist/');

define('URL_QUESTIONBAMK_IMPORT', PREFIX.'exams/questionbank/import');

//SUBJECTS MODULE
define('URL_SUBJECTS', PREFIX.'mastersettings/subjects');
define('URL_SUBJECTS_ADD', PREFIX.'mastersettings/subjects/add');
define('URL_SUBJECTS_EDIT', PREFIX.'mastersettings/subjects/edit');
define('URL_SUBJECTS_DELETE', PREFIX.'mastersettings/subjects/delete/');

define('URL_SUBJECTS_IMPORT', PREFIX.'mastersettings/subjects/import');


//TOPICS MODULE
define('URL_TOPICS', PREFIX.'mastersettings/topics');
define('URL_TOPICS_LIST', PREFIX.'mastersettings/topics/list');
define('URL_TOPICS_ADD', PREFIX.'mastersettings/topics/add');
define('URL_TOPICS_EDIT', PREFIX.'mastersettings/topics/edit');
define('URL_TOPICS_DELETE', PREFIX.'mastersettings/topics/delete/');
define('URL_TOPICS_GET_PARENT_TOPICS', PREFIX.'mastersettings/topics/get-parents-topics/');

define('URL_TOPICS_IMPORT', PREFIX.'mastersettings/topics/import');
//EMAIL TEMPLATES MODULE
define('URL_EMAIL_TEMPLATES', PREFIX.'email/templates');
define('URL_EMAIL_TEMPLATES_ADD', PREFIX.'email/templates/add');
define('URL_EMAIL_TEMPLATES_EDIT', PREFIX.'email/templates/edit');
define('URL_EMAIL_TEMPLATES_VIEW', PREFIX.'email/templates/view');
define('URL_EMAIL_TEMPLATES_DUPLICATE', PREFIX.'email/templates/duplicate');
define('URL_EMAIL_TEMPLATES_DELETE', PREFIX.'email/templates/delete/');

//INSTRUCTIONS MODULE
define('URL_INSTRUCTIONS', PREFIX.'exam/instructions/list');
define('URL_INSTRUCTIONS_ADD', PREFIX.'exams/instructions/add');
define('URL_INSTRUCTIONS_EDIT', PREFIX.'exams/instructions/edit/');
define('URL_INSTRUCTIONS_DELETE', PREFIX.'exams/instructions/delete/');
define('URL_INSTRUCTIONS_GETLIST', PREFIX.'exams/instructions/getList');

//LANGUAGES MODULE
define('URL_LANGUAGES_LIST', PREFIX.'languages/list');
define('URL_LANGUAGES_ADD', PREFIX.'languages/add');
define('URL_LANGUAGES_EDIT', PREFIX.'languages/edit');
define('URL_LANGUAGES_UPDATE_STRINGS', PREFIX.'languages/update-strings/');
define('URL_LANGUAGES_DELETE', PREFIX.'languages/delete/');
define('URL_LANGUAGES_GETLIST', PREFIX.'languages/getList/');
define('URL_LANGUAGES_MAKE_DEFAULT', PREFIX.'languages/make-default/');

//SETTINGS MODULE
define('URL_SETTINGS_LIST', PREFIX.'mastersettings/settings');
define('URL_SETTINGS_VIEW', PREFIX.'mastersettings/settings/view/');
define('URL_SETTINGS_ADD', PREFIX.'mastersettings/settings/add');
define('URL_SETTINGS_EDIT', PREFIX.'mastersettings/settings/edit/');
define('URL_SETTINGS_DELETE', PREFIX.'mastersettings/settings/delete/');
define('URL_SETTINGS_GETLIST', PREFIX.'mastersettings/settings/getList/');
define('URL_SETTINGS_ADD_SUBSETTINGS', PREFIX.'mastersettings/settings/add-sub-settings/');




//CONSTANST FOR USERS MODULE
define('URL_USERS', PREFIX.'users');
define('URL_USER_DETAILS', PREFIX.'users/details/');
define('URL_USERS_EDIT', PREFIX.'users/edit/');
define('URL_MY_USERS_EDIT', PREFIX.'users/edit/');
define('URL_USERS_ADD', PREFIX.'users/create');
define('URL_USERS_DELETE', PREFIX.'users/delete/');
define('URL_USERS_SETTINGS', PREFIX.'users/settings/');
define('URL_USERS_CHANGE_PASSWORD', PREFIX.'users/change-password/');
define('URL_USERS_LOGOUT', PREFIX.'logout');
define('URL_PARENT_LOGOUT', PREFIX.'parent-logout');
define('URL_USERS_REGISTER', PREFIX.'register');
define('URL_USERS_REGISTER_INSTRUCTOR', PREFIX.'register-instructor');
define('URL_INSTRUCTOR_APPLICATION', PREFIX.'instructor');
define('URL_USERS_LOGIN', PREFIX.'login');
define('URL_AUTHADMIN_LOGIN', PREFIX.'authadmin');
define('URL_ADMIN_BACKLOGIN', PREFIX.'backtoadmin');
define('URL_USERS_LOGIN_CO', PREFIX.'loginco');
define('URL_USERS_UPDATE_PARENT_DETAILS', PREFIX.'users/parent-details/');
define('URL_USERS_ASSIGN_COURSE', PREFIX.'users/assign-course/');
define('URL_SEARCH_PARENT_RECORDS', PREFIX.'users/search/parent');

define('URL_USERS_IMPORT', PREFIX.'users/import');
define('URL_USERS_IMPORT_REPORT', PREFIX.'users/import-report');

// define('URL_FORGOT_PASSWORD', PREFIX.'users/forgot-password');
define('URL_USERS_FORGOT_PASSWORD', PREFIX.'users/forgot-password');


define('URL_RESET_PASSWORD', PREFIX.'password/reset');


//CONSTANST FOR USERS MODULE
define('URL_INSTRUCTORS', PREFIX.'instructors');
define('URL_INSTRUCTORS_DETAILS', PREFIX.'instructors/details/');
define('URL_INSTRUCTORS_EDIT', PREFIX.'instructors/edit/');
define('URL_INSTRUCTORS_ADD', PREFIX.'instructors/create');
define('URL_INSTRUCTORS_DELETE', PREFIX.'instructors/delete/');
define('URL_INSTRUCTORS_SETTINGS', PREFIX.'instructors/settings');
define('URL_INSTRUCTORS_APPLICATIONS', PREFIX.'requestinstructor');
define('URL_INSTRUCTORS_PAYOUTS', PREFIX.'instructors/settings/');

define('URL_INSTRUCTORSREQUEST_REVIEW', PREFIX.'instructorsrequests/review/');
define('URL_INSTRUCTORSREQUEST_DELETE', PREFIX.'instructorsrequests/delete/');


// Roles Module
define('URL_ROLES', PREFIX.'roles');
define('URL_ROLES_ADD', PREFIX.'roles/create');
define('URL_ROLES_EDIT', PREFIX.'roles/edit');
define('URL_ROLES_GETLIST', PREFIX.'roles/getlist');
define('URL_ROLES_DELETE', PREFIX.'roles/delete');


// Logs Module
define('URL_LOGS', PREFIX.'logs');
define('URL_LOGS_VIEW', PREFIX.'logs/view');
define('URL_LOGS_GETLIST', PREFIX.'logs/getlist');
define('URL_LOGS_DELETE', PREFIX.'logs/delete');


			///////////////////
			//STUDENT MODULE //
			///////////////////

//STUDENT NAVIGATION
define('URL_STUDENT_EXAM_CATEGORIES', PREFIX.'exams/student/categories');
define('URL_STUDENT_EXAM_ATTEMPTS', PREFIX.'exams/student/exam-attempts/');
define('URL_STUDENT_ANALYSIS_SUBJECT', PREFIX.'student/analysis/subject/');
define('URL_STUDENT_ANALYSIS_BY_EXAM', PREFIX.'student/analysis/by-exam/');
define('URL_MY_STUDENT_ANALYSIS_BY_EXAM', PREFIX.'student-dashboard/my-exam/');
define('URL_STUDENT_SUBSCRIPTIONS_PLANS', PREFIX.'subscription/plans');
define('URL_STUDENT_LIST_INVOICES', PREFIX.'subscription/list-invoices/');


///////////////////
// STUDENT EXAMS //
///////////////////
define('URL_STUDENT_EXAM_ALL', PREFIX.'exams/student/exams/all');
define('URL_STUDENT_EXAMS', PREFIX.'exams/student/exams/');
define('URL_STUDENT_QUIZ_GETLIST', PREFIX.'exams/student/quiz/getList/');
define('URL_STUDENT_QUIZ_GETLIST_ALL', PREFIX.'exams/student/quiz/getList/all');
define('URL_STUDENT_TAKE_EXAM', PREFIX.'exams/student/quiz/take-exam/');
define('URL_STUDENT_EXAM_GETATTEMPTS', PREFIX.'exams/student/get-exam-attempts/');
define('URL_STUDENT_EXAM_ANALYSIS_BYSUBJECT', PREFIX.'student/analysis/by-subject/');
define('URL_STUDENT_EXAM_ANALYSIS_BYEXAM', PREFIX.'student/analysis/get-by-exam/');
define('URL_STUDENT_EXAM_FINISH_EXAM', PREFIX.'exams/student/finish-exam/');


//PARENT NAVIGATION
define('URL_PARENT_CHILDREN', PREFIX.'parent/children');
define('URL_PARENT_CHILDREN_LIST', PREFIX.'parent/children_list');
define('URL_PARENT_CHILDREN_GETLIST', PREFIX.'parent/children/getList/');
define('URL_SUBSCRIBE', PREFIX.'subscription/subscribe/');

define('URL_PARENT_ANALYSIS_FOR_STUDENTS', PREFIX.'children/analysis');


// define('URL_STUDENT_COMPLETED_EXAMS', PREFIX.'atp_user/student/completedexams/');
// define('URL_STUDENT_GET_EXAMS', PREFIX.'atp_user/student/getexamslist/');
define('URL_STUDENT_VIEW_MARKS', PREFIX.'student/view/marks/');

//STUDENT BOOKMARKS
define('URL_BOOKMARKS', PREFIX.'student/bookmarks/');
define('URL_BOOKMARK_ADD', PREFIX.'student/bookmarks/add');
define('URL_BOOKMARK_DELETE', PREFIX.'student/bookmarks/delete/');
define('URL_BOOKMARK_DELETE_BY_ID', PREFIX.'student/bookmarks/delete_id/');
define('URL_BOOKMARK_AJAXLIST', PREFIX.'student/bookmarks/getList/');
define('URL_BOOKMARK_SAVED_BOOKMARKS', PREFIX.'student/bookmarks/getSavedList');


//EXAM SERIES
define('URL_EXAM_SERIES', PREFIX.'exams/exam-series');
define('URL_EXAM_SERIES_ADD', PREFIX.'exams/exam-series/add');
define('URL_EXAM_SERIES_DELETE', PREFIX.'exams/exam-series/delete/');
define('URL_EXAM_SERIES_EDIT', PREFIX.'exams/exam-series/edit/');
define('URL_EXAM_SERIES_AJAXLIST', PREFIX.'exams/exam-series/getList');
define('URL_EXAM_SERIES_UPDATE_SERIES', PREFIX.'exams/exam-series/update-series/');
define('URL_EXAM_SERIES_GET_EXAMS', PREFIX.'exams/exam-series/get-exams');


define('URL_STUDENT_EXAM_SERIES_LIST', PREFIX.'exams/student-exam-series/list');
define('URL_STUDENT_EXAM_SERIES_VIEW_ITEM', PREFIX.'exams/student-exam-series/');



define('URL_PAYMENTS_CHECKOUT', PREFIX.'payments/checkout/');


define('URL_PAYMENTS_LIST', PREFIX.'payments/list/');
define('URL_MY_PAYMENTS_LIST', PREFIX.'student-dashboard/my-orders/');
define('URL_PAYNOW', PREFIX.'payments/paynow/');
define('URL_STRIPE_PAYMENT_SUCCESS', PREFIX.'payments/stripe/status-success');
define('URL_PAYPAL_PAYMENT_SUCCESS', PREFIX.'payments/paypal/status-success');
define('URL_PAYPAL_PAYMENT_CANCEL', PREFIX.'payments/paypal/status-cancel');
define('URL_ORDER_THANKYOU', PREFIX.'order-thankyou');

define('URL_PAYPAL_PAYMENTS_AJAXLIST', PREFIX.'payments/getList/');

define('URL_PAYMENTS_ADMIN_LIST', PREFIX.'payments/list');
define('URL_PAYPAL_ADMIN_PAYMENTS_AJAXLIST', PREFIX.'payments/getList');

// Enquiries
define('URL_ENQUIRIES_LIST', PREFIX.'enquires/list/');
define('URL_ENQUIRIES_AJAXLIST', PREFIX.'enquires/getList/');
define('URL_ENQUIRIES_VIEW', PREFIX.'enquires/view/');

define('URL_PAYU_PAYMENT_SUCCESS', PREFIX.'payments/payu/status-success');
define('URL_PAYU_PAYMENT_CANCEL', PREFIX.'payments/payu/status-cancel');
define('URL_UPDATE_OFFLINE_PAYMENT', PREFIX.'payments/offline-payment/update');

//COUPONS MODULE
define('URL_COUPONS', PREFIX.'coupons/list');
define('URL_COUPONS_ADD', PREFIX.'coupons/add');
define('URL_COUPONS_EDIT', PREFIX.'coupons/edit/');
define('URL_COUPONS_DELETE', PREFIX.'coupons/delete/');
define('URL_COUPONS_GETLIST', PREFIX.'coupons/getList');

define('URL_COUPONS_VALIDATE', PREFIX.'coupons/validate-coupon');
define('URL_COUPONS_USAGE', PREFIX.'coupons/get-usage');
define('URL_COUPONS_USAGE_AJAXDATA', PREFIX.'coupons/get-usage-data');


//PAGES
define('URL_PAGES', PREFIX.'pages/list');
define('URL_PAGES_ADD', PREFIX.'pages/add');
define('URL_PAGES_EDIT', PREFIX.'pages/edit/');
define('URL_PAGES_DELETE', PREFIX.'pages/delete/');
define('URL_PAGES_GETLIST', PREFIX.'pages/getList');

//FRONT PAGES
define('URL_PAGE', PREFIX.'page/');

//PROMO BANNER
define('URL_PROMOBANNER_ADD', PREFIX.'promobanner');
define('URL_PROMOBANNER', PREFIX.'promobanner');


//Marketting BANNER
define('URL_MARKETTINGBANNER_ADD', PREFIX.'marketingbanner');
define('URL_MARKETTINGBANNER', PREFIX.'marketingbanner');

//All Course BANNER
define('URL_ALLCOURSE_ADD', PREFIX.'allcourseadd');
define('URL_ALLCOURSE', PREFIX.'allcourse');

//Spacial Offer's
define('URL_OFFER', PREFIX.'offer/list');
define('URL_OFFER_ADD', PREFIX.'offer/add');
define('URL_OFFER_EDIT', PREFIX.'offer/edit/');
define('URL_OFFER_DELETE', PREFIX.'offer/delete/');
define('URL_OFFER_GETLIST', PREFIX.'offer/getList');

//Subscribed Users
define('URL_SUBSCRIBED', PREFIX.'subscribed/list');
define('URL_SUBSCRIBED_GETLIST', PREFIX.'subscribed/getList');

//PROMO POPUP
define('URL_PROMOPOPUP', PREFIX.'popup/list');
define('URL_PROMOPOPUP_ADD', PREFIX.'popup/add');
define('URL_PROMOPOPUP_EDIT', PREFIX.'popup/edit/');
define('URL_PROMOPOPUP_DELETE', PREFIX.'popup/delete/');
define('URL_PROMOPOPUP_GETLIST', PREFIX.'popup/getList');

//Student ID card Admin
define('URL_STUDENTID', PREFIX.'studentid/list');
define('URL_STUDENTID_ADD', PREFIX.'studentid/add');
define('URL_STUDENTID_EDIT', PREFIX.'studentid/edit/');
define('URL_STUDENTID_DELETE', PREFIX.'studentid/delete/');
define('URL_STUDENTID_GETLIST', PREFIX.'studentid/getList');

//Certificates Admin
define('URL_CERTIFICATES', PREFIX.'certificates/list');
define('URL_CERTIFICATES_ADD', PREFIX.'certificates/add');
define('URL_CERTIFICATES_VIEW', PREFIX.'certificates/view/');
define('URL_CERTIFICATES_OPT', PREFIX.'certificates/list/');
define('URL_CERTIFICATES_GETLISTFIRST', PREFIX.'certificates/getListfirst');
define('URL_CERTIFICATES_GETLISTSECOND', PREFIX.'certificates/getListsecond');
define('URL_CERTIFICATES_DELETE', PREFIX.'certificates/delete/');
define('URL_CERTIFICATES_GETLIST', PREFIX.'certificates/getList');

//REED Certificate
define('URL_REED_CERTIFICATES', PREFIX.'certificates/list/reed');
define('URL_REED_CERTIFICATES_GETLIST', PREFIX.'reedcertificates/getList');
define('URL_REED_CERTIFICATES_VIEW', PREFIX.'reedcertificates/view/');


//Certificates Student
define('URL_STUDENT_CERTIFICATES', PREFIX.'student/certificates/list');
define('URL_MY_STUDENT_CERTIFICATES', PREFIX.'student-dashboard/my-certificates');
define('URL_STUDENT_CERTIFICATES_VIEW', PREFIX.'student/certificates/view/');
define('URL_STUDENT_CERTIFICATES_GETLIST', PREFIX.'student/certificates/getList');


//REED Certificates Student
define('URL_STUDENT_REED_CERTIFICATES', PREFIX.'student/reedcertificates/list');
define('URL_STUDENT_REED_CERTIFICATES_VIEW', PREFIX.'student/reedcertificates/view/');
define('URL_STUDENT_REED_CERTIFICATES_GETLIST', PREFIX.'student/reedcertificates/getList');


//EMAILS
define('URL_STUDENT_ID', PREFIX.'emails/list');
define('URL_STUDENT_ID_EDIT', PREFIX.'emails/edit/');
define('URL_STUDENT_ID_GETLIST', PREFIX.'emails/getList');
define('URL_CORPORATE', PREFIX.'emails/corporate');
define('URL_CORPORATE_EDIT', PREFIX.'emails/corporate/edit/');
define('URL_CORPORATE_GETLIST', PREFIX.'emails/corporategetList');

//FAQS CATEGORIES
define('URL_FAQ_CATEGORIES', PREFIX.'faq-categories');
define('URL_FAQ_CATEGORIES_ADD', PREFIX.'faq-categories/add');
define('URL_FAQ_CATEGORIES_EDIT', PREFIX.'faq-categories/edit/');
define('URL_FAQ_CATEGORIES_DELETE', PREFIX.'faq-categories/delete/');
define('URL_FAQ_CATEGORIES_GETLIST', PREFIX.'faq-categories/getList');

//FAQ QUESTIONS
define('URL_FAQ_QUESTIONS', PREFIX.'faq-questions');
define('URL_FAQ_QUESTIONS_ADD', PREFIX.'faq-questions/add');
define('URL_FAQ_QUESTIONS_EDIT', PREFIX.'faq-questions/edit/');
define('URL_FAQ_QUESTIONS_DELETE', PREFIX.'faq-questions/delete/');
define('URL_FAQ_QUESTIONS_GETLIST', PREFIX.'faq-questions/getList');

//FRONT FAQS
define('URL_FAQS', PREFIX.'faqs');


//CURRENCIES CATEGORIES
define('URL_CURRENCIES', PREFIX.'currencies');
define('URL_CURRENCIES_ADD', PREFIX.'currencies/add');
define('URL_CURRENCIES_EDIT', PREFIX.'currencies/edit/');
define('URL_CURRENCIES_DELETE', PREFIX.'currencies/delete/');
define('URL_CURRENCIES_GETLIST', PREFIX.'currencies/getList');


//REVIEWS MODULE
define('URL_REVIEWS', PREFIX.'reviews/list');
define('URL_REVIEWS_ADD', PREFIX.'reviews/add');
define('URL_REVIEWS_EDIT', PREFIX.'reviews/edit/');
define('URL_REVIEWS_DELETE', PREFIX.'reviews/delete/');
define('URL_REVIEWS_GETLIST', PREFIX.'reviews/getList');

//BLOG MODULE
define('URL_POSTS', PREFIX.'posts/list');
define('URL_POSTS_ADD', PREFIX.'posts/add');
define('URL_POSTS_EDIT', PREFIX.'posts/edit/');
define('URL_POSTS_DELETE', PREFIX.'posts/delete/');
define('URL_POSTS_GETLIST', PREFIX.'posts/getList');

//POST CATEGORIES
define('URL_POST_CATEGORIES', PREFIX.'posts/categories');
define('URL_POST_CATEGORY_EDIT', PREFIX.'posts/categories/edit');
define('URL_POST_CATEGORY_ADD', PREFIX.'posts/categories/add');
define('URL_POST_CATEGORY_DELETE', PREFIX.'posts/categories/delete/');

//TAG MODULE
define('URL_TAGS', PREFIX.'tags/list');
define('URL_TAGS_ADD', PREFIX.'tags/add');
define('URL_TAGS_EDIT', PREFIX.'tags/edit/');
define('URL_TAGS_DELETE', PREFIX.'tags/delete/');
define('URL_TAGS_GETLIST', PREFIX.'tags/getList');

//TAG CATEGORIES
define('URL_TAG_CATEGORIES', PREFIX.'tags/categories');
define('URL_TAG_CATEGORY_EDIT', PREFIX.'tags/categories/edit');
define('URL_TAG_CATEGORY_ADD', PREFIX.'tags/categories/add');
define('URL_TAG_CATEGORY_DELETE', PREFIX.'tags/categories/delete/');


//FRONT PAGES
define('URL_POST', PREFIX.'blog/');
define('URL_BLOGS', PREFIX.'posts/list');


// Notifications Module
define('URL_ADMIN_NOTIFICATIONS', PREFIX.'admin/notifications');
define('URL_ADMIN_NOTIFICATIONS_ADD', PREFIX.'admin/notifications/add');
define('URL_ADMIN_NOTIFICATIONS_EDIT', PREFIX.'admin/notifications/edit/');
define('URL_ADMIN_NOTIFICATIONS_DELETE', PREFIX.'admin/notifications/delete/');
define('URL_ADMIN_NOTIFICATIONS_GETLIST', PREFIX.'admin/notifications/getList');

//Notifications Student
define('URL_NOTIFICATIONS', PREFIX.'notifications/list');
define('URL_NOTIFICATIONS_VIEW', PREFIX.'notifications/show/');

define('URL_NOTIFICATIONS_USER', PREFIX.'student-dashboard/notifications_user');



//LMS MODULE
define('URL_LMS_CATEGORIES', PREFIX.'lms/categories');
define('URL_LMS_CATEGORIES_ADD', PREFIX.'lms/categories/add');
define('URL_LMS_CATEGORIES_EDIT', PREFIX.'lms/categories/edit/');
define('URL_LMS_SUBCATEGORIES_LIST', PREFIX.'lms/categories/edit/');
define('URL_LMS_CATEGORIES_DELETE', PREFIX.'lms/categories/delete/');
define('URL_LMS_CATEGORIES_GETLIST', PREFIX.'lms/categories/getList');

//LMS AWARDING BODIES
define('URL_LMS_AWARDINGBODIES', PREFIX.'lms/awardingbodies');
define('URL_LMS_AWARDINGBODIES_ADD', PREFIX.'lms/awardingbodies/add');
define('URL_LMS_AWARDINGBODIES_EDIT', PREFIX.'lms/awardingbodies/edit');
define('URL_LMS_AWARDINGBODIES_DELETE', PREFIX.'lms/awardingbodies/delete/');
define('URL_LMS_AWARDINGBODIES_GETLIST', PREFIX.'lms/awardingbodies/getList');
define('IMAGE_PATH_UPLOAD_LMS_AWARDING_BODIES', UPLOADS.'lms/awardingbodies/');

//LMS MODULE
define('URL_LMS_LEVELS', PREFIX.'lms/levels');
define('URL_LMS_LEVELS_ADD', PREFIX.'lms/levels/add');
define('URL_LMS_LEVELS_EDIT', PREFIX.'lms/levels/edit/');
define('URL_LMS_LEVELS_DELETE', PREFIX.'lms/levels/delete/');
define('URL_LMS_LEVELS_GETLIST', PREFIX.'lms/levels/getList');

// LMS CONTENT
define('URL_LMS_CONTENT', PREFIX.'lms/content');
define('URL_LMS_ASSIGNMENTS', PREFIX.'lms/assignments');
define('URL_LMS_CONTENT_ADD', PREFIX.'lms/content/add');
define('URL_LMS_CONTENT_EDIT', PREFIX.'lms/content/edit/');
define('URL_LMS_CONTENT_DELETE', PREFIX.'lms/content/delete/');
define('URL_LMS_CONTENT_GETLIST', PREFIX.'lms/content/getList');


//LMS SERIES
define('URL_LMS_SERIES', PREFIX.'lms/series/all');
define('URL_LMS_SERIES_ADD', PREFIX.'lms/series/add/new');
define('URL_LMS_SERIES_DELETE', PREFIX.'lms/series/delete/');
define('URL_LMS_SERIES_DELETE_MULTIPLE', PREFIX.'lms/series/deletemultiple/');
define('URL_LMS_SERIES_EDIT', PREFIX.'lms/series/edit/');
define('URL_LMS_SERIES_ADDSECTIONS', PREFIX.'lms/series/editsections/');
define('URL_LMS_SERIES_STORESECTIONS', PREFIX.'lms/series/storesections/');
define('URL_LMS_SERIES_UPDATESECTIONS', PREFIX.'lms/series/updatesections/');
define('URL_LMS_SERIES_DELETESECTIONS', PREFIX.'lms/series/deletesections/');
define('URL_LMS_SERIES_AJAXLIST', PREFIX.'lms/series/getList');
define('URL_LMS_SERIES_UPDATE_SERIES', PREFIX.'lms/series/update-series/');
define('URL_LMS_SERIES_GET_SERIES', PREFIX.'lms/series/get-series');
define('VALID_IS_PAID_TYPE', PREFIX.'user/paid/');

define('URL_LMS_SERIES_AJAXEXAMS', PREFIX.'lms/series/getExams');
define('URL_LMS_SERIES_UPDATE_EXAMS', PREFIX.'lms/series/update-exams/');
define('URL_LMS_SERIES_GET_EXAMS', PREFIX.'lms/series/get-exams');



//LMS STUDENT SERIES
define('URL_STUDENT_LMS_CATEGORIES', PREFIX.'my-courses/categories');
define('URL_STUDENT_LMS_CATEGORIES_VIEW', PREFIX.'my-courses/view/');
define('URL_STUDENT_LMS_SERIES', PREFIX.'my-courses');
define('URL_MY_STUDENT_LMS_SERIES', PREFIX.'student-dashboard/my-courses');
define('URL_STUDENT_LMS_WISHLIST', PREFIX.'my-courses/wishlists');
define('URL_MY_STUDENT_LMS_WISHLIST', PREFIX.'student-dashboard/wishlist');
define('URL_LMS_REVIEWS_ADD', PREFIX.'my-courses/storeReview');

define('URL_STUDENT_LMS_SERIES_VIEW', PREFIX.'my-courses/');


//Results Constants
define('URL_RESULTS_VIEW_ANSWERS', PREFIX.'student/exam/answers/');

 define('URL_COMPARE_WITH_TOPER', PREFIX.'toppers/compare-with-topper/');

// FEEDBACK SYSTEM
define('URL_FEEDBACK_SEND', PREFIX.'feedback/send');
define('URL_FEEDBACKS', PREFIX.'feedback/list');
define('URL_FEEDBACK_VIEW', PREFIX.'feedback/view-details/');
define('URL_FEEDBACK_EDIT', PREFIX.'feedback/edit/');
define('URL_FEEDBACK_DELETE', PREFIX.'feedback/delete/');
define('URL_FEEDBACKS_GETLIST', PREFIX.'feedback/getlist');

//MESSAGES
define('URL_MESSAGES', PREFIX.'messages');
define('URL_MY_MESSAGES', PREFIX.'student-dashboard/my-message');
define('URL_MESSAGES_SHOW', PREFIX.'messages/');
define('URL_MESSAGES_CREATE', PREFIX.'messages/create');
//MESSAGES student
define('URL_MY_MESSAGES_SHOW', PREFIX.'student-dashboard/messages/');
define('URL_MY_MESSAGES_CREATE', PREFIX.'student-dashboard/messages/create');





define('URL_GENERATE_CERTIFICATE', PREFIX.'result/generate-certificate/');


define('URL_PAYMENT_REPORTS', PREFIX.'payments-report/');
define('URL_ONLINE_PAYMENT_REPORTS', PREFIX.'payments-report/online');
define('URL_ONLINE_PAYMENT_REPORT_DETAILS', PREFIX.'payments-report/online/');
define('URL_ONLINE_PAYMENT_REPORT_DETAILS_AJAX', PREFIX.'payments-report/online/getList/');
define('URL_OFFLINE_PAYMENT_REPORTS', PREFIX.'payments-report/offline');
define('URL_OFFLINE_PAYMENT_REPORT_DETAILS', PREFIX.'payments-report/offline/');
define('URL_OFFLINE_PAYMENT_REPORT_DETAILS_AJAX', PREFIX.'payments-report/offline/getList/');

define('URL_PAYMENT_REPORT_EXPORT', PREFIX.'payments-report/export');
define('URL_GET_PAYMENT_RECORD', PREFIX.'payments-report/getRecord');
define('URL_PAYMENT_APPROVE_OFFLINE_PAYMENT', PREFIX.'payments/approve-reject-offline-request');


define('URL_SEND_SMS', PREFIX.'sms/index');
define('URL_SEND_SMS_NOW', PREFIX.'sms/send');

define('URL_FACEBOOK_LOGIN', PREFIX.'auth/facebook');
define('URL_GOOGLE_LOGIN', PREFIX.'auth/google');

//Site Pages
define('SITE_PAGES_PRIVACY', PREFIX.'site/privacy-policy');
define('SITE_PAGES_TERMS', PREFIX.'site/terms-conditions');
define('SITE_PAGES_ABOUT_US', PREFIX.'site/about-us');
define('SITE_PAGES_CONTACT_US', PREFIX.'site/contact_us');
define('URL_VIEW_SITE_COURSES', PREFIX.'site/courses');
define('URL_VIEW_SITE_PATTREN', PREFIX.'site/pattren');
define('URL_VIEW_SITE_PRICING', PREFIX.'site/pricing');
define('URL_VIEW_SITE_SYALLABUS', PREFIX.'site/syllabus');


// Front End Part
define('URL_FRONTEND_EXAMS_LIST', PREFIX.'exams/list');
define('URL_FRONTEND_START_EXAM', PREFIX. 'exams/start-exam/');
define('URL_FRONTEND_FINISH_EXAM', PREFIX. 'exams/finish-exam/');

define('IMAGE_PATH_EXAMS', UPLOADS.'exams/categories/');
define('IMAGE_PATH_EXAMS_DEFAULT', UPLOADS.'exams/categories/default.png');

//Resume Exam
define('URL_SAVE_RESUME_EXAM_DATA', PREFIX.'resume/examdata/save');


//Update DataBase
define('URL_UPDATE_DATABASE', PREFIX.'update/application');
define('URL_EXAM_TYPES', PREFIX.'exam-types');
define('URL_EDIT_EXAM_TYPE', PREFIX.'edit/exam-type/');
define('URL_UPDATE_EXAM_TYPE', PREFIX.'update/exam-type/');
define('URL_RAZORPAY_SUCCESS', PREFIX.'razoapay/success');

define('URL_SAVE_SUBSCRIPTION_EMAIL', PREFIX.'subscription/email');


//Subscribed users
define('URL_SUBSCRIBED_USERS', PREFIX.'subscribed/users');
define('URL_SUBSCRIBED_USERS_DATA', PREFIX.'subscribed/users/data');

//Enrolled users
define('URL_ENROLLED_USERS', PREFIX.'users_enrolled');
define('URL_ENROLLED_USERS_DATA', PREFIX.'users_enrolled/data');


//All exam categories
define('URL_VIEW_ALL_EXAM_CATEGORIES', PREFIX.'exam/categories');
define('URL_VIEW_ALL_PRACTICE_EXAMS', PREFIX.'practice-exams');
define('URL_VIEW_ALL_LMS_CATEGORIES', PREFIX.'courses');
define('URL_VIEW_LMS_CONTENTS', PREFIX.'course/');
define('URL_LMS_SERIES_ADD_TO_CART', PREFIX.'course');

define('URL_DOWNLOAD_LMS_CONTENT', PREFIX.'download/lms/contents/');
define('URL_LMS_VIDEO_CONTENT', PREFIX.'lms/video/');
define('URL_SITE_CONTACTUS', PREFIX.'contact_us');
define('URL_SEND_CONTACTUS', PREFIX.'send/contact_us/details');
define('URL_GET_FRONT_END_SERIES_CONTENTS', PREFIX.'get/series/contents');
define('URL_SITE_MULTICOURSE', PREFIX.'multiple_course_redeem');
define('URL_SITE_REDEEMVOUCHER', PREFIX.'redeem_a_voucher');

//Themes
define('URL_THEMES_LIST', PREFIX.'themes/list');
define('URL_THEMES_GET_DATA', PREFIX.'themes/data');
define('URL_THEME_MAKE_DEFAULT', PREFIX.'make/default/theme/');
define('URL_VIEW_THEME_SETTINGS', PREFIX.'theme/settings/');
define('URL_UPDATE_THEME_SUBSETTINGS', PREFIX.'theme/update/settings/');
define('URL_USERS_DASHBOARD', PREFIX.'dashboard');



//define('ProPayPal', 0);
//if(ProPayPal){
//    define("PayPalClientId", "ATsTXf9YbG6BmRUbPTOYA_tBd8qHtPCwOjdw1-QrfWifVn0AYtcMX7FKVoIHynEmUEYSwdHCDBPsPeAN");
//    define("PayPalSecret", "EMNpGhRJ6pWIcIWEUHjXWhX3s5D_5XS3NJkjvYdm1gzJ5SeXCW2n4cSNE7D_NItxwrOmL2K7H_GPs0x7");
//    define("PayPalBaseUrl", "https://api.paypal.com/v1/");
//    define("PayPalENV", "production");
//} else {
//    define("PayPalClientId", "ARYbyWUQ7sYk_cFmGHCqdVDhWED-s_yZJ4VMJi1Yl1RJF5f5lFOBGuQa2kJ3SSAgMDhEKxIGma_MxvTz");
//    define("PayPalSecret", "EJqNLezQGGnbAU7ZSWVTZGz4a4FdoN1tbhOxllr71R7apDO8jCmj22hJ3xup5jGIt2l_CZWo-Dg2bPa5");
//    define("PayPalBaseUrl", "https://api.sandbox.paypal.com/v1/");
//    define("PayPalENV", "sandbox");
//}

