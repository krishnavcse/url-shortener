<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrlDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'short_url',
        'is_active',
        'user_id'
    ];


}
