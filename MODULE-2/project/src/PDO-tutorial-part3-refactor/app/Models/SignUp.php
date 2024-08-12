<?php

declare(strict_types=1);
namespace App30\Models;

class SignUp extends \App30\Models\Model
{
    public function __construct(protected User $userModel, protected Invoice $invoiceModel)
    {
        parent::__construct(); // This is used so that the $db property is available in this 'SignUp' model.
    }

    // Will return the invoice id 
    public function register(array $userInfo, array $invoiceInfo): int
    {

        try {
            $this->db->beginTransaction();

            $userId = $this->userModel->create($userInfo['email'], $userInfo['name']);
            $invoiceId = $this->invoiceModel->create($invoiceInfo['amount'], $userId);

            $this->db->commit();
        } catch (\Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }
            throw $e;
        }

        return $invoiceId;
    }
}