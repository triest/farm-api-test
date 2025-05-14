<?php

namespace App\Http\Controllers\V1;

use App\DTO\AnimalOwnerDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnimalOwnerObject\StoreAnimalObjectRequest;
use App\Http\Requests\AnimalOwnerObject\StoreAnimalOwnerRequest;
use App\Http\Requests\AnimalOwnerObject\UpdateAnimalOwnerRequest;
use App\Http\Resources\Animal\AnimalOwner\AnimalOwnerResource;
use App\Models\Animal\AnimalOwner;
use App\Service\Animals\AnimalOwnerService;

class AnimalOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animalTransfers = AnimalOwnerService::index();

        return AnimalOwnerResource::collection($animalTransfers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimalOwnerRequest $request)
    {
        $animalTransfer = AnimalOwnerService::store(new AnimalOwnerDTO(...$request->validated()));

        return AnimalOwnerResource::make($animalTransfer);
    }

    /**
     * Display the specified resource.
     */
    public function show(AnimalOwner $owner)
    {
        $animalOwner = AnimalOwnerService::get($owner);

        return AnimalOwnerResource::make($animalOwner);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnimalOwnerRequest $request, AnimalOwner $owner)
    {
        $animalTransfer = AnimalOwnerService::update($owner, new AnimalOwnerDTO(...$request->validated()));

        return AnimalOwnerResource::make($animalTransfer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnimalOwner $owner)
    {
        $result = AnimalOwnerService::destroy($owner);

        return response()->json(['result' => $result]);
    }
}
