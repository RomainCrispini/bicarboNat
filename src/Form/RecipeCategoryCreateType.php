<?php

namespace App\Form;

use App\Entity\RecipeCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;

class RecipeCategoryCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'required' => true,
                    'minlength' => '3',
                    'minLengthMessage' => 'test',
                    'maxlength' => '50',
                ],
                'label' => 'Nom',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50])
                    // new Assert\NotBlank(),
                    // new Assert\Unique()
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecipeCategory::class
        ]);
    }
}
