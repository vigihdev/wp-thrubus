<?php

declare(strict_types=1);

namespace WpThrubus\Contracts\Hero;

interface HeroSliderContract
{

    public function getName(): string;
    public function getImageUrl(): string;
}
