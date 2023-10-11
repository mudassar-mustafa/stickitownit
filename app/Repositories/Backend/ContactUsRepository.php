<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\ContactUsContract;
use App\Models\ContactUs;


class ContactUsRepository extends BaseRepository implements ContactUsContract
{
    protected $model;

    public function __construct(ContactUs $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listContactUs(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findContactUsById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteContactUs($id)
    {
        return $this->delete($id);
    }
}
