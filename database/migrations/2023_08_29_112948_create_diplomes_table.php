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
        Schema::create('diplomes', function (Blueprint $table) {
            $table->id();
            $table->string('intitule', 100);
            $table->string('refrence', 50);
            $table->string('numeroEnregistrement', 50);
            $table->string('cote', 20);
            $table->date('dateSignature');
            $table->date('dateCreation');
            $table->foreignId('resultatAcademique_id')->constrained('resultat_academiques')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('signataireIesr_id')->constrained('signataire_iesrs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade')->onUpdate('cascade');           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diplomes');
    }
};
