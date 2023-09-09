<?php

namespace App\Repositories\Backend;

use App\Models\AttributeValue;
use App\Models\Attribute;
use App\Contracts\Backend\AttributeValueContract;

class AttributeValueRepository extends BaseRepository implements AttributeValueContract
{
    protected $model;

    public function __construct(AttributeValue $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listAttributeValue(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findAttributeValueById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createAttributeValue(array $params)
    {
        $params['slug'] = \Str::slug(strtolower($params['name']));
        return $this->create($params);

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateAttributeValue($id, array $params)
    {
        $params['slug'] = \Str::slug(strtolower($params['name']));
        return $this->update($params, $id);

    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteAttributeValue($id)
    {
        return $this->delete($id);
    }

    /**
     * @return mixed
     */
    public function getAttributeList(){
        return Attribute::where('status', 'active')->get();
    }
}
