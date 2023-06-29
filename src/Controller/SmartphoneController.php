<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/', name: 'smartphone_')]
class SmartphoneController extends AbstractController
{

	#[IsGranted('ROLE_USER')]
	#[Route('/', name: 'identify')]
	public function index(): Response
	{
		return $this->render('smartphone/identify.html.twig');
	}
}
