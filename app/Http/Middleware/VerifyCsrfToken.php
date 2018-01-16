<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/flight-booking-confirmation',
        '/hotel-booking-confirmation',
        '/package-booking-confirmation',
        '/packages/storePackageInfo',
        '/packages/storeFlightInfo',
        '/packages/storeHotelInfo',
        '/packages/storeAttractionInfo',
        '/packages/storeSightSeeingInfo',
        '/packages/storeGoodToKnowInfo'
    ];
}
