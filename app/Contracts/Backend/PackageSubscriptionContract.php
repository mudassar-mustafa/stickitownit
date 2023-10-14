<?php

namespace App\Contracts\Backend;

/**
 * Interface CityContract
 * @PackageSubscription App\Contracts
 */
interface PackageSubscriptionContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listPackageSubscription(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

}
