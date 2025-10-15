<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\AboutUsDto;
use Yiisoft\Html\Html;

final class AboutUsRenderer extends BaseRenderer implements RendererInterface
{

    private AboutUsDto $item;

    protected static function getName(): string
    {
        return 'about-us';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof AboutUsDto) {
            throw new \InvalidArgumentException('item expects AboutUsDto');
        }

        $this->item = $item;
        return $this;
    }

    public function render(): string
    {

        if (is_null($this->item)) {
            return '';
        }

        $itemsHtml = $this->renderCardAboutUs($this->item);

        if (empty($this->wrapperOptions)) {
            return implode('', [
                $itemsHtml,
            ]);
        }

        return implode('', [
            Html::openTag('div', $this->wrapperOptions),
            $itemsHtml,
            Html::closeTag('div'),
        ]);
    }

    private function renderCardAboutUs(AboutUsDto $about)
    {

        $options = [
            'class' => parent::getCardName(),
        ];

        return implode('', [
            Html::openTag('div', $options),
            $this->renderMedia($about),
            $this->renderContent($about),
            Html::closeTag('div'),
        ]);
    }

    private function renderMedia(AboutUsDto $about)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardMedia()]),
            Html::img($about->getLogoUrl(), 'Logo', [
                'class' => self::getName() . '-image-media'
            ]),
            Html::closeTag('div')
        ]);
    }

    private function renderContent(AboutUsDto $about)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardContent()]),
            Html::div($about->getDescription(), ['class' => 'text-description']),
            Html::closeTag('div')
        ]);
    }
}
