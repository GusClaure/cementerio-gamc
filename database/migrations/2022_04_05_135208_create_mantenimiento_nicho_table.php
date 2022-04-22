<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantenimientoNichoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimiento_nicho', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_in');
            $table->string('gestion');
            $table->boolean('pagado')->default(false);
            $table->timestamp('fecha_pago')->nullable();
            $table->integer('fur');
            $table->integer('responsable_id');
            $table->integer('cantidad_gestiones');
            $table->string('monto');

            $table->string('estado');
            $table->timestamps();

            $table->foreign('responsable_id')->references('id')->on('responsable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mantenimiento_nicho');
    }
}
