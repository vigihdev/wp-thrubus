<?php

declare(strict_types=1);

namespace WpThrubus\Contracts\GoogleMaps;

interface LatLngContract
{
    /**
     * Get latitude
     */
    public function getLat(): float;

    /**
     * Get longitude
     */
    public function getLng(): float;
}
