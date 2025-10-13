<?php

declare(strict_types=1);

namespace WpThrubus\Renderers\Posts;

use WpThrubus\DTOs\Posts\RelatedPostDto;
use WpThrubus\Renderers\{BaseRenderer, RendererInterface};
use Yiisoft\Html\Html;


final class RelatedPostRenderer extends BaseRenderer implements RendererInterface
{

    /**
     * @var RelatedPostDto[] $items
     */
    private array $items = [];

    protected static function getName(): string
    {
        return 'related-post';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof RelatedPostDto) {
            throw new \InvalidArgumentException('item expects RelatedPostDto');
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
            $itemsHtml[] = $this->renderCardRelatedPost($item);
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


    private function renderCardRelatedPost(RelatedPostDto $related)
    {
        $options = [
            'class' => parent::getCardName() . ' ripple-effect user-select-none',
            'onclick' => $this->onclick($related->getActionUrl())
        ];

        return implode('', [
            Html::openTag('div', $options),
            $this->renderMedia($related),
            $this->renderContent($related),
            Html::closeTag('div'),
        ]);
    }

    private function renderMedia(RelatedPostDto $related)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardMedia()]),
            Html::img($related->getImageUrl(), $related->getTitle(), [
                'class' => self::getName() . '-image-media'
            ]),
            Html::closeTag('div')
        ]);
    }

    private function renderContent(RelatedPostDto $related)
    {
        $prefix = self::getName();
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardContent()]),
            Html::div($related->getTitle(), ['class' => "{$prefix}-title"]),
            Html::div($related->getSnippet(), ['class' => "{$prefix}-snippet"]),
            Html::closeTag('div')
        ]);
    }
}
