<?php

declare(strict_types=1);

namespace WpThrubus\DTOs;

use WpThrubus\Contracts\ConnectWithUsContract;

final class ConnectWithUsDto extends BaseDto implements ConnectWithUsContract
{


    public function __construct(
        private readonly string $name,
        private readonly string $iconUrl,
        private readonly string $actionUrl,
    ) {}

    public function getName(): string
    {
        return $this->name;
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
