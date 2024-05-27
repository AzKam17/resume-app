<?php

namespace App\Repository;

use App\Entity\ScrappedData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ScrappedData>
 */
class ScrappedDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ScrappedData::class);
    }

    public function findByCreatedAtRange($startDate, $endDate) {
        $qb = $this->createQueryBuilder('e');

        $qb->where($qb->expr()->between(
            'e.createdAt',
            ':startDate',
            ':endDate'
        ))
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate);

        return $qb->getQuery()->getResult();
    }

    public function countItemsPerPlatform(): array
    {
        return $this->createQueryBuilder('s')
            ->select('s.platform, COUNT(s.id) as item_count, MAX(s.createdAt) as last_created_at')
            ->groupBy('s.platform')
            ->orderBy('item_count', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return ScrappedData[] Returns an array of ScrappedData objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ScrappedData
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
