<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;

class ProductApiController extends Controller
{
    public function index(){
        $products = Product::
        search()
        ->when(request('category'),function($q){
            $search = request('category');

            $category = Category::where('title','like',"%$search%")->first();
            $category = $category->id;
            $q->where('category_id' ,'=',"$category");
        })

        ->latest('id')
        ->with('category','productimage','type','review')
        ->paginate(10)->withQueryString();

        // return $products;

        return  response()->json([
            "message"=>"product is fetched successfully",

            "success" => true,
            'data' =>  ProductResource::collection($products),
            'meta' => [
                'total' => $products->total(),
                'currentPage' => $products->currentPage(),
                'lastPage' => $products->lastPage(),
                'perPage' => $products->perPage(),
            ],
            'links' => [
                'first' => $products->url(1),
                'last' => $products->url($products->lastPage()),
                'prev' => $products->previousPageUrl(),
                'next' => $products->nextPageUrl(),
            ],
        ]);



    }

    public function show($id){
        $product = Product::where('id',$id)->first();
        if($product){
            return response()->json([
                "message"=>"product is found",
                "product" => $product,
                "success" => true
            ]);
        }
        return response()->json([
            "message"=>"product not found",
            "success" => true
        ]);
    }

    public function store(Request $request){
        $product =new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->ordered = 0;
        $product->user_id = User::where('role','admin')->first()->id;
        $product->category_id = $request->category_id;
        $product->type_id = $request->type_id;
        $product->save();


        if($request->hasFile('productImages')){

            $productImageCollection = [];
            foreach($request->productImages as $key=>$productImage){

                $newName = "productImage.".uniqid().'.'.$productImage->extension();
                $productImage->storeAs('public/',$newName);

                $productImageCollection[$key] = [
                    'imageName' => $newName,
                    'imageUrl' => asset(Storage::url($newName)),
                    'product_id' => $product->id,
                ];
            }
            // return $productImageCollection;
            ProductImage::insert($productImageCollection);
        }
        return response()->json([
            "message"=>"product is added",
            "product" => $product,
            "success" => true
        ]);
    }

    public function update(Request $request,$id){
        $product =Product::findOrFail($id);
        if(request('name')){
            $product->name = $request->name;
        }
        if(request('price')){
            $product->price = $request->price;
        }
        if(request('quantity')){
            $product->quantity = $request->quantity;
        }
        if(request('description')){
            $product->description = $request->description;
        }
        if(request('status')){
            $product->status = $request->status;
        }

        if(request('category_id')){
            $product->category_id = $request->category_id;
        }
        if(request('type_id')){

        $product->type_id = $request->type_id;
        }

        $product->update();

        return response()->json([
            "message"=>"product is updated",
            "product" => $product,
            "success" => true
        ]);
    }

    public function destory($id){
        $product = Product::where('id',$id)->first();
        // return $product;

        if(isset($product->productimage)){
            $productImagesId  =[];
            $productImages = ProductImage::where('product_id',$product->id)->get();
            foreach($productImages as $key=>$productImage){

                $productImagesId[$key] = $productImage->id;
                Storage::delete('public/'.$productImage->imageName);
                // return "here";
            }
            ProductImage::destroy($productImagesId);
        }


        $product->delete();
        return response()->json([
            "message"=>"product is deleted",
            "success" => true
        ]);
    }
}
