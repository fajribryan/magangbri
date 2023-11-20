<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class premisslm extends Model
{
    use HasFactory;
    protected $table = 'premisesslm';
    protected $guarded = [
        'id',
    ];
    public $timestamps = false;
}
