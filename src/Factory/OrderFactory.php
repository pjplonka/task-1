<?php

declare(strict_types=1);

namespace App\Factory;

use App\DTO\OrderDto;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Exception\ProductNotFoundException;
use App\Repository\ProductRepository;

class OrderFactory
{
    public function __construct(private readonly ProductRepository $products)
    {
    }

    public function create(OrderDto $orderDto): Order
    {
        $order = new Order();

        foreach ($orderDto->getItems() as $item) {
            $product = $this->products->find($item->getId());

            if (!$product) {
                throw new ProductNotFoundException();
            }

            $orderItem = new OrderItem();
            $orderItem->product = $product;
            $orderItem->quantity = $item->getQuantity();
            $orderItem->price = $product->price;

            $order->addItem($orderItem);
        }

        return $order;
    }
}