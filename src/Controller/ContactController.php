<?php

namespace App\Controller;

use App\Services\CategoriesServices;
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
    public function index(): Response
    {
        $form = $this ->createFormBuilder()
                      ->add("Email", EmailType::class, [
                        "label" => "Votre Email",
                        "attr" => [
                            "placeholder" => "Votre Email",
                            "class" => "form-group"
                        ],
                        "row_attr" => [
                            "class" => "form-group"
                        ]
                      ])
                      ->add("Subject", TextType::class, [
                        "label" => "Votre Object",
                        "attr" => [
                            "placeholder" => "Votre sujet",
                            "class" => "form-group"
                        ],
                        "row_attr" => [
                            "class" => "form-group"
                        ]
                      ])
                      ->add("Message", TextareaType::class, [
                        "label" => "Votre message",
                        "attr" => [
                            "placeholder" => "Que voulez vous nous dire ?",
                            "class" => "form-group"
                        ],
                        "row_attr" => [
                            "class" => "form-group"
                        ]
                      ])
                      ->getForm()  
        ;
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'contact' => $form->createView()
        ]);
    }
}
