<?php

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('categories', 'CategoriesController');

Route::resource('posts', 'PostsController') -> middleware('auth');

Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');

Route::put('restore-post/{post}', 'PostsController@restore')->name('restore-post');
