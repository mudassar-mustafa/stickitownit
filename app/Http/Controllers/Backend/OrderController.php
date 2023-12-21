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
        OrderDataTable $dataTable,
        $buyerIds = null,
        $sellerIds = null,
        $categoryIds = null,
    )
    {
        try {
            
            $buyerId = 0;
            $sellerId = 0;
            $buyerList = [];
            $sellerList = [];
            $categoryList = [];

            if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('SuperAdmin')){
                $buyerList = $this->orderRepository->getBuyerList("Sale"); 
                $sellerList = $this->orderRepository->getSellerList("Sale"); 
                $categoryList = $this->orderRepository->getCategoriesList(); 
            }

            if(Auth::user()->hasRole('Customer')){
                $buyerId = Auth::user()->id;
                $sellerList = $this->orderRepository->getSellerList("Sale"); 
                $categoryList = $this->orderRepository->getCategoriesList();
            }
            
            if(Auth::user()->hasRole('Seller')){
                $sellerId = Auth::user()->id;
                $buyerList = $this->orderRepository->getBuyerList("Sale"); 
                $categoryList = $this->orderRepository->getCategoriesList(); 
            }

            return $dataTable->with(['buyerId' => $buyerId, 'sellerId' => $sellerId, 'sellerIds' => '$sellerIds',  'buyerIds' => $buyerIds, 'categoryIds' => $categoryIds])->render('backend.pages.order.sale_order', compact('buyerList', 'sellerList', 'categoryList'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.order.sale_order', $exception->getMessage());
        }
    }

    public function updateOrderStatus(
        Request $request, 
        UtilService $utilService,
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
        PackageOrderDataTable $dataTable,
        $buyerIds = null
    )
    {
        try {
            $userId = 0;
            $buyerList = [];

            if(Auth::user()->hasRole('Customer')){
                $userId = Auth::user()->id;
            }

            if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('SuperAdmin')){
                $buyerList = $this->orderRepository->getBuyerList("Package"); 
            }
            
            return $dataTable->with(['userId' => $userId, 'buyerIds' => $buyerIds])->render('backend.pages.order.package_order', compact('buyerList'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.order.package_order', $exception->getMessage());
        }
    }


    /**
     * @param Request $request
     * @param UtilService $utilService
     * @return JsonResponse
     */
    public function getOrderDetail(Request $request, UtilService $utilService)
    {
        try {
            $orderDetailHtml= "";
            
            $order = $this->orderRepository->getOrderDetail($request->orderId);

            $orderDetailHtml = view('backend.pages.order.modal.order_detail', ['order' => $order])->render();


            return $utilService->makeResponse(200, "Order Detail Get Successfully", $orderDetailHtml, CommonEnum::SUCCESS_STATUS);

        } catch (\Exception $exception) {
            return $utilService->makeResponse(500, $exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param UtilService $utilService
     * @return JsonResponse
     */
    public function storeFeedback(Request $request, UtilService $utilService)
    {
        try {
            $message = "";
            $params = $request->except('_token');
            $status = $this->orderRepository->storeFeedback($params);
            if($status == "update"){
                $message = "Feedback update Successfully";
            }else{
                $message = "Feedback save Successfully";
            }

            return $utilService->makeResponse(200, $message, [], CommonEnum::SUCCESS_STATUS);

        } catch (\Exception $exception) {
            return $utilService->makeResponse(500, $exception->getMessage());
        }
    }

    

}
