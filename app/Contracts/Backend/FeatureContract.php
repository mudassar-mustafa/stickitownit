<?php

namespace App\Contracts\Backend;

/**
 * Interface FeatureContract
 * @package App\Contracts
 */
interface FeatureContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listFeature(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findFeatureById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createFeature(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateFeature($id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteFeature($id);
}
