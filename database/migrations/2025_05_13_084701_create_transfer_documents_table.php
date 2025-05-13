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
        Schema::create('transfer_documents', function (Blueprint $table) {
            $table->id();
            $table->morphs('dispatch_object');
            $table->morphs('destination_object');
            $table->morphs('transfer_object');
            $table->date('date');
            $table->softDeletesTz();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_documents');
    }
};
