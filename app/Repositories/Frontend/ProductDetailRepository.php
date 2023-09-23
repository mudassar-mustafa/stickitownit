<?php

namespace App\Repositories\Frontend;

use App\Models\Product;
use App\Models\ProductAttributeValueGroup;
use App\Models\AttributeValue;
use App\Models\ProductAttributeGroup;
use App\Contracts\Frontend\ProductDetailContract;

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
            return ProductAttributeGroup::where('short_description','like','%'.$combinationString.'%')->get();
        }else{
            return ProductAttributeGroup::where('short_description',$combinationString)->first();
        }
    }

}
