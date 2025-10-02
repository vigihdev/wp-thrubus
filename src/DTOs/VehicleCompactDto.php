<?php

declare(strict_types=1);

namespace WpThrubus\DTOs;

use WpThrubus\Contracts\VehicleCompactContract;

final class VehicleCompactDto extends BaseDto implements VehicleCompactContract
{

    public function __construct(
        private readonly string $nama,
        private readonly string $image,
        private readonly string $tipeMobil,
        private readonly string $actionUrl
    ) {}

    public function getNama(): string
    {
        return $this->nama;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getTipeMobil(): string
    {
        return $this->tipeMobil;
    }

    public function getActionUrl(): string
    {
        return $this->actionUrl;
    }
}
