<?php

declare(strict_types=1);

namespace WpThrubus\DTOs\GoogleMaps;

use WpThrubus\Contracts\GoogleMaps\InfoWindowContentContract;
use WpThrubus\DTOs\BaseDto;

final class InfoWindowContentDto extends BaseDto implements InfoWindowContentContract
{
    public function __construct(
        private readonly string $imageUrl,
        private readonly string $title,
        private readonly float|int $rating,
        private readonly int $jumlahUlasan
    ) {}

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getRating(): float|int
    {
        return $this->rating;
    }

    public function getJumlahUlasan(): int
    {
        return $this->jumlahUlasan;
    }
}
