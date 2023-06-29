<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/smartphone', name: 'smartphone_')]
class SmartphoneDetailsController extends AbstractController
{

	private const CONGRATULATIONS_PHRASES = [
		"Bravo pour offrir une nouvelle vie grâce à ce smartphone reconditionné ! Tu fais une réelle différence sociale !",
		"Ton expertise rend la technologie accessible à tous. Félicitations pour ton engagement social remarquable !",
		"Mission accomplie pour rendre la technologie plus accessible ! Tu es un acteur du changement social !",
		"Félicitations pour ton implication sociale ! Grâce à toi, ce téléphone offre une opportunité aux personnes en difficulté.",
		"Ton engagement pour la solidarité numérique est impressionnant ! Félicitations pour ton impact social positif !",
		"Félicitations pour ton implication en faveur de l'accessibilité technologique !",
		"Ton évaluation précise contribue à créer un monde plus équitable grâce à la technologie. Merci pour ton engagement social !",
		"Ton dévouement envers les personnes en difficulté est inspirant ! Félicitations pour ton impact social positif !",
		"Félicitations pour ton talent au service de l'inclusion ! Ton engagement social est source d'inspiration !",
		"Bravo pour ta contribution à la solidarité numérique ! Ton implication sociale est remarquable !"
	];

	#[IsGranted('ROLE_USER')]
	#[Route('/{id}', name: 'details')]
	public function showDetails($id): Response
	{
		// Récupérer les détails du téléphone portable avec l'ID donné

		// ...

		$congratulationsPhrase = $this->getRandomCongratulationsPhrase();
		return $this->render('smartphone/details.html.twig', [
			//'phoneDetails' => $phoneDetails,
			'congratulationsPhrase' => $congratulationsPhrase,
		]);
	}

	private function getRandomCongratulationsPhrase(): string
	{
		$randomIndex = array_rand(self::CONGRATULATIONS_PHRASES);
		$congratulationsPhrase = self::CONGRATULATIONS_PHRASES[$randomIndex];
		return $congratulationsPhrase;
	}
}
