<?php

declare(strict_types=1);

namespace WpThrubus\Contracts;

interface VehicleCompactContract
{
    public function getNama(): string;
    public function getImage(): string;
    public function getTipeMobil(): string;
    public function getActionUrl(): string;
}
