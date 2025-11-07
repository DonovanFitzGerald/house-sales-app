<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'featured_image',
    ];

    public function realtors()
    {
        return $this->belongsToMany(User::class, 'house_realtor')
            ->using(HouseRealtor::class)
            ->where('users.role', 'realtor');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class)->orderBy('value','desc');
    }

    public function topBid()
    {
        return $this->hasOne(Bid::class)->ofMany('value', 'max');
    }
}