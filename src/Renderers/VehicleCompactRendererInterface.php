<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\VehicleCompactDto;
use WpThrubus\DTOs\VehicleCompactHargaDto;

interface VehicleCompactRendererInterface
{

    /**
     *
     * @param VehicleCompactDto $itemMobil
     * @param VehicleCompactHargaDto[] $itemHargas
     * @return static
     */
    public function addCompact(VehicleCompactDto $itemMobil, array $itemHargas): self;

    /**
     * Set rendering options
     * 
     * @param array<string,mixed> $options
     */
    public function setOptions(array $options): self;
}
