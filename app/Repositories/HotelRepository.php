<?php

namespace App\Repositories;

use App\Models\Hotel;
use App\Repositories\Interfaces\HotelRepositoryInterface;


class HotelRepository extends BaseRepository implements HotelRepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * HotelRepository constructor.
     * @param App\Models\Hotel $hotel
     */
    public function __construct(Hotel $hotel)
    {
        $this->model = $hotel;
    }

}


