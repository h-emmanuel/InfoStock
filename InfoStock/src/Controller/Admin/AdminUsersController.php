<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\Produit\ProduitType;
use App\Repository\UserRepository;
use App\Repository\ProduitRepository;
use App\Entity\Recherche\RechercheUtilisateur;
use App\Form\RechercheUserType;
use App\Form\UserType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use phpDocumentor\Reflection\DockBLock\Description;
use Doctrine\Common\Annotations\AnnotationRegistry; 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminUsersController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository){
        $this->repository = $repository;
    }

    
    /**
     * @Route("/admin/users", name="admin.users")
     */
    public function showAllUser(PaginatorInterface $paginator, Request $request)
    {
        $search = new RechercheUtilisateur();
        $form =  $this->createForm(RechercheUserType::class,$search);
        $form->handleRequest($request);
        $users = $paginator->paginate(
            $this->repository->findUser($search),
            $request->query->getInt('page', 1),10
        );

        return $this->render('admin/users/show.html.twig', [
            'users' => $users,
            'formSearch' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/add/user", name="admin.users.add")
     */
    public function addUser(Request $request,ObjectManager $manager)
    {
        $user = new User();

        $form=$this->createForm(UserType::class,$user);
        $form->handlerequest($request);
        $pageTitle = "Ajouter un utilisateur";
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('admin.users');
        }
        
        return $this->render('admin/users/add.html.twig',[ 
            'formUser' => $form->createView(),
            'pageTitle' => $pageTitle
        ]);

    }

     /**
   * @Route("/admin/user/{id<\d+>}/edit", name="admin.user.edit")
   */
  public function editUser(User $user, Request $request, ObjectManager $manager)
  {
    if (!$user) {
       $user = new Produit();
    }
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
        //$manager->persist($produit);
      $manager->flush();
      $this->addFlash('success',"bien modifié !");
      return $this->redirectToRoute('admin.users');//, ['id' => $produit->getId()]);
    }
    return $this->render('admin/users/edit.html.twig', [
    'formUser' => $form->createView()



    ]);
  }

     /**
     * @Route("/admin/user/{id}/delete", name="admin.user.delete")
     */
    public function deleteUser(User $user, ObjectManager $manager )

    {

        //dump("suppression");

        $manager->remove($user);

        $manager->flush();

        $this->addFlash('success',"bien supprim� !");

        //return new Response("Suppression");

        return $this->redirectToRoute('admin.users');

    }

}
