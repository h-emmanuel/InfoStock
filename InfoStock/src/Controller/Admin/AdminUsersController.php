<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\Produit\ProduitType;
use App\Repository\UserRepository;
use App\Repository\ProduitRepository;
use App\Entity\Recherche\RechercheUtilisateur;
use App\Form\RechercheUserType;
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
}
