<?php

namespace App\Getters;

use PDO;
use Dojo\Aggregates\Gettable;

abstract class Getter implements Gettable
{
    protected $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function pdo(): PDO
    {
        return $this->pdo;
    }
}
