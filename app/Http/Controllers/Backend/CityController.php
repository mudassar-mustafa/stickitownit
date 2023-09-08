<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\City\UpdateCityRequest;
use Illuminate\Contracts\View\View;
use App\Contracts\Backend\CityContract;
use App\Http\Requests\City\StoreCityRequest;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\CityDataTable;

class CityController extends Controller
{
    /**
     * @var CityContract
     */
    protected $cityRepository;

    public function __construct(CityContract $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        CityDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.city.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.city.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $states = $this->cityRepository->getStateList();
        return view('backend.pages.city.create', compact('states'));
    }

    /**
     * @param StoreCityRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StoreCityRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->cityRepository->createCity($data);

            return redirect()->route("backend.pages.city.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "City has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.city.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $city = $this->cityRepository->findCityById($id);
            $states = $this->cityRepository->getStateList();
            return view('backend.pages.city.edit', compact(['city','states']));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.city.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdateCityRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdateCityRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->cityRepository->updateCity($id, $data);

            return redirect()->route("backend.pages.city.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "City has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.city.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->cityRepository->deleteCity($id);
            return redirect()->route("backend.pages.city.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "City has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.city.destroy', $exception->getMessage());
        }
    }
}