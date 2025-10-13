<?php

declare(strict_types=1);

namespace WpThrubus\Renderers\Posts;

use WpThrubus\DTOs\Posts\RandomPostDto;
use WpThrubus\Renderers\{BaseRenderer, RendererInterface};
use Yiisoft\Html\Html;


final class RandomPostRenderer extends BaseRenderer implements RendererInterface
{

    /**
     * @var RandomPostDto[] $items
     */
    private array $items = [];

    protected static function getName(): string
    {
        return 'random-post';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof RandomPostDto) {
            throw new \InvalidArgumentException('item expects RandomPostDto');
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
            $itemsHtml[] = $this->renderCardRandomPost($item);
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


    private function renderCardRandomPost(RandomPostDto $random)
    {
        $options = [
            'class' => parent::getCardName() . ' ripple-effect user-select-none',
            'onclick' => $this->onclick($random->getActionUrl())
        ];

        return implode('', [
            Html::openTag('div', $options),
            $this->renderMedia($random),
            $this->renderContent($random),
            Html::closeTag('div'),
        ]);
    }

    private function renderMedia(RandomPostDto $random)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardMedia()]),
            Html::img($random->getImageUrl(), $random->getTitle(), [
                'class' => self::getName() . '-image-media'
            ]),
            Html::closeTag('div')
        ]);
    }

    private function renderContent(RandomPostDto $random)
    {
        $prefix = self::getName();
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardContent()]),
            Html::div($random->getTitle(), ['class' => "{$prefix}-title"]),
            Html::div($random->getSnippet(), ['class' => "{$prefix}-snippet"]),
            Html::closeTag('div')
        ]);
    }
}
