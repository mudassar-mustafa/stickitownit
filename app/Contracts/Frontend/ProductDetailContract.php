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
    public function getProductAttributeValueArray($productId);
}
