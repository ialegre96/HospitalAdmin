<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['xss','languageChangeName']], function () {
    Route::get('/', 'Landing\LandingScreenController@index')->name('landing.home');
    Route::get('/about-us', 'Landing\LandingScreenController@aboutUs')->name('landing.about.us');
    Route::get('/our-services', 'Landing\LandingScreenController@services')->name('landing.services');
    Route::get('/pricing', 'Landing\LandingScreenController@pricing')->name('landing.pricing');
    Route::get('/contact-us', 'Landing\LandingScreenController@contactUs')->name('landing.contact.us');
    Route::get('/faqs', 'Landing\LandingScreenController@faq')->name('landing.faq');
    Route::post('/subscribe', 'Landing\SubscribeController@store')->name('subscribe.store');
    Route::post('/enquiries', 'SuperAdminEnquiryController@store')->name('super.admin.enquiry.store');
});
