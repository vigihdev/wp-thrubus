<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

interface RendererInterface
{


    public function addItem(mixed $item): self;

    /**
     * Set rendering options
     * 
     * @param array<string,mixed> $options
     */
    public function setOptions(array $options): self;
}
