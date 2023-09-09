<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Backend\BlogContract;
use App\DataTables\BlogDataTable;
use App\Helpers\s3Helper;
use App\Http\Enums\CommonEnum;
use App\Http\Requests\Blogs\StoreBlogRequest;
use App\Http\Requests\Blogs\UpdateBlogRequest;
use App\Models\PropertyPhoto;
use App\Services\UtilService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    /**
     * @var BlogContract
     */
    protected $blogRepository;

    public function __construct(BlogContract $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService   $utilService,
        BlogDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.blogs.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $blog_id = substr(str_shuffle(str_repeat($x = '0123456789', ceil(10 / strlen($x)))), 1, 10);

        if (session()->has('blog_id') && !is_null(session()->get('blog_id'))) {
            $blog_id = session()->get('blog_id');
        } else {
            session()->put('blog_id', $blog_id);
        }
        $categories = $this->blogRepository->getCategories();
        $tags = $this->blogRepository->getTags();
        return view('backend.pages.blogs.create', compact('tags', 'categories', 'blog_id'));
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
            $this->blogRepository->createBlog($data);
            session()->forget(['blog_id']);
            return redirect()->route("backend.pages.blogs.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Blog has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $blog = $this->blogRepository->findBlogById($id);
            $categories = $this->blogRepository->getCategories();
            $tags = $this->blogRepository->getTags();
            session()->put('blog_id', $blog->id);

            return view('backend.pages.blogs.edit', compact('blog', 'categories', 'tags'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs.edit', $exception->getMessage());
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
            $this->blogRepository->updateBlog($id, $data);

            return redirect()->route("backend.pages.blogs.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Blog has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->blogRepository->deleteBlog($id);
            return redirect()->route("backend.pages.blogs.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Blog has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs.destroy', $exception->getMessage());
        }
    }


    function upload(Request $request, UtilService $utilService)
    {
        try {
            return response()->json(['success' => $this->blogRepository->uploadImages($request->all())]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs.media.upload', $exception->getMessage());
        }

    }

    function fetch($id, UtilService $utilService)
    {

        try {
            echo $this->blogRepository->fetch($id);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs.media.fetch', $exception->getMessage());
        }

    }

    function deleteMedia(Request $request, UtilService $utilService)
    {
        try {
            return $this->blogRepository->deleteMedia($request->all());
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.blogs.media.delete', $exception->getMessage());
        }

    }
}
