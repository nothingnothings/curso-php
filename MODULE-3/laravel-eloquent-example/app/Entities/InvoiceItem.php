<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('invoice_items')]  // The table name to be used, for this entity ('Invoice' will be equal to the entries in the 'invoices' table).
class InvoiceItem
{
    #[Id]
    #[Column, GeneratedValue()]
    private int $id;

    #[Column('invoice_id')]
    private int $invoiceId;

    #[Column]
    private string $description;

    #[Column]
    private int $quantity;

    #[Column('unit_price', type: Types::DECIMAL, precision: 10, scale: 2)]
    private float $unitPrice;

    // This, with the corresponding code in the Invoice entity, establishes a relationship between the 'Invoice' and 'InvoiceItem' entities.
    #[ManyToOne(targetEntity: Invoice::class, inversedBy: 'items')]
    private Invoice $invoice;

    public function getId(): int
    {
        return $this->id;
    }

    public function getInvoiceId(): int
    {
        return $this->invoiceId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setInvoiceId(int $invoiceId): void
    {
        $this->invoiceId = $invoiceId;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function setUnitPrice(float $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function setInvoice(Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }
}
