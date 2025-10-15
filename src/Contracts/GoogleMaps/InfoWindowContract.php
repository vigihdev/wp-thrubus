<?php

declare(strict_types=1);

namespace WpThrubus\Contracts\GoogleMaps;

interface InfoWindowContract
{
    /**
     * Get aria label for accessibility
     */
    public function getAriaLabel(): string;

    /**
     * Get content of the info window
     */
    public function getContent(): ?string;

    /**
     * Check if auto pan is disabled
     */
    public function isDisableAutoPan(): bool;

    /**
     * Get header content
     */
    public function getHeaderContent(): string;

    /**
     * Check if header is disabled
     */
    public function isHeaderDisabled(): bool;

    /**
     * Get maximum width
     */
    public function getMaxWidth(): int;

    /**
     * Get minimum width
     */
    public function getMinWidth(): int;

    /**
     * Get pixel offset
     */
    public function getPixelOffset(): SizeContract;

    /**
     * Get position
     */
    public function getPosition(): LatLngContract;

    /**
     * Get z-index
     */
    public function getZIndex(): int;
}
