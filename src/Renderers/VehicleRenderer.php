<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\VehicleDto;
use Yiisoft\Html\Html;

final class VehicleRenderer extends BaseRenderer implements RendererInterface
{

    /**
     * @var VehicleDto[] $items
     */
    private array $items = [];

    protected static function getName(): string
    {
        return 'vehicle';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof VehicleDto) {
            throw new \InvalidArgumentException('item expects VehicleDto');
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
            $itemsHtml[] = $this->renderVehicleCard($item);
        }

        return implode('', [
            implode('', $itemsHtml),
        ]);
    }

    private function renderVehicleCard(VehicleDto $vehicle): string
    {

        $options = [
            'class' => parent::getCardName()
        ];

        $media = $this->renderCardMedia($vehicle);
        $content = $this->renderCardContent($vehicle);
        $action = $this->renderCardAction($vehicle);
        return implode('', [
            Html::openTag('div', $options),
            $media,
            $content,
            $action,
            Html::closeTag('div'),
        ]);
    }

    private function renderCardMedia(VehicleDto $vehicle): string
    {

        return implode('', [
            Html::openTag('div', ['class' => parent::getCardMedia()]),
            Html::img($vehicle->getImage(), $vehicle->getNama(), [
                'class' => 'vehicle-media-img'
            ]),
            Html::closeTag('div')
        ]);
    }

    private function renderCardContent(VehicleDto $vehicle): string
    {
        $prefix = 'vehicle-content-';
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardContent()]),
            Html::openTag('div', ['class' => $prefix . 'nama-mobil']),
            Html::div($vehicle->getNama(), ['class' => 'text-label']),
            Html::closeTag('div'),

            Html::openTag('div', ['class' => $prefix . 'harga']),
            Html::div($vehicle->getHargaFormatted(), ['class' => 'text-amount']),
            Html::closeTag('div'),

            Html::openTag('div', ['class' => $prefix . 'paket-sewa']),
            Html::div($vehicle->getPaketSewa(), ['class' => 'text-paket-sewa']),
            Html::closeTag('div'),

            Html::closeTag('div')
        ]);
    }

    private function renderCardBody(VehicleDto $vehicle): string
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardBody()]),
            Html::closeTag('div')
        ]);
    }

    private function renderCardAction(VehicleDto $vehicle): string
    {
        return implode('', [
            Html::openTag('div', ['class' => parent::getCardAction()]),
            Html::button('Pesan Sekarang', [
                'class' => 'btn btn-secondary btn-block ripple-effect'
            ]),
            Html::closeTag('div')
        ]);
    }
}
