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
        Schema::create('etablissements', function (Blueprint $table) {
            $table->id();
            $table->string('sigle', 20)->unique();
            $table->string('denomination', 100);
            $table->string('telephone', 20);
            $table->string('adresse', 20);
            $table->string('email', 30);
            $table->string('type', 10);
            $table->string('logo', 50);
            $table->text('description');
            $table->foreignId('iesr_id')->constrained('iesrs')->onDelete('cascade')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etablissements');
    }
};
