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
        Schema::create('numeroteurs', function (Blueprint $table) {
            $table->id();
            $table->string('categorie', 20);
            $table->integer('compteur')->default(0);
            $table->string('chaine', 150)->nullable();
            $table->foreignId('institution_id')->constrained('institutions')->onDelete('cascade')->onUpdate('cascade')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numeroteurs');
    }
};
