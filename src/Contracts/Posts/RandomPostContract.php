<?php

declare(strict_types=1);

namespace WpThrubus\Contracts\Posts;

interface RandomPostContract
{
    public function getTitle(): string;
    public function getSnippet(): string;
    public function getImageUrl(): string;
    public function getActionUrl(): string;
}
