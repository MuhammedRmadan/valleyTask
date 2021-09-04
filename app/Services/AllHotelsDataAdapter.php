<?php

namespace App\Services;


use App\Helpers\HotelHelper;
use App\Helpers\MapHotelsArray;
use App\Interfaces\HotelsDataInterface;

class AllHotelsDataAdapter implements HotelsDataInterface
{
    public function getHotelsData()
    {
        //get count of providers
        $providersCount = count(\Illuminate\Support\Facades\Config::get('providersNames'));
        //get hotels array mapped and sorted by rate from all providers (merge different responses from different providers)
        $hotelsArray = [];
        //loop through responses and merge with the same array
        for ($index = 0; $index < $providersCount; $index++) {
            $hotelsArray = array_merge($hotelsArray, json_decode(HotelHelper::json(\Config::get('providers')[$index]['provider_name']), true));
        }
        $hotels = MapHotelsArray::mapHotelsArray($hotelsArray);
        return $hotels;
    }
}
