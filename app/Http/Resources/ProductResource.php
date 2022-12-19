<?php

namespace App\Http\Resources;

use App\Helpers\Mono;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Type;
use App\Models\User;
use App\Policies\CategoryPolicy;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

     public function productImage($image){
        if(count($image)>0){
            $image= ProductimageResource::collection($image);
        }
        else{
            $image = "https://sneakernews.com/wp-content/uploads/2020/02/air-jordan-34-shroud-CU1548-001-3.jpg";
        }
        return $image;
     }

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
            'productImage' => $this->productImage($this->productimage),
            "averageReview" =>$this->whenNotNull( Mono::review($this->id)),
            'reviews' => ReviewResource::collection($this->review),
            'created_at' => $this->created_at->format('M d ,Y'),
            'updated_at' => $this->updated_at,
        ];
    }
}
