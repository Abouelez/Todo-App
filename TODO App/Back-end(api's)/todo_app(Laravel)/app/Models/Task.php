<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'user_id',
        'status'
    ];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
