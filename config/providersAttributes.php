<?php
//map different response attributes from different providers into one same response

return [
    //start of bestHotels provider keys
    'hotel' => ['key_name' => 'hotelName', 'provider_name' => 'bestHotels'],
    'hotelFare' => ['key_name' => 'fare', 'provider_name' => 'bestHotels'],
    'roomAmenities' => ['key_name' => 'amenities', 'provider_name' => 'bestHotels'],
    'hotelRate' => ['key_name' => 'hotelRate', 'provider_name' => 'bestHotels'],
    //end of bestHotels provider keys
    //start of topHotels provider keys
    'hotelName' => ['key_name' => 'hotelName', 'provider_name' => 'topHotels'],
    'price' => ['key_name' => 'fare', 'provider_name' => 'topHotels'],
    'amenities' => ['key_name' => 'amenities', 'provider_name' => 'topHotels'],
    'rate' => ['key_name' => 'hotelRate', 'provider_name' => 'topHotels'],
    'discount' => ['key_name' => 'discount', 'provider_name' => 'topHotels'],
    //end of topHotels provider keys
];

