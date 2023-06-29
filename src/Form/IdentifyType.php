<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\IdentifySearch;
use App\Entity\Model;
use App\Repository\BrandRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdentifyType extends AbstractType
{
	private FormFactoryInterface $factory;

	private $dependencies = [];

	public function __construct(private BrandRepository $brandRepository)
	{
	}
	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$this->factory = $builder->getFormFactory();

		$builder
			->add('brand', EntityType::class, [
				'class' => Brand::class,
				'required' => false,
				'choice_label'  => 'name',
				'placeholder' => 'Quelle marque ?',
				'attr' => [
					'class' => 'form-select form-select-lg mb-3 bg-light border-primary',
				],
			])
			->add(
				'imeiNumber',
				TextType::class,
				[
					'label' => 'Imei',
					'required' => false,
					'attr' => [
						'placeholder' => 'N° de Imei...',
						'class' => 'form-control fs-4 bg-light',
					],
				]
			);

		$builder->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'onPreSetData']);
		$builder->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmit']);

		$builder->get('brand')->addEventListener(FormEvents::POST_SUBMIT, [$this, 'storeDependencies']);
		$builder->get('brand')->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmitBrand']);
	}

	public function configureOptions(OptionsResolver $resolver): void
	{
		$resolver->setDefaults(['data_class' => IdentifySearch::class]);
	}

	public function onPreSetData(FormEvent $event): void
	{
		//the object tied to your Form
		/** @var ?IdentifySearch */
		$data = $event->getData();
		$this->addModelField($event->getForm(), $data?->getBrand());
	}

	public function onPostSubmit(FormEvent $event): void
	{
		$this->dependencies = [];
	}

	public function storeDependencies(FormEvent $event): void
	{
		$this->dependencies[$event->getForm()->getName()] = $event->getForm()->getData();
	}

	public function onPostSubmitBrand(FormEvent $event): void
	{
		$this->addModelField(
			$event->getForm()->getParent(),
			$this->dependencies['brand'],
		);
	}

	public function addModelField(FormInterface $form, ?Brand $brand): void
	{
		$models = null === $brand ? [] : $brand->getModels();

		//dd($brand);
		$model = $this->factory
			->createNamedBuilder('model', EntityType::class, $brand, [
				'class' => Model::class,
				'placeholder' => null === $brand ? 'Choisir une marque en premier' : sprintf('Quel model pour %s?', $brand->getName()),
				'choice_label' => 'name',
				'choices' => $models,
				'disabled' => null === $brand,
				// silence real-time "invalid" message when switching "Brand"
				'invalid_message' => false,
				'auto_initialize' => false,
				'attr' => [
					'class' => 'form-select form-select-lg mb-3 bg-light border-primary',
				],
			])
			->addEventListener(FormEvents::POST_SUBMIT, [$this, 'storeDependencies']);
		//->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmitModel']);

		$form->add($model->getForm());
	}

	/*
	public function addPizzaSizeField(FormInterface $form, ?Food $food): void
	{
		if (Food::Pizza !== $food) {
			return;
		}

		$form->add('pizzaSize', EnumType::class, [
			'class' => PizzaSize::class,
			'placeholder' => 'What size pizza?',
			'choice_label' => fn (PizzaSize $pizzaSize): string => $pizzaSize->getReadable(),
			'required' => true,
			'autocomplete' => true,
		]);
	}
	*/
}
