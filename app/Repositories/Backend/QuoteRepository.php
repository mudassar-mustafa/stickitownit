<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\QuoteContract;

use App\Models\Quote;


class QuoteRepository extends BaseRepository implements QuoteContract
{
    protected $model;

    public function __construct(Quote $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listQuote(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findQuoteById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteQuote($id)
    {
        $quote  = $this->find($id);

        if ($quote->file) {

            \File::delete(public_path('/storage/uploads/quotes/' . $quote->file));
        }

        return $this->delete($id);
    }
}
