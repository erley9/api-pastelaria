<?php
namespace App\Repositories;

use App\Models\Order;
use App\Models\Client;

class OrderRepository extends BaseEloquentRepository
{
    protected $model = Order::class;

    protected $requiredRelationships = ["clients","products"];

    public function getClient($clientId) {
        return $this->getById($clientId);
    }

    public function getAllOrder() {
        return $this->getAll(
            [
                "id",
                "client_id",
                "products"
            ],
            "client.name",
            "asc"
        );
    }

    public function saveOrder($request) {
        $client = Client::find($request->clientId);
        $client->products()->attach($request->products);

        return $this->getOrderTodayClient($request->clientId);
    }

    public function changeOrder($orderId, $request) {
        return $this->update($orderId, $request);
    }

    public function deleteOrder($orderId) {
        return $this->delete($orderId);
    }

    public function getOrderTodayClient($clienteId) {
        return Order::with(['client','product'])
        ->where("client_id",$clienteId)
        ->whereRaw('Date(created_at) = CURDATE()')
        ->get();
    }
}
