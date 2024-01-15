<?php

namespace App\Form;

use App\Entity\RecipeCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RecipeCategoryEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'bg-gray-700 border border-gray-600 text-gray-400 text-sm rounded-lg focus:border-gray-200 block w-full p-2.5',
                    'required' => true,
                    'minlength' => '3',
                    'minLengthMessage' => 'test',
                    'maxlength' => '50',
                ],
                'label' => 'Catégories',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50])
                    // new Assert\NotBlank(),
                    // new Assert\Unique()
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'bg-gray-700 border border-gray-600 text-gray-400 text-sm rounded-lg focus:border-gray-200 block w-full p-2.5'
                ],
                'label' => 'Description'
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'bg-green-800 text-green-300 hover:bg-green-600 hover:text-green-300 rounded-md px-3 py-2 text-sm font-medium'
                ],
                'label' => 'Modifier'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecipeCategory::class,
        ]);
    }
}
