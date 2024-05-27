<?php

namespace App\Form;

use App\Entity\ScrappedData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublishJobsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hash')
            ->add('title')
            ->add('type')
            ->add('location')
            ->add('description')
            ->add('startDate')
            ->add('endDate')
            ->add('departement')
            ->add('numberPosition')
            ->add('file')
            ->add('publishedAt')
            ->add('tags')
            ->add('level')
            ->add('image')
            ->add('url')
            ->add('platform')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('isPublished')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ScrappedData::class,
        ]);
    }
}
