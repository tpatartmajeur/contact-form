<?php

namespace App\Controller\Front;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\ContactToJson;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/", name="app_front_home", methods="GET")
     */
    public function displayHome()
    {
        return $this->render('front/home.html.twig');
    }


    /**
     * @Route("/contact", name="app_front_contact", methods={"GET", "POST"})
     */
    public function displayAndSubmitContact(Request $request, EntityManagerInterface $entityManager, ContactToJson $contactToJson)
    {
        $contactModel = new Contact();
        
        $form = $this->createForm(ContactType::class, $contactModel); 
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($contactModel);
            $entityManager->flush();
            $contactToJson->add($contactModel);
            $this->addFlash('success', 'Votre question à été envoyée');
            return $this->redirectToRoute('app_front_home', [], Response::HTTP_CREATED);
        }

        return $this->render('front/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
