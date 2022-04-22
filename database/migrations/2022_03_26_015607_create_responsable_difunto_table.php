<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsableDifuntoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsable_difunto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('responsable_id'); 
            $table->integer('difunto_id');  
            $table->string('codigo_nicho',20);           
            $table->date('fecha_adjudicacion');    
            $table->varchar('tiempo',4)->nullable();
            $table->integer('user_id');
            $table->string('estado',10)->default('ACTIVO');
            $table->timestamps();     
            $table->foreign('responsable_id')->references('id')->on('responsable');
            $table->foreign('difunto_id')->references('id')->on('difunto');
            $table->foreign('codigo_nicho')->references('codigo')->on('nicho');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responsable_difunto');
    }
}
