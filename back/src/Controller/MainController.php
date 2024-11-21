<?php

namespace Gri\Acme\Controller;

use Gri\Acme\Config\AppConst;
use Gri\Acme\Model\Question;
use Gri\Acme\Repository\QuestionRepository;
use Gri\Acme\Validator\QuestionValidator;

class MainController extends AbstractController
{
    // GET request to read all questions
    public function index()
    {
        $this->checkRequestType(AppConst::REQUEST_GET);

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

    // GET request to read a question
    public function readQuestion(int $idQuestion)
    {
        $this->checkRequestType(AppConst::REQUEST_GET);

        $repo = QuestionRepository::getInstance();
        $question = $repo->getQuestionById($idQuestion, true);

        // on veut éviter une référence circulaire donc on reconstruit le tableau
        $data = [];
        $data['id'] = $question->getId();
        $data['cleanData$cleanData'] = $question->getText();
        foreach ($question->getAnswers() as $answer) {
            $data['answers'][$answer->getId()]['id'] = $answer->getId();
            $data['answers'][$answer->getId()]['cleanData$cleanData'] = $answer->getText();
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

    // POST request to add a question
    public function addQuestion(string $data)
    {
        $this->checkRequestType(AppConst::REQUEST_POST);

        $validator = new QuestionValidator();
        $cleanData = $validator->cleanup($data);

        $newQuestion = new Question();
        $newQuestion
            ->setText($cleanData['text'])
            ->setStatus($cleanData['status'])
        ;

        $repo = QuestionRepository::getInstance();        
        $repo->addQuestion($newQuestion);

        $response = [
            'status' => 'success',
            'code' => 200,
            'message' => 'La question avec ID ' . $newQuestion->getId() . ' a bien été enregistré',
            'data' => [
                'id' => $newQuestion->getId(),
                'data' => $newQuestion->getText()
            ]
        ];

        return json_encode($response);
    }

    // PUT request to update a question
    public function updateQuestion(string $data)
    {
        $this->checkRequestType(AppConst::REQUEST_PUT);

        $validator = new QuestionValidator();
        $cleanData = $validator->cleanup($data);

        $repo = QuestionRepository::getInstance();
        $question = $repo->getQuestionById($cleanData['id'], true);

        $question
            ->setText($cleanData['text'])
            ->setStatus($cleanData['status'])
        ;

        $repo->updateQuestion($question);

        $response = [
            'status' => 'success',
            'code' => 200,
            'message' => 'La question avec ID ' . $question->getId() . ' a bien été mise à jour',
            'data' => [
                'id' => $question->getId(),
                'data' => $question->getText()
            ]
        ];

        return json_encode($response);
    }

}