<?php

namespace App\Controller\Admin;

use App\Form\ProduitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Annotations\AnnotationRegistry; 
use phpDocumentor\Reflection\DockBLock\Description;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

 /**
 * Require ROLE_ADMIN for *every* controller method in this class.  *
 * @IsGranted("ROLE_ADMIN")
  */

class AdminController extends AbstractController
{
    
      /**
     * @Route("/admin", name="admin")
     */
    public function adminIndex(ProduitRepository $repository)
    {

        return $this->render('admin/index.html.twig');
        
    }
    
    
    
    
    /**
     * @Route("/admin/produits", name="admin.produits")
     */
    public function showAllProduit(ProduitRepository $repository)
    {
        $produits= $repository->findAll();

        return $this->render('admin/produits/show.html.twig', [
            'produits' => $produits,
        ]);
        
    }

    
    
    
    /**
     * @Route("/admin/add", name="admin.produits.add")
     */
    public function addProduit(Request $request,ObjectManager $manager)
    {
        $produit = new Produit();

        $form=$this->createForm(ProduitType::class,$produit);
        $form->handlerequest($request);
        dump($produit);
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

        $this->addFlash('success',"bien supprimé !");

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
      $this->addFlash('success',"bien modifiÃ© !");
      return $this->redirectToRoute('admin.produits');//, ['id' => $produit->getId()]);
    }
    return $this->render('admin/produits/edit.html.twig', [
    'formProduit' => $form->createView()



    ]);



  }






}
