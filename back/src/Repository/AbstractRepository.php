<?php

namespace Gri\Acme\Repository;

use Gri\Acme\Config\Database;

abstract class AbstractRepository
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }
}