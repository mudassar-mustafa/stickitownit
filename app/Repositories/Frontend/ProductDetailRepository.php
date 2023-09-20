<?php

namespace App\Repositories\Frontend;

use App\Models\Product;
use App\Models\ProductAttributeValueGroup;
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
    public function getProductAttributeValueArray($productId){
        return ProductAttributeValueGroup::where('product_id', $productId)->groupBy('product_attribute_val_id')->pluck('product_attribute_val_id')->toArray();
    }

}
