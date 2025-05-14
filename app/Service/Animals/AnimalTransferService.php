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
        $animalTransfers = TransferDocument::query()->with('dispatchObject','destinationObject','transferObject','status','dispatchObject')->paginate();

        return $animalTransfers;
    }

    public static function get(TransferDocument $transferDocument): TransferDocument
    {
        $transferDocument->load('dispatchObject','destinationObject','transferObject','status');
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



        $transferDocument->load('dispatchObject','destinationObject','transferObject','status');

        return $transferDocument;
    }

    public static function update(TransferDocument $transferDocument, AnimalTransferDTO $animalTransferDTO)
    {
        DB::beginTransaction();

        if ($transferDocument?->status?->slug === TransferStatus::STATUS_COMPLETED) {
            throw new \Exception("Document already completed");
        }


        $transferStatus = TransferStatus::query()->where('id', $animalTransferDTO->status_id)->first();

        if (!$transferStatus) {
            throw new \Exception("Status not found");
        }


        if ($transferDocument->status->slug === TransferStatus::STATUS_IN_WORK && $transferStatus->slug === TransferStatus::STATUS_COMPLETED) {
            //перемещение состоялось, смена владельца

            $animal = $transferDocument->transferObject;

            $distinctionObject = $transferDocument->dispatchObject;

            $animal->animalObject()->associate($distinctionObject);
            $newOwner = $distinctionObject->owner;

            if ($animal->animal_owner_id != $newOwner->id) {
                $animal->animalOwner()->associate($newOwner);
            }

            $transferDocument->status()->associate($transferStatus);

            $transferDocument->save();
            $animal->save();
        } else {

            $animal = Animal::query()->where('id', $animalTransferDTO->animal_id)->first();

            $dispatchObject = AnimalObject::query()->where('id', $animalTransferDTO->dispatch_object_id)->first();

            if (!$dispatchObject) {
                throw new \Exception("dispatch Object not found");
            }


            $distinationObject = AnimalObject::query()->where('id', $animalTransferDTO->destination_object_id)->first();

            if (!$distinationObject) {
                throw new \Exception("distinction Object not found");
            }

            $transferDocument->dispatchObject()->associate($dispatchObject);

            $transferDocument->destinationObject()->associate($distinationObject);

            $transferDocument->transferObject()->associate($animal);

            $transferDocument->date = Carbon::now()->toDateTimeString();

            $transferDocument->status()->associate(TransferStatus::query()->where('slug', 'new')->firstOrFail());

            $transferDocument->save();
        }

        DB::commit();

        $transferDocument->load('dispatchObject','destinationObject','transferObject','status');

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
