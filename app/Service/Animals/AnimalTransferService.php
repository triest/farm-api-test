<?php

namespace App\Service\Animals;

use App\DTO\AnimalTransferDTO;
use App\Models\Animal\Animal;
use App\Models\Animal\AnimalObject;
use App\Models\TransferDocument;
use App\Models\TransferStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimalTransferService
{

    public static function index(Request $request = null)
    {
        $animalTransfers = TransferDocument::query()->with('dispatchObject', 'destinationObject', 'transferObject', 'status', 'dispatchObject')->paginate();

        return $animalTransfers;
    }

    public static function get(TransferDocument $transferDocument): TransferDocument
    {
        $transferDocument->load('dispatchObject', 'destinationObject', 'transferObject', 'status');
        return $transferDocument;
    }

    public static function store(AnimalTransferDTO $animalTransferDTO)
    {
        DB::beginTransaction();

        $animal = Animal::query()->where('id', $animalTransferDTO->animal_id)->first();

        if (!$animal) {
            throw new \Exception("Animal not found");
        }

        $dispatchObject = AnimalObject::query()->where('id', $animalTransferDTO->dispatch_object_id)->first();

        if (!$dispatchObject) {
            throw new \Exception("dispatchObject not found");
        }


        $distinationObject = AnimalObject::query()->where('id', $animalTransferDTO->destination_object_id)->first();

        if (!$distinationObject) {
            throw new \Exception("distination Object already exists");
        }


        $transferDocument = new TransferDocument();

        $transferDocument->dispatchObject()->associate($dispatchObject);

        $transferDocument->destinationObject()->associate($distinationObject);

        $transferDocument->transferObject()->associate($animal);

        $transferDocument->status()->associate(TransferStatus::query()->where('slug', 'new')->firstOrFail());

        $transferDocument->date = Carbon::now()->toDateTimeString();

        $transferDocument->save();


        DB::commit();


        $transferDocument->load('dispatchObject', 'destinationObject', 'transferObject', 'status');

        return $transferDocument;
    }

    public static function update(TransferDocument $transferDocument, AnimalTransferDTO $animalTransferDTO)
    {
        DB::beginTransaction();

        $transferDocument->load('dispatchObject', 'destinationObject', 'transferObject', 'status');

        if ($transferDocument?->status?->slug === TransferStatus::STATUS_COMPLETED) {
            throw new \Exception("Document already completed");
        }


        $transferStatus = TransferStatus::query()->where('id', $animalTransferDTO->status_id)->first();

        if (!$transferStatus) {
            throw new \Exception("Status not found");
        }
        $oldStatus = $transferDocument->status;

        if ($animalTransferDTO->animal_id) {
            $animal = Animal::query()->where('id', $animalTransferDTO->animal_id)->first();
        } else {
            $animal = $transferDocument->transferObject;
        }

        if (!$animal) {
            throw new \Exception("Animal not found");
        }

        if ($animalTransferDTO->destination_object_id) {
            $dispatchObject = AnimalObject::query()->where('id', $animalTransferDTO->dispatch_object_id)->first();
        } else {
            $dispatchObject = $transferDocument->dispatchObject;
        }

        if (!$dispatchObject) {
            throw new \Exception("dispatch Object not found");
        }

        if ($animalTransferDTO->destination_object_id) {
            $destinationObject = AnimalObject::query()->where('id', $animalTransferDTO->destination_object_id)->first();
        } else {
            $destinationObject = $transferDocument->destinationObject;
        }

        if (!$destinationObject) {
            throw new \Exception("distinction Object not found");
        }

        $transferDocument->dispatchObject()->associate($dispatchObject);

        $transferDocument->destinationObject()->associate($destinationObject);

        $transferDocument->transferObject()->associate($animal);

        $transferDocument->date = Carbon::now()->toDateTimeString();

        $transferDocument->status()->associate($transferStatus);

        $transferDocument->save();

        if ($oldStatus->id !== $transferStatus->id && $transferStatus->slug === TransferStatus::STATUS_COMPLETED) {
            $transferDocument->changeOwner();
        }


        DB::commit();

        return $transferDocument;
    }

    public static function destroy(TransferDocument $transferDocument)
    {
        DB::beginTransaction();
        $result = $transferDocument->delete();
        DB::commit();
        return $result;
    }
}
