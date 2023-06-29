<?php

namespace App\Service;

use App\Entity\Smartphone;

class CalculateCarbonService
{
	/*
	Pour calculer l’empreinte carbone des réseaux mobiles, il faut s’intéresser à la production de CO2 générée par la consommation des données mobiles. 
	Selon l’Ademe, au 1er janvier 2022, un utilisateur de téléphone cellulaire émet environ 49,4g équivalent CO2 /Go consommé.
	En moyenne, un usager mobile consomme 11,6 Go de data par mois d’après l’ARCEP. Cela représente 573,94 g de CO2 rejeté par mois, 
	soit 6,876 kg sur l’année. À titre de comparaison, c’est l’équivalent des émissions induites par 35 km en voiture (calcul réalisé grâce à l’outil « Mon Convertisseur CO2 » de l’Ademe).
	*/
	const CARBONNE_BY_YEAR = 6876; //en gramme

	public function getCarbonne(Smartphone $smartphone): int
	{
		if ($smartphone->getYearManufacture() > 0) {
			$separateYears =  (int)date("Y") - $smartphone->getYearManufacture();
			return self::CARBONNE_BY_YEAR * $separateYears;
		} else {
			return self::CARBONNE_BY_YEAR;
		}
	}
}
