<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CmsManagementController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GroupMenuController;
use App\Http\Controllers\HomeCmsController;
use App\Http\Controllers\MasterMenuController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TitleMenuController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cms'], function () {
    Route::middleware('guest')->group(function () {
        Route::get('register', [RegisteredUserController::class, 'create'])
            ->name('register');

        Route::post('register', [RegisteredUserController::class, 'store']);

        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.update');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
        Route::controller(HomeCmsController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('home-cms');
            Route::get('/', function () {
                return redirect()->route('home-cms');
            });
        });

        Route::group(['prefix' => 'settings'], function () {
            Route::controller(UserController::class)->group(function () {
                Route::group(['prefix' => 'user'], function () {
                    Route::get('/index', 'index')->name('user');
                    Route::get('/datatable', 'datatable')->name('datatable-user');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-user');
                    Route::get('/edit', 'edit')->name('edit-user');
                    Route::post('/store', 'store')->name('store-user');
                    Route::post('/update', 'update')->name('update-user');
                    Route::post('/destroy', 'destroy')->name('destroy-user');
                });
            });

            Route::controller(TitleMenuController::class)->group(function () {
                Route::group(['prefix' => 'title-menu'], function () {
                    Route::get('/index', 'index')->name('title-menu');
                    Route::get('/datatable', 'datatable')->name('datatable-title-menu');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-title-menu');
                    Route::get('/edit', 'edit')->name('edit-title-menu');
                    Route::get('/sequence', 'sequence')->name('sequence-title-menu');
                    Route::post('/store', 'store')->name('store-title-menu');
                    Route::post('/update', 'update')->name('update-title-menu');
                    Route::post('/destroy', 'destroy')->name('destroy-title-menu');
                });
            });

            Route::controller(GroupMenuController::class)->group(function () {
                Route::group(['prefix' => 'group-menu'], function () {
                    Route::get('/index', 'index')->name('group-menu');
                    Route::get('/datatable', 'datatable')->name('datatable-group-menu');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-group-menu');
                    Route::get('/edit', 'edit')->name('edit-group-menu');
                    Route::get('/sequence', 'sequence')->name('sequence-group-menu');
                    Route::post('/store', 'store')->name('store-group-menu');
                    Route::post('/update', 'update')->name('update-group-menu');
                    Route::post('/destroy', 'destroy')->name('destroy-group-menu');
                });
            });

            Route::controller(MenuController::class)->group(function () {
                Route::group(['prefix' => 'menu'], function () {
                    Route::get('/index', 'index')->name('menu');
                    Route::get('/datatable', 'datatable')->name('datatable-menu');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-menu');
                    Route::get('/edit', 'edit')->name('edit-menu');
                    Route::get('/sequence', 'sequence')->name('sequence-menu');
                    Route::post('/store', 'store')->name('store-menu');
                    Route::post('/update', 'update')->name('update-menu');
                    Route::post('/destroy', 'destroy')->name('destroy-menu');
                });
            });
        });


        Route::group(['prefix' => 'privileges'], function () {
            Route::controller(PrivilegeController::class)->group(function () {
                Route::group(['prefix' => 'privilege'], function () {
                    Route::get('/index', 'index')->name('privilege');
                    Route::get('/datatable', 'datatable')->name('datatable-privilege');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-privilege');
                    Route::get('/edit', 'edit')->name('edit-privilege');
                    Route::get('/sequence', 'sequence')->name('sequence-privilege');
                    Route::post('/store', 'store')->name('store-privilege');
                    Route::post('/update', 'update')->name('update-privilege');
                    Route::post('/destroy', 'destroy')->name('destroy-privilege');
                });
            });
            Route::controller(RoleController::class)->group(function () {
                Route::group(['prefix' => 'role'], function () {
                    Route::get('/index', 'index')->name('role');
                    Route::get('/datatable', 'datatable')->name('datatable-role');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-role');
                    Route::get('/edit', 'edit')->name('edit-role');
                    Route::get('/sequence', 'sequence')->name('sequence-role');
                    Route::post('/store', 'store')->name('store-role');
                    Route::post('/update', 'update')->name('update-role');
                    Route::post('/destroy', 'destroy')->name('destroy-role');
                });
            });
        });

        Route::group(['prefix' => 'master'], function () {
            Route::controller(TableController::class)->group(function () {
                Route::group(['prefix' => 'table'], function () {
                    Route::get('/index', 'index')->name('table');
                    Route::get('/datatable', 'datatable')->name('datatable-table');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-table');
                    Route::get('/edit', 'edit')->name('edit-table');
                    Route::get('/sequence', 'sequence')->name('sequence-table');
                    Route::post('/store', 'store')->name('store-table');
                    Route::post('/update', 'update')->name('update-table');
                    Route::post('/destroy', 'destroy')->name('destroy-table');
                });
            });

            Route::controller(PaymentMethodController::class)->group(function () {
                Route::group(['prefix' => 'payment-method'], function () {
                    Route::get('/index', 'index')->name('payment-method');
                    Route::get('/datatable', 'datatable')->name('datatable-payment-method');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-payment-method');
                    Route::get('/edit', 'edit')->name('edit-payment-method');
                    Route::get('/sequence', 'sequence')->name('sequence-payment-method');
                    Route::post('/store', 'store')->name('store-payment-method');
                    Route::post('/update', 'update')->name('update-payment-method');
                    Route::post('/destroy', 'destroy')->name('destroy-payment-method');
                });
            });

            Route::controller(CategoryController::class)->group(function () {
                Route::group(['prefix' => 'category'], function () {
                    Route::get('/index', 'index')->name('category');
                    Route::get('/datatable', 'datatable')->name('datatable-category');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-category');
                    Route::get('/edit', 'edit')->name('edit-category');
                    Route::get('/sequence', 'sequence')->name('sequence-category');
                    Route::post('/store', 'store')->name('store-category');
                    Route::post('/update', 'update')->name('update-category');
                    Route::post('/destroy', 'destroy')->name('destroy-category');
                });
            });
            Route::controller(MasterMenuController::class)->group(function () {
                Route::group(['prefix' => 'master-menu'], function () {
                    Route::get('/index', 'index')->name('master-menu');
                    Route::get('/datatable', 'datatable')->name('datatable-master-menu');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-master-menu');
                    Route::get('/ganti-favorite', 'gantiFavorite')->name('ganti-favorite-master-menu');
                    Route::get('/edit', 'edit')->name('edit-master-menu');
                    Route::get('/sequence', 'sequence')->name('sequence-master-menu');
                    Route::post('/store', 'store')->name('store-master-menu');
                    Route::post('/update', 'update')->name('update-master-menu');
                    Route::post('/destroy', 'destroy')->name('destroy-master-menu');
                });
            });
        });

        Route::group(['prefix' => 'content-management'], function () {
            Route::controller(BlogController::class)->group(function () {
                Route::group(['prefix' => 'blog'], function () {
                    Route::get('/index', 'index')->name('blog');
                    Route::get('/datatable', 'datatable')->name('datatable-blog');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-blog');
                    Route::get('/edit', 'edit')->name('edit-blog');
                    Route::get('/sequence', 'sequence')->name('sequence-blog');
                    Route::post('/store', 'store')->name('store-blog');
                    Route::post('/update', 'update')->name('update-blog');
                    Route::post('/destroy', 'destroy')->name('destroy-blog');
                });
            });

            Route::controller(GalleryController::class)->group(function () {
                Route::group(['prefix' => 'gallery'], function () {
                    Route::get('/index', 'index')->name('gallery');
                    Route::get('/datatable', 'datatable')->name('datatable-gallery');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-gallery');
                    Route::get('/edit', 'edit')->name('edit-gallery');
                    Route::get('/sequence', 'sequence')->name('sequence-gallery');
                    Route::post('/store', 'store')->name('store-gallery');
                    Route::post('/update', 'update')->name('update-gallery');
                    Route::post('/destroy', 'destroy')->name('destroy-gallery');
                });
            });

            Route::controller(ScheduleController::class)->group(function () {
                Route::group(['prefix' => 'schedule'], function () {
                    Route::get('/index', 'index')->name('schedule');
                    Route::get('/datatable', 'datatable')->name('datatable-schedule');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-schedule');
                    Route::get('/edit', 'edit')->name('edit-schedule');
                    Route::get('/get-menu', 'getMenu')->name('get-menu-schedule');
                    Route::get('/refresh-calendar', 'refreshCalendar')->name('refresh-calendar-schedule');
                    Route::get('/sequence', 'sequence')->name('sequence-schedule');
                    Route::post('/store', 'store')->name('store-schedule');
                    Route::post('/update', 'update')->name('update-schedule');
                    Route::post('/destroy', 'destroy')->name('destroy-schedule');
                });
            });

            Route::controller(ContactController::class)->group(function () {
                Route::group(['prefix' => 'contact'], function () {
                    Route::get('/index', 'index')->name('contact');
                    Route::get('/datatable', 'datatable')->name('datatable-contact');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-contact');
                    Route::get('/edit', 'edit')->name('edit-contact');
                    Route::get('/sequence', 'sequence')->name('sequence-contact');
                    Route::post('/store', 'store')->name('store-contact');
                    Route::post('/update', 'update')->name('update-contact');
                    Route::post('/destroy', 'destroy')->name('destroy-contact');
                });
            });

            Route::controller(CmsManagementController::class)->group(function () {
                Route::group(['prefix' => 'cms-management'], function () {
                    Route::get('/index', 'index')->name('cms-management');
                    Route::get('/datatable', 'datatable')->name('datatable-cms-management');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-cms-management');
                    Route::get('/edit', 'edit')->name('edit-cms-management');
                    Route::get('/sequence', 'sequence')->name('sequence-cms-management');
                    Route::post('/store', 'store')->name('store-cms-management');
                    Route::post('/update', 'update')->name('update-cms-management');
                    Route::post('/destroy', 'destroy')->name('destroy-cms-management');
                });
            });

            Route::controller(FaqController::class)->group(function () {
                Route::group(['prefix' => 'faq'], function () {
                    Route::get('/index', 'index')->name('faq');
                    Route::get('/datatable', 'datatable')->name('datatable-faq');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-faq');
                    Route::get('/edit', 'edit')->name('edit-faq');
                    Route::get('/sequence', 'sequence')->name('sequence-faq');
                    Route::post('/store', 'store')->name('store-faq');
                    Route::post('/update', 'update')->name('update-faq');
                    Route::post('/destroy', 'destroy')->name('destroy-faq');
                });
            });

            Route::controller(CmsManagementController::class)->group(function () {
                Route::group(['prefix' => 'front-end-management'], function () {
                    Route::get('/index', 'index')->name('front-end-management');
                    Route::get('/datatable', 'datatable')->name('datatable-front-end-management');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-front-end-management');
                    Route::get('/edit', 'edit')->name('edit-front-end-management');
                    Route::get('/sequence', 'sequence')->name('sequence-front-end-management');
                    Route::post('/store', 'store')->name('store-front-end-management');
                    Route::post('/update', 'update')->name('update-front-end-management');
                    Route::post('/destroy', 'destroy')->name('destroy-front-end-management');
                });
            });
        });

        Route::group(['prefix' => 'transaksi'], function () {
            Route::controller(ReservationController::class)->group(function () {
                Route::group(['prefix' => 'reservation'], function () {
                    Route::get('/index', 'index')->name('reservation');
                    Route::get('/datatable', 'datatable')->name('datatable-reservation');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-reservation');
                    Route::get('/edit', 'edit')->name('edit-reservation');
                    Route::get('/sequence', 'sequence')->name('sequence-reservation');
                    Route::post('/store', 'store')->name('store-reservation');
                    Route::post('/update', 'update')->name('update-reservation');
                    Route::post('/destroy', 'destroy')->name('destroy-reservation');
                });
            });

            Route::controller(CashierController::class)->group(function () {
                Route::group(['prefix' => 'cashier'], function () {
                    Route::get('/index', 'index')->name('cashier');
                    Route::get('/datatable', 'datatable')->name('datatable-cashier');
                    Route::get('/ganti-status', 'gantiStatus')->name('ganti-status-cashier');
                    Route::get('/edit', 'edit')->name('edit-cashier');
                    Route::get('/sequence', 'sequence')->name('sequence-cashier');
                    Route::post('/store', 'store')->name('store-cashier');
                    Route::post('/update', 'update')->name('update-cashier');
                    Route::post('/destroy', 'destroy')->name('destroy-cashier');

                    Route::get('/get-data-detail', 'getDataDetail')->name('get-data-detail');
                });
            });
        });
    });
});
