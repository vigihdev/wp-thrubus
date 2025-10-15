<?php

declare(strict_types=1);

namespace WpThrubus\Contracts\GoogleMaps;

interface InfoWindowContentContract
{

    public function getImageUrl(): string;

    public function getTitle(): string;

    public function getRating(): float|int;

    public function getJumlahUlasan(): int;
}
