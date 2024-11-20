<?php

require_once('vendor/autoload.php');

use Gri\Acme\Controller\MainController;

$controller = new MainController();
echo $controller->index();