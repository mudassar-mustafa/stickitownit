<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $table = 'features';
    protected $guarded = [];


    /**
     * Always the image when it is updated.
     * @param $value
     * @return string
     */
    public function setImageAttribute($value)
    {

        $imageName = '';
        if (!is_null($value) && $value !== '') {
            $imageName = time() . '.' . $value->getClientOriginalExtension();
            $destinationPathThumbail = public_path('/uploads/features');
            $value->move($destinationPathThumbail, $imageName);
            $this->attributes['image'] = $imageName;
        }


    }


    /**
     * @param $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return asset('/uploads/features/' . $value);
    }
}
