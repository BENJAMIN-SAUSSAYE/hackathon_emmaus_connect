<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Model;
use App\Entity\Smartphone;
use App\Form\SmartphoneType;
use App\Service\CalculatePriceService;
use App\Service\CalculateCarbonService;
use App\Repository\ImeiDeviceRepository;
use App\Repository\ModelRepository;
use App\Repository\SmartphoneRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CaracteristiqueController extends AbstractController
{
    #[Route('/caracteristique', name: 'app_caracteristique')]
    public function index(): Response
    {
        return $this->render('caracteristique/index.html.twig');
    }

    #[Route('/new', name: 'app_caracteristique_new', methods: ['GET', 'POST'])]
    public function new(ModelRepository $modelRepository, ImeiDeviceRepository $imeiDeviceRepository, CalculatePriceService $calculatePriceService, CalculateCarbonService $calculateCarbonService, Request $request, SmartphoneRepository $smartphoneRepository): Response
    {
        $modelId = ($request->query->get('modelId')) ?? null;
        $imei = ($request->query->get('imei')) ?? null;
        $smartphone = new Smartphone();
        /** @var User $user */
        $user = $this->getUser();
        $smartphone->setOperator($user);

        if ($modelId !== null) {
            $model = $modelRepository->find($modelId);
            $smartphone->setModel($model);
            $smartphone->setBasePrice($model->getBasePrice());
        }
        if ($imei !== null) {
            $imeiDevice = $imeiDeviceRepository->findOneBy(['imei_number' => $imei]);

            $smartphone->setModel($imeiDevice->getModel());
            $smartphone->setBasePrice($imeiDevice->getModel()->getBasePrice());
            $smartphone->setScreenSize($imeiDevice->getScreenSize());
            $smartphone->setYearManufacture($imeiDevice->getYearManufacture());
            $smartphone->setNetworkSpeed($imeiDevice->getNetworkSpeed());
            $smartphone->setRamNumber($imeiDevice->getRamNumber());
            $smartphone->setStockageNumber($imeiDevice->getStockageNumber());
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
            return $this->redirectToRoute('smartphone_result', ["id" => $smartphone->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('caracteristique/new.html.twig', [
            'smartphone' => $smartphone,
            'form' => $form,
        ]);
    }
}
