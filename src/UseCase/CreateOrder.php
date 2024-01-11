<?php

declare(strict_types=1);

namespace App\UseCase;

use App\DTO\OrderDto;
use App\Entity\Order;
use App\Exception\ProductNotFoundException;
use App\Factory\OrderFactory;
use App\Repository\OrderRepository;
use App\Service\OrderPricesCalculator\Aggregator;

class CreateOrder
{
    public function __construct(
        private readonly OrderFactory $orderFactory,
        private readonly OrderRepository $orders,
        private readonly Aggregator $aggregator
    )
    {
    }

    /** @throws ProductNotFoundException */
    public function handle(OrderDto $orderDto): Order
    {
        $order = $this->orderFactory->create($orderDto);

        $this->aggregator->calculate($order);

        $this->orders->save($order);

        return $order;
    }
}