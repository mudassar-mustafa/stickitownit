<?php

namespace App\Repositories\Backend;

use App\Models\Page;
use App\Contracts\Backend\PageContract;

class PageRepository extends BaseRepository implements PageContract
{
    protected $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listPage(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findPageById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createPage(array $params)
    {
        $params['slug'] = \Str::slug(strtolower($params['name']));
        return $this->create($params);

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updatePage($id, array $params)
    {
        $params['slug'] = \Str::slug(strtolower($params['name']));
        return $this->update($params, $id);

    }

    /**
     * @param $id
     * @return bool
     */
    public function deletePage($id)
    {
        return $this->delete($id);
    }
}
