<?php

namespace Gri\Acme\Repository;

use Gri\Acme\Config\Database;
use Gri\Acme\Model\Answer;
use Gri\Acme\Model\Question;
use PDO;

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

        return  $resultats->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQuestionById(int $id, bool $withAnswers = false): Question
    {
        $sql = 'SELECT * FROM question WHERE id = "' . $id .'";';
        
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new \OutOfRangeException('Impossible de trouver cet enregistrement');
        }


        $question = new Question();
        $question
            ->setId($result['id'])
            ->setText(  $result['text'])
        ;

        if (!$withAnswers) {
            return $question;
        }

        $sql = "SELECT * FROM answer WHERE FK_question = '" . $id . "';";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);


        if (!$results) {
            return $question;
        }

        foreach ($results as $result) {
            $answer = new Answer();
            $answer
                ->setId($result["id"])
                ->setText( $result["text"])
                ->setQuestion($question)
                ->setStatus($result["status"])
            ;

            $question->addAnswer($answer);
        }

        return $question;
    }

    public function addQuestion(Question &$question): Question
    {
        $sql = "INSERT INTO question (text, status) VALUES (:text, :status)";
        
        $query = $this->pdo->prepare($sql);
        $query->execute([
            ':text' => $question->getText(),
            ':status' => $question->getStatus()
        ]);

        $question->setId($this->pdo->lastInsertId());

        return $question;
    }

    public function updateQuestion(Question $question): Question
    {
        $sql = "UPDATE question SET text = :text, status = :status WHERE id = :id;";

        $query = $this->pdo->prepare($sql);
        $query->execute([
            ':id' => $question->getId(),
            ':text' => $question->getText(),
            ':status' => $question->getStatus()
        ]);

        return $question;
    }
}
