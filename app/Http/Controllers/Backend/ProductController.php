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
     * Show the form for creating a new resource.
     */
    public function import_data()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '-1');
        $uploadFile = "";

        $import = new YourImportClass();
        $data = Excel::toCollection($import, storage_path() . "/app/diecut sticker.csv");
        //return $data[0];

        foreach ($data[0] as $key => $value) {
            if($key != 0){
                $product = Product::where('title', strtolower($value[1]))->first();
                if(empty($product)){
                    $product = new Product;
                    $product->title = $value[1];
                    $product->slug = \Str::slug(strtolower($value[1]));
                    $product->product_type = "variation";
                    $product->main_image = "1694893109391850627Screenshot (6).png";
                    $product->quantity = 0;
                    $product->price = 0.0;
                    $product->brand_id = 1;
                    $product->shipping_type = "free";
                    $product->status = "active";
                    $product->save();
                }

                $product->categories()->sync([1]);

                $attributeMaterialId = Attribute::where('name', strtolower('material'))->value('id');
                $attributeSizeId = Attribute::where('name', strtolower('size'))->value('id');
                $attributeQuantityId = Attribute::where('name', strtolower('quantity'))->value('id');

                $product->attributes()->sync([$attributeMaterialId, $attributeSizeId, $attributeQuantityId]);



                $attributeValueMaterial = AttributeValue::where('name', strtolower($value[2]))->where('attribute_id', $attributeMaterialId)->first();
                if(empty($attributeValueMaterial)){
                    $attributeValueMaterial = new AttributeValue;
                    $attributeValueMaterial->attribute_id = $attributeMaterialId;
                    $attributeValueMaterial->name = $value[2];
                    $attributeValueMaterial->slug = \Str::slug(strtolower($value[2]));
                    $attributeValueMaterial->status = 'active';
                    $attributeValueMaterial->save();
                }

                $size = "".$value[3]."x".$value[4]."";
                $attributeValueSize = AttributeValue::where('name', strtolower($size))->where('attribute_id', $attributeSizeId)->first();
                if(empty($attributeValueSize)){
                    $attributeValueSize = new AttributeValue;
                    $attributeValueSize->attribute_id = $attributeSizeId;
                    $attributeValueSize->name = $size;
                    $attributeValueSize->slug = \Str::slug(strtolower($size));
                    $attributeValueSize->status = 'active';
                    $attributeValueSize->save();
                }

                $attributeValueQuantity = AttributeValue::where('name', strtolower($value[5]))->where('attribute_id', $attributeQuantityId)->first();
                if(empty($attributeValueQuantity)){
                    $attributeValueQuantity = new AttributeValue;
                    $attributeValueQuantity->attribute_id = $attributeQuantityId;
                    $attributeValueQuantity->name = $value[5];
                    $attributeValueQuantity->slug = \Str::slug(strtolower($value[5]));
                    $attributeValueQuantity->status = 'active';
                    $attributeValueQuantity->save();
                }

                $productAttributeGroup = new ProductAttributeGroup;
                $productAttributeGroup->product_id = $product->id;
                $productAttributeGroup->main_image = "1694893109391850627Screenshot (6).png";
                $productAttributeGroup->short_description = "".$value[2]."-".$size."-".$value[5]."";
                $productAttributeGroup->sku = $key + 1;
                $productAttributeGroup->quantity = 100000;
                $productAttributeGroup->price = $value[10];
                $productAttributeGroup->visibilty = true;
                $productAttributeGroup->save();

                $productAttributeValueGroup = new ProductAttributeValueGroup;
                $productAttributeValueGroup->product_id = $product->id;
                $productAttributeValueGroup->product_group_id = $productAttributeGroup->id;
                $productAttributeValueGroup->product_attribute_val_id = $attributeValueMaterial->id;
                $productAttributeValueGroup->save();

                $productAttributeValueGroup = new ProductAttributeValueGroup;
                $productAttributeValueGroup->product_id = $product->id;
                $productAttributeValueGroup->product_group_id = $productAttributeGroup->id;
                $productAttributeValueGroup->product_attribute_val_id = $attributeValueSize->id;
                $productAttributeValueGroup->save();

                $productAttributeValueGroup = new ProductAttributeValueGroup;
                $productAttributeValueGroup->product_id = $product->id;
                $productAttributeValueGroup->product_group_id = $productAttributeGroup->id;
                $productAttributeValueGroup->product_attribute_val_id = $attributeValueQuantity->id;
                $productAttributeValueGroup->save();
            }

        }

        return view('backend.pages.product.import_data');
    }
}