<?php

namespace App\Repository;

use App\Entity\Produit;
use App\Entity\Recherche\RechercheProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    
    public function findProduit(RechercheProduit $search)
    {
        $query = $this->createQueryBuilder('p')
        ;
        if($search -> getTitre())
        {
            $titre= $search->getTitre();
            $query = $query
                        ->andWhere('p.libelle LIKE :titre')
                        ->setParameter('titre','%'.$titre.'%')
                    ;
        }
    
        return $query->getQuery();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    // /**
    //  * @return Produit[] Returns an array of Produit objects
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
    public function findOneBySomeField($value): ?Produit
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
