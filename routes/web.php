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
Route::prefix('/questionnaire_bbs')->group(function () {
    Route::get('/','pagesController@index');
    Route::get('/logout','pagesController@logout');
    Route::get('/home', 'pagesController@index');
    Route::post('/delete','pagesController@delete');
    Route::middleware(['auth'])->group(function () {
        Route::get('/mypage','pagesController@mypage');
        Route::get('/makeQ','pagesController@makeQ');
        Route::post('/sendQ','pagesController@sendQ');
        Route::get('/detail','pagesController@detail');
        Route::post('/submit','pagesController@submit');
    });
    Auth::routes();
});

