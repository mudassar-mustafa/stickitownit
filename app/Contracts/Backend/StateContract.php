<?php

namespace App\Contracts\Backend;

/**
 * Interface CityContract
 * @package App\Contracts
 */
interface StateContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listState(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findStateById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createState(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateState($id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteState($id);

    /**
     * @return mixed
     */
    public function getCountryList();
}
