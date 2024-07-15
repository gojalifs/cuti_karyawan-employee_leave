<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataCuti extends Model
{
    use HasFactory;

    protected $table = 'data_cuti';

    protected $fillable = [
        'user_id',
        'cuti_id',
        'sisa',
    ];
}
