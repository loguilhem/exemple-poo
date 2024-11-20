<?php

namespace Gri\Acme\Controller;

use Gri\Acme\Repository\QuestionRepository;

class MainController
{
    public function index()
    {
        $questionRepository = QuestionRepository::getInstance();
        $all = $questionRepository->getAllQuestions();

    
        $dataEncode = json_encode($all);

        return $dataEncode;
    }
}