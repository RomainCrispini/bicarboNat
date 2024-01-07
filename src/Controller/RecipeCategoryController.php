<?php

namespace App\Controller;

use App\Repository\RecipeCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeCategoryController extends AbstractController
{
    #[Route('/categories', name: 'recipe_category', methods: ['GET'])]
    public function index(RecipeCategoryRepository $repo): Response
    {
        $categories = $repo->findAll();
        $count = $repo->getCount();
        return $this->render('admin/recipe_category.html.twig', [
            'categories' => $categories,
            'compte' => $count
        ]);
    }

    #[Route('/categorie/nouvelle', name: 'recipe_category.new', methods: ['GET', 'POST'])]
    public function new(): Response
    {
        return $this->render('admin/recipe_category_new.html.twig');
    }
}
