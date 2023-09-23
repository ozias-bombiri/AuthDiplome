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
        Schema::create('iesrs', function (Blueprint $table) {
            $table->id();
            $table->string('sigle', 20)->unique('iesrs');
            $table->string('denomination', 100);
            $table->string('telephone', 20);
            $table->string('email', 50);
            $table->string('adresse', 50);
            $table->string('siteweb', 30)->nullable();
            $table->string('logo', 20)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iesrs');
    }
};
