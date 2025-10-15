<?php

declare(strict_types=1);

namespace WpThrubus\DTOs;

use WpThrubus\Contracts\AboutUsContract;

final class AboutUsDto extends BaseDto implements AboutUsContract
{


    public function __construct(
        private readonly string $logoUrl,
        private readonly string $description
    ) {}

    public function getLogoUrl(): string
    {
        return $this->logoUrl;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
