<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\StickerContract;
use App\Models\Sticker;


class StickerRepository extends BaseRepository implements StickerContract
{
    protected $model;

    public function __construct(Sticker $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listSticker(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findStickerById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createSticker(array $params)
    {
        return $this->create($params);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSticker($id, array $params)
    {
        return $this->update($params, $id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteSticker($id)
    {
        return $this->delete($id);
    }
}
