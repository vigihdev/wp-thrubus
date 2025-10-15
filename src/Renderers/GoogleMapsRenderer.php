<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\GoogleMaps\MapsDto;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

final class GoogleMapsRenderer extends BaseRenderer implements RendererInterface
{

    public function __construct(
        private readonly MapsDto $map
    ) {}

    protected static function getName(): string
    {
        return 'google-maps';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        return $this;
    }

    public function render(): string
    {

        $options = [
            'class' => parent::getCardName(),
            'id' => self::getName(),
            'style' => 'height:400px;',
            'data-options' => $this->getOptionMap()
        ];

        return implode('', [
            Html::openTag('div', $options),
            Html::closeTag('div'),
        ]);
    }

    private function getOptionMap(): string
    {
        $map = $this->map;
        $latLng = $map->getCenter();
        $marker = $map->getMarker();
        $infoWindow = $map->getInfoWindow();
        $options = ArrayHelper::merge($latLng->toArray(), [
            'center' => $latLng->toArray(),
            'marker' => array_filter($marker->toArray(), fn($value) => $value),
            'infoWindow' => array_filter($infoWindow->toArray(), fn($value) => $value)
        ]);

        return json_encode($options);
    }
}
