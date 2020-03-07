<?php

namespace App\Providers;

use App\Contracts\BookingContract;
use App\Repositories\BookingRepository;
use Illuminate\Support\ServiceProvider;



class BookingServiceProvider extends ServiceProvider
{
   public function boot()
   {

   }

   public function register()
   {
        $this->app->bind(BookingContract::class, function ($app) {
                    return new BookingRepository();
                });
   }

}