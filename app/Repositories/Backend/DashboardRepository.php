<?php

namespace App\Repositories\Backend;

use App\Models\User;
use App\Models\Order;
use App\Models\PackageSubscription;
use Auth;
use App\Contracts\Backend\DashboardContract;

class DashboardRepository extends BaseRepository implements DashboardContract
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listDashboard(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    public function getTotalOrders($type){
        $totalOrders = Order::where('order_type', $type);
        if(auth()->user()->hasrole('Customer') == true){
            $totalOrders = $totalOrders->where('buyer_id', Auth::user()->id);
        }else if(auth()->user()->hasrole('Seller') == true){
            $totalOrders = $totalOrders->where('seller_id', Auth::user()->id);
        }
        $totalOrders = $totalOrders->count();

        return $totalOrders;
    }

    public function getPackageRemaingToken(){
        return PackageSubscription::where('user_id', Auth::user()->id)->where('status', 'active')->value('remaing_token');
    }


    public function getTotalUsers(){
        return User::where('user_type', 'Customer')->count();
    }

}
