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
        Schema::create('acte_academiques', function (Blueprint $table) {
            $table->id();
            $table->string('intitule', 100);
            $table->string('reference', 50)->unique();
            $table->string('numero', 50) ;            
            $table->string('lieu');
            $table->date('dateSignature');            
            $table->boolean('satutSignature')->default(0);            
            $table->boolean('statutRemise')->default(0);
            $table->boolean('validite')->default(1);
            $table->foreignId('resultatAcademique_id')->constrained('resultat_academiques')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('signataireActe_id')->constrained('signataires_actes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('categorieActe_id')->nullable()->constrained('categorie_actes')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['resultatAcademique_id', 'categorieActe_id']);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acte_academiques');
    }
};
