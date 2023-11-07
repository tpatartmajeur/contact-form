<?php 

namespace App\Controller\Back;

use App\Repository\FormRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class FormController extends AbstractController
{
    
    /**
     * Route to get all 'forms' posted
     *
     * @Route("/bo/forms", name="app_back_forms", methods="GET")
     */
    public function viewForms(FormRepository $formRepository)
    {
        return $this->render('/back/form-list.html.twig', ['forms' => $formRepository->findAll()]);
    }
}