<?php

namespace App\Service\Animals;

use App\DTO\AnimalObjectDTO;
use App\DTO\AnimalTransferDTO;
use App\Models\Animal\AnimalObject;
use App\Models\Animal\AnimalOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimalObjectService
{

    public static function index(Request $request = null)
    {
        $animalTransfers = AnimalObject::query()->paginate();

        return $animalTransfers;
    }

    public static function get(AnimalObject $animalObject): AnimalObject
    {
        return $animalObject;
    }

    public static function store(AnimalObjectDTO $animalTransferDTO)
    {
        DB::beginTransaction();

        $animalObject = new AnimalObject();

        $animalObject->name = $animalTransferDTO->name;

        $animalOwner = AnimalOwner::query()->where('id', $animalTransferDTO->owner_id)->firstOrFail();

        $animalObject->owner()->associate($animalOwner);

        $animalObject->save();

        DB::commit();

        return $animalObject;
    }

    public static function update(AnimalObject $animalObject, AnimalObjectDTO $animalTransferDTO)
    {
        DB::beginTransaction();

        $animalObject->name = $animalTransferDTO->name;

        $animalOwner = AnimalOwner::query()->where('id', $animalTransferDTO->owner_id)->firstOrFail();

        $animalObject->owner()->associate($animalOwner);

        $animalObject->save();

        DB::commit();

        return $animalObject;
    }

    public static function destroy(AnimalObject $animalObject)
    {
        DB::beginTransaction();

        $result = $animalObject->delete();

        DB::commit();

        return $result;
    }
}
