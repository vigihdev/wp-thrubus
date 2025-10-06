<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\FastResponseDto;
use Yiisoft\Html\Html;
use Yiisoft\Strings\Inflector;

final class FastResponseRenderer extends BaseRenderer implements RendererInterface
{

    /**
     * @var FastResponseDto[] $items
     */
    private array $items = [];

    protected static function getName(): string
    {
        return 'fast-response';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof FastResponseDto) {
            throw new \InvalidArgumentException('item expects OurClientDto');
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
            $itemsHtml[] = $this->renderCardFastResponse($item);
        }

        return implode('', [
            implode('', $itemsHtml),
        ]);
    }

    private function inflectorID(string $value)
    {
        $inflector = new Inflector();
        return $inflector->pascalCaseToId($inflector->toPascalCase($value));
    }


    private function renderCardFastResponse(FastResponseDto $fastResponse)
    {
        $options = [
            'class' => parent::getCardName() . ' ripple-effect user-select-none ' . $this->inflectorID($fastResponse->getFastType()),
            'onclick' => $this->onclick($fastResponse->getActionUrl())
        ];

        return implode('', [
            Html::openTag('div', $options),
            $this->renderMedia($fastResponse),
            $this->renderContent($fastResponse),
            Html::closeTag('div'),
        ]);
    }

    private function renderMedia(FastResponseDto $fastResponse)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardMedia()]),
            Html::img($fastResponse->getIconUrl(), $fastResponse->getFastType(), [
                'class' => self::getName() . '-image-media'
            ]),
            Html::closeTag('div')
        ]);
    }

    private function renderContent(FastResponseDto $fastResponse)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardContent()]),
            Html::div($fastResponse->getFastValue(), ['class' => 'text-label']),
            Html::closeTag('div')
        ]);
    }
}
