<?php

namespace App\Service;

use App\Entity\Smartphone;
use App\Repository\SmartphoneRepository;

class CalculatePriceService
{
	public const PARAM_CARETORGIES = [
		['valTotalMin' => 0, 'valTotalMax' => 89, 'category' => '1-HC'],
		['valTotalMin' => 90, 'valTotalMax' => 164, 'category' => '2-C'],
		['valTotalMin' => 165, 'valTotalMax' => 254, 'category' => '3-B'],
		['valTotalMin' => 255, 'valTotalMax' => 374, 'category' => '4-A'],
		['valTotalMin' => 375, 'valTotalMax' => 1000000, 'category' => '5-PREMIUM'],
	];

	public const PARAM_RAM = [
		['value' => 1, 'rank' => 30],
		['value' => 2, 'rank' => 40],
		['value' => 3, 'rank' => 54],
		['value' => 4, 'rank' => 60],
		['value' => 6, 'rank' => 64],
		['value' => 8, 'rank' => 68],
		['value' => 10, 'rank' => 70],
		['value' => 12, 'rank' => 74],
		['value' => 16, 'rank' => 78],
		['value' => 18, 'rank' => 82],
		['value' => 20, 'rank' => 84],
		['value' => 22, 'rank' => 86],
		['value' => 24, 'rank' => 90],
		['value' => 26, 'rank' => 02],
		['value' => 28, 'rank' => 94],
		['value' => 30, 'rank' => 96],
	];

	public const PARAM_STOCKAGE = [
		['value' => 8, 'rank' => 25],
		['value' => 16, 'rank' => 30],
		['value' => 32, 'rank' => 45],
		['value' => 16, 'rank' => 31],
		['value' => 64, 'rank' => 66],
		['value' => 128, 'rank' => 70],
		['value' => 256, 'rank' => 84],
		['value' => 512, 'rank' => 92],
		['value' => 1024, 'rank' => 110],
	];


	public function __construct(private SmartphoneRepository $smartphoneRepository)
	{
	}

	public function getPrice()
	{
	}

	public function getCategory()
	{
	}
}
