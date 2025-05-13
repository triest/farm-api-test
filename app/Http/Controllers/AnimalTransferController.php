<?php

namespace App\Http\Controllers;

use App\DTO\AnimalDTO;
use App\DTO\AnimalTransferDTO;
use App\Http\Requests\AnimalTransfer\StoreAnimalTransferRequest;
use App\Http\Requests\AnimalTransfer\UpdateAnimalTransferRequest;
use App\Models\TransferDocument;
use App\Service\Animals\AnimalService;
use App\Service\Animals\AnimalTransferService;
use Illuminate\Http\Request;

class AnimalTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimalTransferRequest $request)
    {
        $animal = AnimalTransferService::store(new AnimalTransferDTO(...$request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnimalTransferRequest $request, TransferDocument $transfer)
    {

        $animalTransfer = AnimalTransferService::update($transfer,new AnimalTransferDTO(...$request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
