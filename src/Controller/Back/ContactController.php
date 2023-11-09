<?php 

namespace App\Controller\Back;

use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController
{
    
    /**
     * Route to get all 'contact forms' posted
     *
     * @Route("/bo/contact/list", name="app_back_contacts", methods="GET")
     */
    public function viewContact(ContactRepository $contactRepository)
    {
        $contacts = $contactRepository->findAll();
        $groupContact = [];

        foreach($contacts as $contact){
            $email = $contact->getEmail();
            // verify if in array, email key doesn't exist.
            if(!isset($groupContact[$email])){
                // we create a new array from this email key
                $groupContact[$email] = [];
            }
            // then add the data to the corresponding emplacement
            $groupContact[$email][] = $contact;
        }

        return $this->render('/back/contact-list.html.twig', ['groupContact' => $groupContact ]);
    }

    /**
     * @Route("/bo/contact/list/{id<\d+>}", name="app_back_contact_checked")
     */
    public function checkContact($id=null, ContactRepository $contactRepository)
    {
        if($id === null){
            throw $this->createNotFoundException('Not Found');
        }
        $contactQuestion = $contactRepository->find($id);
        $contactQuestion->setIsChecked();
        $contactRepository->add($contactQuestion, true);
        
        return $this->redirectToRoute('app_back_contacts', ['question'=>$contactQuestion], Response::HTTP_SEE_OTHER);
    }
}