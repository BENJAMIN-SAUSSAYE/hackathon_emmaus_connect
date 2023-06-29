<?php

namespace App\Form;

use App\Entity\Smartphone;
use App\Service\CalculatePriceService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SmartphoneType extends AbstractType
{
    public function __construct(private CalculatePriceService $calculatePriceService){

    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'ramNumber',
                choiceType::class,
                [
                    'choices' => $this->calculatePriceService.get
                    'label' => "Mémoire vive",
                    'attr' => ["class" => ""],
                ]
            )
            ->add(
                'stockageNumber',
                RadioType::class,
                [
                    'label' => "Capacité de stockage",
                    'attr' => ["class" => ""],
                ]
            )
            ->add(
                'ponderation',
                RadioType::class,
                [
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
