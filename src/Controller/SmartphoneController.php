<?php

namespace App\Controller;

use App\Entity\Smartphone;
use App\Form\IdentifyType;
use App\Entity\IdentifySearch;
use App\Repository\ModelRepository;
use App\Service\CalculatePriceService;

use function PHPUnit\Framework\isEmpty;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/', name: 'smartphone_')]
class SmartphoneController extends AbstractController
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

	private const MOTIVATION_PHRASES = [
		"Reconditionnez des téléphones, changez des vies.",
		"Donnez une seconde chance aux smartphones, donnez de l'espoir.",
		"Transformez des gadgets en opportunités d'inclusion numérique.",
		"Votre travail fait le lien entre la technologie et l'inclusion sociale.",
		"Revalorisez des téléphones pour offrir l'accès à tous.",
		"En reconditionnant des smartphones, vous créez des sourires et des opportunités.",
		"Votre expertise en reconditionnement crée des ponts numériques pour les plus démunis.",
		"Changer des vies grâce aux smartphones reconditionnés, un appareil à la fois.",
		"Faites partie du changement en donnant un accès équitable à la technologie.",
		"Votre travail soutient l'inclusion numérique et ouvre des portes vers un avenir meilleur."
	];

	#[IsGranted('ROLE_USER')]
	#[Route('/', name: 'identify')]
	public function index(Request $request): Response
	{
		$motivationPhrase = $this->getRandomMotivationPhrase();
		$identifySearch = new IdentifySearch();
		$form = $this->createForm(IdentifyType::class, $identifySearch);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$params = [];
			if (!empty($identifySearch->getModel())) {
				$params += ['id_model' => $identifySearch->getModel()->getId()];
			}
			if (!empty($identifySearch->getImeiNumber()) && is_numeric($identifySearch->getImeiNumber())) {
				$params = ['imei' => $identifySearch->getImeiNumber()];
			}
			return $this->redirectToRoute('app_caracteristique', $params, Response::HTTP_SEE_OTHER);
		}
		return $this->render('smartphone/identify.html.twig', [
			'form' => $form,
			'motivationPhrase' => $motivationPhrase,
		]);
	}

	#[IsGranted('ROLE_USER')]
	#[Route('/smartphone/resultat/{id}', name: 'smartphone_result')]
	public function showResult(Smartphone $smartphone, ModelRepository $modelRepository, CalculatePriceService $calculatePriceService): Response
	{
		$categoryLabel = $calculatePriceService->getPriceCategory($smartphone);
		$congratulationsPhrase = $this->getRandomCongratulationsPhrase();

		return $this->render('smartphone/result.html.twig', [
			'categoryLabel' => $categoryLabel,
			'smartphone' => $smartphone,
			'congratulationsPhrase' => $congratulationsPhrase,
		]);
	}

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

	private function getRandomMotivationPhrase(): string
	{
		$randomIndex = array_rand(self::MOTIVATION_PHRASES);
		$motivationPhrase = self::MOTIVATION_PHRASES[$randomIndex];
		return $motivationPhrase;
	}


	private function getRandomCongratulationsPhrase(): string
	{
		$randomIndex = array_rand(self::CONGRATULATIONS_PHRASES);
		$congratulationsPhrase = self::CONGRATULATIONS_PHRASES[$randomIndex];
		return $congratulationsPhrase;
	}
}
