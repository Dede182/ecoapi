<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\TownShip;

class UserOrdersController extends Controller
{
    public function index($id){
        $user = User::where('id',$id)->get();
        $orders = Order::where('user_id',$id)->get();
        return response()->json([
            "message"=>"order was updated successfully",
            "success" => true,
            'user' => $user,
            'orders'=>OrderResource::collection($orders)
        ]);

    }

    public function township(){
        $townships = TownShip::pluck('name');
        $orders = Order::where("town_ship_id",3)->pluck('town_ship_id');
        $OT = [];
        foreach($townships as $key=>$township){
            $OT[$township] = count(Order::where("town_ship_id",($key+1))->pluck('town_ship_id'));
        }
        return $OT;
    }
}
