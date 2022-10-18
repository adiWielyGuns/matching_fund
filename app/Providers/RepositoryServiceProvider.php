<?php

namespace App\Providers;

use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CmsManagementRepositoryInterface;
use App\Interfaces\ContactRepositoryInterface;
use App\Interfaces\FaqRepositoryInterface;
use App\Interfaces\GalleryRepositoryInterface;
use App\Interfaces\GroupMenuRepositoryInterface;
use App\Interfaces\MasterMenuRepositoryInterface;
use App\Interfaces\MenuRepositoryInterface;
use App\Interfaces\PaymentMethodRepositoryInterface;
use App\Interfaces\PrivilegeRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\ScheduleRepositoryInterface;
use App\Interfaces\TableRepositoryInterface;
use App\Interfaces\TitleMenuRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\BlogRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CmsManagementRepository;
use App\Repositories\ContactRepository;
use App\Repositories\FaqRepository;
use App\Repositories\GalleryRepository;
use App\Repositories\GroupMenuRepository;
use App\Repositories\MasterMenuRepository;
use App\Repositories\MenuRepository;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\PrivilegeRepository;
use App\Repositories\RoleRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\TableRepository;
use App\Repositories\TitleMenuRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TitleMenuRepositoryInterface::class, TitleMenuRepository::class);
        $this->app->bind(GroupMenuRepositoryInterface::class, GroupMenuRepository::class);
        $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
        $this->app->bind(PrivilegeRepositoryInterface::class, PrivilegeRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(MasterMenuRepositoryInterface::class, MasterMenuRepository::class);
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
        $this->app->bind(GalleryRepositoryInterface::class, GalleryRepository::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(ScheduleRepositoryInterface::class, ScheduleRepository::class);
        $this->app->bind(FaqRepositoryInterface::class, FaqRepository::class);
        $this->app->bind(CmsManagementRepositoryInterface::class, CmsManagementRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TableRepositoryInterface::class, TableRepository::class);
        $this->app->bind(PaymentMethodRepositoryInterface::class, PaymentMethodRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
