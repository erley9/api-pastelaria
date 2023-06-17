<?php

namespace App\DTO\Clients;
use App\Http\Requests\StoreCreateProduct;

class CreateProductDTO
{
    public function __construct(
        public string $name,
        public double $price,
        public string $photo
    ) {}

    public static function makeFromRequest(StoreCreateProduct $request): self
    {
        return new self(
            $request->name,
            $request->price,
            $request->photo
        );
    }
}
