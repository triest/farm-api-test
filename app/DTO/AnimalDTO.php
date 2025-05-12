<?php

namespace App\DTO;

class AnimalDTO
{
    public function __construct(
        public ?string $number,
        public ?int $gender_id = null,
        public ?int $animal_species_id=null,
        public ?int $animal_color_id=null,
        public ?int $animal_object_id=null,
        public ?int $animal_owner_id=null,
    ) {}

}
