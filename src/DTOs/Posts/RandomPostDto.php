<?php

declare(strict_types=1);

namespace WpThrubus\DTOs\Posts;

use WpThrubus\Contracts\Posts\RandomPostContract;
use WpThrubus\DTOs\BaseDto;

final class RandomPostDto extends BaseDto implements RandomPostContract
{
    public function __construct(
        private readonly string $title,
        private readonly string $snippet,
        private readonly string $imageUrl,
        private readonly string $actionUrl,
    ) {}

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSnippet(): string
    {
        return $this->snippet;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function getActionUrl(): string
    {
        return $this->actionUrl;
    }
}
