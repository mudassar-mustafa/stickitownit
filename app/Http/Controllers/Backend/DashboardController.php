<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Contracts\View\View;
use App\Contracts\Backend\DashboardContract;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use Auth;

class DashboardController extends Controller
{
    /**
     * @var DashboardContract
     */
    protected $dashboardRepository;

    public function __construct(DashboardContract $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService $utilService
    )
    {
        try {
            $totalOrders = $remaingToken = $totalUsers = $totalPackages =  0;
            $totalOrders = $this->dashboardRepository->getTotalOrders('Sale');
            if(auth()->user()->hasrole('Customer') == true){
                $remaingToken = $this->dashboardRepository->getPackageRemaingToken();
            }else{
                $totalPackages = $this->dashboardRepository->getTotalOrders('Package');
                $totalUsers = $this->dashboardRepository->getTotalUsers();
            }
            return view('backend.pages.index', compact(['totalOrders', 'remaingToken', 'totalPackages', 'totalUsers']));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.index', $exception->getMessage());
        }
    }

}