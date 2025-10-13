<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\Whatsapp\{WhatsappPopupCollapseDto, WhatsappPopupHeaderDto, WhatsappPopupItemDto};
use Yiisoft\Html\Html;
use Yiisoft\Arrays\ArrayHelper;

final class WhatsappPopupRenderer extends BaseRenderer implements RendererInterface
{

    /**
     * @var WhatsappPopupItemDto[] $items
     */
    private array $items = [];

    protected static function getName(): string
    {
        return 'whatsapp-popup';
    }

    public function __construct(
        private readonly WhatsappPopupCollapseDto $popupCollapse,
        private readonly WhatsappPopupHeaderDto $popupHeader,
    ) {}

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof WhatsappPopupItemDto) {
            throw new \InvalidArgumentException('item expects WhatsappPopupItemDto');
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
            // $itemsHtml[] = $this->renderListPostTypeCard($item);
        }

        $content = implode('', [
            // implode('', $itemsHtml),
            // $this->renderPopupCollapse(),
            $this->renderPopupContent(),
        ]);

        if (empty($this->wrapperOptions)) {
            return $content;
        }

        return implode('', [
            Html::openTag('div', $this->wrapperOptions),
            $content,
            Html::closeTag('div'),
        ]);
    }

    private function renderPopupCollapse(): string
    {

        $options = [
            'class' => parent::getCardName()
        ];

        return implode('', [
            Html::openTag('div', $options),
            Html::closeTag('div'),
        ]);
    }

    private function renderPopupItem(): string
    {

        $itemsHtml = [];
        foreach ($this->items as $item) {
            $itemsHtml[] = implode('', [
                Html::openTag('div', ['class' => parent::transformWithName('item ripple-effect user-select-none')]),

                Html::openTag('div', ['class' => 'item-media']),
                Html::img($item->avatarUrl(), $item->username(), ['class' => 'img-media']),
                Html::div('', ['class' => 'circle-online']),
                Html::closeTag('div'),

                Html::openTag('div', ['class' => 'item-content']),
                Html::div($item->username(), ['class' => 'username']),
                Html::div($item->noHp(), ['class' => 'no-hp']),
                Html::closeTag('div'),

                Html::closeTag('div'),
            ]);
        }

        return implode('', $itemsHtml);
    }

    private function renderPopupContent(): string
    {

        $classOption = ArrayHelper::remove($this->options, 'class');
        $classOption = $classOption ? " {$classOption}" : null;
        $options = [
            'class' => parent::getCardName() . $classOption
        ];

        return implode('', [
            Html::openTag('div', $options),
            Html::openTag('div', ['class' => parent::getNameTitle()]),
            Html::div($this->popupHeader->getTitle(), ['class' => 'text-title']),
            Html::closeTag('div'),

            Html::openTag('div', ['class' => parent::transformWithName('item-group')]),
            $this->renderPopupItem(),
            Html::closeTag('div'),

            Html::closeTag('div'),
        ]);
    }
}
