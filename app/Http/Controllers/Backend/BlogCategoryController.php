<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Backend\BlogCategoryContract;
use App\DataTables\BlogCategoryDataTable;
use App\Http\Enums\CommonEnum;
use App\Http\Requests\Blogs\Category\StoreBlogCategoryRequest;
use App\Http\Requests\Blogs\Category\UpdateBlogCategoryRequest;
use App\Services\UtilService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class BlogCategoryController extends Controller
{
    /**
     * @var BlogCategoryContract
     */
    protected $blogCategoryRepository;

    public function __construct(BlogCategoryContract $blogCategoryRepository)
    {
        $this->blogCategoryRepository = $blogCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        BlogCategoryDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.blogs.categories.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs-categories.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.pages.blogs.categories.create');
    }

    /**
     * @param StoreBlogCategoryRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StoreBlogCategoryRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->blogCategoryRepository->createCategory($data);

            return redirect()->route("backend.pages.blogs-categories.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Category has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs-categories.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $category = $this->blogCategoryRepository->findCategoryById($id);
            return view('backend.pages.blogs.categories.edit', compact('category'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs-categories.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdateBlogCategoryRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdateBlogCategoryRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->blogCategoryRepository->updateCategory($id, $data);

            return redirect()->route("backend.pages.blogs-categories.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Category has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs-categories.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->blogCategoryRepository->deleteCategory($id);
            return redirect()->route("backend.pages.blogs-categories.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Category has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs-categories.destroy', $exception->getMessage());
        }
    }
}
