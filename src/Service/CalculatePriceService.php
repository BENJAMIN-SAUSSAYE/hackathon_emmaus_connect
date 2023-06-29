<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Smartphone;

class CalculatePriceService
{
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

	private const COEF_REGUL = 5;
	private float $finalPrice = 0.0;

	public function __construct(private Smartphone $smartphone)
	{
		$this->calculate();
	}

	public function getFinalPrice(): float
	{
		return $this->finalPrice;
	}

	public function getPriceCategory()
	{
		$category = new Category();
		return $category->getCode($this->getFinalPrice());
	}

	private function calculate()
	{
		$valRam = $this->getValRam($this->smartphone->getRamNumber());
		$valStock = $this->getValStock($this->smartphone->getStockageNumber());
		$basePrice = $this->smartphone->getBasePrice();
		$ponderation = $this->smartphone->getPonderation();

		$rate = (($valRam + $valStock) / self::COEF_REGUL);
		$intermediatePrice = floor($basePrice + ($basePrice * $rate) / 100);
		$this->finalPrice = $intermediatePrice + ($ponderation * $intermediatePrice / 100);
	}
	private function getValRam(int $ramNumber): int
	{
		$val = '';
		foreach (self::PARAM_RAM as $itemRam) {
			if ($itemRam['value'] === $ramNumber) {
				$val = $itemRam['rank'];
				break;
			}
		}
		return $val;
	}

	private function getValStock(int $stockageNumber): int
	{
		$val = '';
		foreach (self::PARAM_STOCKAGE as $itemStockage) {
			if ($itemStockage['value'] === $stockageNumber) {
				$val = $itemStockage['rank'];
				break;
			}
		}
		return $val;
	}
}
