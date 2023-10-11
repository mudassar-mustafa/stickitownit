<?php

namespace App\Contracts\Backend;

/**
 * Interface ContactUsContract
 * @package App\Contracts
 */
interface ContactUsContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listContactUs(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findContactUsById(int $id);


    /**
     * @param $id
     * @return bool
     */
    public function deleteContactUs($id);
}
