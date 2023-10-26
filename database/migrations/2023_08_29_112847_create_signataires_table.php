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
        Schema::create('signataires', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 30);
            $table->string('prenom', 100);
            $table->string('nip', 50);
            $table->enum('sexe', ['Masculin', 'Féminin']);
            $table->enum('typeDocument', ['Attestation Provisoire', 'Attestation Definitive', 'Diplome']);
            $table->string('fonction', 30);
            $table->string('fonctionLongue', 100);
            $table->string('grade', 50);
            $table->string('titreAcademique', 100)->nullable();
            $table->string('titreHonorifique', 100)->nullable();
            $table->foreignId('institution_id')->constrained('institutions')->onDelete('cascade')->onUpdate('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signataires');
    }
};
