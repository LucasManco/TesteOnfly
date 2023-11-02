<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Despesa extends Model
{
    use HasFactory;

    protected $fillable = ["descricao","data","usuario","valor"];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuarios');
    }
}
