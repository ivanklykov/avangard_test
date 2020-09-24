<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Order;
use App\Partner;


class OrdersController extends Controller
{

    public function index()
    {
        $orders = Order::paginate(50);

        $orders->getCollection()->transform(function ($order) {

            $cost = 0;
            $structure = [];
            foreach ($order->products as $product) {
                $cost+=$product->pivot->quantity*$product->price;
                $structure[] = $product->name;
            }

            return [
                'id' => $order->id,
                'partner_name' => $order->partner->name,
                'cost' => $cost,
                'structure' => $structure,
                'status' => Order::getStatuses()[$order->status],
            ];
        });

        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit(Order $order)
    {
        $cost = 0;
        foreach ($order->products as $product) {
            $cost+=$product->pivot->quantity*$product->price;
        }

        return view('orders.edit', [
            'partners' => Partner::all(),
            'order' => $order,
            'statuses' => Order::getStatuses(),
            'cost' => $cost,
        ]);
    }


    public function update(Order $order, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_email' => ['required', 'email:rfc,dns'],
            'partner_id' => ['required'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('orders.edit', ['id' => $order->id])
                ->withErrors($validator)
                ->withInput();
        }

        $order->update($request->all());

        return redirect()->route('orders.edit', ['id' => $order->id])->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
