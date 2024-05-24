<?php

namespace App\Dto\ScrappedData;

class CheckSCExistenceDto
{
    public function __construct(
        // Lien vers l'offre
        public readonly string $url
    )
    {
    }
}