<?php

declare(strict_types=1);

namespace WpThrubus\Contracts;

interface ListPostTypeContract
{

    /**
     *
     * @return string Judul Post Type
     */
    public function getTitle(): string;

    /**
     *
     * @return string URL gambar artikel
     */
    public function getImageUrl(): string;

    public function getActionUrl(): string;

    /**
     * @return string Cuplikan konten artikel
     */
    public function getSnippet(): string;
}
