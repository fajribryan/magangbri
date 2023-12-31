<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris';

    protected $guarded = [
        'id',
    ];
    protected $dateFormat = 'Y-m-d';

    public $timestamps = false;
}
