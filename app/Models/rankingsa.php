<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rankingsa extends Model
{
    use HasFactory;
    protected $table = 'rangkingsa';
    protected $fillable = ['ro','kodeu','namau', 'tipeu', 'noe', 'noa', 'noc', 'tse', 'tsa', 'tsc', 'tsep', 'tsap', 'tscp', 'pse', 'psa', 'psc'];

    public $timestamps = false;
}
