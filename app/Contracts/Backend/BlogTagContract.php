<?php

namespace App\Contracts\Backend;

/**
 * Interface BlogTagContract
 * @package App\Contracts
 */
interface BlogTagContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listTag(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findTagById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createTag(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTag($id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteTag($id);
}
