<?php

namespace App\Twig\Components;

use App\Entity\ScrappedData;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('job_display')]
class JobDisplay
{
    public ScrappedData $job;
}