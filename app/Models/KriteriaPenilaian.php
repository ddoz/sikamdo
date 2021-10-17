<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KriteriaPenilaianDetail;
use App\Models\TipeMedia;

class KriteriaPenilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        "tipemedia_id",'nama_kriteria',"status","multiple"
    ];

    public function tipemedia() {
        return $this->belongsTo(TipeMedia::class);
    }

    /**
     * Get the details for the blog post.
     */
    public function details()
    {
        return $this->hasMany(KriteriaPenilaianDetail::class);
    }
}
