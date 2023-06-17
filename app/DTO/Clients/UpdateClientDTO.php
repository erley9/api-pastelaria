<?php

namespace App\DTO\Clients;
use App\Http\Requests\StoreUpdatedClient;

class UpdateClientDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $phonenumber,
        public date $dateofbirth,
        public string $address,
        public string $complement,
        public string $neighborhood,
        public string $zipcode
    ) {}

    public static function makeFromRequest(StoreUpdatedClient $request): self
    {
        return new self(
            $id ?? $request->id,
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
