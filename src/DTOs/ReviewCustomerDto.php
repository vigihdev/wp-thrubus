<?php

declare(strict_types=1);

namespace WpThrubus\DTOs;

use WpThrubus\Contracts\ReviewCustomerContract;

final class ReviewCustomerDto extends BaseDto implements ReviewCustomerContract
{

    public function __construct(
        private string $username,
        private float|int $rating,
        private string $imageUrl,
        private string $reviewText

    ) {}

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return float|int
     */
    public function getRating(): float|int
    {
        return $this->rating;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @return string
     */
    public function getReviewText(): string
    {
        return $this->reviewText;
    }
}
