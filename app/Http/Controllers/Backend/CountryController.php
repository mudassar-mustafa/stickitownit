<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Country\UpdateCountryRequest;
use Illuminate\Contracts\View\View;
use App\Contracts\Backend\CountryContract;
use App\Http\Requests\Country\StoreCountryRequest;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\CountryDataTable;

class CountryController extends Controller
{
    /**
     * @var CountryContract
     */
    protected $countryRepository;

    public function __construct(CountryContract $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        CountryDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.country.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.country.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.pages.country.create');
    }

    /**
     * @param StoreCountryRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StoreCountryRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->countryRepository->createCountry($data);

            return redirect()->route("backend.pages.country.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Country has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.country.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $country = $this->countryRepository->findCountryById($id);
            return view('backend.pages.country.edit', compact('country'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.country.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdateCountryRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdateCountryRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->countryRepository->updateCountry($id, $data);

            return redirect()->route("backend.pages.country.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Country has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.country.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->countryRepository->deleteCountry($id);
            return redirect()->route("backend.pages.country.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Country has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.country.destroy', $exception->getMessage());
        }
    }
}