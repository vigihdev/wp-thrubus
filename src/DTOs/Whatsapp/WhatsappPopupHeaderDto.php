<?php

declare(strict_types=1);

namespace WpThrubus\DTOs\Whatsapp;

use WpThrubus\Contracts\Whatsapp\WhatsappPopupHeaderContract;
use WpThrubus\DTOs\BaseDto;

final class WhatsappPopupHeaderDto extends BaseDto implements WhatsappPopupHeaderContract
{
    public function __construct(
        private readonly string $title,
    ) {}

    public function getTitle(): string
    {
        return $this->title;
    }
}
