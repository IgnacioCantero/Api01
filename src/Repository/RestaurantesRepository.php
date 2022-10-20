<?php

namespace App\Repository;

use App\Entity\Restaurantes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Restaurantes>
 *
 * @method Restaurantes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurantes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurantes[]    findAll()
 * @method Restaurantes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Restaurantes::class);
    }

    public function add(Restaurantes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Restaurantes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByDiaHoraMunicipio($dia, $hora, $municipio) {
        //Creamos la query y le añadimos un alias que hace referencia al objeto que va a devolver (Restaurantes)
        return$this->createQueryBuilder('restaurantes')
            ->join('restaurantes.horarios', 'horarios')
            ->join('restaurantes.municipio', 'municipio')
            ->where('municipio.id = :municipio')
            ->andWhere('horarios.dia = :dia')
            ->andWhere('horarios.apertura <= :hora')
            ->andWhere('horarios.cierre >= :hora')
            ->setParameters(new ArrayCollection(
                [
                    new Parameter('municipio', $municipio),
                    new Parameter('dia', $dia),
                    new Parameter('hora', $hora)
                ]
            ))
            ->orderBy('restaurantes.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Restaurantes[] Returns an array of Restaurantes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Restaurantes
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
