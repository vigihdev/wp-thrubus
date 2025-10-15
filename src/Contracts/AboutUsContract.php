<?php

declare(strict_types=1);

namespace WpThrubus\Contracts;

interface AboutUsContract
{

    public function getLogoUrl(): string;
    public function getDescription(): string;
}
