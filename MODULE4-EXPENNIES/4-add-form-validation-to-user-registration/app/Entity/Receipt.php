<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity, ORM\Table(name: "receipts")]
class Receipt
{

    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: "integer", options: ["unsigned" => true])]
    private int $id;

    #[ORM\Column(type: "string", name: "file_name")]
    private string $fileName;

    #[ORM\Column(name: "created_at", type: "datetime")]
    private \DateTime $createdAt;

    #[ORM\ManyToOne(targetEntity: Transaction::class, inversedBy: "receipts")]
    #[ORM\JoinColumn(nullable: false)]
    private $transaction;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

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

    public function getTransaction(): ?Transaction
    {
        return $this->transaction;
    }

    public function setTransaction(Transaction $transaction): Receipt
    {

        $transaction->addReceipt($this);

        $this->transaction = $transaction;

        return $this;
    }
}
