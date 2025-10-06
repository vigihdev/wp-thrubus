<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\Entity\OwlCarousel\{OwlCarouselOptions, OwlCarouselResponsive};
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;


final class OwlCarouselRenderer extends BaseRenderer implements RendererInterface
{

    private string $item = '';

    protected static function getName(): string
    {
        return 'owl-carousel';
    }

    public function __construct(
        private readonly OwlCarouselOptions $owlOptions,
        private readonly OwlCarouselResponsive $owlResponsive
    ) {}

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!is_string($item)) {
            throw new \InvalidArgumentException('item harus string');
        }

        $this->item = $item;
        return $this;
    }

    public function render(): string
    {

        if (empty($this->item)) {
            return '';
        }

        return $this->renderOwlCarousel($this->item);
    }

    private function renderOwlCarousel(string $content): string
    {

        $owlOption = json_encode(
            ArrayHelper::merge($this->owlOptions->toArray(), [
                'responsive' => $this->owlResponsive->toArray()
            ]),
            JSON_FORCE_OBJECT
        );

        $className = self::getName();
        $options = [
            'class' => "{$className} {$className}-root owl-theme",
            'data-options' => $owlOption
        ];

        return implode('', [
            Html::openTag('div', $options),
            $content,
            Html::closeTag('div'),
        ]);
    }
}
