<?php

declare(strict_types=1);

namespace WpThrubus\Contracts;

interface OurClientContract
{

    public function getName(): string;
    public function getImageUrl(): string;
}
