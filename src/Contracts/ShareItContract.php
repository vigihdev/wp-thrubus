<?php

declare(strict_types=1);

namespace WpThrubus\Contracts;

interface ShareItContract
{

    public function getName(): string;
    public function getIconUrl(): string;
    public function getShareUrl(): string;
}
