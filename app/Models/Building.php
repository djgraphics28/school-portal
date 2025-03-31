<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = ['building_code', 'name', 'location', 'floors', 'description'];

    protected $casts = [
        'floors' => 'integer'
    ];
}
