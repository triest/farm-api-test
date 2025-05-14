<?php

namespace App\Http\Controllers\V1;

use App\DTO\AnimalTransferDTO;
use App\Http\Controllers\Controller;

use App\Http\Requests\AnimalTransfer\StoreAnimalTransferRequest;
use App\Http\Requests\AnimalTransfer\UpdateAnimalTransferRequest;
use App\Http\Resources\Animal\AnimalTransfer\AnimalTransferResource;
use App\Models\TransferDocument;
use App\Service\Animals\AnimalTransferService;

class AnimalTransferStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animalTransfers = AnimalTransferService::statusList();

        return response()->json($animalTransfers);
    }


}
