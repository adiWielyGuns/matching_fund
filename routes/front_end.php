<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/order', 'order')->name('order');
    Route::get('/receipt', 'receipt')->name('receipt');
});

Route::controller(ApiController::class)->group(function () {
    Route::post('/checkIfCodeExist', 'checkIfCodeExist')->name('checkIfCodeExist');
    Route::post('/submit-reservasi', 'submitReservasi')->name('submitReservasi');
    Route::post('/order-notifier', 'orderNotifier')->name('orderNotifier');
    Route::post('/process-order', 'processOrder')->name('processOrder');
    Route::post('/check-transaction', 'checkTransaction')->name('checkTransaction');
    Route::post('/progress-menu', 'progressMenu')->name('progressMenu');
    Route::post('/check-location', 'checkLocation')->name('checkLocation');
    Route::post('/cancel-order', 'cancelOrder')->name('cancelOrder');
    // Route::get('/menu', 'menu')->name('menu-front-end');
    // Route::get('/menu/{slug}', 'menuDetail');
    // Route::get('/schedule', 'schedule')->name('schedule-front-end');
    // Route::get('/blog', 'blog')->name('blog-front-end');
    // Route::get('/blog/{slug}', 'blogDetail');
    // Route::get('/contact', 'contact')->name('contact-front-end');
    // Route::post('/contact-store', 'contactStore')->name('contact-store-front-end');

    // Route::get('/faq', 'faq')->name('faq-front-end');
});
