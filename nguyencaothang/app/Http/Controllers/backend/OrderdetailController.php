<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderDetailRequest;



class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $list = OrderDetail::join('product', 'product.id', '=', 'order_detail.product_id')
        ->join('order', 'order.id', '=', 'order_detail.order_id')
        ->select('order_detail.id','order_detail.id','product.name as productname','order.name as ordername','order_detail.price','order_detail.qty','amount')
       
        ->get();

    return view("backend.orderdetail.index", compact("list"));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_product= Product::where('status','!=',0)
        ->orderBy('created_at','asc')
        ->get();
        $list_order= Order::where('status','!=',0)
        ->orderBy('created_at','asc')
        ->get();
        $htmlproductid="";
        $htmlorderid="";
        foreach($list_product as $item)
        {
            $htmlproductid .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
        }
        foreach($list_order as $item)
        {
            $htmlorderid .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
        }
        return view("backend.orderdetail.create",compact("htmlproductid","htmlorderid"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderDetailRequest $request)
    {
        $orderdetail=new OrderDetail();
       
     
        $orderdetail->product_id=$request->product_id;//form
        $orderdetail->order_id=$request->order_id;//form
        $orderdetail->price=$request->price;//form
   
        $orderdetail->qty=$request->qty;//form
        
        $orderdetail->amount=$request->amount;//form
     
    
        
        // $product->created_by=Auth::id()??1;
      
        // $category->image=$request->image;//form
        $order_detail->save();
        return redirect()->route('admin.order_detail.index');
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
