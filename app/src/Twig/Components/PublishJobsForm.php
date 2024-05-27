<?php

namespace App\Twig\Components;
use App\Entity\ScrappedData;
use Carbon\CarbonImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;


#[AsLiveComponent('publish_jobs_form')]
final class PublishJobsForm extends AbstractController
{
    use DefaultActionTrait;
    use ValidatableComponentTrait;


    #[LiveProp(
        writable: [
            'title', 'type', 'location', 'description',
            'startDate', 'endDate', 'departement',
            'numberPosition', 'file', 'publishedAt',
            'tags', 'level', 'image'
        ])
    ]
    #[Assert\Valid]
    public ScrappedData $job;


    public bool $isSaved = false;

    #[LiveAction]
    public function save(EntityManagerInterface $entityManager)
    {
        $this->validate();
        $this->isSaved = true;
        $entityManager->flush();
    }

    #[LiveAction]
    public function publish(EntityManagerInterface $entityManager)
    {
        $this->job->setPublished(true);
        $this->validate();
        $entityManager->flush();
        $this->addFlash('success', 'Offre publiée !');
        return $this->redirectToRoute('app_admin_jobs_publish');
    }
}