<?php

namespace App\Repositories\Frontend;

use App\Models\Package;
use App\Contracts\Frontend\LandingContract;
use Auth;

class LandingRepository extends BaseRepository implements LandingContract
{
    protected $model;

    public function __construct(Package $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getPackages(){
        return Package::where('status', 'active')->get();
    }

}
