<?php

declare(strict_types=1);

namespace WpThrubus\Contracts\GoogleMaps;

interface SizeContract
{
    /**
     * Get width
     */
    public function getWidth(): int;

    /**
     * Get height
     */
    public function getHeight(): int;
}
