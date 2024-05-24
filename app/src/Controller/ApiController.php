<?php

namespace App\Controller;

use App\Dto\ScrappedData\ScrappedDataInsertDto;
use App\Entity\ScrappedData;
use App\Repository\ScrappedDataRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{
    #[Route('/api/jobs', name: 'app_api')]
    public function index(
        #[MapRequestPayload] ScrappedDataInsertDto $dto,
        EntityManagerInterface $manager,
        ScrappedDataRepository $repository
    ): Response
    {
        $sc = (new ScrappedData())
            ->setUrl($dto->url)
            ->setTitle($dto->title)
            ->setHash(hash("sha256", $dto->url))

            ->setType($dto->type)
            ->setLocation($dto->location)

            ->setStartDate($dto->start_date)
            ->setEndDate($dto->end_date)
            ->setPublishedAt($dto->published_at)

            ->setDescription($dto->description)
            ->setDepartement($dto->departement)
            ->setNumberPosition($dto->number_position)
            ->setFile($dto->file)
            ->setTags($dto->tags)
            ->setLevel($dto->level)
            ->setPlatform($dto->platform)
        ;

        $e = $repository->findOneBy(['hash' => $sc->getHash()]);
        if(!is_null($e)){
            return $this->json([
                'message' => 'Job already inserted',
            ]);
        }

        $manager->persist($sc);
        $manager->flush();

        return $this->json([
            'message' => 'Job inserted',
        ]);
    }
}
