<?php

namespace App\Http\Controllers\V1;

use App\DTO\AnimalDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Http\Resources\Animal\AnimalResource;
use App\Models\Animal;
use App\Service\Animals\AnimalService;

class AnimalController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animals = AnimalService::getAnimals();

        return AnimalResource::collection($animals);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimalRequest $request)
    {
        $animal = AnimalService::store(new AnimalDTO(...$request->validated()));

        return AnimalResource::make($animal);
    }

    /**
     * Display the specified resource.
     */
    public function show(Animal $animal)
    {
        return AnimalResource::make($animal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnimalRequest $request, Animal $animal)
    {

        $animal = AnimalService::update($animal,new AnimalDTO(...$request->validated()));

        return AnimalResource::make($animal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        return AnimalService::destroy($animal);
    }
}
