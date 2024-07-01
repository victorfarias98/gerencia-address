<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Address
 *
 * @package App
 * @mixin Builder
 * @mixin Model
 */
class Address extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id', 'street','number','complement', 'city', 'state', 'country', 'postal_code'
    ];

    protected $hidden = ['address_id', 'user_id'];

    protected $table = 'addresses';
    protected $keyType = 'string';
    protected $primaryKey = 'address_id';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
