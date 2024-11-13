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
        Schema::create('obituary', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->date('date_of_birth');
            $table->date('date_of_death');
            $table->text('content');
            $table->string('author', 100);
            $table->timestamp('submission_date')->useCurrent();
            $table->string('slug', 255)->unique();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obituaries');
    }
};
