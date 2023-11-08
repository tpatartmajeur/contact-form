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
        $forms = $formRepository->findAll();
        $groupForm = [];

        foreach($forms as $form){
            $email = $form->getEmail();
            // verify if in array, email key doesn't exist.
            if(!isset($groupForm[$email])){
                // we create a new array from this email key
                $groupForm[$email] = [];
            }
            // then add the data to the corresponding emplacement
            $groupForm[$email][] = $form->getQuestion();
        }

        return $this->render('/back/form-list.html.twig', ['groupForm' => $groupForm ]);
    }
}