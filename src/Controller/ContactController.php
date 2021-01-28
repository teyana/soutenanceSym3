<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $contact = new Contact;

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('new_contact');
        }
        
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    
    
    }

    /**
     * @Route("/new_contact", name="new_contact")
     *
     * @return Response
     */
    public function new(){

        return $this->render('contact/new.html.twig');
     }
}
