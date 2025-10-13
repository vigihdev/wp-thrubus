<?php

declare(strict_types=1);

namespace WpThrubus\Contracts;

interface WidgetTitleContract
{

    public function getTitle(): string;

    public function getName(): string;
}
