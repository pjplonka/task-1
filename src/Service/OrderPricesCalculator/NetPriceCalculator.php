<?php

declare(strict_types=1);

namespace App\Service\OrderPricesCalculator;

use App\Entity\Order;

class NetPriceCalculator implements Calculator
{
    public function calculate(Order $order): void
    {
        $price = 0;
        foreach ($order->items as $item) {
            $price += $item->quantity * $item->price;
        }

        $order->prices->netPrice += $price;
    }
}