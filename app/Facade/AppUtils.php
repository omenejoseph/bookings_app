<?php


namespace App\Facade;


use Illuminate\Support\Facades\Facade;

class AppUtils extends Facade
{
    /**
     * Get the registered name of the component.
     * @see \App\Helpers\AppUtils
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'app-utils';
    }
}