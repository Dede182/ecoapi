<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderResource;

class OrderApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id',Auth::user()->id)->paginate(10)->withQueryString();
        return  response()->json([
            "message"=>"orders were fetched successfully",
            "success" => true,
            'data' =>  OrderResource::collection($orders),
            'meta' => [
                'total' => $orders->total(),
                'currentPage' => $orders->currentPage(),
                'lastPage' => $orders->lastPage(),
                'perPage' => $orders->perPage(),
            ],
            'links' => [
                'first' => $orders->url(1),
                'last' => $orders->url($orders->lastPage()),
                'prev' => $orders->previousPageUrl(),
                'next' => $orders->nextPageUrl(),
            ],
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->code =  random_int(1000000, 9999999);
        $order->user_id = Auth::user()->id;
        $order->admin_id = User::where('role','admin')->first()->id;
        $order->town_ship_id = Auth::user()->town_ship_id;
        $order->status = "Pending";
        $order->save();

        foreach($request->products as $key=>$pro){
            $orderitem = new OrderItem();
            $orderitem->product_id = $pro;
            $orderitem->order_id = $order->id;
            $orderitem->amount = $request->amount[$key];
            $orderitem->cost = $orderitem->amount * Product::where('id',$pro)->first()->price;
            $orderitem->save();

        }
        return response()->json([
            "message"=>"order was created successfully",
            "success" => true,
            'data' =>  new OrderResource($order),
        ]);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::where('id',$id)->first();
        $order->deliveryOption  = $request->deliveryOption;
        $order->payment = $request->payment;
        $order->update();

        return response()->json([
            "message"=>"order was updated successfully",
            "success" => true,
            'data' =>  new OrderResource($order),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::where('id',$id)->first();
        $order->delete();
        return response()->json([
            "message"=>"order was deleted successfully",
            "success" => true,
        ]);
    }
}
