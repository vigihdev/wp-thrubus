<?php

declare(strict_types=1);

namespace WpThrubus\DTOs\GoogleMaps;

use WpThrubus\Contracts\GoogleMaps\InfoWindowContract;
use WpThrubus\Contracts\GoogleMaps\LatLngContract;
use WpThrubus\Contracts\GoogleMaps\MapsContract;
use WpThrubus\Contracts\GoogleMaps\MarkerContract;
use WpThrubus\DTOs\BaseDto;

final class MapsDto extends BaseDto implements MapsContract
{
    public function __construct(
        private int $zoom = 17,
        private bool $mapTypeControl = false,
        private bool $fullscreenControl = false,
        private bool $panControl = false,
        private bool $scaleControl = false,
        private ?LatLngContract $center = null,
        private ?MarkerContract $marker = null,
        private string $style = '',
        private ?InfoWindowContract $infoWindow = null
    ) {}

    public function getZoom(): int
    {
        return $this->zoom;
    }

    public function isMapTypeControl(): bool
    {
        return $this->mapTypeControl;
    }

    public function isFullscreenControl(): bool
    {
        return $this->fullscreenControl;
    }

    public function isPanControl(): bool
    {
        return $this->panControl;
    }

    public function isScaleControl(): bool
    {
        return $this->scaleControl;
    }

    public function getCenter(): LatLngDto
    {
        return $this->center;
    }

    public function getMarker(): MarkerDto|MarkerContract
    {
        return $this->marker;
    }

    public function getStyle(): string
    {
        return $this->style;
    }

    public function getInfoWindow(): InfoWindowContract|InfoWindowDto
    {
        return $this->infoWindow;
    }
}
