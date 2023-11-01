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
        Schema::create('niveau_etudes', function (Blueprint $table) {
            $table->id();
            $table->enum('intitule', ['L1', 'L2', 'Licence', 'M1', 'Master', 'Doctorat'])->unique('niveau_etudes');
            $table->string('credit', 10)->nullable();
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveau_etudes');
    }
};
