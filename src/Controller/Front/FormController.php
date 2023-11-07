<?php

namespace App\Controller\Front;

use App\Entity\Form;
use App\Form\FormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormController extends AbstractController
{
    /**
     * @Route("/", name="app_front_home", methods="GET")
     */
    public function displayHome()
    {
        return $this->render('front/home.html.twig');
    }


    /**
     * @Route("/form", name="app_front_form", methods={"GET", "POST"})
     */
    public function displayAndSubmitForm(Request $request, EntityManagerInterface $entityManager)
    {
        $formModel = new Form();
        
        $form = $this->createForm(FormType::class, $formModel); 

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($formModel);
            $entityManager->flush();
            return $this->redirectToRoute('app_front_home', [], Response::HTTP_CREATED);
        }

        return $this->render('front/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
