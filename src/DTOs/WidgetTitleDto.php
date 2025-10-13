<?php

declare(strict_types=1);

namespace WpThrubus\DTOs;

use WpThrubus\Contracts\WidgetTitleContract;

final class WidgetTitleDto extends BaseDto implements WidgetTitleContract
{

    public function __construct(
        private readonly string $name,
        private readonly string $title,
    ) {}

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
