<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AttributeValue\UpdateAttributeValueRequest;
use Illuminate\Contracts\View\View;
use App\Contracts\Backend\AttributeValueContract;
use App\Http\Requests\AttributeValue\StoreAttributeValueRequest;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\AttributeValueDataTable;

class AttributeValueController extends Controller
{
    /**
     * @var AttributeValueContract
     */
    protected $attributeValueRepository;

    public function __construct(AttributeValueContract $attributeValueRepository)
    {
        $this->attributeValueRepository = $attributeValueRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        AttributeValueDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.attribute-value.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.attribute-value.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $attributes = $this->attributeValueRepository->getAttributeList();
        return view('backend.pages.attribute-value.create', compact('attributes'));
    }

    /**
     * @param StoreAttributeValueRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StoreAttributeValueRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->attributeValueRepository->createAttributeValue($data);

            return redirect()->route("backend.pages.attribute-value.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "AttributeValue has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.attribute-value.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $attributeValue = $this->attributeValueRepository->findAttributeValueById($id);
            $attributes = $this->attributeValueRepository->getAttributeList();
            return view('backend.pages.attribute-value.edit', compact(['attributeValue','attributes']));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.attribute-value.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdateAttributeValueRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdateAttributeValueRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->attributeValueRepository->updateAttributeValue($id, $data);

            return redirect()->route("backend.pages.attribute-value.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "AttributeValue has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.attribute-value.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->attributeValueRepository->deleteAttributeValue($id);
            return redirect()->route("backend.pages.attribute-value.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "AttributeValue has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.attribute-value.destroy', $exception->getMessage());
        }
    }
}