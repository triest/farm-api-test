<?php

namespace App\DTO;

class AnimalObjectDTO
{
    public function __construct(
        public ?string $name,
        public ?int $owner_id=null,
    ) {}

}
