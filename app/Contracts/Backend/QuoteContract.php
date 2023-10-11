<?php

namespace App\Contracts\Backend;

/**
 * Interface QuoteContract
 * @package App\Contracts
 */
interface QuoteContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listQuote(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findQuoteById(int $id);


    /**
     * @param $id
     * @return bool
     */
    public function deleteQuote($id);
}
