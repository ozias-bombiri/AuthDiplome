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
            $table->boolean('statut')->default('active');
            $table->date('debut')->nullable();
            $table->date('fin')->nullable();
            $table->foreignId('categorieActe_id')->constrained('categorie_actes')->onDelete('cascade')->onUpdate('cascade');    
            $table->foreignId('institution_id')->constrained('institutions')->onDelete('cascade')->onUpdate('cascade');    
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
