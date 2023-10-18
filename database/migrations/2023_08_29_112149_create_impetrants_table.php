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
        Schema::create('impetrants', function (Blueprint $table) {
            $table->id();
            $table->string('identifiant', 30)->unique();
            $table->enum('typeIdentifiant', ['INE', 'Matricule', 'Autre'])->default('INE');
            $table->string('nom',30);
            $table->string('prenom', 100);
            $table->enum('sexe', ['Masculin', 'Féminin']);
            $table->date('dateNaissance');
            $table->boolean('nevers')->default(0)->change();
            $table->string('lieuNaissance', 50);
            $table->string('paysNaissance', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impetrants');
    }
};
