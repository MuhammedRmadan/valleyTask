<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $json = parent::toArray($request);
        //handle response according to provider code
        foreach ($json as $key => $name) {
            //map different keys to one key to unify response
            if (array_key_exists($key, \Illuminate\Support\Facades\Config::get('providersAttributes'))) {
                //rename custom key to our unified key
                $json[\Illuminate\Support\Facades\Config::get('providersAttributes')[$key]] = $json[$key];
                unset($json[$key]);
            }
        }

        return $json;
    }
}
