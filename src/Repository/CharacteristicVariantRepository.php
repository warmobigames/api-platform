<?php

namespace App\Repository;

use App\Entity\characteristicVariant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CharacteristicVariant>
 *
 * @method CharacteristicVariant|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacteristicVariant|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacteristicVariant[]    findAll()
 * @method CharacteristicVariant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacteristicVariantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharacteristicVariant::class);
    }

//    /**
//     * @return characteristicVariant[] Returns an array of characteristicVariant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?characteristicVariant
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
