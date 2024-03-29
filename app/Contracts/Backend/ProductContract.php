<?php

namespace App\Contracts\Backend;

/**
 * Interface CityContract
 * @package App\Contracts
 */
interface ProductContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listProduct(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findProductById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createProduct($id , array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateProduct($id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteProduct($id);

    /**
     * @return mixed
     */
    public function getBrands();

    /**
     * @return mixed
     */
    public function getCategories();

    /**
     * @return mixed
     */
    public function getAttributes();

    /**
     * @return mixed
     */
    public function getAttributeValues($attributeName);

    /**
     * @return mixed
     */
    public function getCombination($attributeArray);

    /**
     * @return mixed
     */
    public function getProducAttributeValue($productId, $attributeName);

    /**
     * @return mixed
     */
    public function getProductGroups($productId);

    /**
     * @param array $params
     * @return mixed
    */
    public function updateProductVariation(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteProductVariation($id);



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
