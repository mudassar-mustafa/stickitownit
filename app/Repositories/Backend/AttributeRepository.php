<?php

namespace App\Repositories\Backend;

use App\Models\Attribute;
use App\Contracts\Backend\AttributeContract;

class AttributeRepository extends BaseRepository implements AttributeContract
{
    protected $model;

    public function __construct(Attribute $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listAttribute(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findAttributeById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createAttribute(array $params)
    {
        $params['slug'] = \Str::slug(strtolower($params['name']));
        return $this->create($params);

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateAttribute($id, array $params)
    {
        $params['slug'] = \Str::slug(strtolower($params['name']));
        return $this->update($params, $id);

    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteAttribute($id)
    {
        return $this->delete($id);
    }
}
