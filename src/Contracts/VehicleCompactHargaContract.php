<?php

declare(strict_types=1);

namespace WpThrubus\Contracts;

interface VehicleCompactHargaContract
{
    public function getHarga(): int;
    public function getPaketSewa(): string;
}
