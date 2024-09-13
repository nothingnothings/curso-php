<?php declare(strict_types=1);

namespace App\Contracts;

use App\Entity\Category;
use App\Entity\Transaction;
use App\Entity\User;
use Doctrine\Common\Collections\Collection;

interface UserInterface
{
    public function getId(): ?int;

    public function getName(): ?string;

    public function setName(string $name): self;

    public function getEmail(): ?string;

    public function setEmail(string $email): self;

    public function getPassword(): ?string;

    public function setHashedPassword($password): void;  // This is the eloquent implementation, replacing  DBAL implementation

    public function getCreatedAt(): ?\DateTimeInterface;

    public function setCreatedAt(\DateTimeInterface $createdAt): self;

    public function getTransactions(): Collection;

    public function getCategories(): Collection;

    public function addCategory(Category $category): User;

    public function addTransaction(Transaction $transaction): User;
}
