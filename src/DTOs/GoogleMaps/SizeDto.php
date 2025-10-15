<?php

declare(strict_types=1);

namespace WpThrubus\DTOs\GoogleMaps;

use WpThrubus\Contracts\GoogleMaps\SizeContract;
use WpThrubus\DTOs\BaseDto;

final class SizeDto extends BaseDto implements SizeContract
{
    public function __construct(
        private int $width,
        private int $height
    ) {}

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}
