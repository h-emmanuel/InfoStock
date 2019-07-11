<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Form\Produit\ProduitType;
use App\Repository\ProduitRepository;
use App\Entity\Recherche\RechercheProduit;
use App\Form\Produit\RechercheProduitType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use phpDocumentor\Reflection\DockBLock\Description;
use Doctrine\Common\Annotations\AnnotationRegistry; 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

 /**
 * Require ROLE_ADMIN for *every* controller method in this class.  *
 * @IsGranted("ROLE_ADMIN")
  */

class AdminProduitController extends AbstractController
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
     * @Route("/admin/produits", name="admin.produits")
     */
    public function showAllProduit(PaginatorInterface $paginator , Request $request)
    {
        $search = new RechercheProduit();
        $form =  $this->createForm(RechercheProduitType::class,$search);
        $form->handleRequest($request);
        
        $produits= $paginator->paginate( 
            $this->repository->findProduit($search),
            $request->query->getInt('page',1),
            10
            );
        
       

        return $this->render('admin/produits/show.html.twig', [
            'produits' => $produits,
            'formSearch'=> $form->createView()
        ]);
        
    }

    
    
    
    /**
     * @Route("/admin/add/produit", name="admin.produits.add")
     */
    public function addProduit(Request $request,ObjectManager $manager)
    {
        $produit = new Produit();

        $form=$this->createForm(ProduitType::class,$produit);
        $form->handlerequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($produit);
            $manager->flush();
            return $this->redirectToRoute('admin.produits');
        }
        
        return $this->render('admin/produits/add.html.twig',[ 
            'formProduit' => $form->createView()
        ]);

    }

     /**

     * @Route("/admin/produit/{id}/delete", name="admin.produits.delete")

     */
    public function deleteProduit(Produit $produit, ObjectManager $manager )

    {

        //dump("suppression");

        $manager->remove($produit);

        $manager->flush();

        $this->addFlash('success',"bien supprim� !");

        //return new Response("Suppression");

        return $this->redirectToRoute('admin.produits');

    }


    
    
    
    
    /**
   * @Route("/admin/produit/{id<\d+>}/edit", name="admin.produits.edit")
   */
  public function editProduit(Produit $produit, Request $request, ObjectManager $manager)
  {
    if (!$produit) {
       $produit = new Produit();
    }
    $form = $this->createForm(ProduitType::class, $produit);
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
        //$manager->persist($produit);
      $manager->flush();
      $this->addFlash('success',"bien modifié !");
      return $this->redirectToRoute('admin.produits');//, ['id' => $produit->getId()]);
    }
    return $this->render('admin/produits/edit.html.twig', [
    'formProduit' => $form->createView()



    ]);



  }






}
