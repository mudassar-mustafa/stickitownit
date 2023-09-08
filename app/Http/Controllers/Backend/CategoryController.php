<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Backend\CategoryContract;
use App\DataTables\CategoryDataTable;
use App\Http\Enums\CommonEnum;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\UtilService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class CategoryController extends Controller
{
    /**
     * @var CategoryContract
     */
    protected $categoryRepository;

    public function __construct(CategoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        CategoryDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.categories.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.categories.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.pages.categories.create');
    }

    /**
     * @param StoreCategoryRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->categoryRepository->createCategory($data);

            return redirect()->route("backend.pages.categories.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Category has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.categories.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $category = $this->categoryRepository->findCategoryById($id);
            return view('backend.pages.categories.edit', compact('category'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.categories.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdateCategoryRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdateCategoryRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->categoryRepository->updateCategory($id, $data);

            return redirect()->route("backend.pages.categories.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Category has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.categories.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->categoryRepository->deleteCategory($id);
            return redirect()->route("backend.pages.categories.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Category has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.categories.destroy', $exception->getMessage());
        }
    }
}
