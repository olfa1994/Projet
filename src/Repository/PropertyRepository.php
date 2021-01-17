<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }
    /**
     * Undocumented function
     *
     * @return Query
     */


    public function findAllVisibleQuery(): Query
    {
        return $this->findVisibleQuery()
            ->getQuery();

    }
     /**
     * Undocumented function
     *
     * @return Property[]
     */
   

    public function findLatest($num):array
    {
        return $this->findVisibleQuery('p')
            ->Where('p.sold = false')
            ->setMaxResults($num)
            ->orderBy('p.created_at', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findLatestventes($num):array
    {
        return $this->findVisibleQuery('p')
            ->Where('p.sold = false','p.location = false')
            ->setMaxResults($num)
            ->orderBy('p.created_at', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findLatestlocation($num):array
    {
        return $this->findVisibleQuery('p')
            ->Where('p.sold = false','p.location = true')
            ->setMaxResults($num)
            ->orderBy('p.created_at', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    private function findVisibleQuery():QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->Where('p.sold = false');
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
