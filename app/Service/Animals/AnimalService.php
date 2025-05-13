<?php

namespace App\Service\Animals;

use App\DTO\AnimalDTO;
use App\Models\Animal\Animal;
use App\Models\Animal\AnimalColor;
use App\Models\Animal\AnimalGender;
use App\Models\Animal\AnimalObject;
use App\Models\Animal\AnimalOwner;
use App\Models\Animal\AnimalSpecies;
use Illuminate\Support\Facades\DB;

class AnimalService
{
    public static function getAnimals()
    {
        return  Animal::query()->paginate();
    }

    public static function store(AnimalDTO $animalDTO){
        DB::beginTransaction();

        $exists = Animal::query()->where('number',$animalDTO->number)->exists();

        if ($exists) {
            throw new \Exception("Animal already exists");
        }

        $newAnimal = new Animal();

        $newAnimal->number = $animalDTO->number;

        $gender = AnimalGender::query()->find($animalDTO->gender_id);

        if(!$gender){
            throw new \Exception('gender not found');
        }

        $newAnimal->animalGender()->associate($gender);

        $AnimalSpecies = AnimalSpecies::query()->find($animalDTO->animal_species_id);

        if(!$AnimalSpecies){
            throw new \Exception('animal species not found');
        }

        $newAnimal->animalSpecies()->associate($AnimalSpecies);

        $animalColor = AnimalColor::query()->find($animalDTO->animal_color_id);

        if(!$animalColor) {
            throw new \Exception('animal color not found');
        }

        $newAnimal->animalColor()->associate($animalColor);

        $animalObject = AnimalObject::query()->find($animalDTO->animal_object_id);

        if(!$animalObject){
            throw new \Exception('animal object not found');
        }

        $newAnimal->animalObject()->associate($animalObject);

        $animalOwner = AnimalOwner::query()->find($animalDTO->animal_owner_id);

        if(!$animalOwner){
            throw new \Exception('animal owner not found');
        }

        $newAnimal->animalOwner()->associate($animalOwner);

        $newAnimal->save();

        DB::commit();

        $newAnimal->refresh();

        return $newAnimal;
    }

    public static function update(Animal $animal,AnimalDTO $animalDTO){
        DB::beginTransaction();

        $numberExist = Animal::query()->where('id','!=',$animal->id)->where('number',$animalDTO->number)->exists();
        if($numberExist){
            throw new \Exception("Animal already exists");
        }

        $animal->number = $animalDTO->number;

        $gender = AnimalGender::query()->find($animalDTO->gender_id);

        if(!$gender){
            throw new \Exception('gender not found');
        }

        $animal->animalGender()->associate($gender);

        $AnimalSpecies = AnimalSpecies::query()->find($animalDTO->animal_species_id);

        if(!$AnimalSpecies){
            throw new \Exception('animal species not found');
        }

        $animal->animalSpecies()->associate($AnimalSpecies);

        $animalColor = AnimalColor::query()->find($animalDTO->animal_color_id);

        if(!$animalColor) {
            throw new \Exception('animal color not found');
        }

        $animal->animalColor()->associate($animalColor);

        $animalObject = AnimalObject::query()->find($animalDTO->animal_object_id);

        if(!$animalObject){
            throw new \Exception('animal object not found');
        }

        $animal->animalObject()->associate($animalObject);

        $animalOwner = AnimalOwner::query()->find($animalDTO->animal_owner_id);

        if(!$animalOwner){
            throw new \Exception('animal owner not found');
        }

        $animal->animalOwner()->associate($animalOwner);

        $animal->save();

        DB::commit();

        $animal->refresh();

        return $animal;
    }

    public static function destroy(Animal $animal){

       return $animal->delete();
    }
}
