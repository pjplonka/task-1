<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Service\OrderPricesCalculator\Aggregator;
use App\Service\OrderPricesCalculator\GrossPriceCalculator;
use App\Service\OrderPricesCalculator\VatCalculator;
use App\Service\OrderPricesCalculator\NetPriceCalculator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PriceCalculatorTest extends KernelTestCase
{
    /** @test */
    public function calculate(): void
    {
        // before
        $aggregator = new Aggregator(
            new NetPriceCalculator(),
            new VatCalculator(),
            new GrossPriceCalculator()
        );

        $order = $this->createOrder();

        // when
        $aggregator->calculate($order);

        // then
        $this->assertSame(400, $order->prices->netPrice);
        $this->assertSame(92, $order->prices->vat);
        $this->assertSame(492, $order->prices->grossPrice);
    }

    protected function createOrder(): Order
    {
        $orderItem1 = new OrderItem();
        $orderItem1->price = 150;
        $orderItem1->quantity = 2;

        $orderItem2 = new OrderItem();
        $orderItem2->price = 100;
        $orderItem2->quantity = 1;

        $order = new Order();
        $order->addItem($orderItem1);
        $order->addItem($orderItem2);

        return $order;
    }
}