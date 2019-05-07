<?php





Auth::routes();
Route::get('getstarted/{manager_id}', 'Auth\RegisterController@showRegistrationForm');

Route::get('/', 'mailingNinjaController@home');

Route::get('/test','managerController@test');


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/preview/email/{code}/link', 'htmlEmail@previewEmailLink');
Route::get('/preview/email/{code}/unsubscribe', 'htmlEmail@previewEmailUnsubscribe');
Route::get('/preview/email/{code}', 'htmlEmail@previewEmail');
Route::get('/preview/email/id/{id}', 'htmlEmail@previewEmailId');
Route::get('/download/email/{code}', 'htmlEmail@downloadEmail');
Route::get('/download/email/screenshot/{code}', 'htmlEmail@screenshotEmailDownload');

Route::get('/{code}/tracking/{email?}', 'trackingController@open');

Route::pattern('code', '[A-Z]{5}');
Route::get('/{code}/{email?}', 'landingController@publisherLanding')->name('publisher-landing');

Route::pattern('id', '[0-9]+');

Route::get('/preview/{id}', 'landingController@previewLanding')->name('preview');
Route::get('/ebook/{id}', 'landingController@hostLanding')->name('host-landing');


Route::get('/related/{offer_id}', 'landingController@showRelatedBooks');
Route::get('/books/{category}', 'landingController@showVerticalBooks');




Route::get('/check', 'publisherController@refreshEPC');


Route::get('/{code}/subscribe/{email}', 'subscribeController@subscribe');


Route::get('/confirm/{email}', 'subscribeController@confirmSub');

Route::post('/', 'subscribeController@subscribePost');

Route::get('/unsubscribe/{email?}', 'subscribeController@unsubscribe');

Route::post('/unsubscribe', 'subscribeController@unsubscribe');

Route::get('/buy', 'landingController@register');
Route::post('/buy', 'landingController@register');


Route::post('saveContact', 'ContactController@saveContact');




//costumer

Route::get('/members', 'costumerController@home')->name('costumer-home');
Route::get('/ebooks', 'costumerController@ebooks')->name('ebooks');
Route::get('/members/cancel/{id}', 'costumerController@cancel_product')->name('cancel-product');
Route::get('/pay/{invoice}', 'PaymentController@RedirectToPayment')->name('paypal-invoice');
Route::get('/download/{id}', 'costumerController@download')->name('costumer-download');
Route::get('/contact', 'costumerController@contact')->name('costumer-contact');

Route::post('/ipn/paypal','PaymentController@paypalIPN');
Route::get('/ipn/paypal','PaymentController@paypalIPN');





Route::group(array('domain' => 'premiumbooks.net'), function() {
    Route::any( '(.*)', 'mailingNinjaController@home');
    Route::post('/ipn/paypal','PaymentController@paypalIPN');
    Route::get('/ipn/paypal','PaymentController@paypalIPN');

});

    Route::get('/home', 'mailingNinjaController@home');
    Route::get('/welcome', 'mailingNinjaController@welcome');





    Route::get('/publisher', 'publisherController@home')->name('publisher-home');

    Route::get('/publisher/offers/download-subscribers/{id}', 'publisherController@offerSubscribers')->name('publisher-offer-subscribers');

    Route::get('/publisher/account', 'publisherController@account')->name('publisher-account');


    Route::get('/publisher/statistics', 'publisherController@userStats')->name('publisher-statistics');

    Route::get('/publisher/dashboard', 'publisherController@dashboard')->name('publisher-dashboard');
    Route::get('/publisher/offers', 'publisherController@offers')->name('publisher-offers');

    Route::get('/publisher/offers/{id}', 'publisherController@offer')->name('promote-offer');
    Route::post('/publisher/offers/{id?}', 'publisherController@offerSetPrice')->name('offer-set-price');

    Route::get('/publisher/offers/stats/{offer_id}', 'publisherController@offerStats')->name('offer-stats');

    Route::get('/publisher/offers/subscribed/{id}', 'publisherController@offerSubscribed')->name('offer-subscribed');

    Route::get('/publisher/suppression/{id}', 'publisherController@suppressionList')->name('suppression-list');
    Route::get('/publisher/support', 'publisherController@support')->name('publisher-support');
    Route::get('/publisher/subscribers', 'publisherController@subscribers')->name('publisher-subscribers');
    Route::post('/publisher/subscribers', 'publisherController@downloadSubscribers')->name('download-subscribers');



    Route::get('/manager/download/{id}', 'managerController@downloadProduct')->name('manager-product-download');
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


    Route::get('/manager/publishers/{id}', 'managerController@publisher')->name('edit-publisher');
    Route::get('/manager/publishers/{id}/offers', 'managerController@publisherPrivateOffers')->name('publisher-private-offers');
    Route::delete('/manager/publishers/{publisher_id}/offers/destroy/{id}', 'managerController@destroyPublisherOffer')->name('publisher-offer-destroy');
    Route::get('/manager/publishers/{id}/stats', 'managerController@publisherStats')->name('publisher-stats');

    Route::post('/manager/publishers/offers', 'managerController@assignOffer')->name('assign-offers');
    Route::get('/manager/statistics', 'managerController@globalStats')->name('manager-statistics');
    Route::get('/manager/offers/stats/{offer_id}', 'managerController@globalOfferStats')->name('global-offer-stats');
    Route::get('/manager/offers/activate/{offer_id}', 'managerController@globalOfferActivate')->name('global-offer-activate');

//summernote store route
    Route::post('/manager/offers/new','managerController@storeOffer')->name('store-offer');
    Route::post('/manager/offers/edit','managerController@updateOffer')->name('update-offer');
    Route::post('/manager/offers/edit/landing','managerController@updateLanding')->name('update-landing');
    Route::post('/manager/offers/edit/promo','managerController@updatePromo')->name('update-promo');


//summernote display route
    Route::get('/summernote_display','landingController@show')->name('summernoteDispay');

    Route::post('/account','userController@updateInfo')->name('updateInfo');

//});



