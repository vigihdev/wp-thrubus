<?php

declare(strict_types=1);

namespace WpThrubus\DTOs;

use WpThrubus\Contracts\OurClientContract;

final class OurClientDto extends BaseDto implements OurClientContract
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
