<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class OrderItemDto
{
    #[Assert\NotBlank]
    #[Assert\Type('int')]
    private int $id;

    #[Assert\NotBlank]
    #[Assert\Type('int')]
    #[Assert\Length(min: 1, max: 100)]
    private int $quantity;

    public function __construct(int $id, int $quantity)
    {
        $this->id = $id;
        $this->quantity = $quantity;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}