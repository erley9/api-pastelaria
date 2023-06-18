<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Requests\StoreCreateUpdateOrder;
use DB;

class OrderController extends Controller
{

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $orders = $this->service->listOrders();
        } catch(Exception $e) {
            return response()->json($e->getMessage(),500);
        }

        return response()->json($orders,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCreateUpdateOrder $request)
    {
        DB::beginTransaction();

        try {
            $product = $this->service->createOrder($request);
        } catch(Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(),500);
        }

        DB::commit();

        return response()->json($product,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        try {
            $order = $this->service->OrderForId($client->id);
        } catch(Exception $e) {
            return response()->json($e->getMessage(),500);
        }

        return response()->json($order,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCreateUpdateOrder $request, Client $client)
    {
        DB::beginTransaction();

        try {
            $order = $this->service->updateOrderToday($request->all());
        } catch(Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(),500);
        }

        DB::commit();

        return response()->json($order,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        DB::beginTransaction();

        try {
            $this->service->removeOrder($client->id);
        } catch(Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage()->message(),500);
        }

        DB::commit();

        return response()->json(["Client deleted"],200);
    }
}
