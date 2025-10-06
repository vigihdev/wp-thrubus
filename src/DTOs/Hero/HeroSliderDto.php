<?php

declare(strict_types=1);

namespace WpThrubus\DTOs\Hero;

use WpThrubus\Contracts\Hero\HeroSliderContract;
use WpThrubus\DTOs\BaseDto;

final class HeroSliderDto extends BaseDto implements HeroSliderContract
{

    public function __construct(
        private readonly string $name,
        private readonly string $imageUrl
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }
}
