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
        Schema::table('transfer_documents', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->after('id');
            $table->foreign('status_id')->references('id')->on('transfer_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transfer_documents', function (Blueprint $table) {
            $table->dropColumn('status_id');
        });
    }
};
