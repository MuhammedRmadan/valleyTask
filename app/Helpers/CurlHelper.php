<?php

namespace App\Helpers;

use App\Enums\InputsColumnTypes;
use App\Model\SpecialPage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CurlHelper
{
    /**
     * curl
     * call APIS and retreive data from other domains
     *
     * @param  $url
     * @return $output
     */
    public static function curl($url)
    {
        $handle = curl_init();

// Set the url
        curl_setopt($handle, CURLOPT_URL, $url);
// Set the result output to be a string.
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($handle);

        curl_close($handle);

        return $output;
    }



}
