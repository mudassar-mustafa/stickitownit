<?php

namespace App\Contracts\Backend;

/**
 * Interface CityContract
 * @package App\Contracts
 */
interface CountryContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listCountry(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findCountryById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createCountry(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCountry($id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteCountry($id);
}
