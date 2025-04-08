<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\Genre;
use App\Entity\Movie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $textImputCss = 'block w-full px-4 py-2 mt-1 text-gray-900 placeholder-gray-500 border border-gray-300 rounded-md shadow-sm focus:outline-none focus-ring-indigo-500 focus:border-indigo-500 sm:text-sm';
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'required' => false,
                'attr' => [
                    'class' => $textImputCss
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => [
                    'rows' => 3,
                    'class' => $textImputCss
                ]
            ])
            ->add('runtime', IntegerType::class, [
                'label' => 'Runtime',
                'required' => false,
                'attr' => [
                    'class' => $textImputCss
                ]
            ])
            ->add('budget', null, [
                'label' => 'Budget',
                'required' => false,
                'attr' => [
                    'class' => $textImputCss
                ]
            ])
            ->add('poster', null, [
                'label' => 'Poster',
                'required' => false,
                'attr' => [
                    'class' => $textImputCss
                ]
            ])
            ->add('release_date', DateType::class, [
                'label' => 'Release date',
                'widget' => 'single_text',
                'required' => false,
                'attr' => [
                    'class' => $textImputCss
                ]
            ])
            ->add('genre', null, [
                'label' => 'Genre',
                'attr' => [
                    'class' => 'block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-2'
                ]
            ])
            ->add('country', null, [
                'label' => 'Country',
                'attr' => [
                    'class' => 'block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
