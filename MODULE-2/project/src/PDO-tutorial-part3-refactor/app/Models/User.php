<?php

declare(strict_types=1);
namespace App30\Models;


// the `Model` base model will have the $db property, which will be used to execute the queries/statements.
class User extends \App30\Models\Model
{


    public function __construct()
    {

    }

    // Will return the id of the user
    public function create(string $email, string $name, bool $isActive = true): int
    {
        $stmt = $this->db->prepare('INSERT INTO users (email, full_name, is_active, created_at) VALUES (?, ?, ?, NOW())');


        $stmt->execute([$email, $name, $isActive]);

        return (int) $this->db->lastInsertId();
    }
}