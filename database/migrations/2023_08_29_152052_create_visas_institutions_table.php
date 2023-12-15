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
        Schema::create('visas_institutions', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            $table->foreignId('categorieActe_id')->constrained('categorie_actes')->onDelete('cascade')->onUpdate('cascade');    
            $table->foreignId('institution_id')->constrained('institutions')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visas_institutions');
    }
};
