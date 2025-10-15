<?php

declare(strict_types=1);

namespace WpThrubus\Contracts\GoogleMaps;

interface MarkerContract
{
    /**
     * Get anchor point
     */
    public function getAnchorPoint(): mixed;

    /**
     * Get animation
     */
    public function getAnimation(): mixed;

    /**
     * Check if marker is clickable
     */
    public function isClickable(): bool;

    /**
     * Get collision behavior
     */
    public function getCollisionBehavior(): string;

    /**
     * Check if cross on drag is enabled
     */
    public function isCrossOnDrag(): bool;

    /**
     * Get cursor style
     */
    public function getCursor(): string;

    /**
     * Check if marker is draggable
     */
    public function isDraggable(): bool;

    /**
     * Get icon
     */
    public function getIcon(): string;

    /**
     * Get label
     */
    public function getLabel(): string;

    /**
     * Get map
     */
    public function getMap(): mixed;

    /**
     * Get opacity
     */
    public function getOpacity(): int;

    /**
     * Check if optimized
     */
    public function isOptimized(): bool;

    /**
     * Get position
     */
    public function getPosition(): LatLngContract;

    /**
     * Get shape
     */
    public function getShape(): mixed;

    /**
     * Get title
     */
    public function getTitle(): string;

    /**
     * Check if marker is visible
     */
    public function isVisible(): bool;

    /**
     * Get z-index
     */
    public function getZIndex(): int;
}
