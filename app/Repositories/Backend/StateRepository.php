<?php

namespace App\Repositories\Backend;

use App\Models\State;
use App\Models\Country;
use App\Contracts\Backend\StateContract;

class StateRepository extends BaseRepository implements StateContract
{
    protected $model;

    public function __construct(State $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listState(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findStateById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createState(array $params)
    {
        return $this->create($params);

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateState($id, array $params)
    {
        return $this->update($params, $id);

    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteState($id)
    {
        return $this->delete($id);
    }

    /**
     * @return mixed
     */
    public function getCountryList(){
        return Country::where('status', 'active')->get();
    }
}
