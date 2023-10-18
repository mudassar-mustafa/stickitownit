<?php

namespace App\Contracts\Frontend;

/**
 * Interface CityContract
 * @package App\Contracts
 */
interface ProductDetailContract
{
    /**
     * @param string $slug
     * @return mixed
     */
    public function getProductDetail($slug);

    /**
     * @param integer $productId
     * @return mixed
    */
    public function getProductAttributeValue($productId, $attributeId, $index, $selectedIds);

    public function getProductGroupAttribute($productId, $selectedIds);

    public function addToCart(array $params);


    /**
     * @param string $slug
     * @return mixed
     */
    public function getProductsByCategoryId($slug);

    /**
     * @param integer $id
     * @return mixed
     */
    public function getProductReview($productId);
}
