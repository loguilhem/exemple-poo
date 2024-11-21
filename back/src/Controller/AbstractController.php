<?php

namespace Gri\Acme\Controller;

use LogicException;

abstract class AbstractController
{
    public function checkRequestType(string $acceptedMethod): void
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($acceptedMethod !== $method) {
            throw new LogicException('Cette requête est interdite');
        }
    }
}
