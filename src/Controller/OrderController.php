<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\OrderDto;
use App\Entity\Order;
use App\UseCase\CreateOrder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/orders/{order}', name: 'get_order', methods: ['get'])]
    public function one(Order $order): Response
    {
        return $this->json($order);
    }

    #[Route('/orders', name: 'create_order', methods: ['post'])]
    public function create(#[MapRequestPayload] OrderDto $orderDto, CreateOrder $createOrderUseCase): Response
    {
        $order = $createOrderUseCase->handle($orderDto);

        return $this->json($order, 201);
    }
}
