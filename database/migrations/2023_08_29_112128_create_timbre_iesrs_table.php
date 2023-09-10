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
        Schema::create('timbres_iesrs', function (Blueprint $table) {
            $table->id();
            $table->string('intitule', 100)->unique();
            $table->enum('type', ['iesr', 'etablissement']);
            $table->string('ministere', 20)->unique();
            $table->string('denomMinistere', 150)->unique();
            $table->text('description');
            $table->foreignId('iesr_id')->constrained('iesrs')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timbres_iesrs');
    }
};
