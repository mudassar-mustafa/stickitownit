<?php

namespace App\Contracts\Backend;

/**
 * Interface CityContract
 * @package App\Contracts
 */
interface AttributeValueContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listAttributeValue(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findAttributeValueById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createAttributeValue(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateAttributeValue($id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteAttributeValue($id);

    /**
     * @return mixed
     */
    public function getAttributeList();
}
