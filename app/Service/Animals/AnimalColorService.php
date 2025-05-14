<?php

namespace App\Service\Animals;

use App\DTO\AnimalColorDTO;
use App\Models\Animal\AnimalColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimalColorService
{

    public static function index(Request $request = null)
    {
        $animalTransfers = AnimalColor::query()->paginate();

        return $animalTransfers;
    }

    public static function get(AnimalColor $animalColor): AnimalColor
    {
        return $animalColor;
    }

    public static function store(AnimalColorDTO $animalColorDTO)
    {
        DB::beginTransaction();

        $animalObject = new AnimalColor();

        $animalObject->name = $animalColorDTO->name;

        $animalObject->save();

        DB::commit();

        return $animalObject;
    }

    public static function update(AnimalColor $animalColor, AnimalColorDTO $animalTransferDTO)
    {
        DB::beginTransaction();

        $animalColor->name = $animalTransferDTO->name;

        $animalColor->save();

        DB::commit();

        return $animalColor;
    }

    public static function destroy(AnimalColor $animalObject)
    {
        DB::beginTransaction();

        $result = $animalObject->delete();

        DB::commit();

        return $result;
    }
}
