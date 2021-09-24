<?php

namespace App\Http\Controllers\Api;

use App\Enum\searchTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchHotelsRequest;
use App\Models\Hotel;
use App\Repositories\Interfaces\HotelRepositoryInterface;
use App\Services\BestHotelsDataAdapter;
use App\Services\HotelService;
use App\Services\TopHotelsDataAdapter;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * @var $hotelService
     */
    protected $hotelService;

    /**
     * HotelController constructor.
     *
     * @param HotelService $hotelService
     */
    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    /**
     * searchHotels
     * Aggregator function to search hotels from different sources and one selected source
     * @param : Request $request
     * @param :  $type : enum
     * @return \Illuminate\Http\Response
     */
    public function searchHotels(SearchHotelsRequest $request, $type)
    {
        logger(__CLASS__ . __FUNCTION__ . __LINE__);
        //choose search type according to user select
        switch ($type) {
            case searchTypeEnum::AGGREGATOR:
                {
                    return $this->hotelService->searchAllProviders($request);
                }
                break;
            case searchTypeEnum::SELECTED:
                {//get hotels array mapped and sorted by rate from certain provider
                    $hotelsDataObject = '';
                    switch ($request->provider_code) {
                        case 0:
                            $hotelsDataObject = new BestHotelsDataAdapter();
                            break;
                        case 1:
                            $hotelsDataObject = new TopHotelsDataAdapter();
                            break;
                        default:
                            throw new \RuntimeException("Unknown hotel provider");
                    }
                    return $this->hotelService->searchCertainProvider($request,$hotelsDataObject);
                }
                break;
            default:
                break;
        }
    }
}
