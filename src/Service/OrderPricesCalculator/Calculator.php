<?php

declare(strict_types=1);

namespace App\Service\OrderPricesCalculator;

use App\Entity\Order;

interface Calculator
{
    public function calculate(Order $order): void;
}