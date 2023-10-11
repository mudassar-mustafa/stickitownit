<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Backend\QuoteContract;
use App\DataTables\QuoteDataTable;
use App\Http\Enums\CommonEnum;

use App\Services\UtilService;


class QuoteController extends Controller
{
    /**
     * @var QuoteContract
     */
    protected $quoteRepository;

    public function __construct(QuoteContract $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        QuoteDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.quote.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.quote.index', $exception->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->quoteRepository->deleteQuote($id);
            return redirect()->route("backend.pages.quote.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Quotation has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.contact-us.destroy', $exception->getMessage());
        }
    }

}
