<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class formazione extends Model
{
    protected $table = 'formaziones';
    protected $fillable = [
        'titolo',
        'area',
        'sotto_area',
    ];
}
