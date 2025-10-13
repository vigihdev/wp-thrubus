<?php

declare(strict_types=1);

namespace WpThrubus\Core;

use Stringable;

final class EmailLink implements Stringable
{

    public function __construct(
        private readonly string $email,
    ) {}

    public function build(): string
    {

        $email = $this->email;
        return "mailto:{$email}";
    }

    public function __toString(): string
    {
        return $this->build();
    }
}
