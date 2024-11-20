<?php

namespace Gri\Acme\Model;

class Answer
{
    private $id;

    private $text;

    private $status;

    private $question;

    public function setId(int $id): Answer
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setText(string $text): Answer
    {
        $this->text = $text;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setStatus(int $status): Answer
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setQuestion(Question $question): Answer
    {
        $this->question = $question;

        return $this;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }
}
