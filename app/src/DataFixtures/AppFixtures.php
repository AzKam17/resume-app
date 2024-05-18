<?php

namespace App\DataFixtures;

use App\Entity\ScrappedData;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements FixtureGroupInterface
{
    public function __construct(
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $sc = new ScrappedData();
        $sc
            ->setHash('az')
            ->setTitle('az')
            ->setType('az')
            ->setLocation('az')
            ->setDescription('az')
            ->setStartDate('az')
            ->setEndDate('az')
            ->setDepartement('az')
            ->setNumberPosition('az')
            ->setFile('az')
            ->setPublished('az')
            ->setTags('az')
            ->setLevel('az')
            ->setUrl('az')
            ->setPlatform('az')
        ;

        $manager->persist($sc);
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['test-fixtures'];
    }
}
