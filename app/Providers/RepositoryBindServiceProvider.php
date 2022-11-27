<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryBindServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        \App\Repositories\UserRepository::class => \App\Repositories\Impls\UserRepositoryImpl::class,
        \App\Repositories\CompanyRepository::class => \App\Repositories\Impls\CompanyRepositoryImpl::class,
        \App\Repositories\BankRepository::class => \App\Repositories\Impls\BankRepositoryImpl::class,
        \App\Repositories\CompanyPricingPlanRepository::class => \App\Repositories\Impls\CompanyPricingPlanRepositoryImpl::class,
        \App\Repositories\PricingPlanSettingRepository::class => \App\Repositories\Impls\PricingPlanSettingRepositoryImpl::class,
        \App\Repositories\PricingPlanRepository::class => \App\Repositories\Impls\PricingPlanRepositoryImpl::class,
        \App\Repositories\EmployerRepository::class => \App\Repositories\Impls\EmployerRepositoryImpl::class,
        \App\Repositories\NewRepository::class => \App\Repositories\Impls\NewRepositoryImpl::class,
        \App\Repositories\NotificationRepository::class => \App\Repositories\Impls\NotificationRepositoryImpl::class,
        \App\Repositories\NewsRepository::class => \App\Repositories\Impls\NewsRepositoryImpl::class,
        \App\Repositories\EmployerWageAccessLimitRepository::class => \App\Repositories\Impls\EmployerWageAccessLimitRepositoryImpl::class,
        \App\Repositories\RequestRepository::class => \App\Repositories\Impls\RequestRepositoryImpl::class,
        \App\Repositories\PromotionRepository::class => \App\Repositories\Impls\PromotionRepositoryImpl::class,
        \App\Repositories\CompanyPromotionRepository::class => \App\Repositories\Impls\CompanyPromotionRepositoryImpl::class,
        \App\Repositories\BankRepository::class => \App\Repositories\Impls\BankRepositoryImpl::class,
        \App\Repositories\ConfigRepository::class => \App\Repositories\Impls\ConfigRepositoryImpl::class,
        \App\Repositories\NotificationDetailRepository::class => \App\Repositories\Impls\NotificationDetailRepositoryImpl::class,
        \App\Repositories\GroupRepository::class => \App\Repositories\Impls\GroupRepositoryImpl::class,
        \App\Repositories\EmployeeImportRepository::class => \App\Repositories\Impls\EmployeeImportRepositoryImpl::class,
        \App\Repositories\EmployeeImportResultRepository::class => \App\Repositories\Impls\EmployeeImportResultRepositoryImpl::class,
        \App\Repositories\UserRepository::class => \App\Repositories\Impls\UserRepositoryImpl::class,
        \App\Repositories\CryptoTagRepository::class => \App\Repositories\Impls\CryptoTagRepositoryImpl::class,
        \App\Repositories\PayLinkRepository::class => \App\Repositories\Impls\PayLinkRepositoryImpl::class,
        \App\Repositories\WalletRepository::class => \App\Repositories\Impls\WalletRepositoryImpl::class,
        \App\Repositories\PaymentButtonRepository::class => \App\Repositories\Impls\PaymentButtonRepositoryImpl::class,
        \App\Repositories\TokenRepository::class => \App\Repositories\Impls\TokenRepositoryImpl::class,
        \App\Repositories\RewardRepository::class => \App\Repositories\Impls\RewardRepositoryImpl::class,
        \App\Repositories\TransactionRepository::class => \App\Repositories\Impls\TransactionRepositoryImpl::class,
        \App\Repositories\ContactRepository::class => \App\Repositories\Impls\ContactRepositoryImpl::class,
        \App\Repositories\ConstantRepository::class => \App\Repositories\Impls\ConstantRepositoryImpl::class,
        \App\Repositories\PayLinkTokenRepository::class => \App\Repositories\Impls\PayLinkTokenRepositoryImpl::class,
        \App\Repositories\PasswordResetRepository::class => \App\Repositories\Impls\PasswordResetRepositoryImpl::class,
        \App\Repositories\Google2faQrcodeRepository::class => \App\Repositories\Impls\Google2faQrcodeRepositoryImpl::class,
        \App\Repositories\MailVerificationRepository::class => \App\Repositories\Impls\MailVerificationRepositoryImpl::class,
        \App\Repositories\NotificationRepository::class => \App\Repositories\Impls\NotificationRepositoryImpl::class,
        \App\Repositories\NotificationReceiverRepository::class => \App\Repositories\Impls\NotificationReceiverRepositoryImpl::class,
        /* NEW BINDING */
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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
