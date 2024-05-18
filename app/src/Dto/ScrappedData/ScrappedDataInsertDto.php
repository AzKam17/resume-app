<?php

namespace App\Dto\ScrappedData;

use Symfony\Component\Validator\Constraints as Assert;

class ScrappedDataInsertDto
{
    public function __construct(
        // Titre de l'offre
        #[Assert\NotBlank]
        public readonly string $title,

        // Type de l'offre
        #[Assert\NotBlank]
        public readonly string $type,

        // Lieu de travail
        public readonly string $location,
        // Date de debut de l'offre
        public readonly string $start_date,
        // Date de fin l'offre
        public readonly string $end_date,
        // Departement de l'offre
        public readonly string $departement,
        // Nombre de postes à pourvoir
        public readonly string $number_position,
        // Fichier joint
        public readonly string $file,
        // Poste sur le site le
        public readonly string $published_at,
        // Tags lies a l'offre
        public readonly string $tags,
        // Niveau scolaire requis
        public readonly string $level,
        // Lien vers l'offre
        public readonly string $url,
        // Platforme de l'offre
        public readonly string $platform,
        // Description de l'offre
        public readonly string $description,
    )
    {
    }
}