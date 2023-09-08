<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\State\UpdateStateRequest;
use Illuminate\Contracts\View\View;
use App\Contracts\Backend\StateContract;
use App\Http\Requests\State\StoreStateRequest;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\StateDataTable;

class StateController extends Controller
{
    /**
     * @var StateContract
     */
    protected $stateRepository;

    public function __construct(StateContract $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        StateDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.state.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.state.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $countries = $this->stateRepository->getCountryList();
        return view('backend.pages.state.create', compact('countries'));
    }

    /**
     * @param StoreStateRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StoreStateRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->stateRepository->createState($data);

            return redirect()->route("backend.pages.state.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "State has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.state.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $state = $this->stateRepository->findStateById($id);
            $countries = $this->stateRepository->getCountryList();
            return view('backend.pages.state.edit', compact(['state','countries']));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.state.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdateStateRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdateStateRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->stateRepository->updateState($id, $data);

            return redirect()->route("backend.pages.state.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "State has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.state.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->stateRepository->deleteState($id);
            return redirect()->route("backend.pages.state.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "State has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.state.destroy', $exception->getMessage());
        }
    }
}