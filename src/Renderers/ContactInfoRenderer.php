<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\ContactInfoDto;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;
use Yiisoft\Strings\Inflector;

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

        if (empty($this->wrapperOptions)) {
            return implode('', [
                implode('', $itemsHtml),
            ]);
        }

        return implode('', [
            Html::openTag('div', $this->wrapperOptions),
            implode('', $itemsHtml),
            Html::closeTag('div'),
        ]);
    }

    private function inflectorID(string $value)
    {
        $inflector = new Inflector();
        return $inflector->pascalCaseToId($inflector->toPascalCase($value));
    }

    private function renderCardContactInfo(ContactInfoDto $contactInfo)
    {

        $options = [
            'class' => parent::getCardName() . ' ripple-effect user-select-none ' . $this->inflectorID($contactInfo->getContactType()),
            'onclick' => $this->onclick($contactInfo->getActionUrl())
        ];


        return implode('', [
            Html::openTag('div', $options),
            $this->renderMedia($contactInfo),
            $this->renderContent($contactInfo),
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
            Html::div($contactInfo->getContactValue(), ['class' => 'text-label']),
            Html::closeTag('div')
        ]);
    }
}
