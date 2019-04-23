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

Route::get('/',function(){

	return redirect('/referral');

});

Route::get('/{any}','Web\WebController@index');

Route::get('/api/referral/{cat}/{id}','Api\ReferralController@show');

Route::post('/api/referral/{cat}/{id}','Api\ReferralController@update_referral');

Route::get('/api/search/referral/{cat_id}/{id}','Api\ReferraReturnController@referral_search');

Route::get('/api/pdf/referral/{cat_id}/{control_id}','Api\ReferraReturnController@pdf_referral');

Route::get('/api/excel/referral/{cat_id}','Api\ReferraReturnController@excel_referral');

Route::delete('/api/referral/{cat_id}/{id}','Api\ReferraReturnController@delete_referral');