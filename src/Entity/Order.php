<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\ValueObject\OrderPrices;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Embedded(class: OrderPrices::class, columnPrefix: false)]
    public OrderPrices $prices;

    public function __construct()
    {
        $this->prices = new OrderPrices();
        $this->items = new ArrayCollection();
    }

    /** @var Collection<OrderItem> $items */
    #[ORM\OneToMany(mappedBy: 'order', targetEntity: OrderItem::class)]
    public Collection $items;

    public function getId(): int
    {
        return $this->id;
    }

    public function addItem(OrderItem $item): self
    {
        $this->items->add($item);
        $item->order = $this;

        return $this;
    }
}
