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
        Schema::create('resultat_academiques', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 50)->unique();
            $table->double('moyenne');
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('procesVerbal_id')->constrained('proces_verbaux')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['etudiant_id', 'parcours_id']);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultat_academiques');
    }
};
