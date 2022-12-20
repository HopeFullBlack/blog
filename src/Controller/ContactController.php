<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Services\CategoriesServices;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
     public function __construct(CategoriesServices $categoriesServices)
    {
        $categoriesServices->updateSession();
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, CategoryRepository $repoCat, EntityManagerInterface $em): Response
    {        
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);       
        $form->handleRequest($request);
        $session = $request->getSession();
        
        if($form->isSubmitted() && $form->isValid()){
            $contact->setCreatedAt(new \DateTimeImmutable());
            $em->persist($contact);
            $em->flush(); #flush permet de sauvegarder les infos en bdd
            $contact = new Contact();
            $form = $this->createForm(ContactType::class, $contact);       
            
            $session->getFlashBag()->add("message", "Message envoyé avec succés");
            $session->set('status',"success");

        }elseif($form->isSubmitted() && ! $form->isValid()){
            $session->getFlashBag()->add("message", "Un erreur est survenue");
            $session->set('status',"danger");
        }
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'contact' => $form->createView()
        ]);

        }
        
    }

