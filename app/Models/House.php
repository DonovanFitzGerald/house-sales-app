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

    /**
     * Get realtors assigned to this house via the house_user pivot table.
     */
    public function realtors()
    {
        return $this->belongsToMany(User::class)
            ->where('users.role', 'realtor');
    }

    /**
     * Get all bids for this house, ordered by highest value first.
     */
    public function bids()
    {
        return $this->hasMany(Bid::class)->orderBy('value', 'desc');
    }

    /**
     * Get the bid with the max value for this house
     */
    public function topBid()
    {
        return $this->hasOne(Bid::class)->ofMany('value', 'max');
    }
}
