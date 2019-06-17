<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Entity\Souscategory;
use App\Form\SouscategorieType;
use App\Repository\CategorieRepository;
use App\Repository\SouscategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCategorieController extends AbstractController
{
     
    /** 
    * @var CategorieRepository
    */
    private $repository;
      /** 
    * @var SouscategorieRepository
    */
    private $repository2;

    public function __construct(CategorieRepository $repository , SouscategoryRepository $repository2)
    {
        $this->repository = $repository;
        $this->repository2 = $repository2;


    }





    /**
     * @Route("/admin/Categories", name="admin.Categories")
     */
    public function showAllCategorie(PaginatorInterface $paginator , Request $request)
    {
        // $search = new RechercheCategorie();
        // $form =  $this->createForm(RechercheCategorieType::class,$search);
        // $form->handleRequest($request);$search
        
        $Categories= $paginator->paginate( 
            $this->repository->findAll(),
            $request->query->getInt('page',1),
            10
            );

        $Souscategories= $paginator->paginate( 
            $this->repository2->findAll(),
            $request->query->getInt('page',1),
            10
            );
            
        
       

        return $this->render('admin/categories/show.html.twig', [
            'Categories' => $Categories,
            'Souscategories'=>$Souscategories
        ]);
        
    }

    
    
    
    /**
     * @Route("/admin/categorie/add", name="admin.Categories.add")
     */
    public function addCategorie(Request $request,ObjectManager $manager)
    {
        $Categorie = new Categorie();

        $form=$this->createForm(CategorieType::class,$Categorie);
        $form->handlerequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($Categorie);
            $manager->flush();
            return $this->redirectToRoute('admin.Souscategories.add');
        }
        
        return $this->render('admin/categories/add.html.twig',[ 
            'formCategories' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/souscategorie/add", name="admin.Souscategories.add")
     */
    public function addSouscategorie(Request $request,ObjectManager $manager)
    {
        $Souscategorie = new Souscategory();

        $form=$this->createForm(SouscategorieType::class,$Souscategorie);
        $form->handlerequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($Souscategorie);
            $manager->flush();
            return $this->redirectToRoute('admin.Categories');
        }
        
        return $this->render('admin/souscategories/add.html.twig',[ 
            'formSouscategorie' => $form->createView()
        ]);

    }

     /**

     * @Route("/admin/categorie/{id}/delete", name="admin.Categories.delete")

     */
    public function deleteCategorie(Categorie $Categorie, ObjectManager $manager )

    {

        //dump("suppression");

        $manager->remove($Categorie);

        $manager->flush();

        $this->addFlash('success',"la categorie a été bien supprimmé  !");

        //return new Response("Suppression");

        return $this->redirectToRoute('admin.Categories');

    }

    /**

     * @Route("/admin/souscategorie/{id}/delete", name="admin.Souscategories.delete")

     */
    public function deleteSouscategorie(Souscategory $Souscategorie, ObjectManager $manager )

    {

        //dump("suppression");

        $manager->remove($Souscategorie);

        $manager->flush();

        $this->addFlash('success',"la sous-categorie a été bien supprimmé  !");

        //return new Response("Suppression");

        return $this->redirectToRoute('admin.Categories');

    }
    
    
    /**
   * @Route("/admin/categorie/{id<\d+>}/edit", name="admin.Categories.edit")
   */
  public function editCategorie(Categorie $Categorie, Request $request, ObjectManager $manager)
  {
    if (!$Categorie) {
       $Categorie = new Categorie();
    }
    $form = $this->createForm(CategorieType::class, $Categorie);
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
        //$manager->persist($Categorie);
      $manager->flush();
      $this->addFlash('success',"bien modifiÃ© !");
      return $this->redirectToRoute('admin.Categories');//, ['id' => $Categorie->getId()]);
    }
    return $this->render('admin/categories/edit.html.twig', [
    'formCategorie' => $form->createView()



    ]);
}

    
    
    
    
    /**
   * @Route("/admin/souscategorie/{id<\d+>}/edit", name="admin.Souscategories.edit")
   */
  public function editSouscategorie(Souscategory $Souscategorie, Request $request, ObjectManager $manager)
  {
    if (!$Souscategorie) {
       $Souscategorie = new Souscategory();
    }
    $form = $this->createForm(SouscategorieType::class, $Souscategorie);
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
        //$manager->persist($Categorie);
      $manager->flush();
      $this->addFlash('success',"bien modifiÃ© !");
      return $this->redirectToRoute('admin.Categories');//, ['id' => $Categorie->getId()]);
    }
    return $this->render('admin/souscategories/edit.html.twig', [
    'formSouscategorie' => $form->createView()



    ]);
}

 
}
