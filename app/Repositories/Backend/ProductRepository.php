<?php

namespace App\Repositories\Backend;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Contracts\Backend\ProductContract;

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
        return $this->find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createProduct(array $params)
    {
        return $this->create($params);

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
    
}
