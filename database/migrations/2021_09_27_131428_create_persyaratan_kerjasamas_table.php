<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersyaratanKerjasamasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persyaratan_kerjasamas', function (Blueprint $table) {
            $table->id();
            $table->integer('tipemedia_id');
            $table->string('kolom');
            $table->string('deskripsi')->nullable();
            $table->enum('tipe',['string','integer','file','date']);
            $table->integer('nilai')->default(0);
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
        Schema::dropIfExists('persyaratan_kerjasamas');
    }
}
