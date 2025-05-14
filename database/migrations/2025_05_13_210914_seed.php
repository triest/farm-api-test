<?php

use App\Models\Animal\AnimalColor;
use App\Models\Animal\AnimalGender;
use App\Models\Animal\AnimalSpecies;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::beginTransaction();

        $arraySpecies = ['овцы', 'козы'];

        $array = [];
        foreach ($arraySpecies as $value) {
            $array[] = [
                'name' => $value,
                'created_at' => now(),
                'updated_at' => now()
                ];
        }

        AnimalSpecies::insert($array);

        $arrayGender = ['самка', 'самец'];

        $array = [];
        foreach ($arrayGender as $value) {
            $array[] = [
                'name' => $value,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        AnimalGender::insert($array);

        $arrayColor = ['белая', 'серая'];

        $array = [];
        foreach ($arrayColor as $value) {
            $array[] = [
                'name' => $value,
                'created_at' => now(),
                'updated_at' => now()
            ];
        };

        AnimalColor::insert($array);

        DB::commit();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
