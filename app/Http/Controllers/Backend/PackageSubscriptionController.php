<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Contracts\View\View;
use App\Contracts\Backend\PackageSubscriptionContract;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\PackageSubscriptionDataTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Auth;

class PackageSubscriptionController extends Controller
{
    /**
     * @var PackageSubscriptionContract
     */
    protected $packageSubscriptionRepository;

    public function __construct(PackageSubscriptionContract $packageSubscriptionRepository)
    {
        $this->packageSubscriptionRepository = $packageSubscriptionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        PackageSubscriptionDataTable $dataTable
    )
    {
        try {
            $userId = Auth::user()->id;
            return $dataTable->with(['id' => $userId])->render('backend.pages.package-subscription.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.package-subscription.index', $exception->getMessage());
        }
    }
}
