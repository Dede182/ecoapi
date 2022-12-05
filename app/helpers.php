<?php
namespace App\Helpers;

use App\Models\Product;

class Mono{
    public static function review($productId){
        $product = Product::where('id',$productId)->with('review')->first();
        // return $product;
        $productReviews = $product->review;
        $ReviewsCount =[];
        if(count($productReviews) > 0){
            foreach($productReviews as $key=>$pro){
                $ReviewsCount[$key] = $pro->rating;
            }

           $total = array_reduce($ReviewsCount,function($pre,$next){
            return $pre += $next;
           });

           $fullRate = count($ReviewsCount) * 5;

           if($total===0){
            return "";
            }
            elseif($fullRate===0){
                return "";
            }else{
                $rate = ($total / $fullRate) * 100;
                $ratePerStar = 20;

                $avgRate = $rate/$ratePerStar;
                 return number_format($avgRate,1,'.');
            }
        }

        else{
            return "0";
        }
    }
}
