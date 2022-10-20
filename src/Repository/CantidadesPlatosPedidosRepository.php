<?php

namespace App\Repository;

use App\Entity\CantidadesPlatosPedidos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CantidadesPlatosPedidos>
 *
 * @method CantidadesPlatosPedidos|null find($id, $lockMode = null, $lockVersion = null)
 * @method CantidadesPlatosPedidos|null findOneBy(array $criteria, array $orderBy = null)
 * @method CantidadesPlatosPedidos[]    findAll()
 * @method CantidadesPlatosPedidos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CantidadesPlatosPedidosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CantidadesPlatosPedidos::class);
    }

    public function add(CantidadesPlatosPedidos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CantidadesPlatosPedidos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CantidadesPlatosPedidos[] Returns an array of CantidadesPlatosPedidos objects
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

//    public function findOneBySomeField($value): ?CantidadesPlatosPedidos
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
