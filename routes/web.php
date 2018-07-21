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

Route::group(array('domain' => 'premiumbooks.net'), function()
{
    Route::get('/', 'landingController@home');
    Route::get('/private', 'costumerController@home');

});


Route::group(array('domain' => 'mailing.ninja'), function()
{
    Route::get('/', 'mailingNinjaController@home');
    Route::get('/home', 'homeController@redirect');

    Route::get('/manager', 'managerController@home');
    Route::get('/publisher', 'publisherController@home');


});



