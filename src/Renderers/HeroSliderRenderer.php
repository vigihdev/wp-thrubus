<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\Hero\HeroSliderDto;
use Yiisoft\Html\Html;

final class HeroSliderRenderer extends BaseRenderer implements RendererInterface
{

    /**
     * @var HeroSliderDto[] $items
     */
    private array $items = [];

    protected static function getName(): string
    {
        return 'hero-slider';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof HeroSliderDto) {
            throw new \InvalidArgumentException('item expects HeroSliderDto');
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
            $itemsHtml[] = $this->renderCardHeroSlider($item);
        }

        return implode('', [
            implode('', $itemsHtml),
        ]);
    }


    private function renderCardHeroSlider(HeroSliderDto $heroSlider)
    {
        $options = [
            'class' => parent::getCardName()
        ];

        return implode('', [
            Html::openTag('div', $options),
            $this->renderMedia($heroSlider),
            Html::closeTag('div'),
        ]);
    }

    private function renderMedia(HeroSliderDto $heroSlider)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardMedia()]),
            Html::img($heroSlider->getImageUrl(), $heroSlider->getName(), [
                'class' => self::getName() . '-image-media'
            ]),
            Html::closeTag('div')
        ]);
    }

    private function renderContent(HeroSliderDto $heroSlider)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardContent()]),
            Html::closeTag('div')
        ]);
    }
}
