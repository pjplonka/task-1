<?php

declare(strict_types=1);

namespace App\UseCase;

use App\DTO\OrderDto;
use App\Entity\Order;
use App\Exception\ProductNotFoundException;
use App\Factory\OrderFactory;
use App\Repository\OrderRepository;

class CreateOrder
{
    public function __construct(private readonly OrderFactory $orderFactory, private readonly OrderRepository $orders)
    {
    }

    /** @throws ProductNotFoundException */
    public function handle(OrderDto $orderDto): Order
    {
        $order = $this->orderFactory->create($orderDto);

        $this->orders->save($order);

        return $order;
    }
}