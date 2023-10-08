<?php

namespace App\Contracts\Frontend;

/**
 * Interface CityContract
 * @package App\Contracts
 */
interface CartContract
{
    /**
     * @param string $slug
     * @return mixed
     */
    public function getAllCart();

    public function removeToCart($cartId);
}
