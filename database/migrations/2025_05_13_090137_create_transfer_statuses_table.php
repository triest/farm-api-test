<?php

use App\Models\TransferStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transfer_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });



                $transferStatus = new TransferStatus();
                $transferStatus->name = 'Новый';
                $transferStatus->slug = 'new';

                $transferStatus->save();

        $transferStatus = new TransferStatus();
        $transferStatus->name = 'В работе';
        $transferStatus->slug = 'in_work';
        $transferStatus->save();

        $transferStatus = new TransferStatus();
        $transferStatus->name = 'выполнен';
        $transferStatus->slug = 'completed';
        $transferStatus->save();

        $transferStatus = new TransferStatus();
        $transferStatus->name = 'отменен';
        $transferStatus->slug = 'cancelled';
        $transferStatus->save();



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_statuses');
    }
};
