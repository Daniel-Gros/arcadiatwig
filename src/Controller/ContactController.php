<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {



            // A configurer une fois le mail et les mails employés créés

            // $contactData = $form->getData();

            // $email = (new Email())
            //     ->from($contactData['email'])
            //     ->to('employe@zoo.fr') 
            //     ->subject('Nouveau message de contact')
            //     ->text(
            //         sprintf(
            //             "Nom: %s\nEmail: %s\nMessage: %s",
            //             $contactData['name'],
            //             $contactData['email'],
            //             $contactData['message']
            //         )
            //     );

            // // Envoyez l'email
            // $mailer->send($email);


            // afficher un message de succès

            $this->addFlash('success', 'Votre message a bien été envoyé !');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}
