<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\ReviewCustomerDto;
use Yiisoft\Html\Html;

final class ReviewCustomerRenderer extends BaseRenderer implements RendererInterface
{

    private array $items = [];

    protected static function getName(): string
    {
        return 'review-customer';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof ReviewCustomerDto) {
            throw new \InvalidArgumentException('item expects ReviewCustomerDto');
        }

        $this->items[] = $item;
        return $this;
    }

    public function render(): string
    {

        if (empty($this->items)) {
            return '';
        }

        $itemsHtml = [];

        foreach ($this->items as $item) {
            $itemsHtml[] = $this->renderReviewCustomerCard($item);
        }

        return implode('', [
            implode('', $itemsHtml),
        ]);
    }

    private function renderReviewCustomerCard(ReviewCustomerDto $review): string
    {

        $options = [
            'class' => parent::getCardName()
        ];

        $header = $this->renderHeader($review);
        $content = $this->renderContent($review);
        return implode('', [
            Html::openTag('div', $options),
            $header,
            $content,
            Html::closeTag('div'),
        ]);
    }

    private function renderHeader(ReviewCustomerDto $review)
    {

        return implode('', [
            Html::openTag('div', ['class' => parent::getCardHeader()]),

            Html::openTag('div', ['class' => parent::transformWithName('media')]),
            Html::img($review->getImageUrl(), $review->getUsername(), [
                'class' => parent::transformWithName('media-img')
            ]),
            Html::closeTag('div'),

            Html::openTag('div', ['class' => parent::transformWithName('profile')]),
            Html::div($review->getUsername(), ['class' => 'username text-content']),
            $this->ratingStar(5),

            Html::closeTag('div'),

            Html::closeTag('div')
        ]);
    }

    private function renderContent(ReviewCustomerDto $review)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardContent()]),
            Html::span($review->getReviewText(), ['class' => 'text-content']),
            Html::closeTag('div')
        ]);
    }

    /**
     * Mengembalikan string HTML yang merepresentasikan bintang rating berdasarkan nilai rating yang diberikan.
     *
     * @param float|string|int $rating Nilai rating (misal: 4.5).
     * @return string String HTML dari bintang rating.
     */
    private function ratingStar(float|string|int $rating): string
    {
        $stars = implode('', [
            Html::span('star', ['class' => 'material-icons-outlined text-warning']),
            Html::span('star', ['class' => 'material-icons-outlined text-warning']),
            Html::span('star', ['class' => 'material-icons-outlined text-warning'])
        ]);

        $stars4 = implode('', [
            $stars,
            Html::span('star_half', ['class' => 'material-icons-outlined text-warning'])
        ]);

        $stars5 = implode('', [
            $stars,
            Html::span('star', ['class' => 'material-icons-outlined text-warning']),
            Html::span('star_half', ['class' => 'material-icons-outlined text-warning'])
        ]);


        return implode('', [
            Html::openTag('div', ['class' => 'rating-group']),
            Html::span($stars5, ['class' => 'rating-star'])->encode(false),
            Html::span("({$rating})", ['class' => 'rating-number']),
            Html::closeTag('div')
        ]);
    }
}
