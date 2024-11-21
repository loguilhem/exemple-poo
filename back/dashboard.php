<?php

require_once('vendor/autoload.php');

use Gri\Acme\Config\AppConst;
use Gri\Acme\Controller\MainController;

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

$controller = new MainController();

// route to add a question
if (!empty($_GET['action']) && AppConst::ADD === $_GET['action']) {
    $json = file_get_contents('php://input');

    echo $controller->addQuestion($json);

    exit;
}

// route to update a question
if (!empty($_GET['action']) && ( AppConst::UPDATE === $_GET['action'])) {
    $json = file_get_contents('php://input');

    echo $controller->updateQuestion($json);

    exit;
}

// route to read question by id
if (!empty($_GET['action']) && !empty($_GET['id']) && AppConst::READ === $_GET['action']) {
    $id = (int) $_GET['id'];

    echo $controller->readQuestion($id);

    exit;
}

// default route to read all questions
echo $controller->index();