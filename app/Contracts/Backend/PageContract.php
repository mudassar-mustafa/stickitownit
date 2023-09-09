<?php

namespace App\Contracts\Backend;

/**
 * Interface CityContract
 * @package App\Contracts
 */
interface PageContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listPage(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findPageById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createPage(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updatePage($id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deletePage($id);
}
