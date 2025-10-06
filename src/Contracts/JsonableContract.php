<?php

declare(strict_types=1);

namespace WpThrubus\Contracts;

interface JsonableContract
{
    public function toJson(int $options = 0): string;
}
