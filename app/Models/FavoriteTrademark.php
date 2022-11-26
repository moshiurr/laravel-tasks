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
}
