<?php
namespace App\Repositories\Backend;

use App\Models\Brand;
use App\Repositories\Backend\BaseRepository;
use App\Contracts\Backend\BrandContract;
use Illuminate\Http\Request;

class BrandRepository extends BaseRepository implements BrandContract
{
    protected $model;

    public function __construct(Brand $model){
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBrand(string $order = 'id', string $sort = 'desc', array $columns = ['*']){

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findBrandById(int $id){

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function create(array $params){
        $brand = new Brand;
        $brand->name = $params['name'];
        $brand->slug = \Str::slug(strtolower($params['name']));
        $brand->status = $params['status'];
        $brand->save();
        return $brand; 
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBrand(array $params){

    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteBrand($id){
        
    }
}
