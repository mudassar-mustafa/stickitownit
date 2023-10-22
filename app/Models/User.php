<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\UploadFile;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes, UploadFile;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'user_type',
        'status',
        'cnic',
        'country_id',
        'state_id',
        'city_id',
        'profile_image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    /**
     * Always encrypt the password when it is updated.
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Always the icon when it is updated.
     * @param $value
     * @return string
     */
    public function setProfileImageAttribute($value)
    {
        $imageName = '';
        if (!is_null($value) && $value !== '') {
            $imageName =  $this->upload($value, 'profileImages');
            $this->attributes['profile_image'] = $imageName;
        }
    }


    /**
     * @param $value
     * @return string
     */
    public function getProfileImageAttribute($value): String
    {
        return asset('/storage/uploads/profileImages/' . $value);
    }

    /**
    * @return HasMany
    */
    public function cart_user(): HasMany
    {
        return $this->hasMany(Cart::class,'user_id','id');
    }

    /**
    * @return HasMany
    */
    public function buyer_order(): HasMany
    {
        return $this->hasMany(Order::class, 'buyer_id', 'id');
    }

    /**
    * @return HasMany
    */
    public function seller_order(): HasMany
    {
        return $this->hasMany(Order::class, 'seller_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function review_user_detail(): HasMany
    {
        return $this->belongsToMany(ProductReview::class, 'user_id', 'id');
    }
}
