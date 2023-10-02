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
        Schema::create('visas_diplomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visa_id')->constrained('visas')->onDelete('cascade')->onUpdate('cascade');    
            $table->foreignId('diplome_id')->constrained('diplomes')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ordre');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_diplomes');
    }
};
