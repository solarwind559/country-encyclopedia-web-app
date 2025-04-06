<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $fillable = [
        'name',
        'official_name',
        'country_code',
        'population',
        'population_rank',
        'flag',
        'area',
        'neighbors',
        'languages',
        'translations',
        'is_favorite',
    ];
}
