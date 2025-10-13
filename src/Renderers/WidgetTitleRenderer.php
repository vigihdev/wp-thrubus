<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\WidgetTitleDto;
use Yiisoft\Html\Html;
use Yiisoft\Arrays\ArrayHelper;

final class WidgetTitleRenderer extends BaseRenderer
{

    private WidgetTitleDto $item;

    protected static function getName(): string
    {
        return 'widget-title';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof WidgetTitleDto) {
            throw new \InvalidArgumentException('item expects WidgetTitleDto');
        }

        $this->item = $item;
        return $this;
    }

    public function render(): string
    {

        if (is_null($this->item)) {
            return '';
        }

        $content = $this->renderWidgetTitle($this->item);

        if (empty($this->wrapperOptions)) {
            return $content;
        }

        return implode('', [
            Html::openTag('div', $this->wrapperOptions),
            $content,
            Html::closeTag('div'),
        ]);
    }

    private function renderWidgetTitle(WidgetTitleDto $widget): string
    {

        $name = $widget->getName();
        $name = preg_replace('/\s+/m', '-', strtolower($name));

        $widgetName = self::getName();
        $className = ArrayHelper::remove($this->options, 'class');
        $className = is_string($className) ? " {$className}" : null;
        $options = ArrayHelper::merge([], [
            'class' => "{$widgetName}{$className} {$widgetName}--{$name}",
        ]);


        return implode('', [
            Html::openTag('div', $options),
            Html::span('', ['class' => "{$widgetName}--main"]),
            Html::h3($widget->getTitle(), ['class' => 'text-label']),
            Html::closeTag('div'),
        ]);
    }
}
