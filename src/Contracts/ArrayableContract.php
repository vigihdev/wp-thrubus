<?php

declare(strict_types=1);

namespace WpThrubus\Contracts;

interface ArrayableContract
{
    public function toArray(): array;
}
