<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Contracts\View\View;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use App\DataTables\ImageGenerationDataTable;
use App\Models\GenerationImage;
use Response;
use Auth;
class ImageGenerationController extends Controller
{
    

    /**
     * Display a listing of the resource.
     */
    public function index(
        UtilService    $utilService,
        ImageGenerationDataTable $dataTable
    )
    {
        try {
            $userId = 0;
            if(Auth::user()->hasRole('Customer')){
                $userId = Auth::user()->id;
            }
            return $dataTable->with(['userId' => $userId])->render('backend.pages.generations.index');
        } catch (\Exception $exception) {
            return $utilService->logErrorAndRedirectToBack('backend.pages.generations.index', $exception->getMessage());
        }
    }

    public function download($id, UtilService $utilService){
        $generationImage = GenerationImage::where('id', $id)->first();
        if (file_exists($generationImage->image)) {
            return response()->download($generationImage->image);
          }else{
            return $utilService->logErrorAndRedirectToBack('backend.pages.generations.download', "File Not Download");
          }
        
    }
}
