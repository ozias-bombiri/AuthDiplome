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
        Schema::create('signataires_actes', function (Blueprint $table) {
            $table->id();
            $table->string('statut')->default('active');
            $table->date('debut')->nullable();
            $table->date('fin')->nullable();
            $table->foreignId('signataireInstitution_id')->constrained('signataires_institutions')->onDelete('cascade')->onUpdate('cascade');    
            $table->foreignId('signataire_id')->constrained('signataires')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signataires_actes');
    }
};