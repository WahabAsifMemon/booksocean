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
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
        Route::resource('category', 'CategoryController');
     /*   Route::post('UpdateStatus', 'StatusController@status');
*/       Route::get('author/status_active', 'AuthorController@status_active')->name('author.status.active');
        Route::get('author/status_deactive', 'AuthorController@status_deactive')->name('author.status.deactive');
        Route::get('author/delete_all', 'AuthorController@delete_all')->name('author.delete.all');
        Route::put('author/{id}/status', 'AuthorController@status');
        Route::Resource('author','AuthorController');

        
        Route::resource('team', 'TeamController');
        Route::resource('media', 'MediaController');
            Route::put('media/{id}/status', 'MediaController@status');

        Route::resource('book', 'BookController');
            Route::put('book/{id}/status', 'BookController@status');
            Route::post('/deleteSelectedAuthor',[AuthorController::class,'deleteSelectedAuthor'])->name('delete.selected.Author');

        Route::post('/updatepassword', 'HomeController@update_password')->name('update.password');
        Route::put('/profile/update', 'HomeController@profile_update')->name('profile.update');
        Route::get('/profile', 'HomeController@profile');

});





Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');



Route::get('/about', 'MainController@about');
Route::get('/gallery', 'MainController@gallery');
Route::get('/blog', 'MainController@blog');
Route::get('/author', 'MainController@author');
Route::get('/author_detail/{slug}', 'MainController@author_detail');
Route::get('/contact', 'MainController@contact');

Route::get('/book_detail/{slug}', 'BookController@detail')->name('book.detail');
Route::get('/category_detail/{slug}', 'CategoryController@detail')->name('category.detail');

Route::get('/', 'MainController@index');
