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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parcours_id')->constrained('parcours')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade')->onUpdate('cascade');
            $table->string('referenceInscription', 50)->nullable(); 
            $table->unique(['parcours_id', 'etudiant_id']);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');      
            $table->foreignId('anneeAcademique_id')->constrained('annee_academiques')->onDelete('cascade')->onUpdate('cascade');      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
