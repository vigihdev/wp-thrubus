<?php

declare(strict_types=1);

namespace WpThrubus\DTOs\Hero;

use WpThrubus\Contracts\Hero\HeroDestinasiContract;
use WpThrubus\DTOs\BaseDto;

final class HeroDestinasiDto extends BaseDto implements HeroDestinasiContract
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
