<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UploadFile;

class Sticker extends Model
{
    use HasFactory, SoftDeletes, UploadFile;

    protected $table = 'stickers';

    protected $guarded =[];


    /**
     * Always the icon when it is updated.
     * @param $value
     * @return string
     */
    public function setImageAttribute($value)
    {
        $imageName = '';
        if (!is_null($value) && $value !== '') {
            $imageName =  $this->upload($value, 'stickers');
            $this->attributes['image'] = $imageName;
        }

    }


    /**
     * @param $value
     * @return string
     */
    public function getImageAttribute($value): String
    {
        return asset('/storage/uploads/stickers/' . $value);

    }
}
