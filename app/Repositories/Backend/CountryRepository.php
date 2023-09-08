<?php

namespace App\Repositories\Backend;

use App\Models\Country;
use App\Contracts\Backend\CountryContract;

class CountryRepository extends BaseRepository implements CountryContract
{
    protected $model;

    public function __construct(Country $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listCountry(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findCountryById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createCountry(array $params)
    {
        return $this->create($params);

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCountry($id, array $params)
    {
        return $this->update($params, $id);

    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteCountry($id)
    {
        return $this->delete($id);
    }
}
