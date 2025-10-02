<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\ListPostTypeDto;
use Yiisoft\Html\Html;

final class ListPostTypeRenderer extends BaseRenderer implements RendererInterface
{

    private array $items = [];

    protected static function getName(): string
    {
        return 'list-post-type';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof ListPostTypeDto) {
            throw new \InvalidArgumentException('item expects ListPostTypeDto');
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
            $itemsHtml[] = $this->renderListPostTypeCard($item);
        }

        return implode('', [
            implode('', $itemsHtml),
        ]);
    }

    private function renderListPostTypeCard(ListPostTypeDto $item): string
    {

        $options = [
            'class' => parent::getCardName() . ' ripple-effect',
            'onclick' => $this->onclick($item->getActionUrl())
        ];

        $media = $this->renderMedia($item);
        $title = $this->renderTitle($item);
        $content = $this->renderContent($item);
        return implode('', [
            Html::openTag('div', $options),
            $media,
            $title,
            $content,
            Html::closeTag('div'),
        ]);
    }

    private function renderMedia(ListPostTypeDto $item): string
    {

        $options = ['class' => parent::getCardMedia()];
        return implode('', [
            Html::openTag('div', $options),
            Html::img($item->getImageUrl(), $item->getTitle(), [
                'class' => parent::transformWithName('media-img')
            ]),
            Html::closeTag('div'),
        ]);
    }

    private function renderTitle(ListPostTypeDto $item): string
    {

        $options = ['class' => parent::transformWithCardName('title')];
        return implode('', [
            Html::openTag('div', $options),
            Html::span($item->getTitle(), ['class' => 'text-label']),
            Html::closeTag('div'),
        ]);
    }

    private function renderContent(ListPostTypeDto $item): string
    {

        $options = ['class' => parent::getCardContent()];
        return implode('', [
            Html::openTag('div', $options),
            Html::span($item->getSnippet(), ['class' => 'text-content']),
            Html::closeTag('div'),
        ]);
    }
}
