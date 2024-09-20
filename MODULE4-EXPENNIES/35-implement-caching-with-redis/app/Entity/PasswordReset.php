<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\HasTimestamps;
use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[HasLifecycleCallbacks]
#[Entity, Table(name: 'password_resets')]
class PasswordReset
{
    use HasTimestamps;


    #[Id, Column(options: ['unsigned' => true]), GeneratedValue]
    private int $id;

    #[Column(type: 'string', length: 255)]
    private string $email;

    #[Column(name: 'is_active', options: ['default' => true])]
    private bool $isActive;

    #[Column(type: 'datetime')]
    private DateTime $expiration;

    #[Column(type: 'string', length: 255, unique: true)]
    private string $token;


    public function __construct()
    {
        $this->isActive = true;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(): string
    {
        return $this->email;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): PasswordReset
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getExpiration(): DateTime
    {
        return $this->expiration;
    }

    public function setExpiration(DateTime $expiration): PasswordReset
    {
        $this->expiration = $expiration;

        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): PasswordReset
    {
        $this->token = $token;

        return $this;
    }
}
