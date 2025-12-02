<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Represents a bid placed by a user on a house listing.
 */
class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'value', 'house_id', 'user_id',
    ];

    /**
     * Get the user who placed this bid.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the house this bid was placed on.
     */
    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
