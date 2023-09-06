<?php
namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Backend\BaseRepository;
use Illuminate\Http\Request;

class BrandRepository extends BaseRepository
{
    protected $model;

    public function __construct(Brand $model){
        $this->model = $model;
    }

    /**
     * set payload data for posts table.
     *
     * @param Request $request [description]
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        return [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'status' => $request->input('status'),
        ];
    }
}
