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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/lessons', function () {
    return view('lessons.index');
})->name('lessons.index');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/blog/{category_name}', function ($category_name) {
    $category        = new StdClass;
    $category->title = 'カテゴリ1';
    $category->name  = $category_name;
    return view('category', ['category' => $category]);
})->where('category_name', '[A-Za-z]+')->name('category');

Route::get('/blog/{category_name}/{id}', function ($category_name, $id) {
    $category        = new StdClass;
    $category->id    = 1;
    $category->title = 'カテゴリ1';
    $category->name  = $category_name;

    $post            = new StdClass;
    $post->id        = $id;
    $post->title     = "ポスト{$id}";
    $post->category  = $category;
    return view('post', ['post' => $post]);
})->where('category_name', '[A-Za-z]+')->where('id', '[0-9]+')->name('post');
