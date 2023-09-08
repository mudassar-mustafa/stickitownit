<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Backend\FeatureContract;
use App\DataTables\FeatureDataTable;
use App\Http\Enums\CommonEnum;
use App\Http\Requests\Feature\StoreFeatureRequest;
use App\Http\Requests\Feature\UpdateFeatureRequest;
use App\Services\UtilService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FeaturesController extends Controller
{
    /**
     * @var FeatureContract
     */
    protected $featureRepository;

    public function __construct(FeatureContract $featureRepository)
    {
        $this->featureRepository = $featureRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService      $utilService,
        FeatureDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.features.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.features.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.pages.features.create');
    }

    /**
     * @param StoreFeatureRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StoreFeatureRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->featureRepository->createFeature($data);

            return redirect()->route("backend.pages.features.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Feature has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.features.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $feature = $this->featureRepository->findFeatureById($id);
            return view('backend.pages.features.edit', compact('feature'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.features.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdateFeatureRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdateFeatureRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->featureRepository->updateFeature($id, $data);

            return redirect()->route("backend.pages.features.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Feature has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.features.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->featureRepository->deleteFeature($id);
            return redirect()->route("backend.pages.features.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Feature has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.features.destroy', $exception->getMessage());
        }
    }
}
