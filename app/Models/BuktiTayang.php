<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiTayang extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id',
        'formula_id',
        'value'
    ];

    public function formula() {
        return $this->belongsTo('App\Models\FormulirBuktiTayang');
    }
}
