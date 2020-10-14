<?php

namespace App\Http\Controllers\Api;

use App\Enum\searchTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchHotelsRequest;
use App\Models\Hotel;
use App\Repositories\Interfaces\HotelRepositoryInterface;
use App\Services\HotelService;
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
    {  logger(__CLASS__ . __FUNCTION__ . __LINE__);
        //choose search type according to user select
        switch ($type) {
            case searchTypeEnum::AGGREGATOR:
                {
                    return $this->hotelService->searchAllProviders($request);
                }
                break;
            case searchTypeEnum::SELECTED:
                {
                    return $this->hotelService->searchCertainProvider($request);
                }
                break;
            default:
                break;
        }
    }
}
