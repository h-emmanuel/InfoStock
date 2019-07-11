<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Detail;
use App\Entity\Produit;
use App\Entity\Commande;
use App\Entity\Payement;
use App\Form\PayementType;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier/addShow/{id}", name="panier.addShow")
     */

    public function ajouter($id, Request $request,ObjectManager $manager,ProduitRepository $repository)
    {
        $quantityTotal = 0;
        $session = $request->getSession();

        if (!$session->has('panier')) $session->set('panier', array());
        $panier = $session->get('panier');

        if (!isset($panier[$id])) {
            $panier[$id] = 1;
        } else {
            $panier[$id] += 1;
        }
        //$produits = $repository->findArrayById(array_keys($session->get('panier')));
        $client = $this->getUser();
        $commande = new Commande();
        $commande->setClient($client);
        $commande->setDate(new \DateTime());
        $details = [];
        foreach ($panier as $key => $value) {
            $detail = new Detail();
            $produit = $repository->findOneById($key);
            // dump($produit);
            $detail->setCommande($commande);
            $detail->setProduit($produit);
            $detail->setQcom($value);
            $details[] = $detail;
        }
        $session->set('panier', $panier);
        // dump($panier);
        $session->getFlashBag()->add('success', 'Article ajouté avec succès');
        // dump($details);
        return $this->render('panier/listermesproduits.html.twig', [
            'details' => $details,
        ]);

    }





     /**
     * @Route("/panier/addVitrine{id}", name="panier.addVitrine")
     */

    public function addVitrine($id, Request $request,ObjectManager $manager,ProduitRepository $repository)
    {
        $quantityTotal = 0;
        $session = $request->getSession();

        if (!$session->has('panier')) $session->set('panier', array());
        $panier = $session->get('panier');

        if (!isset($panier[$id])) {
            $panier[$id] = 1;
        } else {
            $panier[$id] += 1;
        }
        $client = $this->getUser();
        $commande = new Commande();
        $commande->setClient($client);
        $commande->setDate(new \DateTime());
        $details = [];
        foreach ($panier as $key => $value) {
            $detail = new Detail();
            $produit = $repository->findOneById($key);
            $detail->setCommande($commande);
            $detail->setProduit($produit);
            $detail->setQcom($value);
            $details[] = $detail;
        }
        $session->set('panier', $panier);
        $session->getFlashBag()->add('success', 'Article ajouté avec succès');
        return $this->render('panier/ls1.html.twig', [
            'details' => $details,
        ]);

    }


     /**
     * @Route("/panier/modif/{id}/Quantite/{quantite}", name="panier.modifQuantite")
     */

    public function modifQuantite($id,$quantite, Request $request,ObjectManager $manager,ProduitRepository $repository)
    {
        $quantityTotal = 0;
        $session = $request->getSession();
        $panier = $session->get('panier');
        $panier[$id] = $quantite;
        
        //$produits = $repository->findArrayById(array_keys($session->get('panier')));
        $client = $this->getUser();
        $commande = new Commande();
        $commande->setClient($client);
        $commande->setDate(new \DateTime());
        $details = [];
        foreach ($panier as $key => $value) {
            $detail = new Detail();
            $produit = $repository->findOneById($key);
            // dump($produit);
            $detail->setCommande($commande);
            $detail->setProduit($produit);
            $detail->setQcom($value);
            $details[] = $detail;
        }
        $session->set('panier', $panier);
        // dump($panier);
        $session->getFlashBag()->add('success', 'Article ajouté avec succès');
        // dump($details);
        return $this->render('panier/ls1.html.twig', [
            'details' => $details,
        ]);

    }


     /**
     * @Route("/panier/delete", name="panier.delete")
     */
    public function delete($id,$quantite, Request $request,ObjectManager $manager,ProduitRepository $repository)
    {
        $quantityTotal = 0;
        $session = $request->getSession();
        $panier = $session->get('panier');
        unset($panier[$id]);
        $client = $this->getUser();
        $commande = new Commande();
        $commande->setClient($client);
        $commande->setDate(new \DateTime());
        $details = [];
        foreach ($panier as $key => $value) {
            $detail = new Detail();
            $produit = $repository->findOneById($key);
            $detail->setCommande($commande);
            $detail->setProduit($produit);
            $detail->setQcom($value);
            $details[] = $detail;
        }
        $session->set('panier', $panier);
        $session->getFlashBag()->add('success', 'Article ajouté avec succès');
        return $this->render('panier/ls1.html.twig', [
            'details' => $details,
        ]);

    }


  /**
     * @Route("/panier/afficher", name="panier")
     */

    public function afficher(Request $request,ProduitRepository $repository)
    {
        $quantityTotal = 0;
        $session = $request->getSession();

        if (!$session->has('panier')) $session->set('panier', array());
        $panier = $session->get('panier');
        $client = $this->getUser();
        $commande = new Commande();
        $commande->setClient($client);
        $commande->setDate(new \DateTime());
        $details = [];
        foreach ($panier as $key => $value) {
            $detail = new Detail();
            $produit = $repository->findOneById($key);
            $detail->setCommande($commande);
            $detail->setProduit($produit);
            $detail->setQcom($value);
            $details[] = $detail;
        }
        $session->getFlashBag()->add('success', 'Article ajouté avec succès');
        return $this->render('panier/listermesproduits.html.twig', [
            'details' => $details,
        ]);

    }

 /**
     * @Route("/payer", name="payer")
     */

    public function payer (Request $request, ObjectManager $manager) 
    {
        $payement= new Payement();
        $form = $this->createForm(PayementType::class, $payement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($payement);
            $this->addFlash('success',"Payement accepter merci !");
            return $this->redirectToRoute('produits');
        }
        return $this->render('panier/payer.html.twig', [
            'formPayement' => $form->createView()
        ]);
    }


}


   

