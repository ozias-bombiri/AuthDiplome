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
        Schema::create('attestation_definitives', function (Blueprint $table) {
            $table->id();
            $table->string('intitule', 100);
            $table->date('dateSignaure');
            $table->string('reference', 50);
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
        Schema::dropIfExists('attestation_definitives');
    }
};
