<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\EmployeeContract;
use App\Repositories\EmployeeRepository;


class BookingServiceProvider extends ServiceProvider
{
   public function boot()
   {

   }

   public function register()
   {
        $this->app->bind(BookingContract::class, function ($app) {
                    return new BookingRepository;
                });
   }

}