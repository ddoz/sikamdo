<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaPenilaianDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        "kriteria_penilaian_id","nama_penilaian","nilai"
    ];

    public function kriteria_penilaian(){
        return $this->belongsTo("App\Models\KriteriaPenilaian");
    }
}
