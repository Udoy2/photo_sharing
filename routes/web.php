<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth','admin']);




Route::get('shares/{project}/{ulid}', 'PublicController@get_link_record')->name('share-link');
Route::post('shares/login', 'PublicController@login_as_client');
Route::group(['middleware' => ['auth','client']], function () {
    Route::get('shares/review/{project}/{ulid}', 'PublicController@get_selected_link_record_and_review')->name('share-link-review');
    Route::post('selected/images', 'PublicController@get_selected_images')->name('get-selected-images');

    Route::post('get/images/{folder_id}', 'PublicController@get_images')->name('get-images');

    

    Route::post('save/review', 'PublicController@save_review_photos')->name('save-review-select-photos');
});



Route::group(['prefix'=>'admin','middleware' => ['auth','admin']], function () {
    

    Route::resource('clients', 'ClientController');
    Route::resource('projects', 'ProjectController');
    Route::resource('folders', 'FolderController');
    Route::get('folers/create/folder/{id}','FolderController@create_new_folder')->name('folders.create_new_folder_show');
    Route::resource('photos', 'PhotoController');   
    Route::resource('shares', 'ShareController');   
    Route::resource('reviews', 'ReviewController');
    
    Route::get('export/csv/{id}', 'ReviewController@export_csv')->name('export-csv');
});