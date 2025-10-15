<?php

declare(strict_types=1);

namespace WpThrubus\DTOs\GoogleMaps;

use WpThrubus\Contracts\GoogleMaps\LatLngContract;
use WpThrubus\Contracts\GoogleMaps\MarkerContract;
use WpThrubus\DTOs\BaseDto;

final class MarkerDto extends BaseDto implements MarkerContract
{
    public function __construct(
        private mixed $anchorPoint = null,
        private mixed $animation = null,
        private bool $clickable = true,
        private string $collisionBehavior = '',
        private bool $crossOnDrag = false,
        private string $cursor = '',
        private bool $draggable = false,
        private string $icon = '',
        private string $label = '',
        private mixed $map = null,
        private int $opacity = 1,
        private bool $optimized = true,
        private ?LatLngContract $position = null,
        private mixed $shape = null,
        private string $title = '',
        private bool $visible = false,
        private int $zIndex = 1
    ) {}

    public function getAnchorPoint(): mixed
    {
        return $this->anchorPoint;
    }

    public function getAnimation(): mixed
    {
        return $this->animation;
    }

    public function isClickable(): bool
    {
        return $this->clickable;
    }

    public function getCollisionBehavior(): string
    {
        return $this->collisionBehavior;
    }

    public function isCrossOnDrag(): bool
    {
        return $this->crossOnDrag;
    }

    public function getCursor(): string
    {
        return $this->cursor;
    }

    public function isDraggable(): bool
    {
        return $this->draggable;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getMap(): mixed
    {
        return $this->map;
    }

    public function getOpacity(): int
    {
        return $this->opacity;
    }

    public function isOptimized(): bool
    {
        return $this->optimized;
    }

    public function getPosition(): LatLngContract
    {
        return $this->position;
    }

    public function getShape(): mixed
    {
        return $this->shape;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }

    public function getZIndex(): int
    {
        return $this->zIndex;
    }
}
