<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trademark extends Model
{
    protected $table = 'trademarks';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'category_id',
        'trademark_name',
        'registration',
        'expiration'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
