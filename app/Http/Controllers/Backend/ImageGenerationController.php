<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ImageGenerationDataTableInprogress;
use App\Services\UtilService;
use App\DataTables\ImageGenerationDataTable;
use App\Models\GenerationImage;
use Response;
use Auth;
use Illuminate\Http\Request;
class ImageGenerationController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(
        Request $request,
        UtilService    $utilService,
        ImageGenerationDataTable $dataTable1,
        ImageGenerationDataTableInprogress $dataTable2,
    )
    {
        try {
            $userId = 0;
            if(Auth::user()->hasRole('Customer')){
                $userId = Auth::user()->id;
            }

            if($request->get('status') !== null && $request->get('status') === 'completed'){
                $dataTable = $dataTable1->with(['userId' => $userId])->render('backend.pages.generations.index');
                return $dataTable;
            }
            $dataTable = $dataTable2->with(['userId' => $userId])->render('backend.pages.generations.index');

            return $dataTable;
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
