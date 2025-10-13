<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\OurClientDto;
use Yiisoft\Html\Html;

final class OurClientRenderer extends BaseRenderer implements RendererInterface
{

    /**
     * @var OurClientDto[] $items
     */
    private array $items = [];

    protected static function getName(): string
    {
        return 'our-client';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof OurClientDto) {
            throw new \InvalidArgumentException('item expects OurClientDto');
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
            $itemsHtml[] = $this->renderCardOurClient($item);
        }

        $content = implode('', $itemsHtml);

        if (empty($this->wrapperOptions)) {
            return $content;
        }

        return implode('', [
            Html::openTag('div', $this->wrapperOptions),
            $content,
            Html::closeTag('div'),
        ]);
    }

    private function renderCardOurClient(OurClientDto $ourClient)
    {
        $options = [
            'class' => parent::getCardName()
        ];

        return implode('', [
            Html::openTag('div', $options),
            $this->renderMedia($ourClient),
            Html::closeTag('div'),
        ]);
    }

    private function renderMedia(OurClientDto $ourClient)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardMedia()]),
            Html::img($ourClient->getImageUrl(), $ourClient->getName(), [
                'class' => self::getName() . '-image-media'
            ]),
            Html::closeTag('div')
        ]);
    }

    private function renderContent(OurClientDto $ourClient)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardContent()]),
            Html::closeTag('div')
        ]);
    }
}
