<?php

namespace Gri\Acme\Controller;

use Gri\Acme\Model\Question;
use Gri\Acme\Repository\QuestionRepository;
use Gri\Acme\Validator\NewQuestionValidator;

class MainController
{
    public function index()
    {
        $repo = QuestionRepository::getInstance();
        $all = $repo->getAllQuestions();
    
        $dataEncode = json_encode($all);

        return $dataEncode;
    }

    public function addQuestion(string $data)
    {
        $validator = new NewQuestionValidator();
        $text =$validator->cleanup($data);

        $newQuestion = new Question();
        $newQuestion->setText($text);

        $repo = QuestionRepository::getInstance();        
        $repo->addQuestion($newQuestion);

        header('Content-Type: application/json');
        $response = [
            'status' => 'success',
            'code' => 200,
            'message' => 'La question avec ID ' . $newQuestion->getId() . ' a bien été enregistré',
            'data' => [
                'id' => $newQuestion->getId(),
                'text' => $newQuestion->getText()
            ]
        ];

        return json_encode($response);
    }
}