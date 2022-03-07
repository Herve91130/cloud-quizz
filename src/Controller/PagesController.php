<?php
namespace App\Controller;

use App\Entity\JeuxQuizz;
use App\Entity\User;
use App\Form\EditProfileType;
use App\Repository\CommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ThemeQuizzRepository;
use App\Repository\ProduitBoutiqueRepository;
use App\Repository\JeuxQuizzRepository;
use App\Repository\QuestionQuizzRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PagesController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(ThemeQuizzRepository $themeQuizzRepository): Response
    {
        return $this->render('pages/home.html.twig', [
            'theme_quizzs' => $themeQuizzRepository->findAll(),
        ]);
    }

    /**
     * @Route("/info", name="aproposdenous")
     */
    public function aproposdenous(): Response
    {
        return $this->render('pages/aproposdenous.html.twig');
    }

    /**
     * @Route("/boutique", name="boutique")
     */
    public function boutique(ProduitBoutiqueRepository $ProduitBoutiqueRepository): Response
    {
        return $this->render('pages/boutique.html.twig', [
            'produit_boutiques' => $ProduitBoutiqueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/offres", name="offrepremium")
     */
    public function offrepremium(): Response
    {
        return $this->render('pages/offrepremium.html.twig');
    }

    /**
     * @Route("/jeux/geographie", name="geographie")
     */
    public function geographie(JeuxQuizzRepository $jeuxQuizzRepository): Response
    {
        return $this->render('pages/jeux/geographie/geographie.html.twig', [
            'jeux_quizzs' => $jeuxQuizzRepository->findAll(),
        ]);
    }

    /**
     * @Route("/moncompte", name="moncompte")
     */
    public function moncompte(CommandeRepository $commandeRepository): Response

    {
        $user = $this->getUser();
        
        return $this->render('pages/moncompte.html.twig', [
            'commandes' => $commandeRepository->find($user),
        ]);
    }

    /**
     * @Route("/moncompte/modifier", name="modifiermoncompte")
     */
    public function modifiermoncompte(Request $request)
    {
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_USER')) 
        {
            throw $this->createAccessDeniedException('Impossible d’accéder à cette page !');
        }
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', '✔️ Informations personnelles mises à jour ✔️');
            return $this->redirectToRoute('moncompte');
        }

        return $this->render('pages/modifiermoncompte.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/moncompte/modifier/motdepasse", name="modifiermotdepasse")
     */
    public function modifiermotdepasse(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if($request->isMethod('POST')){
            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();

            // On vérifie si les 2 mots de passe sont identiques
            if($request->request->get('editpassword') == $request->request->get('editpassword2')){
                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('editpassword')));
                $em->flush();
                $this->addFlash('message', '✔️ Mot de passe mis à jour ✔️');

                return $this->redirectToRoute('moncompte');
            }else{
                $this->addFlash('error', '❌ Les deux mots de passe ne sont pas identiques ❌');
            }
        }
        
        return $this->render('pages/modifiermotdepasse.html.twig');
    }

    /**
     * @Route("/jeux/geographie/capitale", name="geographie_capitale")
     */
    public function geographiecapitale(): Response
    {
        return $this->render('pages/jeux/geographie/geographie_capitale.html.twig');
    }

    /**
     * @Route("/CGU", name="CGU")
     */
    public function mentionscgu(): Response
    {
        return $this->render('pages/cgu.html.twig');
    }

    /**
     * @Route("/politiquedeconfidentialite", name="conf")
     */
    public function conf(): Response
    {
        return $this->render('pages/conf.html.twig');
    }

    /**
     * @Route("/jeux/quizz/{id}/details", name="quizz_details")
     */
    public function quizzDetails(JeuxQuizz $quizz, QuestionQuizzRepository $questionQuizzRepository): Response
    {
        $questions = $questionQuizzRepository->findBy([
            'jeux_quizz' => $quizz
        ]);
        
        return new JsonResponse([
            'id' => $quizz->getId(),
            'name' => $quizz->getJeux(),
            'count' => count($questions),
            'question' => [
                'id' => $questions[0]->getId(),
                'text' => $questions[0]->getQuestion(),
                'choices' => [
                    $questions[0]->getChoix1(),
                    $questions[0]->getChoix2(),
                    $questions[0]->getChoix3(),
                    $questions[0]->getChoix4()
                ],
                'answer' => $questions[0]->getReponse()
            ]
        ]);
    }

    /**
     * @Route("/jeux/quizz/{id}/questions/{questId}/next", name="quizz_next")
     */
    public function quizzQuestionSuivante(JeuxQuizz $quizz, QuestionQuizzRepository $questionQuizzRepository, int $questId): Response
    {
        $questions = $questionQuizzRepository->findBy([
            'jeux_quizz' => $quizz
        ]);

        $questionSuivante = null;

        $count = count($questions);

        for ($i = 0; $i < $count; ++$i) {

            if ($questions[$i]->getId() == $questId) {

                $questionSuivanteIndex = $i + 1;

                if ($questionSuivanteIndex < $count) {

                    $questionSuivante = $questions[$questionSuivanteIndex];
                }
                break;
            }
        }
        
        if ($questionSuivante) {
            return new JsonResponse([
                'id' => $questionSuivante->getId(),
                'text' => $questionSuivante->getQuestion(),
                'choices' => [
                    $questionSuivante->getChoix1(),
                    $questionSuivante->getChoix2(),
                    $questionSuivante->getChoix3(),
                    $questionSuivante->getChoix4()
                ],
                'answer' => $questionSuivante->getReponse()
            ]);
        }
        
        return new JsonResponse(null);
    }
}
