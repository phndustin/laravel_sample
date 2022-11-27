<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\LibraryService;
use App\Services\LibraryServiceImpl;
use App\Services\BookService;
use App\Services\BookServiceImpl;


class ServiceBindServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    // public $bindings = [
    //     ServerProvider::class => DigitalOceanServerProvider::class,
    // ];

    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        \App\Services\CompanyService::class => \App\Services\Impls\CompanyServiceImpl::class,
        \App\Services\BankService::class => \App\Services\Impls\BankServiceImpl::class,
        \App\Services\StorageService::class => \App\Services\Impls\StorageServiceImpl::class,
        \App\Services\PlanService::class => \App\Services\Impls\PlanServiceImpl::class,
        \App\Services\EmployerService::class => \App\Services\Impls\EmployerServiceImpl::class,
        \App\Services\EmployerAuthService::class => \App\Services\Impls\EmployerAuthServiceImpl::class,
        \App\Services\OtpService::class => \App\Services\Impls\OtpServiceImpl::class,
        \App\Services\NewsService::class => \App\Services\Impls\NewsServiceImpl::class,
        \App\Services\NotificationService::class => \App\Services\Impls\NotificationServiceImpl::class,
        \App\Services\DashboardService::class => \App\Services\Impls\DashboardServiceImpl::class,
        \App\Services\PromotionService::class => \App\Services\Impls\PromotionServiceImpl::class,
        \App\Services\RequestService::class => \App\Services\Impls\RequestServiceImpl::class,
        \App\Services\WageService::class => \App\Services\Impls\WageServiceImpl::class,
        \App\Services\GpayTestService::class => \App\Services\Impls\GpayTestServiceImpl::class,
        \App\Services\WalletService::class => \App\Services\Impls\GPayServiceImpl::class,
        \App\Services\UploadService::class => \App\Services\Impls\UploadServiceImpl::class,
        \App\Services\CompanyAuth::class => \App\Services\Impls\CompanyAuthImpl::class,
        \App\Services\CompanyAuthService::class => \App\Services\Impls\CompanyAuthServiceImpl::class,
        \App\Services\AuthService::class => \App\Services\Impls\AuthServiceImpl::class,
        \App\Services\TagService::class => \App\Services\Impls\TagServiceImpl::class,
        \App\Services\PayLinkService::class => \App\Services\Impls\PayLinkServiceImpl::class,
        \App\Services\TokenService::class => \App\Services\Impls\TokenServiceImpl::class,
        \App\Services\UserService::class => \App\Services\Impls\UserServiceImpl::class,
        \App\Services\RewardService::class => \App\Services\Impls\RewardServiceImpl::class,
        \App\Services\ContactService::class => \App\Services\Impls\ContactServiceImpl::class,
        \App\Services\Google2faService::class => \App\Services\Impls\Google2faServiceImpl::class,
        \App\Services\WaitlistService::class => \App\Services\Impls\WaitlistServiceImpl::class,
        \App\Services\TokenomicService::class => \App\Services\Impls\TokenomicServiceImpl::class,
        \App\Services\TransactionService::class => \App\Services\Impls\TransactionServiceImpl::class,
        \App\Services\PreGoliveService::class => \App\Services\Impls\PreGoliveServiceImpl::class,
        \App\Services\PaymentService::class => \App\Services\Impls\PaymentServiceImpl::class,
        \App\Services\NotificationService::class => \App\Services\Impls\NotificationServiceImpl::class,
        \App\Services\GoogleReCaptchaService::class => \App\Services\Impls\GoogleReCaptchaServiceImpl::class,
        \App\Services\ReferrerService::class => \App\Services\Impls\ReferrerServiceImpl::class,
        /* NEW BINDING */
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
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
