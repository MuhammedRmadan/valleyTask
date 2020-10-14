<?php


namespace App\Helpers;


class MapHotelsArray
{
    /**
     * mapHotelsArray
     * map hotels array keys to unify the response
     *
     * @param  $hotelsArray :array of hotels from providers
     * @return $hotelsSortedArray : mapped and sorted array
     */
    public static function mapHotelsArray($hotelsArray)
    {
        //init sorted array
        $hotelsSortedArray = [];

        //handle response according to provider code
        foreach ($hotelsArray as $hotel) {
            foreach ($hotel as $key => $value) {
                //map different keys to one key to unify response
                if (array_key_exists($key, \Illuminate\Support\Facades\Config::get('providersAttributes'))) {
                    //rename custom key to our unified key
                    $hotel = self::change_array_key($hotel, $key, \Illuminate\Support\Facades\Config::get('providersAttributes')[$key]);
                }
            }
            ///push to sorted array
            $hotelsSortedArray [] = $hotel;
        }
        //sort DESC according to rate
        usort($hotelsSortedArray, function ($item1, $item2) {
            return $item2['hotelRate'] <=> $item1['hotelRate'];
        });
        return $hotelsSortedArray;
    }

    /**
     * change_array_key
     * chagne array associative keys
     *
     * @param  $array : required array
     * @param  $old_key : old key name
     * @param  $new_key : new key name
     * @return $array : new array
     */
    public static function change_array_key($array, $old_key, $new_key)
    {
        if (!is_array($array)) {
            print 'You must enter a array as a haystack!';
            exit;
        }
        if (!array_key_exists($old_key, $array)) {
            return $array;
        }

        $key_pos = array_search($old_key, array_keys($array));
        $arr_before = array_slice($array, 0, $key_pos);
        $arr_after = array_slice($array, $key_pos + 1);
        $arr_renamed = array($new_key => $array[$old_key]);

        return $arr_before + $arr_renamed + $arr_after;
    }
}
