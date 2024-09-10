<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\HasTimestampsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity, ORM\Table(name: 'categories')]
#[HasLifecycleCallbacks]  // Needed to make the 'onPrePersist' method work.
class Category
{
    use HasTimestampsTrait;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'datetime', name: 'created_at')]
    private \DateTime $createdAt;

    #[ORM\Column(type: 'datetime', name: 'updated_at')]
    private \DateTime $updatedAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'categories')]
    private ?User $user;

    #[ORM\OneToMany(targetEntity: Transaction::class, mappedBy: 'categories')]
    private Collection $transactions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): Category
    {
        $user->addCategory($this);

        $this->user = $user;

        return $this;
    }

    public function addTransaction(Transaction $transaction): Category
    {
        $this->transactions->add($transaction);

        return $this;
    }
}
