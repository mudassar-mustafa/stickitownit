<?php

namespace App\Contracts\Backend;

/**
 * Interface CityContract
 * @package App\Contracts
 */
interface CityContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listCity(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findCityById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createCity(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCity($id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteCity($id);

    /**
     * @return mixed
     */
    public function getStateList();
}
