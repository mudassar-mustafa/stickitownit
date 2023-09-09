<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Sticker\UpdateStickerRequest;
use Illuminate\Contracts\View\View;
use App\Contracts\Backend\StickerContract;
use App\Http\Requests\Sticker\StoreStickerRequest;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\StickerDataTable;

class StickerController extends Controller
{
    /**
     * @var StickerContract
     */
    protected $stickerRepository;

    public function __construct(StickerContract $stickerRepository)
    {
        $this->stickerRepository = $stickerRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        StickerDataTable $dataTable
    )
    {
        try {
            return $dataTable->render('backend.pages.sticker.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.sticker.index', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.pages.sticker.create');
    }

    /**
     * @param StoreStickerRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function store(StoreStickerRequest $request, UtilService $utilService): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->stickerRepository->createSticker($data);

            return redirect()->route("backend.pages.sticker.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Sticker has been added successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.sticker.store', $exception->getMessage());
        }
    }

    public function edit($id, UtilService $utilService)
    {
        try {
            $sticker = $this->stickerRepository->findStickerById($id);
            return view('backend.pages.sticker.edit', compact('sticker'));
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.sticker.edit', $exception->getMessage());
        }

    }

    /**
     * @param $id
     * @param UpdateStickerRequest $request
     * @param UtilService $utilService
     * @return RedirectResponse
     */
    public function update($id, UpdateStickerRequest $request, UtilService $utilService)
    {
        try {
            $data = $request->validated();
            $this->stickerRepository->updateSticker($id, $data);

            return redirect()->route("backend.pages.sticker.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Sticker has been updated successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.sticker.update', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, UtilService $utilService)
    {

        try {
            $this->stickerRepository->deleteSticker($id);
            return redirect()->route("backend.pages.sticker.index")->with([
                "status" => CommonEnum::SUCCESS_STATUS,
                "message" => "Sticker has been deleted successfully."
            ]);
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.sticker.destroy', $exception->getMessage());
        }
    }
}
