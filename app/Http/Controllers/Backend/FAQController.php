<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Backend\FaqContract;
use App\DataTables\FaqDataTable;
use App\Http\Enums\CommonEnum;
use App\Http\Requests\Faq\StoreFaqRequest;
use App\Http\Requests\Faq\UpdateFaqRequest;
use App\Services\UtilService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FAQController extends Controller
{
    /**
     * @var FaqContract
     */
    protected $faqRepository;

    public function __construct(FaqContract $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService      $utilService,
        FaqDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.faqs.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.faqs.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.pages.faqs.create');
    }

    /**
     * @param StoreFaqRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StoreFaqRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->faqRepository->createFaq($data);

            return redirect()->route("backend.pages.faqs.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "FAQ has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.faqs.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $faq = $this->faqRepository->findFaqById($id);
            return view('backend.pages.faqs.edit', compact('faq'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.faqs.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdateFaqRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdateFaqRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->faqRepository->updateFaq($id, $data);

            return redirect()->route("backend.pages.faqs.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "FAQ has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.faqs.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->faqRepository->deleteFaq($id);
            return redirect()->route("backend.pages.faqs.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "FAQ has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.faqs.destroy', $exception->getMessage());
        }
    }
}
