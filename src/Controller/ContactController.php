<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $data = $form->getData();


            $contactData = $form->getData();

            $email = (new Email())
                ->from($contactData['email'])
                ->to($this->getParameter('contact_email_recipient'))
                ->subject('Nouveau message de contact')
                ->text(
                    sprintf(
                        "Nom: %s\nEmail: %s\nMessage: %s",
                        $contactData['nom'],
                        $contactData['email'],
                        $contactData['message']
                    )
                );

            $mailer->send($email);



            $this->addFlash('success', 'Votre message a bien été envoyé !');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}
