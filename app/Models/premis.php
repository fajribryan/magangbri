<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class premis extends Model
{
    use HasFactory;

    protected $table = 'premisessa';
    protected $guarded = [
        'id',
    ];
    public $timestamps = false;

}
