<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenovEnterratorioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renov_enterratorio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('servicioNichoid');
            $table->string('codigoNicho',10);           
            $table->string('monto',10);
            $table->string('renovacion',10);
            $table->string('fecha',10);
            $table->string('estado',10);
            $table->timestamps();
            $table->foreign('servicioNichoid')->references('id')->on('servicio_nicho');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('renov_enterratorio');
    }
}
