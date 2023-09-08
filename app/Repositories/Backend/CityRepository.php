<?php

namespace App\Repositories\Backend;

use App\Models\State;
use App\Models\City;
use App\Contracts\Backend\CityContract;

class CityRepository extends BaseRepository implements CityContract
{
    protected $model;

    public function __construct(City $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listCity(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findCityById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createCity(array $params)
    {
        return $this->create($params);

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCity($id, array $params)
    {
        return $this->update($params, $id);

    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteCity($id)
    {
        return $this->delete($id);
    }

    /**
     * @return mixed
     */
    public function getStateList(){
        return State::where('status', 'active')->get();
    }
}
