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
    public function index(
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
            return $dataTable->with(['buyerId' => $buyerId, 'sellerId' => $sellerId])->render('backend.pages.order.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.order.index', $exception->getMessage());
        }
    }

}
