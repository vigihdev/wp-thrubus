<?php

declare(strict_types=1);

namespace WpThrubus\Contracts;

interface ContactInfoContract
{
    public function getContactValue(): string;
    public function getIconUrl(): string;
    public function getActionUrl(): string;
    public function getContactType(): string;
}
