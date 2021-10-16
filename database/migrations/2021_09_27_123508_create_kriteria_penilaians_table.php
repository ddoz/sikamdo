<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriaPenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriteria_penilaians', function (Blueprint $table) {
            $table->id();
            $table->integer('tipemedia_id')->unsigned();
            $table->string('nama_kriteria');
            $table->enum('status',['0','1'])->default('1');
            $table->enum('multiple',['0','1'])->default('0');
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
        Schema::dropIfExists('kriteria_penilaians');
    }
}
