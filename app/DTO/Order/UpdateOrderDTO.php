<?php

namespace App\DTO\Clients;
use App\Http\Requests\StoreUpdatedOrder;

class UpdateOrderDTO
{
    public function __construct(
        public string $clientId,
        public string $productId,
    ) {}

    public static function makeFromRequest(StoreUpdatedOrder $request): self
    {
        return new self(
            $id ?? $request->id,
            $request->client_id,
            $request->produto_id
        );
    }
}
