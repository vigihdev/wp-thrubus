<?php

declare(strict_types=1);

namespace WpThrubus\DTOs\GoogleMaps;

use WpThrubus\Contracts\GoogleMaps\LatLngContract;
use WpThrubus\DTOs\BaseDto;

final class LatLngDto extends BaseDto implements LatLngContract
{
    public function __construct(
        private float $lat,
        private float $lng
    ) {}

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLng(): float
    {
        return $this->lng;
    }
}
