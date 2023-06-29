<?php

namespace App\Twig\Components;

use App\Entity\IdentifySearch;
use App\Form\IdentifyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('formIdentify')]
class BrandLinkModel  extends AbstractController
{
	use ComponentWithFormTrait;
	use DefaultActionTrait;

	protected function instantiateForm(): FormInterface
	{
		return $this->createForm(IdentifyType::class);
	}
}
