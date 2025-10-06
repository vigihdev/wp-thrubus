<?php

declare(strict_types=1);

namespace WpThrubus\DTOs;

use WpThrubus\Contracts\ShareItContract;

final class ShareItDto extends BaseDto implements ShareItContract
{


    public function __construct(
        private readonly string $name,
        private readonly string $iconUrl,
        private readonly string $shareUrl,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getIconUrl(): string
    {
        return $this->iconUrl;
    }

    public function getShareUrl(): string
    {
        return $this->shareUrl;
    }
}
