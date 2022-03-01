<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitBoutiqueRepository;
use App\Entity\ProduitBoutique;
use App\Classes\Panier;

class PanierController extends AbstractController
{
    private $panier;

    public function __construct(Panier $panier)
    {
        $this->panier = $panier;
    }
    
    /**
     * @Route("/panier", name="panier")
     */
    public function index(Panier $panier): Response
    {
        $tab = $panier->getDetailPanier();
        
        return $this->render('panier/index.html.twig', [

            // je get le panier par la méthode getPanier de l'obget $panier
            'Panier' => $panier->getDetailPanier(),
            'nombre_article' => $panier->getNombreArticlePanier(),
            'totale_panier' => $panier->getTotalePanier(),
        ]);
    }

    /**
     * @Route("/ajouter-panier/{id}", name="add_article_panier")
     */
    public function addArticlePanier($id, Panier $panier, ProduitBoutique $produitboutique): Response
    {
        // j'appel notre méthode de notre class panier (add_article_panier)
        $panier->add_article_panier($id);

        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/supprimer-panier", name="delete_panier")
     */
    public function deleteToutPanier(Panier $panier): Response
    {
        // j'appel la function deletePanier de notre classe panier qui suprime tout le panier

        $panier->deletePanier();

        // et je redirige vers la vue du panier
        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/supprimer-panier/{id}", name="delete_article_panier")
     */
    public function deleteArticlePanier($id, Panier $panier): Response
    {
        // j'appel la function deletePanier de notre classe panier qui suprime tout les articles

        $panier->deleteArticlePanier($id);

        // et je redirige vers la vue du panier
        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/ajout-panier", name="add_5_panier")
     */
    public function add5joute5(Panier $panier): Response
    {
        // j'appel la function ajoute5 de notre classe panier qui ajoute 5 articles

        $panier->ajoute5();

        // et je redirige vers la vue du panier
        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/quantite-article/{id}", name="retire_une_quantite")
     */
    public function delete1Quantite($id, Panier $panier): Response
    {
        // j'appel la function deleteUneQuantite de notre classe panier qui retire une quantité à un article

        $panier->deleteUneQuantite($id);

        // et je redirige vers la vue du panier
        return $this->redirectToRoute('panier');
    }
}
