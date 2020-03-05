<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\UserContract;
use App\Repositories\UserRepository;


class UserServiceProvider extends ServiceProvider
{
   public function boot()
   {
       $this->app->bind(UserContract::class, function ($app) {
           return new UserRepository;
       });
   }

   public function register()
   {

   }

}