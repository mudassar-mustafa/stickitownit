<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\BlogCategoryContract;
use App\Models\BlogCategory;


class BlogCategoryRepository extends BaseRepository implements BlogCategoryContract
{
    protected $model;

    public function __construct(BlogCategory $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listCategory(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findCategoryById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createCategory(array $params)
    {
        $params['slug'] = \Str::slug(strtolower($params['name']));
        return $this->create($params);

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCategory($id, array $params)
    {
        $params['slug'] = \Str::slug(strtolower($params['name']));
        return $this->update($params, $id);

    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteCategory($id)
    {
        return $this->delete($id);
    }
}