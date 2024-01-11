<?php

declare(strict_types=1);

namespace App\Service\OrderPricesCalculator;

use App\Entity\Order;

class GrossPriceCalculator implements Calculator
{
    public function calculate(Order $order): void
    {
        $order->prices->grossPrice += $order->prices->vat + $order->prices->netPrice;
    }
}