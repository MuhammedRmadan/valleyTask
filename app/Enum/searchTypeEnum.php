<?php

/**
 * Created by PhpStorm.
 * User: rami
 * Date: 2/7/19
 * Time: 8:19 PM
 */

namespace App\Enum;

abstract class searchTypeEnum
{
    //get search from differnet endpoints
    public const AGGREGATOR = "aggregator";
    //get results from one endpoint
    public const SELECTED = "selected";

    public static function toArray()
    {
        return [static::AGGREGATOR,
            static::SELECTED,
        ];
    }

}
