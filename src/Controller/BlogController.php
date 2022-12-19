<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/', name: 'app_hello')]
    public function hello(ArticleRepository $repoArticle, CategoryRepository $repoCat): Response
    {
        $articles = $repoArticle->findAll();
        $categories = $repoCat->findAll();

        // dd($articles);

        return $this->render('blog/index.html.twig',[
            'controller_name' => 'BlogController',
            'articles' => $articles,
            'categories' => $categories,
        ]);

       
    ;

    // #[Route('/blog/{id}/{name}', requirements: ["name" => "[a-zA-Z]{3,50}", "id" => "[0-9]{1,50}"], name: 'app_blog')]
    // public function index(int $id, string $name): Response
    // {
    //     return $this->render('blog/index.html.twig', [
    //         'id' => $id,
    //         'name' => $name,
    //         'controller_name' => 'BlogController',
    //     ]);
    }
    #[Route('/article/{slug}', name: 'app_single_article')]
    public function single(ArticleRepository $repoArticle, string $slug, CategoryRepository $repoCat): Response
    {
        $article = $repoArticle->findOneBySlug($slug);
        $categories = $repoCat->findAll();


        // dd($articles);

        return $this->render('blog/single.html.twig',[
            'controller_name' => 'BlogController',
            'article' => $article,
            'categories' => $categories,
        ]);
}}
