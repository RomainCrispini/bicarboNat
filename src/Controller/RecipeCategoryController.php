<?php

namespace App\Controller;

use App\Entity\RecipeCategory;
use App\Form\RecipeCategoryType;
use App\Repository\RecipeCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeCategoryController extends AbstractController
{
    #[Route('/categories', name: 'recipe_category', methods: ['GET', 'POST'])]
    public function index(RecipeCategoryRepository $repo, Request $request, EntityManagerInterface $manager): Response
    {
        $categories = $repo->findAll();
        $count = $repo->getCount();

        $category = new RecipeCategory;
        $form = $this->createForm(RecipeCategoryType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            //dd($category);
            $manager->persist($category);
            $manager->flush();

            // AJOUTER MESSAGE FLASH SUCCES

            return $this->redirectToRoute('recipe_category');
        } else {
            // AJOUTER MESSAGE FLASH ERREUR
        }

        return $this->render('admin/recipe_category.html.twig', [
            'categories' => $categories,
            'compte' => $count,
            'form' => $form->createView()
        ]);
    }


    public function edit()
    {
    }







    #[Route('/categorie/nouvelle', name: 'recipe_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $category = new RecipeCategory;
        $form = $this->createForm(RecipeCategoryType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dd($form->getData());
        }

        return $this->render('admin/recipe_category_new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
