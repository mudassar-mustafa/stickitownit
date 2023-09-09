<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Backend\BlogTagContract;
use App\DataTables\BlogTagDataTable;
use App\Http\Enums\CommonEnum;
use App\Http\Requests\Blogs\Tag\StoreBlogRequest;
use App\Http\Requests\Blogs\Tag\UpdateBlogRequest;
use App\Services\UtilService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class BlogTagController extends Controller
{
    /**
     * @var BlogTagContract
     */
    protected $blogTagRepository;

    public function __construct(BlogTagContract $blogTagRepository)
    {
        $this->blogTagRepository = $blogTagRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        BlogTagDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.blogs.tags.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs-tags.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.pages.blogs.tags.create');
    }

    /**
     * @param StoreBlogRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StoreBlogRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->blogTagRepository->createTag($data);

            return redirect()->route("backend.pages.blogs-tags.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Tag has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs-tags.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $tag = $this->blogTagRepository->findTagById($id);
            return view('backend.pages.blogs.tags.edit', compact('tag'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs-tags.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdateBlogRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdateBlogRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->blogTagRepository->updateTag($id, $data);

            return redirect()->route("backend.pages.blogs-tags.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Tag has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs-tags.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->blogTagRepository->deleteTag($id);
            return redirect()->route("backend.pages.blogs-tags.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Tag has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs-tags.destroy', $exception->getMessage());
        }
    }
}
