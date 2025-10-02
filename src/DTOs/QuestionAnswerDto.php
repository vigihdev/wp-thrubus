<?php

declare(strict_types=1);

namespace WpThrubus\DTOs;

use WpThrubus\Contracts\QuestionAnswerContract;

final class QuestionAnswerDto extends BaseDto implements QuestionAnswerContract
{

    public function __construct(
        private readonly string $question,
        private readonly array $answers
    ) {}

    public function getAnswers(): array
    {
        return $this->answers;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }
}
