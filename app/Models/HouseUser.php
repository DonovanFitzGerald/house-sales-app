<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class HouseUser extends Pivot
{
    protected $fillable = [
        'house_id', 'user_id',
    ];
}
