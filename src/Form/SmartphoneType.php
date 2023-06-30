<?php

namespace App\Form;

use App\Entity\Smartphone;
use App\Service\CalculatePriceService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SmartphoneType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'ramNumber',
                choiceType::class,
                [
                    'choices' =>  [
                        8,
                        16,
                        32,
                        16,
                        64,
                        128,
                        256,
                        512,
                        1024
                    ],
                    'label' => "Mémoire vive",
                    'attr' => ["class" => ""],
                    'expanded' => true,
                    'multiple' => false,
                ]
            )
            ->add(
                'stockageNumber',
                ChoiceType::class,
                [

                    'choices' => [
                        8,
                        16,
                        32,
                        16,
                        64,
                        128,
                        256,
                        512,
                        1024
                    ],
                    'label' => "Capacité de stockage",
                    'attr' => ["class" => ""],
                    'expanded' => true,
                    'multiple' => false,
                ]
            )
            ->add(
                'ponderation',
                choiceType::class,
                [
                    'choices' => array_Flip(["rayé des deux côtés", "rayé à l'avant", "rayé à l'arrière", "bon état", "parfait état",]),
                    'label' => 'Pondération',
                    'attr' => ['class' => ''],
                ]
            )
            ->add(
                'comment',
                TextareaType::class,
                [
                    'label' => 'Commentaire',
                    'attr' => ['class' => ''],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Smartphone::class,
        ]);
    }
}
