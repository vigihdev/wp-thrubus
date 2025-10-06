<?php

declare(strict_types=1);

namespace WpThrubus\Contracts\Whatsapp;

interface WhatsappPopupItemContract
{
    public function username(): string;
    public function avatarUrl(): string;
    public function noHp(): string;
}
