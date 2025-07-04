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
        Schema::create('appreciation_notes', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->string('by');
            $table->text('receivers_id');
            $table->text('receivers_name');
            $table->string('line');
            $table->string('description');
            $table->text('files');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appreciation_notes');
    }
};
