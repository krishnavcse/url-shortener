<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelName extends Model
{
    use HasFactory;

    protected $fillable = [
        'votes',
        'data',
        'name',
        'created_at',
        'amount',
        'column',
        'choices',
        'amount_one',
        'votess',
        'number',
        'email',
    ];
}
