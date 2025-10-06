<?php

declare(strict_types=1);

namespace WpThrubus\Entity\OwlCarousel;

use WpThrubus\Contracts\{ArrayableContract, JsonableContract};

final class OwlCarouselOptions implements JsonableContract, ArrayableContract
{
    public function __construct(
        private readonly int|float $items,
        private readonly bool $loop = true,
        private readonly int $margin = 10,
        private readonly bool $nav = false,
        private readonly bool $dots = true,
        private readonly bool $autoplay = true,
        private readonly array $navText = [
            '<span class="material-icons-outlined ripple-effect" aria-hidden="true">arrow_back_ios</span>',
            '<span class="material-icons-outlined ripple-effect" aria-hidden="true">arrow_forward_ios</span>'
        ],
    ) {}

    public function toArray(): array
    {
        return [
            'items' => $this->items,
            'loop' => $this->loop,
            'margin' => $this->margin,
            'nav' => $this->nav,
            'dots' => $this->dots,
            'autoplay' => $this->autoplay,
            'navText' => $this->navText
        ];
    }

    public function toJson(int $options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }
}
