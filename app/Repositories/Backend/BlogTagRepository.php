<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\BlogTagContract;
use App\Models\Tag;


class BlogTagRepository extends BaseRepository implements BlogTagContract
{
    protected $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listTag(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findTagById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createTag(array $params)
    {
        $params['slug'] = \Str::slug(strtolower($params['name']));
        return $this->create($params);

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTag($id, array $params)
    {
        $params['slug'] = \Str::slug(strtolower($params['name']));
        return $this->update($params, $id);

    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteTag($id)
    {
        return $this->delete($id);
    }
}
