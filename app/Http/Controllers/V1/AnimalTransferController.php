<?php

namespace App\Http\Controllers\V1;

use App\DTO\AnimalTransferDTO;
use App\Http\Controllers\Controller;

use App\Http\Requests\AnimalTransfer\StoreAnimalTransferRequest;
use App\Http\Requests\AnimalTransfer\UpdateAnimalTransferRequest;
use App\Http\Resources\Animal\AnimalTransfer\AnimalTransferResource;
use App\Models\TransferDocument;
use App\Service\Animals\AnimalTransferService;

class AnimalTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animalTransfers = AnimalTransferService::index();

        return AnimalTransferResource::collection($animalTransfers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimalTransferRequest $request)
    {
        $animalTransfer = AnimalTransferService::store(new AnimalTransferDTO(...$request->validated()));

        return AnimalTransferResource::make($animalTransfer);
    }

    /**
     * Display the specified resource.
     */
    public function show(TransferDocument $transfer)
    {
        $animalTransfers = AnimalTransferService::get($transfer);

        return AnimalTransferResource::make($animalTransfers);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnimalTransferRequest $request, TransferDocument $transfer)
    {
        $animalTransfer = AnimalTransferService::update($transfer, new AnimalTransferDTO(...$request->validated()));

        return AnimalTransferResource::make($animalTransfer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransferDocument $transfer)
    {
        $result = AnimalTransferService::destroy($transfer);

        return response()->json(['result' => $result]);
    }
}
