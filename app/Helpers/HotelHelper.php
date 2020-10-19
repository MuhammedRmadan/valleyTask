<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class HotelHelper
{
    /**
     * json
     * get fake json to test search APIs
     *
     * @param  $type : BestHotels or topHotels or both
     * @return $json : test json to simulate providers response
     */
    public static function json($type)
    {
        //switch between different types of requreid json
        switch ($type) {
            case 'BestHotels':
                {
                    $json =
                        [
                            [
                                'hotel' => 'ds',
                                'hotelRate' => 3,
                                'hotelFare' => 78,
                                'roomAmenities' => 'room,kitchen',
                            ],
                            [
                                'hotel' => 'bestHotels_2',
                                'hotelRate' => 4,
                                'hotelFare' => 56,
                                'roomAmenities' => 'room,kitchen,living',
                            ],
                            [
                                'hotel' => 'bestHotels_3',
                                'hotelRate' => 5,
                                'hotelFare' => 33,
                                'roomAmenities' => 'living,kitchen',
                            ],
                            [
                                'hotel' => 'bestHotels_4',
                                'hotelRate' => 1,
                                'hotelFare' => 25,
                                'roomAmenities' => 'room,living',
                            ]
                        ];
                }
                break;
            case 'TopHotels':
                {
                    $json =
                        [
                            [
                                'hotelName' => 'topHotels_1',
                                'rate' => 3,
                                'price' => 30,
                                'discount' => 80,
                                'amenities' => 'room,kitchen',
                            ],
                            [
                                'hotelName' => 'topHotels_2',
                                'rate' => 4,
                                'price' => 66,
                                'discount' => 40,
                                'amenities' => 'room,kitchen,living',
                            ],
                            [
                                'hotelName' => 'topHotels_3',
                                'rate' => 5,
                                'price' => 77,
                                'discount' => 30,
                                'amenities' => 'living,kitchen',
                            ],
                            [
                                'hotelName' => 'topHotels_4',
                                'rate' => 1,
                                'price' => 12,
                                'discount' => 20,
                                'amenities' => 'room,living',
                            ]
                        ];
                }
                break;
            case 'both':
                {
                    $json =
                        [
                            [
                                'hotel' => 'bestHotels_1',
                                'hotelRate' => 3,
                                'hotelFare' => 78,
                                'roomAmenities' => 'room,kitchen',
                            ],
                            [
                                'hotel' => 'bestHotels_2',
                                'hotelRate' => 4,
                                'hotelFare' => 56,
                                'roomAmenities' => 'room,kitchen,living',
                            ],
                            [
                                'hotel' => 'bestHotels_3',
                                'hotelRate' => 5,
                                'hotelFare' => 33,
                                'roomAmenities' => 'living,kitchen',
                            ],
                            [
                                'hotel' => 'bestHotels_4',
                                'hotelRate' => 1,
                                'hotelFare' => 25,
                                'roomAmenities' => 'room,living',
                            ],
                            [
                                'hotelName' => 'topHotels_1',
                                'rate' => 3,
                                'price' => 30,
                                'discount' => 80,
                                'amenities' => 'room,kitchen',
                            ],
                            [
                                'hotelName' => 'topHotels_2',
                                'rate' => 4,
                                'price' => 66,
                                'discount' => 40,
                                'amenities' => 'room,kitchen,living',
                            ],
                            [
                                'hotelName' => 'topHotels_3',
                                'rate' => 5,
                                'price' => 77,
                                'discount' => 30,
                                'amenities' => 'living,kitchen',
                            ],
                            [
                                'hotelName' => 'topHotels_4',
                                'rate' => 1,
                                'price' => 12,
                                'discount' => 20,
                                'amenities' => 'room,living',
                            ]
                        ];
                }
                break;
            default:
                break;
        }

        return json_encode($json);
    }


}
