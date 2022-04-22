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
            $table->integer('respdifunto_id');
            $table->integer('cantidad_gestiones');
            $table->float('precio_sinot', 12, 2);           
            $table->string('monto');
            $table->string('ultimo_pago');
            $table->integer('id_usuario_caja')->nullable();
            $table->string('estado');
            $table->timestamps();

            $table->foreign('respdifunto_id')->references('id')->on('responsable_difunto');
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
