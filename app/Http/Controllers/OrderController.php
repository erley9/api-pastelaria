<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Services\OrderService;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        DB::beginTransaction();

        try {
            $client = $this->service->removeOrder($client->id);
        } catch(Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage()->message(),500);
        }

        DB::commit();

        return response()->json(["Client deleted"],200);
    }
}
