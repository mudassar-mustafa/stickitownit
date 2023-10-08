<?php

namespace App\Repositories\Frontend;

use App\Models\Product;
use App\Models\ProductAttributeValueGroup;
use App\Models\AttributeValue;
use App\Models\ProductAttributeGroup;
use App\Models\Cart;
use App\Contracts\Frontend\ProductDetailContract;
use Auth;

class ProductDetailRepository extends BaseRepository implements ProductDetailContract
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
    public function getProductDetail($slug){
        return Product::with([
            'product_images:id,product_id,filename,name',
            'categories:id,name,slug',
            'attributes:id,name,slug',
            'attributes.attribute_values:id,name,slug,attribute_id',
        ])->where('slug', $slug)->first();
    }

    /**
     * @param integer $productId
     * @return mixed
     */
    public function getProductAttributeValue($productId, $attributeId, $index, $selectedIds){


        $productAttributeValueGroupIdArray = ProductAttributeValueGroup::where('product_id', $productId)->whereHas('attribute_values', function($q) use($attributeId){
            $q->where('attribute_id', $attributeId);
        });
        if($index != "0"){
            $selectedAttributeValueId = explode(',', $selectedIds);
            $getProductAttributeValueGroup = ProductAttributeValueGroup::where('product_id', $productId)->whereIn('product_attribute_val_id', $selectedAttributeValueId)->groupBy('product_group_id')->pluck('product_group_id')->toArray();
            $productAttributeValueGroupIdArray = $productAttributeValueGroupIdArray->whereIn('product_group_id', $getProductAttributeValueGroup);
        }
        $productAttributeValueGroupIdArray = $productAttributeValueGroupIdArray->groupBy('product_attribute_val_id')->pluck('product_attribute_val_id')->toArray();

        return AttributeValue::whereIn('id', $productAttributeValueGroupIdArray)->get();
    }

    public function getProductGroupAttribute($productId, $selectedIds){
        $selectedAttributeValueId = explode(',', $selectedIds);
        $combinationString = "";
        foreach ($selectedAttributeValueId as $key => $value) {
            $getAttributeValues = AttributeValue::where('id', $value)->first();
            if($combinationString == ""){
                $combinationString = $getAttributeValues->slug;    
            }else{
                $combinationString = $combinationString.'-'.$getAttributeValues->slug; 
            }
        }
        if(count($selectedAttributeValueId) == 2){
            $combinationString = $combinationString.'-';
            return ProductAttributeGroup::where('product_id', $productId)->where('short_description','like','%'.$combinationString.'%')->get();
        }else{
            return ProductAttributeGroup::where('product_id', $productId)->where('short_description',$combinationString)->first();
        }
    }

    public function addToCart(array $params){
        $status = 0;
        $productCart = Cart::where('product_attribute_group_id', $params['product_attribute_group_id'])->where('user_id', Auth::user()->id)->first();
        if(!empty($productCart)){
            $status = -1;
        }else{
            if($params['product_type'] == "sticker"){
                $productAttributeGroupDescription = ProductAttributeGroup::where('id', $params['product_attribute_group_id'])->value('short_description');

                $values = explode('-', $productAttributeGroupDescription);
                $params['qty'] = $values[2];
            }
            $productCart = new Cart;
            $productCart->product_attribute_group_id = $params['product_attribute_group_id'];
            $productCart->user_id = Auth::user()->id;
            if(isset($params['image'])){
                $productCart->image_path = $params['image'];
            }
            $productCart->qty = $params['qty'];
            $productCart->product_type = $params['product_type'];
            $productCart->save();
            $status = 1;
        }

        return $status;

    }

}
