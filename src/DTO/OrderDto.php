<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class OrderDto
{
    #[Assert\Valid]
    #[Assert\NotBlank]
    #[Assert\Type('array')]
    /** @var OrderItemDto[] */
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}