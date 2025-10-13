<?php

declare(strict_types=1);

namespace WpThrubus\Renderers\Posts;

use WpThrubus\DTOs\Posts\RecentPostDto;
use WpThrubus\Renderers\{BaseRenderer, RendererInterface};
use Yiisoft\Html\Html;


final class RecentPostRenderer extends BaseRenderer implements RendererInterface
{

    /**
     * @var RecentPostDto[] $items
     */
    private array $items = [];

    protected static function getName(): string
    {
        return 'recent-post';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof RecentPostDto) {
            throw new \InvalidArgumentException('item expects RecentPostDto');
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
            $itemsHtml[] = $this->renderCardRecentPost($item);
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


    private function renderCardRecentPost(RecentPostDto $recent)
    {
        $options = [
            'class' => parent::getCardName() . ' ripple-effect user-select-none',
            'onclick' => $this->onclick($recent->getActionUrl())
        ];

        return implode('', [
            Html::openTag('div', $options),
            $this->renderMedia($recent),
            $this->renderContent($recent),
            Html::closeTag('div'),
        ]);
    }

    private function renderMedia(RecentPostDto $recent)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardMedia()]),
            Html::img($recent->getImageUrl(), $recent->getTitle(), [
                'class' => self::getName() . '-image-media'
            ]),
            Html::closeTag('div')
        ]);
    }

    private function renderContent(RecentPostDto $recent)
    {
        $prefix = self::getName();
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardContent()]),
            Html::div($recent->getTitle(), ['class' => "{$prefix}-title"]),
            Html::div($recent->getSnippet(), ['class' => "{$prefix}-snippet"]),
            Html::closeTag('div')
        ]);
    }
}
