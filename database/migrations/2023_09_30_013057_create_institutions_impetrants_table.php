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
        Schema::create('institutions_impetrants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained('institutions')->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('impetrant_id')->constrained('impetrants')->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('referenceInscription', 50); 
            $table->string('annee', 20);         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutions_impetrants');
    }
};
