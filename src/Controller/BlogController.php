<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/', name: 'app_hello')]
    public function hello(): Response
    {
        return new Response("Hello World")
        ;
    }
    #[Route('/blog/{id}/{name}', requirements: ["name" => "[a-zA-Z]{3,50}", "id" => "[0-9]{1,50}"], name: 'app_blog')]
    public function index(int $id, string $name): Response
    {
        return $this->render('blog/index.html.twig', [
            'id' => $id,
            'name' => $name,
            'controller_name' => 'BlogController',
        ]);
    }
}
