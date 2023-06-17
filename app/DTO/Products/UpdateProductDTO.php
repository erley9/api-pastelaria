<?php

namespace App\DTO\Clients;
use App\Http\Requests\StoreUpdateProduct;

class UpdateProductDTO
{
    public function __construct(
        public string $name,
        public double $price,
        public string $photo
    ) {}

    public static function makeFromRequest(StoreUpdateProduct $request): self
    {
        return new self(
            $id ?? $request->id,
            $request->name,
            $request->price,
            $request->photo
        );
    }
}
