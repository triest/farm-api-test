<?php

namespace App\Service\Animals;

use App\DTO\AnimalOwnerDTO;
use App\Models\Animal\AnimalOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimalOwnerService
{

    public static function index(Request $request = null)
    {
        $animalTransfers = AnimalOwner::query()->paginate();

        return $animalTransfers;
    }

    public static function get(AnimalOwner $animalOwner): AnimalOwner
    {
        return $animalOwner;
    }

    public static function store(AnimalOwnerDTO $animalOwnerDTO)
    {
        $animalOwner = new AnimalOwner();

        $animalOwner->first_name   = $animalOwnerDTO->first_name;

        $animalOwner->last_name   = $animalOwnerDTO->last_name;

        $animalOwner->save();

        return $animalOwner;
    }

    public static function update(AnimalOwner $animalOwner, AnimalOwnerDTO $animalOwnerDTO)
    {
        $animalOwner->first_name   = $animalOwnerDTO->first_name;

        $animalOwner->last_name   = $animalOwnerDTO->last_name;

        $animalOwner->save();

        return $animalOwner;
    }

    public static function destroy(AnimalOwner $animalOwner)
    {
        $result = $animalOwner->delete();

        return $result;
    }
}
