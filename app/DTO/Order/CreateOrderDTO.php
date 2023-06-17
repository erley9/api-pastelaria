<?php

namespace App\DTO\Clients;
use App\Http\Requests\StoreCreateOrder;

class CreateOrderDTO
{
    public function __construct(
        public string $clientId,
        public string $productId,
    ) {}

    public static function makeFromRequest(StoreCreateOrder $request): self
    {
        return new self(
            $request->client_id,
            $request->produto_id
        );
    }
}
