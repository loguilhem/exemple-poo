<?php

namespace Gri\Acme\Model;

class Question
{
    private $id;

    private $text;

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
}
