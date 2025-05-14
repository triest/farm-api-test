<?php

namespace App\Http\Controllers\V1;

use App\DTO\AnimalColorDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Animal\UpdateAnimalColorRequest;
use App\Http\Requests\AnimalColor\StoreAnimalColorRequest;
use App\Http\Resources\Animal\AnimalColorResource\AnimalColorResource;
use App\Models\Animal\AnimalColor;
use App\Service\Animals\AnimalColorService;

class AnimalColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animalTransfers = AnimalColorService::index();

        return AnimalColorResource::collection($animalTransfers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimalColorRequest $request)
    {
        $animalTransfer = AnimalColorService::store(new AnimalColorDTO(...$request->validated()));

        return AnimalColorResource::make($animalTransfer);
    }

    /**
     * Display the specified resource.
     */
    public function show(AnimalColor $color)
    {
        $animalColor = AnimalColorService::get($color);

        return AnimalColorResource::make($animalColor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnimalColorRequest $request, AnimalColor $color)
    {
        $animalColor = AnimalColorService::update($color, new AnimalColorDTO(...$request->validated()));

        return AnimalColorResource::make($animalColor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnimalColor $color)
    {
        $result = AnimalColorService::destroy($color);

        return response()->json(['result' => $result]);
    }
}
