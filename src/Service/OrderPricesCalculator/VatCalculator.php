<?php

declare(strict_types=1);

namespace App\Service\OrderPricesCalculator;

use App\Entity\Order;

class VatCalculator implements Calculator
{
    private const VAT = 0.23;

    public function calculate(Order $order): void
    {
        $order->prices->vat += (int)($order->prices->netPrice * self::VAT);
    }
}