<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Brand\UpdateBrandRequest;
use Illuminate\Contracts\View\View;
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

    public function __construct(BrandContract $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        BrandDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.brand.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.brand.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.pages.brand.create');
    }

    /**
     * @param StoreBrandRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StoreBrandRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->brandRepository->createBrand($data);

            return redirect()->route("backend.pages.brand.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Brand has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.brand.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $brand = $this->brandRepository->findBrandById($id);
            return view('backend.pages.brand.edit', compact('brand'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.brand.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdateBrandRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdateBrandRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->brandRepository->updateBrand($id, $data);

            return redirect()->route("backend.pages.brand.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Brand has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.brand.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->brandRepository->deleteBrand($id);
            return redirect()->route("backend.pages.brand.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Brand has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.brand.destroy', $exception->getMessage());
        }
    }
}
