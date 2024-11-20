<?php

namespace Gri\Acme\Repository;

use Gri\Acme\Config\Db;

abstract class AbstractRepository
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Db::getInstance();
    }
}
