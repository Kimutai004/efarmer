<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Efarmer Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');


/*
|--------------------------------------------------------------------------
| Goats
|--------------------------------------------------------------------------
*/

Route::get('/goats', function () {
    return view('goats.index');
})->name('goats.index');


Route::get('/goats/{id}', function ($id) {
    return view('goats.show', compact('id'));
})->name('goats.show');


/*
|--------------------------------------------------------------------------
| Seller
|--------------------------------------------------------------------------
*/

Route::get('/sell-your-goat', function () {
    return view('seller.create');
})->name('seller.create');


/*
|--------------------------------------------------------------------------
| Information Pages
|--------------------------------------------------------------------------
*/

Route::get('/how-it-works', function () {
    return view('pages.how-it-works');
})->name('how-it-works');


Route::get('/about', function () {
    return view('pages.about');
})->name('about');


Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');


Route::get('/buying-guide', function () {
    return view('pages.buying-guide');
})->name('buying-guide');


Route::get('/faqs', function () {
    return view('pages.faqs');
})->name('faqs');


Route::get('/shipping-delivery', function () {
    return view('pages.shipping');
})->name('shipping');


Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');


Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');


/*
|--------------------------------------------------------------------------
| Blog
|--------------------------------------------------------------------------
*/

Route::get('/blog', function () {
    return view('blog.index');
})->name('blog.index');


Route::get('/blog/{slug}', function ($slug) {
    return view('blog.show', compact('slug'));
})->name('blog.show');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::get('/register', function () {
    return view('auth.register');
})->name('register');