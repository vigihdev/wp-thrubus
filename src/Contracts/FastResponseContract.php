<?php

declare(strict_types=1);

namespace WpThrubus\Contracts;

interface FastResponseContract
{
    public function getFastValue(): string;
    public function getFastType(): string;
    public function getIconUrl(): string;
    public function getActionUrl(): string;
}
