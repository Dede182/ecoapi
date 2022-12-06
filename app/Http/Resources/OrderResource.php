<?php

namespace App\Http\Resources;

use App\Models\TownShip;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'deliveryOption' => $this->deliveryOption,
            'payment' => $this->payment,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'townShip' => TownShip::where('id',$this->town_ship_id)->first()->name,
            'owner' => User::where('id',$this->admin_id)->first()->name,
            'total' => $this->orderitems->sum('cost'),
            'orderItems' => OrderItemResource::collection($this->orderitems),
            'created_at' => $this->created_at
        ];
    }
}
