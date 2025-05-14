<?php

namespace App\DTO;

class AnimalOwnerDTO
{
    public function __construct(
        public ?string $first_name=null,
        public ?string $last_name=null
    ) {}

}
