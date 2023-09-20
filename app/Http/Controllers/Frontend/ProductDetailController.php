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
        //+return $product;
        if($product->product_type == "variation"){
            $productAttributeValues = $this->productDetailRepository->getProductAttributeValueArray($product->id);
        }

        return view('frontend.pages.product.product_detail', compact('product', 'productAttributeValues'));
    }
}
