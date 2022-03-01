<?php

namespace App\Controller;

use App\Entity\Commentaires;
use App\Entity\JeuxQuizz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CommentairesType;
use App\Repository\CommentairesRepository;
use Symfony\Component\Security\Core\Security;
use DateTimeImmutable;

class ForumController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
    }
    
    /**
     * @Route("/forum-geographie-capitale/{id}", name="forum_geographie_capitale")
     */
    public function index(JeuxQuizz $jeuxQuizz, CommentairesRepository $commmentairesRepository, Request $request): Response
    {
        //On créé le commentaire "vierge"
        $commentaire = new Commentaires;

        //On génère le formulaire
        $form = $this->createForm(CommentairesType::class, $commentaire);
        $user = $this->security->getUser();

        $form->handleRequest($request);

        //Traitement du formulaire
        if($form->isSubmitted() && $form->isValid()) {
            $commentaire->setCreatedAt(new DateTimeImmutable());
            $commentaire->setUser($user);
            $jeuxQuizz->addCommentaire($commentaire);

            // On récupère le contenu du champ parentid
            $parentid = $form->get("parent")->getData();

            $em = $this->getDoctrine()->getManager();

            //On va chercher le commentaire correspondant
            if($parentid != null){
                $parent = $em->getRepository(Commentaires::class)->find($parentid);
            }

            // On définit le parent
            $commentaire->setParent($parent ?? null);

            $em->persist($commentaire);
            $em->flush();

            $this->addFlash('message', '✔️ Votre commentaire a bien été envoyé ! ✔️');

            return $this->redirectToRoute('forum_geographie_capitale', ['id' => $jeuxQuizz->getId()]);
        }

        return $this->render('forum/forumgeographiecapitale.html.twig', [
            'jeuxQuizz' => $jeuxQuizz,
            'commentaires' => $commmentairesRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
}
