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
        Schema::create('timbres', function (Blueprint $table) {
            $table->id();
            $table->string('intitule', 100)->unique();
            $table->string('type', 50)->default('etablissement');
            $table->foreignId('ministere_id')->constrained('ministeres')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('institution_id')->constrained('institutions')->onDelete('cascade')->onUpdate('cascade');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timbres');
    }
};
