<?php

declare(strict_types=1);

namespace WpThrubus\Core;

use Stringable;

final class ApiWhatsappCore implements Stringable
{

    private static string $endPaintUrl = 'https://api.whatsapp.com/send';

    public function __construct(
        private readonly string $phone,
        private readonly string $text,
    ) {}

    public function build(): string
    {

        $phone = $this->phone;
        $phone = preg_replace('/[^0-9]+/', '', $phone);
        $text = $this->text;
        $text = urlencode($text);

        $query = http_build_query(['phone' => $phone, 'text' => $text]);
        return self::$endPaintUrl . "?{$query}";
    }

    public function __toString(): string
    {
        return $this->build();
    }
}
