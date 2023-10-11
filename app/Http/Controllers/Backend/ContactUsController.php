<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Backend\ContactUsContract;
use App\DataTables\ContactUsDataTable;
use App\Http\Enums\CommonEnum;

use App\Services\UtilService;


class ContactUsController extends Controller
{
    /**
     * @var ContactUsContract
     */
    protected $contactUsRepository;

    public function __construct(ContactUsContract $contactUsRepository)
    {
        $this->contactUsRepository = $contactUsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        ContactUsDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.contact-us.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.contact-us.index', $exception->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->contactUsRepository->deleteContactUs($id);
            return redirect()->route("backend.pages.contact-us.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Contact Us has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.contact-us.destroy', $exception->getMessage());
        }
    }

}
