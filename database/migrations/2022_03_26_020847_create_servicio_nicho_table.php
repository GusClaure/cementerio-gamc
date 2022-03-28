<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioNichoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio_nicho', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('responsable_id'); 
            $table->integer('difunto_id');  
            $table->string('codigo_nicho',20);           
            $table->date('fecha_registro');     
            $table->string('tipo_servicio_id',30);           
            $table->string('tipo_servicio',200);           
            $table->string('servicio_id',30);           
            $table->string('servicio',200); 
           // $table->jsonb('data')->nullable(); 
            $table->integer('fur');
            $table->integer('gestion_pagada'); //pag_con    

            $table->date('fecha_pago');     
            $table->boolean('estado_pago')->default(false);
            $table->integer('user_id');
            $table->string('estado',10)->default('ACTIVO');
            $table->timestamps();     

            $table->foreign('responsable_id')->references('id')->on('responsable');
            $table->foreign('difunto_id')->references('id')->on('difunto');
           // $table->foreign('codigo_nicho')->references('codigo')->on('nicho');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicio_nicho');
    }
}
