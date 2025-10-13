<?php

declare(strict_types=1);

namespace WpThrubus\Core;

use Stringable;

final class PhoneLink implements Stringable
{

    public function __construct(
        private readonly string $noHp,
    ) {}

    public function build(): string
    {

        $noHp = $this->noHp;
        $noHp = preg_replace('/[^0-9]+/', '', $noHp);
        return "tel:{$noHp}";
    }

    public function __toString(): string
    {
        return $this->build();
    }
}
