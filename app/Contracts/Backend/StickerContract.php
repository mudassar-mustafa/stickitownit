<?php

namespace App\Contracts\Backend;

/**
 * Interface CityContract
 * @package App\Contracts
 */
interface StickerContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listSticker(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findStickerById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createSticker(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSticker($id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteSticker($id);
}
