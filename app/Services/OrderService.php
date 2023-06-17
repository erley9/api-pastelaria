<?php
namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class OrderService
{
    public function __construct(OrderRepository $orderRepository)
    {
        $this->repository = $orderRepository;
    }

    public function listOrder()
    {
        return $this->repository->getAllProducts();
    }

    public function OrderForId($productId)
    {
        return $this->repository->getProduct($productId);
    }

    public function createOrder($request)
    {
        return $this->repository->saveOrder($request);
    }

    public function updateProduct($productId, $request)
    {
        $this->repository->changeProduct($productId, $request);

        return $this->repository->getById($productId);
    }

    public function removeOrder($clientId) {
        $this->repository->deleteOrder($clientId);
    }
}
