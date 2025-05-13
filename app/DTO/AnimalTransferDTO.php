<?php

namespace App\DTO;

class AnimalTransferDTO
{
    public function __construct(
        public ?int $animal_id = null,
        public ?int $dispatch_object_id = null,
        public ?int $destination_object_id = null,
        public ?int $status_id = null,
    ) {}

}
