<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipeMedia;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipemedia_id',
        'nama_media',
        'nama_pic',
        'jabatan_pic',
        'kartu_identitas_pic', //file
        'sk_pic', //file
        'alamat_redaksi_1',
        'alamat_redaksi_2',
        'kota',
        'provinsi',
        'kode_pos',
        'email_redaksi',
        'kontak_redaksi',
        'website',
        'surat_permohonan_kerjasama', //file
        'proposal_penawaran', //file
        'siup_situ', //file
        'npwp', //file
        'sertifikat_kemenkumham', //file
        'sertifikat_dewan_pers', //file
        'kode_identifikasi',
        'user_id',
        'status',
        'keterangan'
    ];

    public function tipemedia() {
        return $this->belongsTo(Tipemedia::class);
    }
}
