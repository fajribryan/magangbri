<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class premis0 extends Model
{
    use HasFactory;

    protected $table = 'premises0';
    protected $guarded = [
        'id',
    ];
    public $timestamps = false;
}
