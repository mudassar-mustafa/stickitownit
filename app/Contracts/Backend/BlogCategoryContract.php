<?php

namespace App\Contracts\Backend;

/**
 * Interface BlogCategoryContract
 * @package App\Contracts
 */
interface BlogCategoryContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listCategory(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findCategoryById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createCategory(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCategory($id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteCategory($id);
}
