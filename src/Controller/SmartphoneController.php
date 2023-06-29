<?php

namespace App\Controller;

use App\Entity\IdentifySearch;
use App\Form\IdentifyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/', name: 'smartphone_')]
class SmartphoneController extends AbstractController
{

	#[IsGranted('ROLE_USER')]
	#[Route('/', name: 'identify')]
	public function index(Request $request): Response
	{

		$identifySearch = new IdentifySearch();
		$form = $this->createForm(IdentifyType::class, $identifySearch);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			//dd($identifySearch);
			return $this->redirectToRoute('app_caracteristic', ['id_brand' => $identifySearch->getBrand()->getId()], Response::HTTP_SEE_OTHER);
		}
		return $this->render('smartphone/identify.html.twig', [
			'form' => $form,
		]);
	}
}
