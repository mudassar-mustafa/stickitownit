<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageSubscription extends Model
{
    use HasFactory;

    protected $table = 'package_subscriptions';

    protected $guarded =[];
}
