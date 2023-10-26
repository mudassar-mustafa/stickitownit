<?php

namespace App\Repositories\Backend;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeGroup;
use App\Models\ProductAttributeValueGroup;
use App\Contracts\Backend\ProductContract;
use Auth;

class ProductRepository extends BaseRepository implements ProductContract
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listProduct(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findProductById(int $id)
    {
        $product = Product::with([
            'categories:id,name',
            'brand:id,name',
            'normal_product_groups:id,product_id,main_image,short_description,quantity,price'
            ])->where('id', $id)->first();
        return $product;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createProduct($id, array $params)
    {

        if($id != null){
            $product = Product::where('id', $id)->first();
        }else{
            $product = new Product;
        }


        $product->title = $params['title'];
        $product->slug = \Str::slug(strtolower($params['title']));
        $product->title = $params['title'];
        $product->brand_id = $params['brand_id'];
        $product->product_type = $params['product_type'];
        $product->description = $params['description'];
        if(isset($params['shipping_type'])){
            $product->shipping_type = $params['shipping_type'];
            if($params['shipping_type'] == "fixed"){
                $product->shipping_fee = $params['shipping_fee'];
            }
        }
        if(isset($params['main_image'])){
            $product->main_image = $params['main_image'];
        }
        $product->short_description = $params['short_description'];

        $product->user_id = Auth::user()->id;
        $product->save();

        if(isset($params['category_id']) && $params['category_id'][0] != null){
            $product->categories()->sync($params['category_id']);
        }


        if($params['product_type'] == "normal"){

            $productAttributeGroup = ProductAttributeGroup::where('product_id', $product->id)->first();
            if(empty($productAttributeGroup)){
                $productAttributeGroup = new ProductAttributeGroup;
            }

            $productAttributeGroup->product_id = $product->id;
            if(isset($params['main_image'])){
                $productAttributeGroup->main_image = $params['main_image'];
            }
            $productAttributeGroup->short_description = $params['short_description'];
            $productAttributeGroup->quantity = $params['quantity'];
            $productAttributeGroup->sku = "product-".$product->id."";
            $productAttributeGroup->price = $params['price'];
            $productAttributeGroup->visibilty = true;
            $productAttributeGroup->save();
            
        }else{
            // Check and Store Attribute, Check and Store Attribute values,  Create and update product Attribute,

            if($id == null){
                $attributeIds = [];
                foreach ($params['attribute_ids'] as $key => $attributeName) {
                    $attributeId = 0;
                    $attribute = Attribute::where('name', strtolower($attributeName))->where('status', 'active')->first();
                    if(!empty($attribute)){
                        $attributeId = $attribute->id;
                    }else{
                        $attribute = new Attribute;
                        $attribute->name = $attributeName;
                        $attribute->slug = \Str::slug(strtolower($attributeName));
                        $attribute->status = "active";
                        $attribute->save();
                        $attributeId = $attribute->id;
                    }

                    foreach ($params['attribute_value_id'.$attributeName.''] as $key => $attributeValueName) {
                        $attributeValues = AttributeValue::where('name', strtolower($attributeValueName))->where('attribute_id', $attributeId)->where('status', 'active')->first();
                        if(empty($attributeValues)){
                            $attributeValues = new AttributeValue;
                            $attributeValues->attribute_id = $attributeId;
                            $attributeValues->name = $attributeValueName;
                            $attributeValues->slug = strtolower($attributeValueName);
                            $attributeValues->status = 'active';
                            $attributeValues->save();
                        }
                    }

                    array_push($attributeIds, $attributeId);

                    // $productAttribute = new ProductAttribute;
                    // $productAttribute->product_id = $product->id;
                    // $productAttribute->attribute_id = $attributeId;
                    // $productAttribute->save();
                }

                $product->attributes()->sync($attributeIds);

                //Delete Product Attribute Group
                $getProdcutGroupArray = ProductAttributeGroup::where('product_id', $product->id)->pluck('id')->toArray();
                if(count($getProdcutGroupArray) > 0){
                    $deleteProductGroupArray = array_diff($getProdcutGroupArray, $params['combination_ids']);
                    if(count($deleteProductGroupArray) > 0){
                        $product->product_attribute_group()->detach($deleteProductGroupArray);
                        $product->product_groups()->whereIn('id', $deleteProductGroupArray)->delete();
                    }
                }

                // Store Attribute Group and Attribute Value Group
                $visibilityIds = explode(',', $params['visibility_ids']);
                foreach ($params['combination_ids'] as $combKey => $value) {

                    $productAttributeGroup = ProductAttributeGroup::where('id', $value)->first();
                    if(empty($productAttributeGroup)){
                        $productAttributeGroup = new ProductAttributeGroup;
                    }

                    $productAttributeGroup->product_id = $product->id;
                    if(isset($params['combination_image'][$combKey]) && $params['combination_image'][$combKey] != null){
                        $productAttributeGroup->main_image = $params['combination_image'][$combKey];
                    }
                    $productAttributeGroup->short_description = $params['combination'][$combKey];
                    $productAttributeGroup->quantity = $params['combination_quantity'][$combKey];
                    $productAttributeGroup->sku = $params['combination_sku'][$combKey];
                    $productAttributeGroup->price = $params['combination_price'][$combKey];
                    $productAttributeGroup->visibilty = $visibilityIds[$combKey];
                    $productAttributeGroup->save();

                    $getcombinationArray = explode('-', $params['combination'][$combKey]);

                    //Delete Product Attribute Group Value
                    $getProdcutGroupValueArray = ProductAttributeValueGroup::where('product_id', $product->id)->where('product_group_id', $productAttributeGroup->id)->pluck('product_attribute_val_id')->toArray();
                    if(count($getProdcutGroupValueArray) > 0){
                        $getAttributeValueIds = AttributeValue::whereIn('name', $getcombinationArray)->pluck('id')->toArray();
                        $deleteProductGroupValueArray = array_diff($getProdcutGroupValueArray, $getAttributeValueIds);

                        if(count($deleteProductGroupValueArray) > 0){
                            ProductAttributeValueGroup::whereIn('product_attribute_val_id', $deleteProductGroupValueArray)->where('product_id', $product->id)->where('product_group_id', $productAttributeGroup->id)->delete();
                        }
                    }

                    foreach ($getcombinationArray as $value) {
                        $getAttributeValueId = AttributeValue::where('name', strtolower($value))->where('status', 'active')->value('id');

                        $productAttributeValueGroup = ProductAttributeValueGroup::where('product_id', $product->id)->where('product_group_id', $productAttributeGroup->id)->where('product_attribute_val_id', $getAttributeValueId)->first();
                        if(empty($productAttributeValueGroup)){
                            $productAttributeValueGroup = new ProductAttributeValueGroup;
                        }

                        $productAttributeValueGroup->product_id = $product->id;
                        $productAttributeValueGroup->product_group_id = $productAttributeGroup->id;
                        $productAttributeValueGroup->product_attribute_val_id = $getAttributeValueId;
                        $productAttributeValueGroup->save();
                    }

                }
            }

            $product->save();

        }

        return $product;

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateProduct($id, array $params)
    {
        return $this->update($params, $id);

    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteProduct($id)
    {

        $product = Product::where('id', $id)->with('product_groups')->first();
        if ($product->main_image) {
            \File::delete(public_path('/storage/uploads/products/' . $product->main_image));
        }
        $product->categories()->detach();

        if($product->type == "variation"){
            foreach ($product->product_groups as $key => $value) {
                if ($product->main_image) {
                    \File::delete(public_path('/storage/uploads/products/' . $value->main_image));
                }
            }

            $product->attributes()->delete();
            $product->product_attribute_group()->delete();
            $product->attribute_values()->delete();
        }

        return $this->delete($id);
    }

    /**
     * @return mixed
     */
    public function getBrands(){
        return Brand::where('status', 'active')->get();
    }

    /**
     * @return mixed
     */
    public function getCategories(){
        return Category::where('status', 'active')->get();
    }

    /**
     * @return mixed
     */
    public function getAttributes(){
        return Attribute::with(['attribute_values:id,name,attribute_id'])->where('status', 'active')->get();
    }

    /**
     * @return mixed
     */
    public function getAttributeValues($attributeName){
        return AttributeValue::whereHas('attribute', function($q) use($attributeName){
            $q->where('name', strtolower($attributeName));
        })->where('status', 'active')->get();
    }

    public function getCombination($attributeArray){

        $attributeValueArray = [];
        foreach ($attributeArray as $key => $value) {
            array_push($attributeValueArray,$value[1]);
        }
        $combination_array = $this->combinations($attributeValueArray);
        return $combination_array;
    }


    public function combinations($arrays, $i = 0) {
        if (!isset($arrays[$i])) {
            return array();
        }
        if ($i == count($arrays) - 1) {
            return $arrays[$i];
        }

        // get combinations from subsequent arrays
        $tmp = $this->combinations($arrays, $i + 1);

        $result = array();

        // concat each array from tmp with each element from $arrays[$i]
        foreach ($arrays[$i] as $v) {
            foreach ($tmp as $t) {
                $result[] = is_array($t) ?
                    array_merge(array($v), $t) :
                    array($v, $t);
            }
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getProducAttributeValue($productId, $attributeName){
        $productAttributeValueGroupIds = ProductAttributeValueGroup::where('product_id', $productId)->groupBy('product_attribute_val_id')->pluck('product_attribute_val_id')->toArray();

        return AttributeValue::whereIn('id',$productAttributeValueGroupIds)->whereHas('attribute', function($q) use($attributeName){
            $q->where('name', strtolower($attributeName));
        })->pluck('name')->toArray();
    }


    /**
     * @return mixed
     */
    public function getProductGroups($productId){
        return ProductAttributeGroup::where('product_id', $productId)->get();
    }

    /**
     * @param array $params
     * @return mixed
    */
    public function updateProductVariation(array $params){
        $productAttributeGroup = ProductAttributeGroup::where('id', $params['id'])->first();
        if(!empty($productAttributeGroup)){
            if(isset($params['image']) && $params['image'] != null){
                $productAttributeGroup->main_image = $params['image'];
            }

            $productAttributeGroup->price = $params['price'];
            $productAttributeGroup->quantity = $params['quantity'];
            $productAttributeGroup->visibilty = $params['visibility'] == "1" ? 1 : 0;
            $productAttributeGroup->save();
        }
        return $productAttributeGroup;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteProductVariation($id){
        ProductAttributeValueGroup::where('product_group_id', $id)->delete();
        ProductAttributeGroup::where('id', $id)->delete();
        return true;
    }

}
