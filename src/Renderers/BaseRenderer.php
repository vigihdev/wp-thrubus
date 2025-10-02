<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

abstract class BaseRenderer
{
    /**
     * @var array<string,mixed> $options
     */
    protected array $options = [];

    abstract protected static function getName(): string;

    abstract public function render(): string;

    public function __construct()
    {
        $this->options = array_merge($this->options, [
            'id' => static::getName() . '-' . bin2hex(random_bytes(5))
        ]);
    }

    protected function onclick(string $url): string
    {
        return "location.href='{$url}'";
    }

    protected function getOption(string $name): mixed
    {
        return isset($this->options[$name]) ? $this->options[$name] : null;
    }

    protected static function getCardName(): string
    {
        return 'card--' . static::getName();
    }

    protected static function transformWithName(string $param): string
    {
        return static::getName() . "-{$param}";
    }

    protected static function transformWithCardName(string $param): string
    {
        return static::getCardName() . "-{$param}";
    }

    protected static function getCardHeader(): string
    {
        return static::getCardName() . '-header';
    }

    protected static function getCardBody(): string
    {
        return static::getCardName() . '-body';
    }

    protected static function getCardContent(): string
    {
        return static::getCardName() . '-content';
    }

    protected static function getCardMedia(): string
    {
        return static::getCardName() . '-media';
    }

    protected static function getCardAction(): string
    {
        return static::getCardName() . '-action';
    }

    protected static function getNameTitle(): string
    {
        return static::getName() . '-title';
    }
}
