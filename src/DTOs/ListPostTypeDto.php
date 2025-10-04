<?php

declare(strict_types=1);

namespace WpThrubus\DTOs;

use WpThrubus\Contracts\ListPostTypeContract;

final class ListPostTypeDto extends BaseDto implements ListPostTypeContract
{

    public function __construct(
        private readonly string $title,
        private readonly string $imageUrl,
        private readonly string $actionUrl,
        private readonly string $snippet

    ) {}

    /**
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     *
     * @return string URL gambar artikel
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function getActionUrl(): string
    {
        return $this->actionUrl;
    }

    /**
     * @return string Cuplikan konten artikel
     */
    public function getSnippet(): string
    {
        return $this->snippet;
    }
}
