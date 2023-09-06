<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Repositories\Backend\BrandRepository;
use App\Contracts\Backend\BrandContract;
use App\Http\Requests\Brand\StoreBrandRequest;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\BrandDataTable;

class BrandController extends Controller
{
    /**
     * @var BrandContract
     */
    protected $brandRepository;

    public function __construct(
        BrandContract $brandRepository
    ) {
        $this->brandRepository = $brandRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService $utilService,
        BrandDataTable  $dataTable
    ) {
        try {
            return  $dataTable->render('backend.pages.brand.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.brand.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('backend.pages.brand.create');
    }

    /**
     * @param StoreBrandRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StoreBrandRequest $request, UtilService $utilService) : RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->brandRepository->create($data);

            return redirect()->route("backend.pages.brand.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Brand has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.brand.store', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
