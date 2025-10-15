<?php

declare(strict_types=1);

namespace WpThrubus\DTOs\GoogleMaps;

use WpThrubus\Contracts\GoogleMaps\InfoWindowContract;
use WpThrubus\Contracts\GoogleMaps\LatLngContract;
use WpThrubus\Contracts\GoogleMaps\SizeContract;
use WpThrubus\DTOs\BaseDto;

final class InfoWindowDto extends BaseDto implements InfoWindowContract
{
    public function __construct(
        private string $ariaLabel = '',
        private ?string $content = null,
        private bool $disableAutoPan = false,
        private string $headerContent = '',
        private bool $headerDisabled = true,
        private int $maxWidth = 0,
        private int $minWidth = 0,
        private ?SizeContract $pixelOffset = null,
        private ?LatLngContract $position = null,
        private int $zIndex = 0
    ) {}

    public function getAriaLabel(): string
    {
        return $this->ariaLabel;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function isDisableAutoPan(): bool
    {
        return $this->disableAutoPan;
    }

    public function getHeaderContent(): string
    {
        return $this->headerContent;
    }

    public function isHeaderDisabled(): bool
    {
        return $this->headerDisabled;
    }

    public function getMaxWidth(): int
    {
        return $this->maxWidth;
    }

    public function getMinWidth(): int
    {
        return $this->minWidth;
    }

    public function getPixelOffset(): SizeContract
    {
        return $this->pixelOffset;
    }

    public function getPosition(): LatLngContract
    {
        return $this->position;
    }

    public function getZIndex(): int
    {
        return $this->zIndex;
    }
}
