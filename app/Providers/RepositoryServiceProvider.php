<?php

namespace App\Providers;

use App\Repository\AccountRepositoryInterface;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\CustomerRepositoryInterface;
use App\Repository\DamageRepositoryInterface;
use App\Repository\Eloquent\AccountRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\CustomerRepository;
use App\Repository\Eloquent\DamageRepository;
use App\Repository\Eloquent\MemberRepository;
use App\Repository\Eloquent\MembershipTypeRepository;
use App\Repository\Eloquent\OfferRepository;
use App\Repository\Eloquent\OrderRepository;
use App\Repository\Eloquent\PermissionRepository;
use App\Repository\Eloquent\ProductRepository;
use App\Repository\Eloquent\ProfileRepository;
use App\Repository\Eloquent\RackRepository;
use App\Repository\Eloquent\RoleRepository;
use App\Repository\Eloquent\SettingRepository;
use App\Repository\Eloquent\ShelfRepository;
use App\Repository\Eloquent\SmsRepository;
use App\Repository\Eloquent\SmsTemplateRepository;
use App\Repository\Eloquent\StockInRepository;
use App\Repository\Eloquent\StoreRepository;
use App\Repository\Eloquent\SubCategoryRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\VendorRepository;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\MemberRepositoryInterface;
use App\Repository\MembershipTypeRepositoryInterface;
use App\Repository\OfferRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\PermissionRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use App\Repository\ProfileRepositoryInterface;
use App\Repository\RackRepositoryInterface;
use App\Repository\RoleRepositoryInterface;
use App\Repository\SettingRepositoryInterface;
use App\Repository\ShelfRepositoryInterface;
use App\Repository\SmsRepositoryInterface;
use App\Repository\SmsTemplateRepositoryInterface;
use App\Repository\StockInRepositoryInterface;
use App\Repository\StoreRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Repository\VendorRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);




        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(SubCategoryRepository::class, SubCategoryRepository::class);
        $this->app->bind(ShelfRepositoryInterface::class, ShelfRepository::class);
        $this->app->bind(RackRepositoryInterface::class, RackRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(MemberRepositoryInterface::class, MemberRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(StoreRepositoryInterface::class, StoreRepository::class);
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(VendorRepositoryInterface::class, VendorRepository::class);
        $this->app->bind(StockInRepositoryInterface::class, StockInRepository::class);
        $this->app->bind(MembershipTypeRepositoryInterface::class, MembershipTypeRepository::class);
        $this->app->bind(SmsTemplateRepositoryInterface::class, SmsTemplateRepository::class);
        $this->app->bind(SmsRepositoryInterface::class, SmsRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(OfferRepositoryInterface::class, OfferRepository::class);
        $this->app->bind(DamageRepositoryInterface::class, DamageRepository::class);
    }
}
