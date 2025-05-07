<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country',
        'city',
        'postal_code',
        'street_address'
    ];

    /**
     * Relationship: An address belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
