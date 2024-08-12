<?php

declare(strict_types=1);
namespace App30\Models;

use PDO;

class Model
{
    protected PDO $db;
    public function __construct()
    {
        $this->db = \App30\App::db();
    }
}