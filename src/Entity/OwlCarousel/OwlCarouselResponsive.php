<?php

declare(strict_types=1);

namespace WpThrubus\Entity\OwlCarousel;

use WpThrubus\Contracts\{ArrayableContract, JsonableContract};

final class OwlCarouselResponsive implements ArrayableContract, JsonableContract
{
    private array $breakpoints = [];

    private function __construct() {}

    public static function create(): self
    {
        return new self();
    }

    public function addBreakpoint(int $width, OwlCarouselOptions $options): self
    {
        $this->breakpoints[$width] = $options->toArray();
        ksort($this->breakpoints); // Sort by key
        return $this;
    }

    // Helper methods untuk Bootstrap breakpoints
    public function xs(OwlCarouselOptions $options): self
    {
        return $this->addBreakpoint(0, $options);
    }

    public function sm(OwlCarouselOptions $options): self
    {
        return $this->addBreakpoint(576, $options);
    }

    public function md(OwlCarouselOptions $options): self
    {
        return $this->addBreakpoint(768, $options);
    }

    public function lg(OwlCarouselOptions $options): self
    {
        return $this->addBreakpoint(992, $options);
    }

    public function xl(OwlCarouselOptions $options): self
    {
        return $this->addBreakpoint(1200, $options);
    }

    public function xxl(OwlCarouselOptions $options): self
    {
        return $this->addBreakpoint(1400, $options);
    }

    public function toArray(): array
    {
        return $this->breakpoints;
    }

    public function toJson(int $options = 0): string
    {
        return json_encode($this->toArray(), JSON_FORCE_OBJECT);
    }
}
