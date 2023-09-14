<?php

namespace App\Repositories\Backend;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Attribute;
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
    
}
