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
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('sigle', 30)->unique();
            $table->string('denomination', 100);
            $table->string('type', 30);
            $table->string('telephone', 20);
            $table->string('adresse', 50);
            $table->string('email', 30);
            $table->string('siteWeb', 50)->nullable();
            $table->string('logo', 50)->nullable();
            $table->text('description');
            $table->foreignId('parent_id')->constrained('institutions')->onDelete('cascade')
            ->onUpdate('cascade')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutions');
    }
};
