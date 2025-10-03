<?php

declare(strict_types=1);

namespace WpThrubus\DTOs;

use WpThrubus\Contracts\VehicleNotAvailableHargaContract;

final class VehicleNotAvailableHargaDto extends BaseDto implements VehicleNotAvailableHargaContract
{

    public function __construct(
        private readonly string $paketSewa,
        private readonly string $harga = 'Tidak tersedia',
    ) {}

    public function getHarga(): string
    {
        return $this->harga;
    }

    public function getPaketSewa(): string
    {
        return $this->paketSewa;
    }

    public function getHargaFormatted(): string
    {
        return $this->getHarga();
    }
}
