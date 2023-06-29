<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Model;
use App\Entity\Smartphone;
use App\Form\SmartphoneType;
use App\Service\CalculatePriceService;
use App\Repository\SmartphoneRepository;
use App\Service\CalculateCarbonService;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CaracteristiqueController extends AbstractController
{
    #[Route('/caracteristique/{imei}{model}', name: 'app_caracteristique')]
    public function index(): Response
    {
        return $this->render('caracteristique/index.html.twig');
    }

    #[Route('/new/{imei}{model}', name: 'app_caracteristique_new', methods: ['GET', 'POST'])]
    public function new(?string $imei, ?Model $model, CalculatePriceService $calculatePriceService, CalculateCarbonService $calculateCarbonService, Request $request, SmartphoneRepository $smartphoneRepository, Security $security): Response
    {
        $smartphone = new Smartphone();
        /** @var User $user */
        $user = $security->getUser();
        $smartphone->setOperator($user);
        if (!empty($model)) {
            $smartphone->setModel($model);
        }




        $form = $this->createForm(SmartphoneType::class, $smartphone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calculatePrice = $calculatePriceService->getCalulatePrice($smartphone);
            $smartphone->setCalculatePrice($calculatePrice);
            $calculateCarbon = $calculateCarbonService->getCarbonne($smartphone);
            $smartphone->setRateCo2($calculateCarbon);
            $user->setLevel($user->getLevel() + 1);
            $smartphoneRepository->save($smartphone, true);

            return $this->redirectToRoute('app_caracteristique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('caracteristique/new.html.twig', [
            'smartphone' => $smartphone,
            'form' => $form,
        ]);
    }
}
