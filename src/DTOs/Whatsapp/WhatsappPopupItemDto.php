<?php

declare(strict_types=1);

namespace WpThrubus\DTOs\Whatsapp;

use WpThrubus\DTOs\BaseDto;
use WpThrubus\Contracts\Whatsapp\WhatsappPopupItemContract;

final class WhatsappPopupItemDto extends BaseDto implements WhatsappPopupItemContract
{
    public function __construct(
        private readonly string $username,
        private readonly string $avatarUrl,
        private readonly string $noHp,
    ) {}

    public function username(): string
    {
        return $this->username;
    }

    public function avatarUrl(): string
    {
        return $this->avatarUrl;
    }

    public function noHp(): string
    {
        return $this->noHp;
    }
}
