<?php

use App\Http\Controllers\HomeFrontEndController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeFrontEndController::class)->group(function () {
    Route::get('/', 'index')->name('home-front-end');
    Route::get('/menu', 'menu')->name('menu-front-end');
    Route::get('/menu/{slug}', 'menuDetail');
    Route::get('/schedule', 'schedule')->name('schedule-front-end');
    Route::get('/blog', 'blog')->name('blog-front-end');
    Route::get('/blog/{slug}', 'blogDetail');
    Route::get('/contact', 'contact')->name('contact-front-end');
    Route::post('/contact-store', 'contactStore')->name('contact-store-front-end');

    Route::get('/faq', 'faq')->name('faq-front-end');
});
