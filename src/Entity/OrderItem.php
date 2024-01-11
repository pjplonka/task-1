<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\OrderItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Ignore;

#[ORM\Entity(repositoryClass: OrderItemRepository::class)]
class OrderItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Ignore]
    public int $id;

    #[ORM\OneToOne(targetEntity: Order::class)]
    #[Ignore]
    public Order $order;

    #[ORM\OneToOne(targetEntity: Product::class)]
    public Product $product;

    #[ORM\Column]
    public int $quantity;

    #[ORM\Column]
    public int $price;
}
