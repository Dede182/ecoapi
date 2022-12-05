<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Type;
use App\Models\User;
use App\Policies\CategoryPolicy;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'status' => $this->status,
            'ordered' => $this->ordered,
            'Owner' => User::where('id',$this->user_id)->first()->name,
            'category' =>Category::where('id', $this->category_id)->first()->title,
            'type' =>Type::where('id', $this->type_id)->first()->title,
            'user_id' => $this->user_id,
            'productimages' => ProductimageResource::collection($this->productimage),
            'reviews' => ReviewResource::collection($this->review),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
