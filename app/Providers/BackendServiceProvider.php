<?php

namespace App\Providers;

use App\Repositories\HotelRepository;
use App\Repositories\Interfaces\HotelRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(HotelRepositoryInterface::class, HotelRepository::class);
    }
}

?>
