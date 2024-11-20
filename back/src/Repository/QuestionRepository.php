<?php

namespace Gri\Acme\Repository;

use Gri\Acme\Config\Database;

class QuestionRepository
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

    public function getAllQuestions()
    {
        $pdo = Database::getInstance();

        $sql = "SELECT * FROM question;";

        $resultats = $pdo->prepare($sql);
        $resultats->execute();
        return  $resultats->fetchAll();
        
        
    }
}
