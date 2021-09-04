<?php

namespace App\Services;


use App\Helpers\HotelHelper;
use App\Helpers\MapHotelsArray;
use App\Interfaces\HotelsDataInterface;

class TopHotelsDataAdapter implements HotelsDataInterface
{
    public function getHotelsData()
    {
        //return data for top hotels provider according to its key mapping in json response
        $hotelsArray = json_decode(HotelHelper::json(\Config::get('providers')[1]['provider_name']), true);
        return MapHotelsArray::mapHotelsArray($hotelsArray);
    }
}
