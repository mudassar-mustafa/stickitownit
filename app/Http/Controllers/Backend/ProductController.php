<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Contracts\View\View;
use App\Contracts\Backend\ProductContract;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\ProductDataTable;
use App\DataTables\ProductVariationDataTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\YourImportClass; 
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeGroup;
use App\Models\ProductAttributeValueGroup;

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
    public function store(Request $request, UtilService $utilService)
    {
        try {
            //return $request;
            //$data = $request->validated();
            $data = $request->except('_token');
            $this->productRepository->createProduct(null ,$data);

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
        // try {
            $product = $this->productRepository->findProductById($id);
            //return $product;
            $brands = $this->productRepository->getBrands();
            $categories = $this->productRepository->getCategories();
            $attributes = [];
            if(!empty($product) && $product->product_type == 'variation'){
                $attributes = $this->productRepository->getAttributes();
            }
            
            return view('backend.pages.product.create', compact('brands', 'categories', 'attributes', 'product'));
            
        // } catch (\Exception $exception) {
        //     return $utilService->logErrorAndRedirectToBack('backend.pages.product.edit', $exception->getMessage());
        // }

    }

    /**
     * @param $id
     * @param UpdateProductRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, Request $request, UtilService $utilService)
    {
        try {
            //return $request;
            //$data = $request->validated();
            $data = $request->except('_token');
            $this->productRepository->createProduct($id, $data);

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
            $attributeSelectedValues = [];
            if($request->product_id != 0){
                $attributeSelectedValues = $this->productRepository->getProducAttributeValue($request->product_id, $request->attribute_name);
            }

            $getAttributeValueHtml = view('backend.pages.product.partial.attribute_value_partial', ['attributeValues'=> $attributeValues,  'attributeName' => $request->attribute_name, 'attributeSelectedValues' => $attributeSelectedValues])->render();

            $data = [
                'getAttributeValueHtml' => $getAttributeValueHtml,
                'attributeName' => $request->attribute_name,
                'attributeSelectedValues' => $attributeSelectedValues
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
            $productGroups = [];
            if($request->product_id != 0){
                $productGroups = $this->productRepository->getProductGroups($request->product_id);
            }

            $getCombinationHtml = view('backend.pages.product.partial.attribute_combination_partial', ['combinations'=> $combinations, 'productGroups' => $productGroups])->render();

            $data = $getCombinationHtml;
            
            return $utilService->makeResponse(200, "Combination Value Get Successfully", $data, CommonEnum::SUCCESS_STATUS);

        } catch (\Exception $exception) {
            return $utilService->makeResponse(500, $exception->getMessage());
        }
    }

    

    /**
     * Display a listing of the resource.
     */
    public function variationEdit(
        UtilService    $utilService,
        ProductVariationDataTable $dataTable,
        $id
    )
    {
        try {
            return $dataTable->with(['id' => $id])->render('backend.pages.product.variationEdit');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.product.variationEdit', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyVariation($id, UtilService $utilService)
    {

        try {
            $this->productRepository->deleteProductVariation($id);
            return redirect()->back()->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Product Variation has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.product.destroyVariation', $exception->getMessage());
        }
    }

    /**
     * @param $id
     * @param UpdateProductRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function updateVariation(Request $request, UtilService $utilService)
    {
        try {
            $data = $request->except('_token');
            $this->productRepository->updateProductVariation($data);

            return $utilService->makeResponse(200, "Variation Update Successfully", [], CommonEnum::SUCCESS_STATUS);
        } catch (\Exception $exception) {
            return $utilService->makeResponse(500, $exception->getMessage());
        }
    }
}