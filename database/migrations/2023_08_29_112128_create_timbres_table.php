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
            $table->enum('type', ['iesr', 'etablissement', 'autre'])->default('etablissement');
            $table->foreignId('ministere_id')->constrained('ministeres')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('signataire_id')->constrained('signataires')->onDelete('cascade')->onUpdate('cascade');
            $table->text('description');
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
