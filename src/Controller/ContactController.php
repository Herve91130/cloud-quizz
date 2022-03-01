<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Ressource\Views\Form;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, MailerInterface $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $contact = $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
            //On crée le mail
            $email = (new TemplatedEmail())
                ->from($contact->get('email')->getData())
                ->to('contact@cloud-quizz.fr')
                ->subject('Cloud Quizz contact')
                ->htmlTemplate('emails/contactindex.html.twig')
                ->context([
                    'nom' => $contact->get('nom')->getData(),
                    'prenom' => $contact->get('prenom')->getData(),
                    'mail' => $contact->get('email')->getData(),
                    'titre' => $contact->get('titre')->getData(),
                    'message' => $contact->get('message')->getData(),
                ]);
            //On envoie le mail
            $mailer->send($email);

            //On confirme et on redirige
            $this->addFlash('success', '✔️ Votre email a bien été envoyé. ✔️');

            return $this->redirectToRoute('contact');
        }

        return $this->render('pages/contact.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }
    
}