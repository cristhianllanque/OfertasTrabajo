<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'title',
        'description',
        'salary',
        'location',
        'user_id',
    ];

    /**
     * Relación con el modelo User (usuario que crea la oferta).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
