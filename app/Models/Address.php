<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id', 'street', 'city', 'state', 'country', 'postal_code'
    ];

    protected $table = 'addresses';
    protected $keyType = 'string';
    protected $primaryKey = 'address_id';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
