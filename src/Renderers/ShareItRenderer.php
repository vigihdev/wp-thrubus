<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\ShareItDto;
use Yiisoft\Html\Html;

final class ShareItRenderer extends BaseRenderer implements RendererInterface
{

    /**
     * @var ShareItDto[] $items
     */
    private array $items = [];

    protected static function getName(): string
    {
        return 'share-it';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof ShareItDto) {
            throw new \InvalidArgumentException('item expects ShareItDto');
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
            $itemsHtml[] = $this->renderCardShareIt($item);
        }

        return implode('', [
            implode('', $itemsHtml),
        ]);
    }


    private function renderCardShareIt(ShareItDto $shareIt)
    {
        $name = $shareIt->getName();
        $name = preg_replace('/\s+/m', '-', strtolower($name));

        $options = [
            'class' => parent::getCardName() . " ripple-effect {$name}"
        ];

        return implode('', [
            Html::openTag('div', $options),
            $this->renderMedia($shareIt),
            Html::closeTag('div'),
        ]);
    }

    private function renderMedia(ShareItDto $shareIt)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardMedia()]),
            Html::img($shareIt->getIconUrl(), $shareIt->getName(), [
                'class' => self::getName() . '-image-media'
            ]),
            Html::closeTag('div')
        ]);
    }

    private function renderContent(ShareItDto $shareIt)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardContent()]),
            Html::closeTag('div')
        ]);
    }
}
