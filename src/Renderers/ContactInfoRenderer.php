<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\ContactInfoDto;
use Yiisoft\Html\Html;

final class ContactInfoRenderer extends BaseRenderer implements RendererInterface
{

    /**
     * @var ContactInfoDto[] $items
     */
    private array $items = [];

    protected static function getName(): string
    {
        return 'contact-info';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof ContactInfoDto) {
            throw new \InvalidArgumentException('item expects ContactInfoDto');
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
            $itemsHtml[] = $this->renderCardContactInfo($item);
        }

        return implode('', [
            implode('', $itemsHtml),
        ]);
    }


    private function renderCardContactInfo(ContactInfoDto $contactInfo)
    {

        $options = [
            'class' => parent::getCardName()
        ];

        return implode('', [
            Html::openTag('div', $options),
            $this->renderMedia($contactInfo),
            Html::closeTag('div'),
        ]);
    }

    private function renderMedia(ContactInfoDto $contactInfo)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardMedia()]),
            Html::img($contactInfo->getIconUrl(), $contactInfo->getContactType(), [
                'class' => self::getName() . '-image-media'
            ]),
            Html::closeTag('div')
        ]);
    }

    private function renderContent(ContactInfoDto $contactInfo)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardContent()]),
            Html::closeTag('div')
        ]);
    }
}
