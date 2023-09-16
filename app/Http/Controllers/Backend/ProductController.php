<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Contracts\View\View;
use App\Contracts\Backend\ProductContract;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\ProductDataTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var ProductContract
     */
    protected $productRepository;

    public function __construct(ProductContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        ProductDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.product.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.product.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $brands = $this->productRepository->getBrands();
        $categories = $this->productRepository->getCategories();
        $attributes = $this->productRepository->getAttributes();
        return view('backend.pages.product.create', compact('brands', 'categories', 'attributes'));
    }

    /**
     * @param StoreProductRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->productRepository->createProduct($data);

            return redirect()->route("backend.pages.product.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Product has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.product.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $product = $this->productRepository->findProductById($id);
            return view('backend.pages.product.edit', compact('product'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.product.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdateProductRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdateProductRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->productRepository->updateProduct($id, $data);

            return redirect()->route("backend.pages.product.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Product has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.product.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->productRepository->deleteProduct($id);
            return redirect()->route("backend.pages.product.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Product has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.product.destroy', $exception->getMessage());
        }
    }



    /**
     * @param Request $request
     * @param UtilService $utilService
     * @return JsonResponse
     */
    public function getAttributeValues(Request $request, UtilService $utilService) : JsonResponse
    {
        try {
            $getAttributeValueHtml= "";
            $attributeValues = $this->productRepository->getAttributeValues($request->attribute_name);

            $getAttributeValueHtml = view('backend.pages.product.partial.attribute_value_partial', ['attributeValues'=> $attributeValues,  'attributeName' => $request->attribute_name])->render();

            $data = [
                'getAttributeValueHtml' => $getAttributeValueHtml,
                'attributeName' => $request->attribute_name
            ];
            
            return $utilService->makeResponse(200, "Attribute Value Get Successfully", $data, CommonEnum::SUCCESS_STATUS);

        } catch (\Exception $exception) {
            return $utilService->makeResponse(500, $exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param UtilService $utilService
     * @return JsonResponse
     */
    public function getCombination(Request $request, UtilService $utilService) 
    {
        try {
            $getCombinationHtml= "";
            $combinations = $this->productRepository->getCombination($request->attributeArray);

            $getCombinationHtml = view('backend.pages.product.partial.attribute_combination_partial', ['combinations'=> $combinations])->render();

            $data = $getCombinationHtml;
            
            return $utilService->makeResponse(200, "Combination Value Get Successfully", $data, CommonEnum::SUCCESS_STATUS);

        } catch (\Exception $exception) {
            return $utilService->makeResponse(500, $exception->getMessage());
        }
    }
}