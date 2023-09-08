<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\FaqContract;
use App\Models\FAQ;


class FaqRepository extends BaseRepository implements FaqContract
{
    protected $model;

    public function __construct(FAQ $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listFaq(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findFaqById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createFaq(array $params)
    {
        return $this->create($params);

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateFaq($id, array $params)
    {

        return $this->update($params, $id);

    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteFaq($id)
    {
        return $this->delete($id);
    }
}
