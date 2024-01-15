<?php

namespace App\Controller;

use App\Entity\RecipeCategory;
use App\Form\RecipeCategoryCreateType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RecipeCategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecipeCategoryController extends AbstractController
{
    #[Route('/categories', name: 'recipe_category', methods: ['GET', 'POST'])]
    public function index(RecipeCategoryRepository $repo, Request $request, EntityManagerInterface $manager): Response
    {
        $categories = $repo->findAll();
        $count = $repo->getCount();

        $category = new RecipeCategory;
        $formCreate = $this->createForm(RecipeCategoryCreateType::class, $category);
        //$formEdit = $this->createForm(RecipeCategoryEditType::class, $category);

        $formCreate->handleRequest($request);
        //$formEdit->handleRequest($request);


        if ($formCreate->isSubmitted() && $formCreate->isValid()) {
            $category = $formCreate->getData();
            //dd($category);
            $manager->persist($category);
            $manager->flush();

            // AJOUTER MESSAGE FLASH SUCCES AJOUT

            return $this->redirectToRoute('recipe_category');
        } else {
            // AJOUTER MESSAGE FLASH ERREUR AJOUT
        }

        return $this->render('admin/recipe_category.html.twig', [
            'categories' => $categories,
            'compte' => $count,
            'form_create' => $formCreate->createView()
            //'form_edit' => $formEdit->createView()
        ]);
    }


    #[Route('categories/suppression/{id}', name: 'recipe_category_delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, RecipeCategory $category): Response
    {
        $manager->remove($category);
        $manager->flush();

        // AJOUTER MESSAGE FLASH SUCCES SUPPRESSION A PASSER A LA VUE

        return $this->redirectToRoute('recipe_category');
    }


    #[Route('categories/modification/{id}', name: 'recipe_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $manager, RecipeCategory $category): Response
    {

        $form = $this->createForm(RecipeCategoryCreateType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $manager->persist($category);
            $manager->flush();

            //$this->addFlash(
            //    'warning',
            //    'Votre ingrédient a bien été modifié !'
            //);

            return $this->redirectToRoute('recipe_category');
        }

        return $this->render('admin/recipe_category_edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
