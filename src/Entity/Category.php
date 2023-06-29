<?php

namespace App\Entity;


class Category
{
	public const CATEGORIES_PRICE_INTERVAL = [
		['code' => '1-HC', 'valMin' => 0, 'valMax' => 20],
		['code' => '2-C', 'valMin' => 21, 'valMax' => 40],
		['code' => '3-B', 'valMin' => 41, 'valMax' => 60],
		['code' => '4-A', 'valMin' => 61, 'valMax' => 80],
		['code' => '5-Premium', 'valMin' => 81, 'valMax' => 1000000]
	];

	public static function getCode(float $price): string
	{
		$returnCode = '';

		foreach (self::CATEGORIES_PRICE_INTERVAL as $itemCateg) {
			if ($price >= $itemCateg['valMin'] && $price <= $itemCateg['valMax']) {
				$returnCode = $itemCateg['code'];
				break;
			}
		}
		return $returnCode;
	}
}
