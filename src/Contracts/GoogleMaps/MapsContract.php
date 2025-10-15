<?php

declare(strict_types=1);

namespace WpThrubus\Contracts\GoogleMaps;

interface MapsContract
{
    /**
     * Get zoom level
     */
    public function getZoom(): int;

    /**
     * Check if map type control is enabled
     */
    public function isMapTypeControl(): bool;

    /**
     * Check if fullscreen control is enabled
     */
    public function isFullscreenControl(): bool;

    /**
     * Check if pan control is enabled
     */
    public function isPanControl(): bool;

    /**
     * Check if scale control is enabled
     */
    public function isScaleControl(): bool;

    /**
     * Get center position
     */
    public function getCenter(): LatLngContract;

    /**
     * Get marker
     */
    public function getMarker(): MarkerContract;

    /**
     * Get style
     */
    public function getStyle(): string;

    /**
     * Get info window
     */
    public function getInfoWindow(): InfoWindowContract;
}
