<?php

namespace Gri\Acme\Model;

class Question
{
    private $id;

    private $question;

    public function setId(int $id): Question
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setQuestion(string $question): Question
    {
        $this->question = $question;

        return $this;
    }
}