<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteTrademark extends Model
{
    protected $table = "favorite_trademarks";
    protected $primaryKey = "id";

    protected $fillable = [
        'owner_id',
        'trademark_id'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function trademark(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Trademark::class, 'trademark_id', 'id');
    }


}
