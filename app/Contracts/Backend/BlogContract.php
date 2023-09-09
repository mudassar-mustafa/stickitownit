<?php

namespace App\Contracts\Backend;

/**
 * Interface BlogContract
 * @package App\Contracts
 */
interface BlogContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBlog(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findBlogById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createBlog(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBlog($id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteBlog($id);

    /**
     * @return mixed
     */
    public function getCategories();

    /**
     * @return mixed
     */
    public function getTags();

    /**
     * @return mixed
     */
    public function uploadImages(array $params);

    /**
     * @return mixed
     */
    public function fetch($id);

    /**
     * @return mixed
     */
    public function deleteMedia(array $params);
}
