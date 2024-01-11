<?php

declare(strict_types=1);

namespace App\Entity\ValueObject;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class OrderPrices
{
    #[Column]
    public int $netPrice = 0;

    #[Column]
    public int $vat = 0;

    #[Column]
    public int $grossPrice = 0;
}