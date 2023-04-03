<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registros_usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_documento_id');
            $table->bigInteger('numero_documento');
            $table->string('nombres');
            $table->string('apellidos');
            $table->integer('telefono');
            $table->string('email');
            $table->unsignedBigInteger('curso_id');
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('gestor_id')->nullable();
            $table->timestamps();

            $table->foreign('tipo_documento_id')->references('id')->on('tipos_documentos')->onDelete('cascade');
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade');
            $table->foreign('gestor_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros_usuarios');
    }
};
