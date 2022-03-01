<?php


namespace App\Classes;

use App\Repository\ProduitBoutiqueRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class Panier {

    private $session;
    private $produitboutiquerepository;

    public function __construct(SessionInterface $session, ProduitBoutiqueRepository $produitboutiquerepository)
    {
        $this->session = $session;
        $this->produitboutiquerepository = $produitboutiquerepository;
    }

    /**
     * fonction qui ajoute un article au panier qui sera passé dans les paramètre de la function
     */
    public function add_article_panier($article) {

        // je créé un tableau

        $panier=$this->session->get('panier',[]);

        // je teste le panier pour voir si la variable existe

        if(!empty($panier[$article])) {

            // si elle existe je rajoute à la quantité 1

            $panier[$article] = $panier[$article] + 1;
        }else{

            // sinon je créé la demande avec une valeur de 1

            $panier[$article] = 1;
        }

        // je renvoi à l'obget session les nouvelle valeur du panier

        $this->session->set('panier', $panier);


    }

    /**
     * fonction qui retourne le panier
     */
    public function getPanier() {

        return $this->session->get('panier', []);
    }

    /**
     * fonction qui suppprime tout le panier
     */
    public function deletePanier() {

        $this->session->remove('panier');
    }

    /**
     * fonction qui supprime un article du panier par son id
     */
    public function deleteArticlePanier($id) 
    {
        // je vais get le panier
        $panier=$this->getPanier();

        // je vérifie si le produit existe
        if(!empty($panier[$id])) 
        {
            // si il existe, je le supprime
            unset($panier[$id]);
        }

        // je renvoi à l'obget session les nouvelle valeur du panier
        $this->session->set('panier', $panier);
    }

    /**
     * fonction qui ajoute 5 articles au panier
     */
    public function ajoute5() 
    {
        // je get le panier avec une méthode
        $panier=$this->getPanier();
        for ($i = 1 ; $i <= 5 ; $i++) 
        {
            $panier[$i] = 1 ;
        }

        // je renvoi à l'obget session les nouvelles valeurs du panier
        $this->session->set('panier', $panier);
    }

    /**
     * fonction qui retire 1 à la quantité d'un article
     */
    public function  deleteUneQuantite($id) 
    {
        // je get le panier avec une méthode
        $panier=$this->getPanier();

        // je test si la quantité est supérieure à 1
        if($panier[$id] > 1) 
        {
            // je retire 1 à la quantité
            $panier[$id] = $panier[$id] - 1 ;
        }else{

        // supprime l'article du panier
        unset($panier[$id]);
        }

        // je renvoi à l'obget session les nouvelles valeurs du panier
        $this->session->set('panier', $panier); 
    }

    /**
      * récupére le panier avec le détail des articles
      */

    public function getDetailPanier()
    {
        $panier=$this->getPanier();

        $detail_panier = [];

        foreach( $panier as $id=>$quantity)
        {
            $article=$this->produitboutiquerepository->find($id);
            
            $detail_panier[]=[
                'article'=>$article,
                'quantity'=>$quantity

            ];

        }

        return $detail_panier ;
    }

    /**
      * calculer le nombre d'articles dans le panier
      */

    public function getNombreArticlePanier() {
        $panier = $this->getDetailPanier();

        return count($panier);
    }  

    /**
      * prix totale du panier
      */

    public function getTotalePanier() {
        $panier = $this->getDetailPanier();
        
        $totale = 0;

        foreach ($panier as $item) {
            $prix = $item['article']->getPrix();
            $totale = $totale + ($item['quantity'] * $prix);
        }
        return $totale;
    } 
}