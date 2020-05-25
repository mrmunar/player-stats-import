<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerImportData extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'reference_id',
        'data',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
