<?php

namespace App\Repositories\Backend;

use App\Models\PackageSubscription;
use App\Models\PackageSubscriptionSaleDetail;
use App\Contracts\Backend\PackageSubscriptionContract;

class PackageSubscriptionRepository extends BaseRepository implements PackageSubscriptionContract
{
    protected $model;

    public function __construct(PackageSubscription $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $PackageSubscription
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listPackageSubscription(string $PackageSubscription = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }


}
