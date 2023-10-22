<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UploadFile;

class Quote extends Model
{
    use HasFactory, SoftDeletes, UploadFile;
    protected $table = 'quotes';
    protected $guarded = [];


    /**
     * Always the icon when it is updated.
     * @param $value
     * @return string
     */
    public function setFileAttribute($value)
    {
        $imageName = '';
        if (!is_null($value) && $value !== '') {
            $imageName =  $this->upload($value, 'quotes');
            $this->attributes['file'] = $imageName;
        }
    }

    /**
     * @param $value
     * @return string
     */
    public function getFileAttribute($value): String
    {
        return asset('/storage/uploads/quotes/' . $value);

    }
}
