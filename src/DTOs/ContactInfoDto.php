<?php

declare(strict_types=1);

namespace WpThrubus\DTOs;

use WpThrubus\Contracts\ContactInfoContract;

final class ContactInfoDto extends BaseDto implements ContactInfoContract
{
    public function __construct(
        private readonly string $contactValue,
        private readonly string $contactType,
        private readonly string $iconUrl,
        private readonly string $actionUrl,
    ) {}

    public function getContactValue(): string
    {
        return $this->contactValue;
    }

    public function getContactType(): string
    {
        return $this->contactType;
    }

    public function getIconUrl(): string
    {
        return $this->iconUrl;
    }

    public function getActionUrl(): string
    {
        return $this->actionUrl;
    }
}
