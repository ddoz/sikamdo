<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->integer('tipemedia_id')->unsigned();
            $table->string('nama_media');
            $table->string('nama_pic');
            $table->string('jabatan_pic');
            $table->text('kartu_identitas_pic');
            $table->text('sk_pic');
            $table->text('alamat_redaksi_1');
            $table->text('alamat_redaksi_2');
            $table->text('kota');
            $table->text('provinsi');
            $table->text('kode_pos');
            $table->string('email_redaksi');
            $table->string('kontak_redaksi');
            $table->string('website')->default('-');
            $table->text('surat_permohonan_kerjasama');
            $table->text('proposal_penawaran');
            $table->text('siup_situ');
            $table->text('npwp');
            $table->text('setifikat_kemenkumham');
            $table->text('sertifikat_dewan_pers');
            $table->text('kode_identifikasi');
            $table->integer('user_id')->unsigned();
            $table->string('status')->default('draft')->comment('draft,approve,decline');
            $table->string('keterangan')->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposals');
    }
}
