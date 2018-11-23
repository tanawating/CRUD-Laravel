<?php

/*

	created by => tanawat.info
	form source code => https://github.com/tanawating

*/

Route::get('/', function () 
{
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/member/getData', 'HomeController@getData');
Route::post('/member/create', 'HomeController@create');
Route::post('/member/update', 'HomeController@update');
Route::get('/member/edit/{id}', 'HomeController@edit');
Route::get('/member/delete/{id}', 'HomeController@delete');
