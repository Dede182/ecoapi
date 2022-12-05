<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Review;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $with = ['productimage'];
    public function scopeSearch($q){
        $q->when(request('search'),function($q){
            $search = request('search');
            $q->orWhere('name' ,'like',"%$search%");

        });
    }
    public function scopeCategory($q){
        $q->when(request('category'),function($q){
            $search = request('category');

            $category = Category::where('title','like',"%$search%")->first();
            $category = $category->id;
            $q->orWhere('category_id' ,'=',"$category");

        });
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function productimage(){
        return $this->hasMany(ProductImage::class);
    }
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function review(){
        return $this->hasMany(Review::class);
    }

}
