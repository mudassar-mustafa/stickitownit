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

    public function getAllCountries();

    public function getStates($countryId);

    public function getCities($stateId);

    public function createNewOrder(array $data);
}
