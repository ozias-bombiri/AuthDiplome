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
        Schema::create('resultat_academiques', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 50);
            $table->boolean('soutenance');
            $table->date('dateSignaure');
            $table->double('moyenne');
            $table->string('cote', 20);
            $table->string('session', 100);
            $table->date('dateSoutenance');
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('parcours_id')->constrained('parcours')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('anneeAcademique_id')->constrained('annee_academiques')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultat_academiques');
    }
};
