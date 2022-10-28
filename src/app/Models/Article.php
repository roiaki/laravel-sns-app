<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    /**
     * Many to 1
     * Sub(atricle) -> Main(user)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
