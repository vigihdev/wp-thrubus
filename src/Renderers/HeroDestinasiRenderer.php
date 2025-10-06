<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\Hero\HeroDestinasiDto;
use Yiisoft\Html\Html;

final class HeroDestinasiRenderer extends BaseRenderer implements RendererInterface
{

    /**
     * @var HeroDestinasiDto[] $items
     */
    private array $items = [];

    protected static function getName(): string
    {
        return 'hero-destinasi';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof HeroDestinasiDto) {
            throw new \InvalidArgumentException('item expects HeroDestinasiDto');
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
            $itemsHtml[] = $this->renderCardHeroDestinasi($item);
        }

        return implode('', [
            implode('', $itemsHtml),
        ]);
    }


    private function renderCardHeroDestinasi(HeroDestinasiDto $heroDestinasi)
    {
        $options = [
            'class' => parent::getCardName()
        ];

        return implode('', [
            Html::openTag('div', $options),
            $this->renderMedia($heroDestinasi),
            Html::closeTag('div'),
        ]);
    }

    private function renderMedia(HeroDestinasiDto $heroDestinasi)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardMedia()]),
            Html::img($heroDestinasi->getImageUrl(), $heroDestinasi->getName(), [
                'class' => self::getName() . '-image-media'
            ]),
            Html::closeTag('div')
        ]);
    }

    private function renderContent(HeroDestinasiDto $heroDestinasi)
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardContent()]),
            Html::closeTag('div')
        ]);
    }
}
