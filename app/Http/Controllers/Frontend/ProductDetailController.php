<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\FAQ;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Contracts\Frontend\ProductDetailContract;
use Illuminate\Contracts\View\View;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;

class ProductDetailController extends Controller
{

    /**
     * @var ProductDetailContract
     */
    protected $productDetailRepository;

    public function __construct(ProductDetailContract $productDetailRepository)
    {
        $this->productDetailRepository = $productDetailRepository;
    }

    public function productDetail($slug)
    {
        $productAttributeValues = [];
        $product =  $this->productDetailRepository->getProductDetail($slug);
        return view('frontend.pages.product.product_detail', compact('product', 'productAttributeValues'));
    }

    /**
     * @param Request $request
     * @param UtilService $utilService
     * @return JsonResponse
    */
    public function getAttributeValue(Request $request, UtilService $utilService)
    {
        $productAttributeValues = $this->productDetailRepository->getProductAttributeValue($request->product_id, $request->attribute_id, $request->key, $request->selectedIds);
        $groupData = [];
        if($request->key == '2'){
            $groupData = $this->productDetailRepository->getProductGroupAttribute($request->product_id, $request->selectedIds);
        }

        $data =[
            'productAttributeValues' => $productAttributeValues,
            'groupData' => $groupData,
        ];
        
        return $utilService->makeResponse(200, "Combination Value Get Successfully", $data, CommonEnum::SUCCESS_STATUS);
    }

    /**
     * @param Request $request
     * @param UtilService $utilService
     * @return JsonResponse
    */
    public function getProductGroupValue(Request $request, UtilService $utilService)
    {
       
        $groupData = $this->productDetailRepository->getProductGroupAttribute($request->product_id, $request->selectedIds);
        
        return $utilService->makeResponse(200, "Combination Value Get Successfully", $groupData, CommonEnum::SUCCESS_STATUS);
    }
}