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
        Schema::table('animal_objects', function (Blueprint $table) {
             $table->unsignedBigInteger('owner_id')->nullable()->default(null);
             $table->foreign('owner_id')->references('id')->on('animal_owners');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('animal_object', function (Blueprint $table) {
            //
        });
    }
};
