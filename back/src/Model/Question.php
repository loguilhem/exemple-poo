<?php

namespace Gri\Acme\Model;

use ArrayObject;

class Question
{
    private $id;

    private $text;

    private $answers;

    public function setId(int $id): Question
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setText(string $text): Question
    {
        $this->text = $text;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function addAnswer(Answer $answer): Question
    {
        $this->answers[] = $answer;

        return $this;
    }

    public function getAnswers(): array
    {
        return $this->answers;
    }
}
