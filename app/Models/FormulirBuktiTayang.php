<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormulirBuktiTayang extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipemedia_id',
        'kolom',
        'tipe',
    ];
}
