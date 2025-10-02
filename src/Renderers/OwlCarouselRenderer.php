<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\OwlCarouselDto;
use Yiisoft\Html\Html;

final class OwlCarouselRenderer extends BaseRenderer implements RendererInterface
{

    /**
     * @var OwlCarouselDto[] $items
     */
    private array $items = [];

    protected static function getName(): string
    {
        return 'owl-carousel';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof OwlCarouselDto) {
            throw new \InvalidArgumentException('item expects OwlCarouselDto');
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
        foreach ($this->items as $i => $item) {
            // $itemsHtml[] = $this->renderQuestionAnswerCard($item, $i);
        }

        return implode('', [
            implode('', $itemsHtml),
        ]);
    }
}
