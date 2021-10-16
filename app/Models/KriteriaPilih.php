<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaPilih extends Model
{
    use HasFactory;

    protected $fillable = [
        "proposal_id","kriteria_id","kriteriadetail_id","nilai","user_id"
    ];

    public function kriteriadetail() {
        return $this->belongsTo("App\Models\KriteriaPenilaianDetail");
    }
}
