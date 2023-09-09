<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Package\UpdatePackageRequest;
use Illuminate\Contracts\View\View;
use App\Contracts\Backend\PackageContract;
use App\Http\Requests\Package\StorePackageRequest;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\PackageDataTable;

class PackageController extends Controller
{
    /**
     * @var PackageContract
     */
    protected $packageRepository;

    public function __construct(PackageContract $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        PackageDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.package.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.package.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.pages.package.create');
    }

    /**
     * @param StorePackageRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StorePackageRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->packageRepository->createPackage($data);

            return redirect()->route("backend.pages.package.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Package has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.package.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $package = $this->packageRepository->findPackageById($id);
            return view('backend.pages.package.edit', compact('package'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.package.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdatePackageRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdatePackageRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->packageRepository->updatePackage($id, $data);

            return redirect()->route("backend.pages.package.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Package has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.package.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->packageRepository->deletePackage($id);
            return redirect()->route("backend.pages.package.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Package has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.package.destroy', $exception->getMessage());
        }
    }
}