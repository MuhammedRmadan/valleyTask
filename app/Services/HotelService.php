<?php

namespace App\Services;

use App\Helpers\HotelHelper;
use App\Helpers\MapHotelsArray;
use App\Http\Resources\HotelResource;
use App\Repositories\Interfaces\HotelRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HotelService
{
    /**
     * @var $hotel
     */
    protected $hotel;

    /**
     * HotelService constructor.
     *
     * @param HotelRepositoryInterface $hotel
     */
    public function __construct(HotelRepositoryInterface $hotel)
    {
        $this->hotel = $hotel;
    }

    /**
     * search.
     * search hotels from certain provider
     * @param HotelRepositoryInterface $hotel
     * return $response
     */
    public function searchCertainProvider(Request $request)
    {
        logger($request->all());
        //get hotels array mapped and sorted by rate from certain provider
        $hotelsArray = json_decode(HotelHelper::json(\Illuminate\Support\Facades\Config::get('providers')[$request->provider_code]['provider_name']), true);
        return MapHotelsArray::mapHotelsArray($hotelsArray);
    }

    /**
     * searchAllProviders.
     * search hotels aggregated from several  providers
     * @param HotelRepositoryInterface $hotel
     * return $response
     */
    public function searchAllProviders(Request $request)
    {
        logger($request->all());
        //get count of providers
        $providersCount = count(\Illuminate\Support\Facades\Config::get('providersNames'));
        //get hotels array mapped and sorted by rate from all providers (merge different responses from different providers)
        $hotelsArray = [];
        //loop through responses and merge with the same array
        for ($index = 0; $index < $providersCount; $index++) {
            $hotelsArray = array_merge($hotelsArray, json_decode(HotelHelper::json(\Illuminate\Support\Facades\Config::get('providers')[$index]['provider_name']), true));
        }
        $hotels = MapHotelsArray::mapHotelsArray($hotelsArray);

        //handle check if new hotel added
        if (Cache::has('hotels')) {
            //cehck difference between cache and response
            $newHotels = array_diff_assoc($hotels[0], Cache::get('hotels')[0]);
            //in case new hotels added cache new one and send push notification
            if ($newHotels != []) {
                logger('new hotels');
                Cache::forever('hotels', $hotels);
                //TODO send FCM with the new hotels data
            } else {
                logger('old hotels');
            }
        } else {
            Cache::forever('hotels', $hotels);
        }
        return $hotels;
    }
}
