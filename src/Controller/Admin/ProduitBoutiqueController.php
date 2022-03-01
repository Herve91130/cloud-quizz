<?php

namespace App\Controller\Admin;

use App\Entity\ProduitBoutique;
use App\Form\ProduitBoutiqueType;
use App\Repository\ProduitBoutiqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/produit/boutique")
 */
class ProduitBoutiqueController extends AbstractController

/**
 * @Route ("/admin")
 */

{
    /**
     * @Route("/liste-produit", name="produit_boutique_index", methods={"GET"})
     */
    public function index(ProduitBoutiqueRepository $produitBoutiqueRepository): Response
    {
        return $this->render('produit_boutique/index.html.twig', [
            'produit_boutiques' => $produitBoutiqueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/ajouter-produit", name="produit_boutique_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        // création de l'object article
        $produitBoutique = new ProduitBoutique();

        //création de l'objet formulaire sur la base de notre ArticleType qui ce trouve dans le dossier form
        // ensuite en le lie a notre object article , grâce a la fonction creatForm
        $form = $this->createForm(ProduitBoutiqueType::class, $produitBoutique);

        // on met notre formulaire a l'ecoute d'une reponse grâce a l'object Request
        $form->handleRequest($request);

        // en suite on test s'il y a eut validation du formulaire sur la vue
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // j'envoie à la bdd l'object $produitBoutique
            $entityManager->persist($produitBoutique);
            $entityManager->flush();

            // une fois fini je redirige vers ma page qui affuche la liste des article mise a jour
            return $this->redirectToRoute('produit_boutique_index');
        }

        // j'envoi la vue avec le formulaire viérge
        return $this->render('produit_boutique/new.html.twig', [
            'produit_boutique' => $produitBoutique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/produit/{id}", name="produit_boutique_show", methods={"GET"})
     */
    public function show(ProduitBoutique $produitBoutique): Response
    {
        return $this->render('produit_boutique/show.html.twig', [
            'produit_boutique' => $produitBoutique,
        ]);
    }

    /**
     * @Route("/produit/{id}/modifier", name="produit_boutique_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProduitBoutique $produitBoutique): Response
    {
        $form = $this->createForm(ProduitBoutiqueType::class, $produitBoutique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produit_boutique_index');
        }

        return $this->render('produit_boutique/edit.html.twig', [
            'produit_boutique' => $produitBoutique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/produit/{id}", name="produit_boutique_delete", methods={"POST"})
     */
    public function delete(Request $request, ProduitBoutique $produitBoutique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produitBoutique->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produitBoutique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit_boutique_index');
    }
}
