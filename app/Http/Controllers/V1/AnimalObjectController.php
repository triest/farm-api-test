<?php

namespace App\Http\Controllers\V1;

use App\DTO\AnimalObjectDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnimalObject\StoreAnimalObjectRequest;
use App\Http\Requests\AnimalObject\UpdateAnimalObjectRequest;
use App\Http\Resources\Animal\AnimalObject\AnimalObjectResource;
use App\Models\Animal\AnimalObject;
use App\Service\Animals\AnimalObjectService;

class AnimalObjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animalTransfers = AnimalObjectService::index();

        return AnimalObjectResource::collection($animalTransfers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimalObjectRequest $request)
    {
        $animalTransfer = AnimalObjectService::store(new AnimalObjectDTO(...$request->validated()));

        return AnimalObjectResource::make($animalTransfer);
    }

    /**
     * Display the specified resource.
     */
    public function show(AnimalObject $object)
    {
        $animalTransfers = AnimalObjectService::get($object);

        return AnimalObjectResource::make($animalTransfers);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnimalObjectRequest $request, AnimalObject $object)
    {
        $animalTransfer = AnimalObjectService::update($object, new AnimalObjectDTO(...$request->validated()));

        return AnimalObjectResource::make($animalTransfer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnimalObject $object)
    {
        $result = AnimalObjectService::destroy($object);

        return response()->json(['result' => $result]);
    }
}
