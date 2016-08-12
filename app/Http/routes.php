<?php

/*
 * |-------------------------------------------------------------------------- | Application Routes |-------------------------------------------------------------------------- | | Here is where you can register all of the routes for an application. | It's a breeze. Simply tell Laravel the URIs it should respond to | and give it the controller to call when that URI is requested. |
 */

Route::get ( '/', 'PagesController@home' );

Route::get('/facebook', function (){
	return view('facebook');
});

Route::get ( '/{type}', 'PagesController@getPage' );

Route::get ( '/{type1}/{type2}', 'PagesController@getPage2' );

Route::get ( '/{type1}/{type}/{type3}', 'PagesController@getPage3' );

Route::post ( '/', 'FormController@post0' );

Route::post ( '/{type1}', 'FormController@post1' );

Route::post ( '/{type1}/{type2}', 'FormController@post2' );


