<?php declare(strict_types=1);

namespace App\Entity;

use App\Enums\InvoiceStatus;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Orm\Mapping\OneToMany;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('invoices')]  // The table name to be used, for this entity ('Invoice' will be equal to the entries in the 'invoices' table).
#[HasLifecycleCallbacks]  // Needed to make the 'onPrePersist' method work.
class Invoice
{
    #[Id]
    #[Column('id'), GeneratedValue(strategy: 'AUTO')]  // GeneratedValue is an attribute that makes it so that the value of that column is automatically generated by the database. The default is 'AUTO', which is good enough for 'ID' fields...
    private int $id;

    #[Column('amount', type: Types::DECIMAL, precision: 10, scale: 2)]
    private float $amount;  // using float for money is not a good idea, it's better to use decimal or string, in your database and your code.

    #[Column('invoice_number')]
    private string $invoiceNumber;

    #[Column('status')]
    private InvoiceStatus $status;

    #[Column('created_at')]
    private \DateTime $createdAt;

    #[Column('due_date')]
    private \DateTime $dueDate;

    #[OneToMany(targetEntity: InvoiceItem::class, mappedBy: 'invoice', cascade: ['persist', 'remove'])]
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    public function getStatus(): InvoiceStatus
    {
        return $this->status;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function setInvoiceNumber(string $invoiceNumber): self
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    public function setStatus(InvoiceStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    #[PrePersist]
    public function onPrePersist(LifecycleEventArgs $args)
    {
        $this->createdAt = new \DateTime();
    }

    // public function setCreatedAt(\DateTime $createdAt): self
    // {
    //     $this->createdAt = $createdAt;

    //     return $this;
    // }

    public function addItem(InvoiceItem $item): self
    {
        $item->setInvoice($this);  // this is the call that establishes the relationship between the 'Invoice' and 'InvoiceItem' entities.

        $this->items->add($item);

        return $this;
    }
}
