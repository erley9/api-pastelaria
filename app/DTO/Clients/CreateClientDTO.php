<?php

namespace App\DTO\Clients;
use App\Http\Requests\StoreCreateClient;

class CreateClientDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $phonenumber,
        public string $dateofbirth,
        public string $address,
        public string $complement,
        public string $neighborhood,
        public string $zipcode

    ) {}

    public static function makeFromRequest(StoreCreateClient $request): self
    {
        return new self(
            $request->name,
            $request->email,
            $request->phonenumber,
            $request->dateofbirth,
            $request->address,
            $request->complement,
            $request->neighborhood,
            $request->zipcode
        );
    }
}
