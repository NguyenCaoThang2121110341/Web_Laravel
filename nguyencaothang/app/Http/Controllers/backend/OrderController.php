<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    public function index()
    {
        $list = Order::where('status', '!=', 0)
            ->select('order.id', 'order.user_id', 'order.name','order.phone', 'order.email','order.address','order.note')
            ->orderBy('order.created_at', 'desc')
            ->get();

        // Lấy ID và tên User
        $users = User::select('user.id', 'user.name')->get();
        return view("backend.order.index", compact("list", "users"));   
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = new Order();
        $order->user_id = $request->user_id;
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->email = $request ->email;
        $order->address = $request->address;
        $order->note = $request->note;
        $order->created_at = date('Y-m-d H:i:s');
        $order->status = $request->status;
        $order->updated_at = now(); // Sử dụng hàm now() để lấy thời gian hiện user
        $order->save();

        return redirect()->route('admin.order.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
