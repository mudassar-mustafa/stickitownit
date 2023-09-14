<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Contracts\View\View;
use App\Contracts\Backend\ProductContract;
use App\Http\Requests\Product\StoreProductRequest;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\ProductDataTable;

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
}