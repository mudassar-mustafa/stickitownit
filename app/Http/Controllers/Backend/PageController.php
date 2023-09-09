<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Page\UpdatePageRequest;
use Illuminate\Contracts\View\View;
use App\Contracts\Backend\PageContract;
use App\Http\Requests\Page\StorePageRequest;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\PageDataTable;

class PageController extends Controller
{
    /**
     * @var PageContract
     */
    protected $pageRepository;

    public function __construct(PageContract $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        PageDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.page.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.page.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.pages.page.create');
    }

    /**
     * @param StorePageRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StorePageRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->pageRepository->createPage($data);

            return redirect()->route("backend.pages.page.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Page has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.page.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $page = $this->pageRepository->findPageById($id);
            return view('backend.pages.page.edit', compact('page'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.page.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdatePageRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdatePageRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->pageRepository->updatePage($id, $data);

            return redirect()->route("backend.pages.page.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Page has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.page.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->pageRepository->deletePage($id);
            return redirect()->route("backend.pages.page.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Page has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.page.destroy', $exception->getMessage());
        }
    }
}