<?php

declare(strict_types=1);

namespace App\Service\OrderPricesCalculator;

use App\Entity\Order;

class Aggregator implements Calculator
{
    private array $calculators;

    public function __construct(Calculator ...$calculators)
    {
        $this->calculators = $calculators;
    }

    public function calculate(Order $order): void
    {
        foreach ($this->calculators as $calculator) {
            $calculator->calculate($order);
        }
    }
}