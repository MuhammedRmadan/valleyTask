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
     * @param $requiredProviderAdapter : inject required provider object using Dependency Injection (applying open close principle)
     * return $response
     */
    public function searchCertainProvider(Request $request,$requiredProviderAdapter)
    {
        logger($request->all());
        return $requiredProviderAdapter->getHotelsData();
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

        //get data for all providers
        $allHotelsDataAdapterObject = new AllHotelsDataAdapter();
        $hotels = $allHotelsDataAdapterObject->getHotelsData();

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
