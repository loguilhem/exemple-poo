<?php

require_once('vendor/autoload.php');

use Gri\Acme\Config\AppConst;
use Gri\Acme\Controller\MainController;

$controller = new MainController();

if (!empty($_GET['action']) && AppConst::ADD === $_GET['action']) {
    $json = file_get_contents('php://input');

    echo $controller->addQuestion($json);

    exit;
}

echo $controller->index();