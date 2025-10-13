<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class House extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'description',
        'address_line_1',
        'address_line_2',
        'city',
        'county',
        'zip',
        'beds',
        'baths',
        'square_metres',
        'energy_rating',
        'house_type',
        'image',
    ];
}