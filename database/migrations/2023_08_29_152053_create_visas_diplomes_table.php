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
            $table->foreignId('visaInstitution_id')->constrained('visas_institutions')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ordre');  
            $table->unique(['visa_id', 'visaInstitution_id']) ;
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
