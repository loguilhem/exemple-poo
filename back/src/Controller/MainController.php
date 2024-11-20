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

        $response = [
            'status' => 'success',
            'code' => 200,
            'message' => 'Toutes les questions enregistrées',
            'data' => $all
        ];

        return json_encode($response);
    }

    public function addQuestion(string $data)
    {
        $validator = new NewQuestionValidator();
        $text =$validator->cleanup($data);

        $newQuestion = new Question();
        $newQuestion->setText($text);

        $repo = QuestionRepository::getInstance();        
        $repo->addQuestion($newQuestion);

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

    public function readQuestion(int $idQuestion)
    {
        $repo = QuestionRepository::getInstance();
        $question = $repo->getQuestionById($idQuestion, true);

        // on veut éviter une référence circulaire donc on reconstruit le tableau

        $data = [];
        $data['id'] = $question->getId();
        $data['text'] = $question->getText();
        foreach ($question->getAnswers() as $answer) {
            $data['answers'][$answer->getId()]['id'] = $answer->getId();
            $data['answers'][$answer->getId()]['text'] = $answer->getText();
            $data['answers'][$answer->getId()]['status'] = $answer->getStatus();
        }

    
        $response = [
            'status' => 'success',
            'code' => 200,
            'message' => 'La question avec ID et ses réponses',
            'data' => $data
        ];

        return json_encode($response);
    }
}