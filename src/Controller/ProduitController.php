<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use App\Repository\ProduitRepository;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produits", name="produits")
     */
    public function show(ProduitRepository $repository)
    {
        // $produit = new Produit();
        // $produit->getId()
        //         ->getImage()
        //         ->getLibelle()
        //         ->getPrix()
        //         ->getPropriete()
        //         ;      
        $produits= $repository->findAll();

        return $this->render('produit/show.html.twig', [
            'produits' => $produits,
        ]);
    }

    
  


}
