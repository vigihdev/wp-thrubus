<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\VehicleCompactDto;
use WpThrubus\DTOs\VehicleCompactHargaDto;
use WpThrubus\DTOs\VehicleNotAvailableHargaDto;
use Yiisoft\Html\Html;
use Yiisoft\Arrays\ArrayHelper;

final class VehicleCompactRenderer extends BaseRenderer implements VehicleCompactRendererInterface
{

    private array $items = [];


    protected static function getName(): string
    {
        return 'vehicle-compact';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    /**
     *
     * @param VehicleCompactDto $itemMobil
     * @param VehicleCompactHargaDto[] $itemHargas
     * @return self
     */
    public function addCompact(VehicleCompactDto $itemMobil, array $itemHargas): self
    {
        $this->items[] = ArrayHelper::merge([$itemMobil], $itemHargas);
        return $this;
    }

    public function render(): string
    {

        if (empty($this->items)) {
            return '';
        }

        $itemsHtml = [];

        foreach ($this->items as $items) {
            $options = [
                'class' => parent::getCardName()
            ];

            $vehicleMobil = array_shift($items);
            if ($vehicleMobil instanceof VehicleCompactDto) {
                $media = $this->renderCardMedia($vehicleMobil);
                $action = $this->renderCardAction($vehicleMobil);

                $content = $this->renderCardContent($vehicleMobil, $items);

                $itemsHtml[] = implode('', [
                    Html::openTag('div', $options),
                    $media,
                    $content,
                    $action,
                    Html::closeTag('div'),
                ]);
            }
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

    private function renderCardMedia(VehicleCompactDto $vehicle): string
    {

        return implode('', [
            Html::openTag('div', ['class' => parent::getCardMedia()]),
            Html::img($vehicle->getImage(), $vehicle->getNama(), [
                'class' => 'vehicle-media-img'
            ]),
            Html::closeTag('div')
        ]);
    }

    /**
     *
     * @param VehicleCompactDto $vehicleMobil
     * @param VehicleCompactHargaDto[] $vehicleHargas
     * @return string
     */
    private function renderCardContent(VehicleCompactDto $vehicleMobil, array $vehicleHargas): string
    {

        $prefix = 'vehicle-content-';
        $contents = [];
        foreach ($vehicleHargas as $vehicle) {

            $amount = null;
            if ($vehicle instanceof VehicleCompactHargaDto) {
                $amount = Html::span($vehicle->getHargaFormatted(), ['class' => 'text-amount']);
            }

            if ($vehicle instanceof VehicleNotAvailableHargaDto) {
                $amount = Html::span($vehicle->getHarga(), ['class' => 'text-not-available']);
            }

            $contents[] = implode('', [
                Html::openTag('div', ['class' => $prefix . 'group']),
                $amount,
                Html::div($vehicle->getPaketSewa(), ['class' => 'text-paket-sewa']),
                Html::closeTag('div'),
            ]);
        }

        return implode('', [
            Html::openTag('div', ['class' => parent::getCardContent()]),
            Html::openTag('div', ['class' => $prefix . 'nama-mobil']),
            Html::div($vehicleMobil->getNama(), ['class' => 'text-label']),
            Html::closeTag('div'),
            implode('', $contents),
            Html::closeTag('div')
        ]);
    }


    private function renderCardAction(VehicleCompactDto $vehicle): string
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
