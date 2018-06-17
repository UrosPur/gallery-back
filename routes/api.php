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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->post('/login','Auth\LoginController@authenticate')->name('login');

Route::middleware('api')->post('/register','RegisterController@store')->name('register');


Route::middleware('api')->get('/galleries','GalleryController@index')->name('galleries');

Route::middleware('api')->get('/galleries/{id}','GalleryController@show')->name('gallery');


Route::middleware('jwt')->post('/galleries','GalleryController@store')->name('gallery-store');
Route::middleware('jwt')->put('/galleries/{id}','GalleryController@update')->name('gallery-update');
Route::middleware('jwt')->delete('/delete-gallery/{id}','GalleryController@delete')->name('delete');

Route::middleware('jwt')->get('/my-galleries/{id}','GalleryController@singleUserGalleries')->name('profile');
Route::middleware('jwt')->get('/author-galleries/{id}','GalleryController@singleAuthorGalleries')->name('profile');


