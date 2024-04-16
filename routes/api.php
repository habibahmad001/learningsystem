<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');



if(env("ENABLEAPI") && env("ENABLEAPI") == 1) {
    Route::get('singleuser/{id}', 'SiteController@APISingleUser');
    Route::get('multipleuser', 'SiteController@APIGetAllUser');
    Route::get('singlecourse/{id}', 'SiteController@APISingleCourse');
    Route::get('multiplecourses', 'SiteController@APIAllCourses');
    Route::get('features_courses', 'SiteController@APIFeaturesCourses');
    Route::post('apilogin', 'Auth\APIController@APILogin');
    Route::post('apisignup', 'Auth\APIController@APIpostRegister');
    Route::post('enquirypost', 'SiteController@APIsendEnquiry');
    Route::post('additem', 'SiteController@APIaddToCart');
    Route::post('removeitem', 'SiteController@APIremoveToCart');
    Route::post('addwishlist', 'SiteController@APIWishlistAdd');
    Route::get('checkoutpage', 'SiteController@APICheckOut');
    Route::get('updatecartqty/{id}/{qty}', 'SiteController@APIUpdateQuantity');
    Route::get('courses/{slug?}', 'SiteController@APIbrowseData');
    Route::get('course/{slug}','SiteController@APICourseDetail');
    Route::get('coursedetail/{slug}','SiteController@APICourseDetail');
    Route::get('searchfilter/{slug}','SiteController@APICourseDetail');
    Route::get('searchcourse', 'SiteController@APIfrontSearchCourses');
    Route::post('addpost', 'SiteController@APIaddPost');
}
