<?php

namespace App\Controller;

use App\Entity\ScrappedData;
use App\Form\PublishJobsType;
use App\Repository\ScrappedDataRepository;
use Carbon\CarbonImmutable;
use http\Encoding\Stream\Enbrotli;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[Route('/app/admin/jobs', name: 'app_admin_jobs')]
    public function jobs_index(
        ScrappedDataRepository $repository
    ): Response
    {
        $lastDay = $repository->findByCreatedAtRange(
            CarbonImmutable::yesterday(),
            CarbonImmutable::now()
        );

        $lastJobsYesterdayAndTheDayBefore = $repository->findByCreatedAtRange(
            CarbonImmutable::now()->subDays(2)->startOfDay(),
            CarbonImmutable::now()->subDays(1)->startOfDay()
        );

        $notPublishedJobs =  $repository->findBy([
            'isPublished' => false
        ]);

        $diffInPercentage = $this->getPercentageEvolution(
            count($lastJobsYesterdayAndTheDayBefore),
            count($lastDay)
        );

        $lastFiveJobs = $repository->findBy([], ['id' => 'DESC'], 10, 0);

        return $this->render('admin/jobs/index.html.twig', [
            'title' => 'Jobs - Admin',
            'lastDayCount' => count($lastDay),
            'diffInPercentage' => $diffInPercentage,


            'notPublishedJobsCount' => count($notPublishedJobs),

            'countPerPlatform' => $repository->countItemsPerPlatform(),

            'lastFiveJobs' => $lastFiveJobs
        ]);
    }

    #[Route('/app/admin/jobs/publish', name: 'app_admin_jobs_publish')]
    public function jobs_publish(
        ScrappedDataRepository $repository
    )
    {
        $e = $repository->findOneBy(
            ['isPublished' => false],
            ['id' => 'DESC'],
        );
        if(!$e instanceof ScrappedData){
            // Faire une vue pour plus de jobs a valider
            return new Response("No job to check");
        }

        $form = $this->createForm(PublishJobsType::class, $e);

        return $this->render('admin/jobs/publish.html.twig', [
            'title' => 'Publier des jobs - Admin',

            'job' => $e
        ]);
    }

    function getPercentageEvolution(int $initial, int $final): ?float
    {
        if ($initial === 0) {
            // Handle the case where initial is zero to avoid division by zero
            return $final === 0 ? 0.0 : null; // Return null if initial is zero and final is not, or 0 if both are zero
        }

        $evolution = (($final - $initial) / $initial) * 100;
        return round($evolution, 2); // Round the result to 2 decimal places
    }
}
