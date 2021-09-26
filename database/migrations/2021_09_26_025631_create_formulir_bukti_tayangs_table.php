<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulirBuktiTayangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulir_bukti_tayangs', function (Blueprint $table) {
            $table->id();
            $table->integer('tipemedia_id')->unsigned();
            $table->string('kolom');
            $table->enum('tipe',['string','integer','file','date'])->default('string');
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
        Schema::dropIfExists('formulir_bukti_tayangs');
    }
}
