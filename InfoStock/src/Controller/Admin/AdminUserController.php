<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Produit;
use App\Form\UserFormType;
use App\Form\Produit\ProduitType;
use App\Repository\UserRepository;
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

class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/user", name="admin_user")
     */
    public function showAllUser(UserRepository $repository)
    {
        $users = $repository->findAll();

        
        return $this->render('admin/users/show.html.twig', [
            'users' => $users,
            
        ]);
    }
    /**
     * @Route("/admin/add/user", name="admin.user.add")
     */
    public function addUser(Request $request,ObjectManager $manager)
    {
        $user = new User();

        $form=$this->createForm(UserFormType::class,$user);
        $form->handlerequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user->setRoles(array('role' => $role));
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('admin.users');
        }
        
        return $this->render('admin/users/add.html.twig',[ 
            'formUser' => $form->createView()
        ]);

    }
}
