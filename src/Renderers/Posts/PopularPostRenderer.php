<?php

declare(strict_types=1);

namespace WpThrubus\Renderers\Posts;

use WpThrubus\DTOs\Posts\PopularPostDto;
use WpThrubus\Renderers\{BaseRenderer, RendererInterface};
use Yiisoft\Html\Html;


final class PopularPostRenderer extends BaseRenderer implements RendererInterface
{

    /**
     * @var PopularPostDto[] $items
     */
    private array $items = [];

    protected static function getName(): string
    {
        return 'popular-post';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof PopularPostDto) {
            throw new \InvalidArgumentException('item expects PopularPostDto');
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
            $itemsHtml[] = $this->renderCardPopularPost($item);
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


    private function renderCardPopularPost(PopularPostDto $popular)
    {
        $options = [
            'class' => parent::getCardName() . ' ripple-effect user-select-none',
            'onclick' => $this->onclick($popular->getActionUrl())
        ];

        return implode('', [
            Html::openTag('div', $options),
            $this->renderMedia($popular),
            $this->renderContent($popular),
            Html::closeTag('div'),
        ]);
    }

    private function renderMedia(PopularPostDto $popular)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardMedia()]),
            Html::closeTag('div')
        ]);
    }

    private function renderContent(PopularPostDto $popular)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardContent()]),
            Html::closeTag('div')
        ]);
    }
}
