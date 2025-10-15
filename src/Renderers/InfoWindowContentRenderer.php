<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\GoogleMaps\InfoWindowContentDto;
use Yiisoft\Html\Html;

final class InfoWindowContentRenderer extends BaseRenderer implements RendererInterface
{

    private InfoWindowContentDto $item;

    protected static function getName(): string
    {
        return 'info-window';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof InfoWindowContentDto) {
            throw new \InvalidArgumentException('item expects InfoWindowContentDto');
        }

        $this->item = $item;
        return $this;
    }

    public function render(): string
    {

        if (is_null($this->item)) {
            return '';
        }

        $content = $this->renderInfoWindowContentCard($this->item);

        if (empty($this->wrapperOptions)) {
            return $content;
        }

        return implode('', [
            Html::openTag('div', $this->wrapperOptions),
            $content,
            Html::closeTag('div'),
        ]);
    }

    private function renderInfoWindowContentCard(InfoWindowContentDto $infoWindow): string
    {

        $options = [
            'class' => parent::getCardName(),
        ];

        $media = $this->renderMedia($infoWindow);
        $title = $this->renderTitle($infoWindow);
        $content = $this->renderContent($infoWindow);

        return implode('', [
            Html::openTag('div', $options),
            $title,
            $media,
            $content,
            Html::closeTag('div'),
        ]);
    }

    private function renderMedia(InfoWindowContentDto $infoWindow): string
    {

        $options = [
            'class' => parent::getCardMedia()
        ];

        return implode('', [
            Html::openTag('div', $options),
            Html::img($infoWindow->getImageUrl(), $infoWindow->getTitle(), [
                'class' => parent::transformWithName('image-media')
            ]),
            Html::closeTag('div'),
        ]);
    }

    private function renderTitle(InfoWindowContentDto $infoWindow): string
    {

        $options = [
            'class' => parent::transformWithCardName('title')
        ];
        return implode('', [
            Html::openTag('div', $options),
            Html::span($infoWindow->getTitle(), ['class' => 'text-label']),
            Html::closeTag('div'),
        ]);
    }

    private function renderContent(InfoWindowContentDto $infoWindow): string
    {

        $options = [
            'class' => parent::getCardContent()
        ];

        $jumlahUlasan = (string)$infoWindow->getJumlahUlasan();
        return implode('', [
            Html::openTag('div', $options),

            Html::openTag('span', ['class' => 'rating-number']),
            Html::span((string)$infoWindow->getRating(), ['class' => 'text-content']),
            Html::closeTag('span'),

            $this->ratingStar($infoWindow->getRating()),

            Html::openTag('span', ['class' => 'jumlah-ulasan']),
            Html::span("({$jumlahUlasan})", ['class' => 'ulasan-number']),
            Html::span('Ulasan', ['class' => 'ulasan-text']),
            Html::closeTag('span'),

            Html::closeTag('div'),
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
            Html::openTag('span', ['class' => 'rating-group']),
            Html::span($stars5, ['class' => 'rating-star'])->encode(false),
            // Html::span("({$rating})", ['class' => 'rating-number']),
            Html::closeTag('span')
        ]);
    }
}
