<?php

namespace App\Repositories\Backend;

use App\Models\Package;
use App\Contracts\Backend\PackageContract;

class PackageRepository extends BaseRepository implements PackageContract
{
    protected $model;

    public function __construct(Package $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listPackage(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findPackageById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createPackage(array $params)
    {
        return $this->create($params);

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updatePackage($id, array $params)
    {
        return $this->update($params, $id);

    }

    /**
     * @param $id
     * @return bool
     */
    public function deletePackage($id)
    {
        return $this->delete($id);
    }
}
