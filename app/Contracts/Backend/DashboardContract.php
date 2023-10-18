<?php

namespace App\Contracts\Backend;

/**
 * Interface CityContract
 * @package App\Contracts
 */
interface DashboardContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listDashboard(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    public function getTotalOrders($type);

    public function getPackageRemaingToken();


    public function getTotalUsers();
}
