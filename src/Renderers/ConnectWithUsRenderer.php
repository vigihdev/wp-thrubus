<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\ConnectWithUsDto;
use Yiisoft\Html\Html;

final class ConnectWithUsRenderer extends BaseRenderer implements RendererInterface
{

    /**
     * @var ConnectWithUsDto[] $items
     */
    private array $items = [];

    protected static function getName(): string
    {
        return 'connect-with-us';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof ConnectWithUsDto) {
            throw new \InvalidArgumentException('item expects ConnectWithUsDto');
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
            $itemsHtml[] = $this->renderCardConnectWithUs($item);
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


    private function renderCardConnectWithUs(ConnectWithUsDto $connect)
    {

        $name = $connect->getName();
        $name = preg_replace('/\s+/m', '-', strtolower($name));

        $options = [
            'class' => parent::getCardName() . " ripple-effect {$name}",
            'onclick' => $this->windowOpen($connect->getActionUrl())
        ];

        return implode('', [
            Html::openTag('div', $options),
            $this->renderMedia($connect),
            Html::closeTag('div'),
        ]);
    }

    private function renderMedia(ConnectWithUsDto $connect)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardMedia()]),
            Html::img($connect->getIconUrl(), $connect->getName(), [
                'class' => self::getName() . '-image-media'
            ]),
            Html::closeTag('div')
        ]);
    }

    private function renderContent(ConnectWithUsDto $connect)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardContent()]),
            Html::closeTag('div')
        ]);
    }
}
