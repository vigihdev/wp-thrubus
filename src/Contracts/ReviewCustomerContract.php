<?php

declare(strict_types=1);

namespace WpThrubus\Contracts;

interface ReviewCustomerContract
{

    /**
     * @return string
     */
    public function getUsername(): string;

    /**
     * @return float|int
     */
    public function getRating(): float|int;

    /**
     * @return string
     */
    public function getImageUrl(): string;

    /**
     * @return string
     */
    public function getReviewText(): string;
}
