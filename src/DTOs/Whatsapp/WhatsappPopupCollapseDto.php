<?php

declare(strict_types=1);

namespace WpThrubus\DTOs\Whatsapp;

use WpThrubus\DTOs\BaseDto;
use WpThrubus\Contracts\Whatsapp\WhatsappPopupCollapseContract;

final class WhatsappPopupCollapseDto extends BaseDto implements WhatsappPopupCollapseContract
{
    public function __construct(
        private readonly string $iconUrl,
    ) {}

    public function getIconUrl(): string
    {
        return $this->iconUrl;
    }
}
