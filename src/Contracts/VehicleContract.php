<?php

declare(strict_types=1);

namespace WpThrubus\Contracts;

interface VehicleContract
{
    public function getNama(): string;
    public function getImage(): string;
    public function getHarga(): int;
    public function getPaketSewa(): string;
    public function getTipeMobil(): string;
    public function getActionUrl(): string;
}
