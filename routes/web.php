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



Auth::routes();

Route::post('saveContact', 'ContactController@saveContact');


Route::group(array('domain' => 'premiumbooks.net'), function() {
    Route::get('/', 'landingController@home');
    Route::get('/private', 'costumerController@home');


});


//Route::group(array('domain' => 'mailing.ninja'), function() {
    Route::get('/home', 'homeController@redirect');



    Route::get('/', 'mailingNinjaController@home');
    Route::get('/contact', 'mailingNinjaController@contact')->name('contact');


    Route::get('/preview/{id}/{n}', 'landingController@preview')->name('preview');

    Route::get('/publisher', 'publisherController@home')->name('publisher-home');
    Route::get('/publisher/account', 'publisherController@account')->name('publisher-account');
    Route::get('/publisher/dashboard', 'publisherController@dashboard')->name('publisher-dashboard');
    Route::get('/publisher/offers', 'publisherController@offers')->name('publisher-offers');

    Route::get('/publisher/offers/{id}', 'publisherController@offer')->name('promote-offer');


    Route::get('/publisher/offers/stats/{id}', 'publisherController@offerStats')->name('offer-stats');

    Route::get('/publisher/offers/subscribed/{id}', 'publisherController@offerSubscribed')->name('offer-subscribed');

    Route::get('/publisher/support', 'publisherController@support')->name('publisher-support');
    Route::get('/publisher/subscribers', 'publisherController@subscribers')->name('publisher-subscribers');




    Route::get('/manager', 'managerController@home')->name('manager-home');
    Route::get('/manager/account', 'managerController@account')->name('manager-account');
    Route::get('/manager/dashboard', 'managerController@home')->name('manager-dashboard');

    Route::get('/manager/offers/new', 'managerController@new')->name('offers-new');

    Route::delete('/manager/offers/destroy', 'managerController@destroyOffer')->name('offers-destroy');

    Route::get('/manager/offers/edit/{id}', 'managerController@edit')->name('offers-edit');

    Route::get('/manager/offers/edit/{id}/landing/{n}', 'managerController@editLanding')->name('offers-edit-landing');

    Route::get('/manager/offers/edit/{id}/promo', 'managerController@editPromo')->name('offers-edit-promo');

    Route::get('/manager/offers', 'managerController@offers')->name('offers-manage');
    Route::get('/manager/publishers', 'managerController@publishers')->name('manage-publishers');
    Route::get('/manager/publishers/{id}', 'managerController@publisher')->name('edit-publisher');
    Route::delete('/manager/publishers/destroy', 'managerController@destroyOffer')->name('publisher-destroy');

    Route::get('/manager/publishers/deactivate/{id}/{status}', 'managerController@activePublisher')->name('publisher-status');

//summernote store route
    Route::post('/manager/offers/new','managerController@storeOffer')->name('store-offer');
    Route::post('/manager/offers/edit','managerController@updateOffer')->name('update-offer');
    Route::post('/manager/offers/edit/landing','managerController@updateLanding')->name('update-landing');
    Route::post('/manager/offers/edit/promo','managerController@updatePromo')->name('update-promo');


//summernote display route
    Route::get('/summernote_display','landingController@show')->name('summernoteDispay');



//});



