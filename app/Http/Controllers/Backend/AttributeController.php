<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Attribute\UpdateAttributeRequest;
use Illuminate\Contracts\View\View;
use App\Contracts\Backend\AttributeContract;
use App\Http\Requests\Attribute\StoreAttributeRequest;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\AttributeDataTable;

class AttributeController extends Controller
{
    /**
     * @var AttributeContract
     */
    protected $attributeRepository;

    public function __construct(AttributeContract $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        AttributeDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.attribute.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.attribute.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.pages.attribute.create');
    }

    /**
     * @param StoreAttributeRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StoreAttributeRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->attributeRepository->createAttribute($data);

            return redirect()->route("backend.pages.attribute.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Attribute has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.attribute.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $attribute = $this->attributeRepository->findAttributeById($id);
            return view('backend.pages.attribute.edit', compact('attribute'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.attribute.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdateAttributeRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdateAttributeRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->attributeRepository->updateAttribute($id, $data);

            return redirect()->route("backend.pages.attribute.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Attribute has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.attribute.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->attributeRepository->deleteAttribute($id);
            return redirect()->route("backend.pages.attribute.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Attribute has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.attribute.destroy', $exception->getMessage());
        }
    }
}