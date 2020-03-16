<?php

namespace App\Helpers;

//use Vectorface\Whip\Whip;
use Illuminate\Support\Arr;
use OK\Ipstack\Client as Ipstack;
use Illuminate\Support\Facades\Request;
// use Stevebauman\Location\Facades\Location;

class RequestHelper
{
    /**
     * Get client ip.
     *
     * @return array|string
     */
    public static function ip()
    {
        return Request::ip();;
    }

    /**
     * Get client country.
     *
     * @param string $ip
     * @return string|null
     */
    public static function country($ip)
    {
        /* $position = Location::get($ip);

        if ($position) {
            return $position->countryCode;
        } */
        return 'VN';
    }

    /**
     * Get client country and currency.
     *
     * @param string|null $ip
     * @return array
     */
    public static function infos($ip)
    {
        $ip = $ip ?? static::ip();

        /* if (config('location.ipstack_apikey') != null) {
            $ipstack = new Ipstack(config('location.ipstack_apikey'));
            $position = $ipstack->get($ip, true);

            if (! is_null($position) && Arr::get($position, 'country_code', null)) {
                return [
                    'country' => Arr::get($position, 'country_code', null),
                    'currency' => Arr::get($position, 'currency.code', null),
                    'timezone' => Arr::get($position, 'time_zone.id', null),
                ];
            }
        } */

        return [
            'country' => static::country($ip),
            'currency' => null,
            'timezone' => null,
        ];
    }
}
