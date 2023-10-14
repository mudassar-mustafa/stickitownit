<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Order\UpdateOrderRequest;
use Illuminate\Contracts\View\View;
use App\Contracts\Backend\OrderContract;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\OrderDataTable;
use App\DataTables\PackageOrderDataTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{
    /**
     * @var OrderContract
     */
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function saleOrder(
        UtilService    $utilService,
        OrderDataTable $dataTable
    )
    {
        try {
            $buyerId = 0;
            if(Auth::user()->hasRole('Customer')){
                $buyerId = Auth::user()->id;
            }
            $sellerId = 0;
            if(Auth::user()->hasRole('Seller')){
                $sellerId = Auth::user()->id;
            }
            return $dataTable->with(['buyerId' => $buyerId, 'sellerId' => $sellerId])->render('backend.pages.order.sale_order');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.order.sale_order', $exception->getMessage());
        }
    }

    public function updateOrderStatus(
        Request $request, 
        UtilService $utilService
        ){
        try {
            $data = $request->except('_token');
            $order = $this->orderRepository->updateOrderStatus($data);
            if(!empty($order)){
                return $utilService->makeResponse(200, "Order Status Update Successfully", $order, CommonEnum::SUCCESS_STATUS);
            }else{
                return $utilService->makeResponse(200, "Order Status Not Update", $order, CommonEnum::FAIL_STATUS);
            }
            

        } catch (\Exception $exception) {
            return $utilService->makeResponse(500, $exception->getMessage());
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function packageOrder(
        UtilService    $utilService,
        PackageOrderDataTable $dataTable
    )
    {
        try {
            $userId = 0;
            if(Auth::user()->hasRole('Customer')){
                $userId = Auth::user()->id;
            }
            
            return $dataTable->with(['userId' => $userId])->render('backend.pages.order.package_order');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.order.package_order', $exception->getMessage());
        }
    }

}
