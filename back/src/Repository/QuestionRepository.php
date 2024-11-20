<?php

namespace Gri\Acme\Repository;

use Gri\Acme\Config\Database;
use Gri\Acme\Model\Question;

class QuestionRepository extends AbstractRepository
{
    private static $instance = null;

    private function __contruct() {}

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getAllQuestions(): array
    {
        $sql = "SELECT * FROM question;";

        $resultats = $this->pdo->prepare($sql);
        $resultats->execute();

        return  $resultats->fetchAll();
    }

    public function addQuestion(Question &$question): Question
    {
        $sql = "INSERT INTO question (text) VALUES (:text)";
        
        $new = $this->pdo->prepare($sql);
        $new->execute([':text' => $question->getText()]);

        $question->setId($this->pdo->lastInsertId());

        return $question;
    }
}
