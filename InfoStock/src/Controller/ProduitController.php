<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    
    
    /**
     * @var ProduitRepository
     */
    private $repository;

    public function __construct(ProduitRepository $repository)
    {  
        $this->repository = $repository;

    }
    
    
    
    /**
     * @Route("/produits", name="produits")
     */
    public function show(PaginatorInterface $paginator ,Request $request  )
    {
                   
        $produits= $paginator->paginate( 
            $this->repository->findAll(),
            $request->query->getInt('page',1),
            10
            );
        

        return $this->render('produits/show.html.twig', [
            'produits' => $produits,
        ]);
    }

    
  


}
