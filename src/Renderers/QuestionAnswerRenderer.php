<?php

declare(strict_types=1);

namespace WpThrubus\Renderers;

use WpThrubus\DTOs\QuestionAnswerDto;
use Yiisoft\Html\Html;

final class QuestionAnswerRenderer extends BaseRenderer implements RendererInterface
{

    /**
     * @var QuestionAnswerDto[] $items
     */
    private array $items = [];

    protected static function getName(): string
    {
        return 'question-answer';
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function addItem(mixed $item): self
    {
        if (!$item instanceof QuestionAnswerDto) {
            throw new \InvalidArgumentException('item expects QuestionAnswerDto');
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
            $itemsHtml[] = $this->renderQuestionAnswerCard($item, $i);
        }

        $content = implode('', [
            Html::openTag('div', [
                'class' => parent::transformWithName('root'),
                'id' => $this->getOption('id')
            ]),
            implode('', $itemsHtml),
            Html::closeTag('div'),
        ]);

        if (empty($this->wrapperOptions)) {
            return $content;
        }

        return implode('', [
            Html::openTag('div', $this->wrapperOptions),
            $content,
            Html::closeTag('div'),
        ]);
    }

    private function renderQuestionAnswerCard(QuestionAnswerDto $question, int $index): string
    {

        $options = [
            'class' => parent::getCardName(),
        ];

        $optionsQuestion = [
            'class' => 'card-question',
            'id' => "question-{$index}"
        ];

        $optionsAnswer = [
            'class' => 'card-answer collapse',
            'data-parent' => '#' . $this->getOption('id'),
            'aria-labelledby' => "question-{$index}",
            'id' => "answer-{$index}"
        ];

        return implode('', [
            Html::openTag('div', $options),

            Html::openTag('div', $optionsQuestion),
            $this->renderQuestionCollapse(
                target: "answer-{$index}",
                parent: $this->getOption('id'),
                content: $question->getQuestion()
            ),
            Html::closeTag('div'),

            Html::openTag('div', $optionsAnswer),
            $this->renderAnswers($question->getAnswers()),
            Html::closeTag('div'),

            Html::closeTag('div'),
        ]);
    }


    /**
     * Merender ikon 'add' sebagai string HTML.
     *
     * @return string Representasi HTML dari ikon 'add'.
     */
    private function renderIconAdd(): string
    {
        return Html::span('add', ['class' => 'material-icons-outlined'])->render();
    }

    /**
     * Merender elemen collapse untuk pertanyaan.
     *
     * @param string $target ID target elemen yang akan diciutkan.
     * @param string $parent ID parent untuk grup collapse.
     * @param string $content Teks pertanyaan yang akan ditampilkan.
     * @return string Representasi HTML dari elemen collapse pertanyaan.
     */
    private function renderQuestionCollapse(string $target, string $parent, string $content): string
    {
        return implode('', [
            Html::openTag('div', [
                'role' => 'button',
                'data-toggle' => 'collapse',
                'data-target' => '#' . $target,
                'data-parent' => '#' . $parent,
                'aria-expanded' => 'false',
                'aria-controls' => $target,
                'aria-labelledby' => $target,
                'tabindex' => '0',
                'class' => 'collapse-group ripple-effect collapsed'
            ]),
            Html::span($content, ['class' => 'question-text']),
            Html::span('add', ['class' => 'material-icons-outlined'])->render(),
            Html::closeTag('div'),
        ]);
    }

    /**
     * Merender daftar jawaban menjadi string HTML.
     *
     * @param array $answers Array berisi teks jawaban.
     * @return string Representasi HTML dari daftar jawaban.
     */
    private function renderAnswers(array $answers): string
    {

        $answers = array_map(function ($value, $key)  use ($answers) {
            if (count($answers) === 1) {
                return Html::div($value, ['class' => 'answer-text'])->render();
            }

            return implode('', [
                Html::openTag('div', ['class' => 'answer-group-text']),
                Html::span((string) ($key + 1), ['class' => 'answer-number']),
                Html::span($value, ['class' => 'answer-text']),
                Html::closeTag('div'),
            ]);
        }, $answers, array_keys($answers));

        return implode('', $answers);
    }
}
