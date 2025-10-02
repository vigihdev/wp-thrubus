<?php

declare(strict_types=1);

namespace WpThrubus\Contracts;

interface QuestionAnswerContract
{

    public function getQuestion(): string;
    public function getAnswers(): array;
}
