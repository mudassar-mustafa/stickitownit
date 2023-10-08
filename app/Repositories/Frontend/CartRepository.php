<?php

namespace App\Repositories\Frontend;

use App\Models\Product;
use App\Models\ProductAttributeValueGroup;
use App\Models\AttributeValue;
use App\Models\ProductAttributeGroup;
use App\Models\Cart;
use App\Contracts\Frontend\CartContract;
use Auth;

class CartRepository extends BaseRepository implements CartContract
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getAllCart(){
        return Cart::with(['user:id,name', 'product_attribute_group_detail:id,product_id,main_image,short_description,quantity,price', 'product_attribute_group_detail.product:id,title,slug'])->where('user_id', Auth::user()->id)->get();
    }

    public function removeToCart($cartId){
        $status = true;
        Cart::where('id', $cartId)->delete();
        return $status;
    }

}
