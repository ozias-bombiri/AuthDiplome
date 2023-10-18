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
        Schema::create('attestation_provisoires', function (Blueprint $table) {
            $table->id();
            $table->string('intitule', 100);
            $table->string('reference', 50)->unique();
            $table->date('dateCreation');
            $table->string('lieuCreation');
            $table->date('dateSignature');
            $table->boolean('statutGeneration');
            $table->foreignId('resultatAcademique_id')->constrained('resultat_academiques')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('signataire_id')->constrained('signataires')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('document_id')->nullable()->constrained('documents')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attestation_provisoires');
    }
};
