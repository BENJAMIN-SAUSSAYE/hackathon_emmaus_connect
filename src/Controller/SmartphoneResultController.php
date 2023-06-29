<?php

namespace App\Controller;

use App\Repository\ModelRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SmartphoneResultController extends AbstractController
{
    #[Route('/smartphone/resultat', name: 'app_smartphone_result')]
    public function index(ModelRepository $modelRepository): Response
    {
        // $modelSmartphone = $modelRepository->findAll();

        return $this->render('smartphone_result/index.html.twig', [
            // 'modelSmartphone' => $modelSmartphone,
        ]);
    }
}
