<?php

namespace App\Repository;

use App\Entity\Imagen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Imagen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Imagen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Imagen[]    findAll()
 * @method Imagen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Imagen::class);
    }

    // /**
    //  * @return Imagen[] Returns an array of Imagen objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Imagen
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function ListImagenes($idproducto):array{       
        $tbl = "i";
        $qb = $this->createQueryBuilder($tbl)            
                    ->where("$tbl.idproducto = $idproducto");
                    //->OrderBy("$tbl.fechacreacion", "DESC");                    
        $query = $qb->getQuery();        

        return $query->execute(); 
    }

    public function Guardar(Imagen $imagen):Imagen {           
        $em = $this->getEntityManager();
        $em->persist($imagen);
        $em->flush();
        
        return $imagen;
    }

    public function Borrar(Imagen $imagen):Imagen {
        $em = $this->getEntityManager();
        $em->remove($imagen);
        $em->flush();
        return $imagen;
    }
}