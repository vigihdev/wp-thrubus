<?php

declare(strict_types=1);

namespace WpThrubus\Core;

use Stringable;

final class WaMeCore implements Stringable
{

    private static string $endPaintUrl = 'https://wa.me';

    public function __construct(
        private readonly string $noHp,
        private readonly string $text,
    ) {}

    public function build(): string
    {

        $noHp = $this->noHp;
        $noHp = preg_replace('/[^0-9]+/', '', $noHp);
        $text = $this->text;
        $text = urlencode($text);
        return self::$endPaintUrl . DIRECTORY_SEPARATOR . $noHp . "?text={$text}";
    }

    public function __toString(): string
    {
        return $this->build();
    }
}
