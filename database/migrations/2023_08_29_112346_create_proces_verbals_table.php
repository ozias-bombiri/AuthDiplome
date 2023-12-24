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
        Schema::create('proces_verbaux', function (Blueprint $table) {
            $table->id();
            $table->string('nomFichierPdf', 150)->nullable();
            $table->string('reference', 50);
            $table->string('intitule', 150);
            $table->string('session');
            $table->date('dateDeliberation');
            $table->enum('type', ['EXAMEN', 'SOUTENANCE', 'AUTRE']);
            $table->integer('nombreEtudiants')->nullable();
            $table->string('description');
            $table->foreignId('parcours_id')->constrained('parcours')->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreignId('anneeAcademique_id')->constrained('annee_academiques')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['parcours_id', 'anneeAcademique_id', 'session']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proces_verbaux');
    }
};
