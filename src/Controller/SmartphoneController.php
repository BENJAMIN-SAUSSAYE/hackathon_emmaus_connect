<?php

namespace App\Controller;

use App\Entity\Smartphone;
use App\Service\PdfService;
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

	#[Route('/pdf/{id}', name: 'pdf')]
	public function generatePdf(Smartphone $smartphone, PdfService $pdf)
	{
		$html = $this->render('smartphone/detail.html.twig', ['smartphone' => $smartphone]);
		$pdf->downloadPdfFile($html);
	}
}
