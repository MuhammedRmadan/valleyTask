<?php
//providers list with inputs key and response keys
return [
    0 => [
        'provider_name' => 'BestHotels',
        'request_params' => [
            [
                'name' => 'fromDate',
                'type' => 'ISO_LOCAL_DATE',
                'validation' => 'required|date',
                'test_value' => '11-9-2019',
            ],
            [
                'name' => 'toDate',
                'type' => 'ISO_LOCAL_DATE',
                'validation' => 'required|date',
                'test_value' => '11-9-2019',
            ],
            [
                'name' => 'city',
                'type' => 'IATA code (AUH)',
                'validation' => 'required|string',
                'test_value' => 'AUH',
            ],
            [
                'name' => 'numberOfAdults',
                'type' => 'integer',
                'validation' => 'required|integer',
                'test_value' => 4,
            ],
        ],
        'response_params' => [
            [
                'name' => 'hotel',
                'type' => 'string',
                'hint' => 'Name of the hotel',
            ],
            [
                'name' => 'hotelRate',
                'type' => 'integer',
                'hint' => 'Number from 1-5',
            ],
            [
                'name' => 'hotelFare',
                'type' => 'float',
                'hint' => ' Total price rounded to 2 decimals',
            ],
            [
                'name' => 'roomAmenities',
                'type' => 'string ',
                'hint' => 'String of amenities separated by comma  ',
            ],
        ],
    ],
    1 => [
        'provider_name' => 'TopHotels',
        'request_params' => [
            [
                'name' => 'from',
                'type' => 'ISO_INSTANT',
                'validation' => 'required|date',
                'test_value' => '11-9-2019',
            ],
            [
                'name' => 'to',
                'type' => 'ISO_INSTANT',
                'validation' => 'required|date',
                'test_value' => '11-9-2019',
            ],
            [
                'name' => 'city',
                'type' => 'IATA code (AUH)',
                'validation' => 'required|string',
                'test_value' => 'AUH',
            ],
            [
                'name' => 'adultsCount',
                'type' => 'integer',
                'validation' => 'required|integer',
                'test_value' => 4,
            ],
        ],
        'response_params' => [
            [
                'name' => 'hotelName',
                'type' => 'string',
                'hint' => 'Name of the hotel',
            ],
            [
                'name' => 'rate',
                'type' => 'integer',
                'hint' => 'Number from 1-5',
            ],
            [
                'name' => 'price',
                'type' => 'float',
                'hint' => ' Total price rounded to 2 decimals',
            ],
            [
                'name' => 'amenities',
                'type' => 'string ',
                'hint' => 'String of amenities separated by comma ',
            ], [
                'name' => 'discount',
                'type' => 'float ',
                'hint' => 'discount on the room (if available).',
            ],
        ],
    ]
];


