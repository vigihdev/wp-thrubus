<?php

declare(strict_types=1);

namespace WpThrubus\Contracts;

interface ConnectWithUsContract
{

    public function getName(): string;
    public function getIconUrl(): string;
    public function getActionUrl(): string;
}
